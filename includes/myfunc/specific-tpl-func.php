<?php
/**
 * Functions which enhance the theme & targets specific templates by hooking into Wordpress.
 *
 * @package auberge-child
 * @subpackage auberge
 * @since 1.0
 */




/*
 * Hooks that display template parts in the frontpage
 */

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
   get_template_part( 'template-parts/content', 'gal_food' );
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
   get_template_part( 'template-parts/content', 'gal_place' );
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

function RBTM_testme() {
  if ( is_front_page() ) :
    get_template_part( 'template-parts/content', 'test' );
  endif;
}
 // add_action('shutdown', 'RBTM_testme', 10, 1);

function RBTM_package_cater() {
  if ( is_front_page()) :
    get_template_part( 'template-parts/content', 'query_sbox' );
  endif;
}
// add_action('shutdown', 'RBTM_package_cater', 10, 1);


 // add style class for type 'course_package' to fix display in content title & page title
 function RBTM_wm_post_title_defaults($mytitle) {
   if ( is_main_query() && !is_feed() && is_post_type_viewable('course_package') )
     $mytitle['class_container'] .= ' food-menu-item-header';

   if (is_main_query() && !is_feed() && is_page('menu') && get_the_id()=='1877' )
        $mytitle = '';
     return $mytitle;
 }
 add_filter('wmhook_wm_post_title_defaults', 'RBTM_wm_post_title_defaults', 10, 1 );



 //A function that is called from the Widget Sidebar

function RBTM_widg_sidebar_pod(  $params = array(
      'limit' => 5,
      'where' => array(
          'nova_menu.term_id != 264',
      ),
      'orderby' => 'post_date DESC',
  ) ) {
  $arg= array(
      'nova_menu.term_id != 264',
  );

  if (!isset($params)){
  $params = array(
      'limit' => 5,
      'where' => $arg,
      'orderby' => 'post_date DESC',
  );
}
  $mypod = pods( 'nova_menu_item' )->find( $params );
  $frag = "<ul>";
  // get page permalink of main menu = http://site1.net/menu/
  $menu_plink = get_permalink(1877);
  // Loop through the records returned
  while ( $mypod->fetch() ) {
     $frag .= '<li><mark class="unicode"></mark><a class="w-title" href="'.esc_url($mypod->display('guid')).'">'.$mypod->display( 'post_title' ).'</a>';
     $frag .= '<span><a href="'.esc_url($menu_plink).$mypod->display('nova_menu.slug' ).'">';
     $frag .= $mypod->display('nova_menu.name').'</a>'.'<small><i>'.date("F j, Y", strtotime($mypod->display('post_date_gmt'))).'</i></small></span>';
     $frag .= '</li>';
  }
  $frag .="</ul>";
  return  $frag;
}


?>
