
<?php
function RBTM_metafunc2($argtag){
//   if (is_single() && get_post_type()=='nova_menu_item' )
//        $argtag['meta'][]='tags';
   return $argtag;
}
// add_filter('wmhook_wm_post_meta_bottom_args', 'RBTM_metafunc2' , 20, 1);

function RBTM_metafunc1($out, $xx) {
    var_dump($xx);
     echo '<pre>getposttype: '.count($xx['meta']).'</pre>';
    if ((is_single() && count($xx['meta'])==1) && get_post_type()=='nova_menu_item' )  {
            $xx= array(
                '{class}' => 'tags-links entry-meta-element',
                '{attributes}' => '',
                '{description}' => '<span class="entry-meta-description">Written by: </span>',
                '{content}' => '<a href="http://site1.net/tag/carousel/" rel="tag">cartosel</a>',
            );

//            return $xx;
    }
    return $xx;
}
//add_filter('wmhook_wm_post_meta_replacements_tags', 'RBTM_metafunc1' , 20, 2);





function RBTM_my_func(){
  remove_action('pre_get_posts','wm_jetpack_food_menu_section_query', 10);
  remove_action('pre_get_posts','Featured_Content::pre_get_posts', 10);
  remove_action('init','Featured_Content::init', 30);
  // remove_action('init','WM_Nova_Restaurant::init', 10);
  // remove_action('parse_query','WM_Nova_Restaurant', 10); // to
  // remove_action('parse_query','WM_Nova_Restaurant–>sort_menu_item_queries_by_menu_order', 10); // to
    // remove_action('parse_query',array("WM_Nova_Restaurant", "sort_menu_item_queries_by_menu_order"), 1);
    // remove_action('parse_query',array("WM_Nova_Restaurant", "start_menu_item_loop"), 1);
    // remove_action('loop_start',array("WM_Nova_Restaurant", "start_menu_item_loop"), 10);
    // remove_action( 'init', array( 'WM_Nova_Restaurant', 'init' ), 10 );
    remove_action( 'wmhook_loop_content_type', 'wm_jetpack_food_menu_loop_content_type', 10 );
    remove_action( 'wmhook_loop_food_menu_postslist_before', 'wm_jetpack_food_menu_loop_section_display_menu_page', 10 );
    remove_action( 'after_setup_theme', 'wm_jetpack', 30 );
    // remove_action('parse_query',array("Nova_Restaurant", "sort_menu_item_queries_by_menu_order"), 10);

global $WM_Nova_Restaurant;
global $wp_filter;
remove_action('parse_query','WM_Nova_Restaurant', 80);
remove_action('parse_query', 'WM_Nova_Restaurant->sort_menu_item_queries_by_menu_order', 80);
remove_action('parse_query',array("WM_Nova_Restaurant", "sort_menu_item_queries_by_menu_order"), 80);
remove_action('parse_query', array("WM_Nova_Restaurant", "sort_menu_item_queries_by_menu_order"), 80);
remove_action('parse_query',array($WM_Nova_Restaurant, "sort_menu_item_queries_by_menu_order"), 80);
remove_action('Nova_Restaurant::init()', 'sort_menu_item_queries_by_menu_order');
remove_action('parse_query', array("Nova_Restaurant::init()", "sort_menu_item_queries_by_menu_order"));
$x=0;
   //do_hard_unregister_object_callback( 'parse_query', 10, 'WM_Nova_Restaurant');
}
 add_action('init', 'RBTM_my_func', 80);

function rbtm_preget_remove() {

remove_action('pre_get_posts','wm_posts_query_ignore_sticky_posts', 10);
remove_action('pre_get_posts','wm_jetpack_food_menu_section_query', 10);
// remove_action('pre_get_posts',array('Featured_Content', 'pre_get_posts'), 10);
remove_action('init','Featured_Content::init', 30);
remove_action('init','WM_Nova_Restaurant::init', 80);
}
add_action( 'init', 'rbtm_preget_remove' );
