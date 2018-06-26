<?php
/**
 * Custom page template
 *
 * Template Name: Package menu
 *
 * Displays page content followed by food menu items.
 *
 * @package    Auberge
 * @author     Raymacz
 *
 * @since    1.0
 * @version  2.0
 */

/* translators: Custom page template name. */
__( 'Package menu', 'auberge' );





get_header();

	?>

	<section class="archives-listing content-container menupack">
		<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
                        while ( have_posts() ) : the_post();
                            // change the default title display text
                            $archtitle =  '<h1 class="page-title">';
                            $archtitle .= get_the_title().wm_paginated_suffix( 'small' );
    //                        $archtitle .= 'TEST TITLE';
                            $archtitle .= '</h1>';
                            print $archtitle;
                            print '<div class="taxonomy-description">'.'<p>'.get_the_content().'</p>'.'</div>';
                        endwhile;
                        wp_reset_postdata();
			?>
		</header>
		<?php endif; //loop of page-template?>
<!--start-->
<?php
            $args = array(
                      'post_type' => 'course_package',
                      'posts_per_page' => -1,
                      'order' => 'DESC',
                      'order_by' => 'modified',
                      'post_per_page' => 10,
                      'posts_per_archive_page' => 10,
                    );
            $query_cpack = new WP_Query( $args );
                if ( $query_cpack->have_posts() ) :
                        do_action( 'wmhook_postslist_before' );
                        ?>
                        <div id="posts" class="posts posts-list clearfix masonry" <?php echo wm_schema_org( 'ItemList' ); ?>>
                                <?php
                                do_action( 'tha_content_while_before' );
                                while ( $query_cpack->have_posts() ) : $query_cpack->the_post();
                                         get_template_part( 'template-parts/content', apply_filters( 'wmhook_loop_content_type', 'pkg_items' ) );
                                endwhile;
                                do_action( 'tha_content_while_after' );
                                ?>
                        </div>
                        <?php
                        do_action( 'wmhook_postslist_after' );
                        $query_cpack->reset_postdata();
                else :
                        get_template_part( 'template-parts/content', 'none' );
                endif;


?>

<!--end-->
	</section>

	<?php

get_footer();
