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
	// wp_dequeue_style('wm-main'); // CSS Parent Theme
	// wp_dequeue_style('wm-custom'); // CSS parent & child theme (if child overrides parent)
  // wp_dequeue_script( 'wm-scripts-global' );
  // note: no need to dequeue 'wm-custom' because of this 'deps' => array( 'wm-main' )
}
 // add_action('wp_enqueue_scripts', 'rbtm_disable_parent_styles', 101);

// check filter of styles
add_filter('wmhook_wm_register_assets_register_styles', function($styles) {
   $reg_styles = array(
            // 'wm-style-b4css'  => array( wm_get_stylesheet_directory_uri( 'assets/css/bootstrap.css' ) ),
            'wm-style-b4css'  => array( 'src' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'),
            'fontawesome-css'  => array( 'src' => 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'),
            'nova-font'  => array( 'src' => 'http://site1.net/wp-content/plugins/jetpack/modules/custom-post-types/css/nova-font.css'),
            'main-style-min'  => array( wm_get_stylesheet_directory_uri( 'assets/css/main-style.min.css' ) ),
            // 'main-style-min'  => array( wm_get_stylesheet_directory_uri( 'assets/css/main.css' ) ),
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
    array_splice($enqueue, 2, 0, 'fontawesome-css' );
    array_splice($enqueue, 3, 0, 'nova-font' );
    array_splice($enqueue, 4, 0, 'main-style-min' );
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
            'wm-script-main-min'  => array( wm_get_stylesheet_directory_uri( 'assets/js/customjs/main.min.js' ), 'deps' => array( 'jquery' ) ),
            // 'wm-script-main-min'  => array( wm_get_stylesheet_directory_uri( 'assets/js/customjs/myfunctions.js' ), 'deps' => array( 'jquery' ) ),
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
    array_splice($enqueue, 6, 0, 'wm-script-main-min' );
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
add_action( 'after_setup_theme', 'wm_remove_menu_social', 0); //#1

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

function RBTM_hide_main_menu_content($mycontent) {
    if (is_main_query() && !is_feed() && is_page('menu'))
        $mycontent = '';
    return $mycontent;
}
// disable page "slug=menu" body content
add_filter('the_content', 'RBTM_hide_main_menu_content', 10, 1);


// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

//show food tags in single content

function RBTM_show_nova_menu_item_tag(){
      $a_terms=array_slice(get_the_terms(get_the_ID(), 'nova_menu_item_label'), 1, 10, false);
    if ($a_terms) {
        if (is_single()  && get_post_type()=='nova_menu_item' )  {
          echo '<footer class="entry-meta entry-meta-bottom">';
            echo '<span class="tags-links entry-meta-element" itemprop="keywords">';
            foreach ($a_terms as $trm) {
                 echo '<a href="'. esc_url(get_term_link($trm->term_id)).'">'.$trm->name.'</a>';
                 if($trm != end($a_terms)) echo ',';
            }
            echo '</span></footer>';
        }
    }
}
add_action('tha_entry_bottom','RBTM_show_nova_menu_item_tag',10,1);

// filter the nova_menu_item  page "slug=menu"

function RBTM_child_theme_food_menu_query( $query ) {
	if (
		class_exists( 'Nova_Restaurant' )
		&& ( isset( $query->query_vars['post_type'] ) && Nova_Restaurant::MENU_ITEM_POST_TYPE == $query->query_vars['post_type'] )
	) {
		$query->set( 'orderby', 'title' );
    $query->set('tax_query', array(
      array(
        'taxonomy'=>'nova_menu',
        'field'=> 'term_id',
        'terms'=>array(264),
        'include_children'=>true,
        'operator'=>'NOT IN',
      )
    ));
	}
}
add_action( 'pre_get_posts', 'RBTM_child_theme_food_menu_query' );


// Read More or Continue Reading...
function RBTM_change_readmore($readmore) {
    return str_replace('Continue reading', 'Read more', $readmore);
}
add_filter('wmhook_wm_excerpt_continue_reading', 'RBTM_change_readmore',11 ,1);

// Contact Form Custom Attribute
function RBTM_wpcf7_form_elements( $content ) {
  $str_pos = strpos( $content, 'name="sMButton-cattrib"' );
  $content = substr_replace( $content, ' data-backdrop="static" data-keyboard="true" ', $str_pos, 0 );
  return $content;
}
// add_filter( 'wpcf7_form_elements', 'RBTM_wpcf7_form_elements' );

/**
 * Functions which enhance the theme for templates in general by hooking into WordPress.
 */
require_once(get_stylesheet_directory(). '/includes/myfunc/tpl-func.php');

/**
 * Functions which enhance the theme & targets specific templates by hooking into Wordpress.
 */
require_once(get_stylesheet_directory() . '/includes/myfunc/specific-tpl-func.php');

/**
 * Functions for CMB2 plugin that creats custom fileds in metaboxes.
 */
require_once(get_stylesheet_directory() . '/includes/myfunc/my-cmb2.php');