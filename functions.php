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
	}
} // /CHILD_THEME_SLUG_parent_theme_options

// add_action( 'after_switch_theme', 'RBTM_CHILD_THEME_SLUG_parent_theme_options' );

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
            'wm-style-b4css'  => array( wm_get_stylesheet_directory_uri( 'assets/css/bootstrap.css' ) ),
    );
   //       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    $a =  array_slice($styles, 0, 3, true);
    $b =  $reg_styles; 
    $c =  array_slice($styles, 3, count($styles) - 1, true);    
    $styles = $a + $b  + $c;
//    var_dump($styles); die();
   return $styles;
}, 10, 1);

// enqueue the newly added style
add_filter('wmhook_wm_enqueue_assets_enqueue_styles', function($enqueue) {
    array_splice($enqueue, 3, 0, 'wm-style-b4css' );
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
    );
    $a =  array_slice($scripts, 0, 1, true);
    $b =  $reg_scripts; 
    $c =  array_slice($scripts, 1, count($scripts) - 1, true);    
    $scripts = $a + $b  + $c;
   return $scripts;
});


// enqueue the newly added script
add_filter('wmhook_wm_enqueue_assets_enqueue_scripts', function($enqueue) {
    array_splice($enqueue, 2, 0, array('wm-script-tether','wm-script-popper', 'wm-script-b4js') );
    array_splice($enqueue, 7, 0, 'wm-script-easing' );
//    var_dump($enqueue); die();
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
