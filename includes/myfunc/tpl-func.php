<?php
/**
 * Functions which enhance the theme for templates in general by hooking into WordPress.
 *
 * @package auberge-child
 * @subpackage auberge
 * @since 1.0
 */


// add body class
function RBTM_body_classes($classes) {
  // Adds a class whether a sidebar is in uses
    if (is_active_sidebar( 'sidebar') || is_active_sidebar('frontpage') || is_active_sidebar('footer')) {
      $classes[] = 'has-sidebar';
    } else {
      $classes[] = 'no-sidebar';
    }
    return $classes;
}
add_filter( 'body_class', 'RBTM_body_classes', 10, 1 );




function add_specific_menu_location_atts( $atts, $item, $args, $depth ) {
    // add class for each nav link & change href when pages switch from frontpage to any
    if( $args->theme_location == 'primary' ) {
      // add the desired attributes:
      $atts['class'] = 'menu-link-class';
    }
      // change menu links when not in frontpage for smooth scrolling 
      // If menu is Primary (#205) or Footer Quick Links (#271)
    if(!is_front_page() && ($args->theme_location == 'primary' || ($args->theme_location == '' && $args->menu->term_id == 271) )) {
      switch ($atts['href']) {
          case '#top':
              $atts['href'] = get_home_url();
              break;
          case '#services':
              $atts['href'] = get_home_url().'#services';
              break;
          case '#about-menu':
              $atts['href'] = get_home_url().'#about-menu';
              break;
          case '#about-chef':
              $atts['href'] = get_home_url().'#about-chef';
              break;
          case '#about-ambi':
              $atts['href'] = get_home_url().'#about-ambi';
              break;
          case '#cont-testi':
              $atts['href'] = get_home_url().'#cont-testi';
              break;
          case '#cont-loc':
              $atts['href'] = get_home_url().'#cont-loc';
              break;
          case '#mywork':
              $atts['href'] = get_home_url().'#mywork';
              break;
          default:
              break;
      }
//    
    }
    
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 4 );

?>
