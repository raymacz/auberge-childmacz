<?php
/**
 * Child theme functions
 *
 * @since    1.0.0
 * @version  1.0.0
 */

/**
 * Enqueue parent theme stylesheet
 *
 * This runs only if parent theme does not claim support for
 * `child-theme-stylesheet`, and so we need to enqueue this
 * child theme's `style.css` file ourselves.
 *
 * If parent theme supports `child-theme-stylesheet`, it enqueues
 * this child theme's `style.css` file automatically.
 *
 * @since    1.0.0
 * @version  1.0.0
 */


 // This will remove support for default child theme from parent's setup.php
  function rbtm_remove_child_theme_stylesheet() {
     remove_theme_support( 'child-theme-stylesheet' );
 }
 // add_action( 'after_setup_theme', 'rbtm_remove_child_theme_stylesheet', 11 );

// if theme support "child-theme-stylesheet" is removed , new custom styles can be loaded
function RBTM_CHILD_THEME_SLUG_parent_theme_style() {
	if ( ! current_theme_supports( 'child-theme-stylesheet' ) ) {
		// wp_enqueue_style( 'CHILD_THEME_SLUG-parent-style', get_template_directory_uri() . '/style.css' );
		// wp_enqueue_style( 'CHILD_THEME_SLUG-child-style', get_stylesheet_uri());
		$parent_style = 'rbtm-main-child';
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		 wp_enqueue_style( 'rbtm-stylesheet-child', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version'), false);
	}
} // /CHILD_THEME_SLUG_parent_theme_style
// add_action( 'wp_enqueue_scripts', 'RBTM_CHILD_THEME_SLUG_parent_theme_style', 999 );


/**
 * Copy parent theme options (customizer settings)
 *
 * This runs only during child theme activation,
 * and only when there are no child theme options saved.
 *
 * @since    1.0.0
 * @version  1.0.0
 */
function RBTM_CHILD_THEME_SLUG_parent_theme_options() {
	if ( false === get_theme_mods() ) {
		$parent_theme_options = get_option( 'theme_mods_' . get_template() );
		update_option( 'theme_mods_' . get_stylesheet(), $parent_theme_options );
                $x=0;
	}
} // /CHILD_THEME_SLUG_parent_theme_options

 add_action( 'after_switch_theme', 'RBTM_CHILD_THEME_SLUG_parent_theme_options' );

/**
 * Put your custom PHP code below...
 */

//========================== CUSTOM CHILD FUNCTIONS.PHP =========================


// disable parent theme styles
function rbtm_disable_parent_styles() {
	wp_dequeue_style('wm-main'); // CSS Parent Theme
	wp_dequeue_style('wm-stylesheet'); // CSS parent & child theme (if child overrides parent)
  // note: no need to dequeue 'wm-custom' because of this 'deps' => array( 'wm-main' )
}
 // add_action('wp_enqueue_scripts', 'rbtm_disable_parent_styles', 101);


// check filter of styles
add_filter('wmhook_wm_register_assets_register_styles', function($styles) {
   $reg_styles = array(
            // 'wm-style-b4css'  => array( wm_get_stylesheet_directory_uri( 'assets/css/bootstrap.css' ) ),
            'wm-style-b4css'  => array( 'src' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'),
    );
   //       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    $a =  array_slice($styles, 0, 0, true);
    $b =  $reg_styles;
    $c =  array_slice($styles, 1, count($styles) - 1, true);
    $styles = $a + $b  + $c;
   return $styles;
}, 10, 1);

// enqueue the newly added style
add_filter('wmhook_wm_enqueue_assets_enqueue_styles', function($enqueue) {
    array_splice($enqueue, 1, 0, 'wm-style-b4css' );
//    var_dump($enqueue);
   return $enqueue;
}, 10, 1);




// check filter of scripts
add_filter('wmhook_wm_register_assets_register_scripts', function($scripts) {

    // bootstrap 4 requirement
   $reg_scripts = array(
            'wm-script-tether'  => array( 'src' => '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js', 'deps' => array( 'jquery' ) ),
            'wm-script-popper'  => array( 'src' => '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 'deps' => array( 'jquery' ) ),
            'wm-script-b4js'    => array( 'src' => '//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', 'deps' => array( 'jquery' ) ),
            'wm-script-easing'  => array( wm_get_stylesheet_directory_uri( 'assets/js/vendor/jquery-easing/jquery.easing.min.js' ), 'deps' => array( 'jquery' ) ),
            'wm-script-myfunctions'  => array( wm_get_stylesheet_directory_uri( 'assets/js/myfunctions.js' ), 'deps' => array( 'jquery' ) ),
    );
    $a =  array_slice($scripts, 0, 1, true);
    $b =  $reg_scripts;
    $c =  array_slice($scripts, 1, count($scripts) - 1, true);
    $scripts = $a + $b  + $c;
   return $scripts;
});


// enqueue the newly added script
add_filter('wmhook_wm_enqueue_assets_enqueue_scripts', function($enqueue) {
    array_splice($enqueue, 0, 0, array('wm-script-tether','wm-script-popper', 'wm-script-b4js') );
    array_splice($enqueue, 5, 0, 'wm-script-easing' );
    array_splice($enqueue, 6, 0, 'wm-script-myfunctions' );
   return $enqueue;
}, 10, 1);

add_action('after_setup_theme', function() {
  /* note: Supported in other themes like Popper & Twentyseventeen
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
      'gallery',
      'audio',
    ) );
});


/**
 * Removes the Social Menu Display from the header. This is done if the header navigation content is too long.
 */

 function wm_remove_menu_social() {
     remove_action( 'tha_header_top', 'wm_menu_social', 130);
  //   echo "TESTER wm_remove_menu_social"; // this prints but remove action doesnt work.
 }

 //any of these hooks can be used & is loaded in order
add_action( 'after_setup_theme', 'wm_remove_menu_social', 0); //#1
//add_action( 'init', 'wm_remove_menu_social');  //#2
//add_action( 'wp_head', 'wm_remove_menu_social'); //#3


// =================
//
// add_action( 'wp_footer', function() {
//   global $wp_filter;
//   echo "<pre>" . var_dump( $wp_filter['after_setup_theme'] ) . "</pre>";
//   // echo "<pre>" . print_r($wp_filter, true) . "</pre>";
// });


function be_event_query( $query ) {

	if( $query->is_main_query() && !$query->is_feed() && !is_admin() && $query->is_post_type_archive( 'event' ) ) {
		$meta_query = array(
			array(
				'key' => 'be_events_manager_end_date',
				'value' => time(),
				'compare' => '>'
			)
		);
		$query->set( 'meta_query', $meta_query );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'meta_key', 'be_events_manager_start_date' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', '4' );
	}
}
//add_action( 'pre_get_posts', 'be_event_query' );



function RBTM_func_query_cpt( $query ) {

  if ( !is_admin() && $query->is_main_query() && $query->is_post_type_archive('course_package') && !$query->is_feed() ) {

     $query->set( 'post_type', array( 'post', 'my_custom_post_type') );
     return $query;

   }
 //or include in category
  if ( is_category('category-slug') && $query->is_main_query() ) {

     $query->set( 'post_type', 'my_custom_post_type' );
     return $query;

   }
}
//add_action( 'pre_get_posts', 'RBTM_func_query_cpt' );



// Frontpage Template

add_action('wmhook_content_primary_before', function(){
if ( is_front_page() && is_page() ) :
   get_template_part( 'template-parts/content', 'services' );
endif;
}, 10, 1);

add_action('wmhook_content_primary_before', function(){
if ( is_front_page() && is_page() ) :
   get_template_part( 'template-parts/content', 'menu' );
endif;
}, 10, 1);

add_action('wmhook_content_primary_before', function(){
if ( is_front_page() && is_page() ) :
   get_template_part( 'template-parts/content', 'gal' );
endif;
}, 10, 1);

add_action('wmhook_content_primary_before', function(){
if ( is_front_page() && is_page() ) :
   get_template_part( 'template-parts/content', 'chef' );
endif;
}, 10, 1);

add_action('wmhook_content_primary_after', function(){
if ( is_front_page() && is_page() ) :
   get_template_part( 'template-parts/content', 'ambience' );
endif;
}, 10, 1);

add_action('wmhook_content_primary_after', function(){
if ( is_front_page() && is_page() ) :
   get_template_part( 'template-parts/content', 'gal' );
endif;
}, 10, 1);

add_action('wmhook_content_primary_after', function(){
  if ( is_front_page() && is_page() ) :
    get_template_part( 'template-parts/content', 'testimonial' );
  endif;
}, 10, 1);

add_action('wmhook_content_primary_after', function(){
  if ( is_front_page() && is_page() ) :
    get_template_part( 'template-parts/content', 'loc' );
  endif;
}, 10, 1);


add_action('wmhook_content_primary_after', function(){
  if ( is_front_page() && is_page() ) :
    get_template_part( 'template-parts/content', 'work' );
  endif;
}, 10, 1);

add_action('shutdown', function(){
  if ( is_front_page() && is_page() ) :
    get_template_part( 'template-parts/content', 'query_sbox' );
  endif;
}, 10, 1);

// add post type 'course_package' to be able to display post meta in content
function RBTM_change_post_meta($mymeta) {
    // var_dump($mymeta);
    $mymeta[] = 'course_package';
    return $mymeta;
}

add_filter('wmhook_wm_post_meta_top_post_type', 'RBTM_change_post_meta',20, 1);


// add meta price for post type 'course_package'
function RBTM_change_content_title($mytitle) {
    if ( 'course_package' === get_post_type() ) {
        $mystr = '<a href="';
        $mystr .= esc_url( get_permalink() );  //.http://site1.net/item/classic-burger/
        $mystr .= '"><span class="food-menu-item-title">'.get_the_title().'</span>';
        $mystr .= '<span class="food-menu-item-price"> $'. strip_tags( get_post_meta( get_the_ID(), "package_price", true ) ).'</span>';
        $mystr .= '</a>';
        $mytitle['title'] = $mystr;
//        $mytitle['title'] = '<a href="http://site1.net/item/classic-burger/"><span class="food-menu-item-title">CLASSIC BURGER</span><span class="food-menu-item-price"> $5</span></a>';
    } 
//         var_dump($mytitle);
    return $mytitle;
}

add_filter('wmhook_wm_post_title_args', 'RBTM_change_content_title',10, 1);


// add style class for type 'course_package' to fix display in content
function RBTM_wm_post_title_defaults($mytitle) {
    $mytitle['class_container'] .= ' food-menu-item-header';
    return $mytitle;
}

add_filter('wmhook_wm_post_title_defaults', 'RBTM_wm_post_title_defaults', 10, 1 );