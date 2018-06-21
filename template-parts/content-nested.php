<?php
/**
 * Standard post content
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





?>

<?php do_action( 'tha_entry_before' ); ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); echo apply_filters( 'wmhook_entry_container_atts', '' ); ?>>

	<?php do_action( 'tha_entry_top' );  ?>

	<div class="entry-content"<?php echo wm_schema_org( 'entry_body' ); ?>>

		<?php do_action( 'tha_entry_content_before' ); ?>

		<?php

		if ( is_single() ) {

                            the_content( apply_filters( 'wmhook_wm_excerpt_continue_reading', '' ) );

		} else {

			the_excerpt();

		}
                 echo "rbtm";   
		?>

		<?php do_action( 'tha_entry_content_after' ); ?>
<?php // ============ insert code
            $term_tax_id = get_post_meta(get_the_ID(), 'course_pack', true)['term_taxonomy_id'];   
            //start new query ------------------------
            $args = array(
            'post_type' => 'course_pack',
            'posts_per_page' => -1,
            'tax_query' => array(
//                'relation' => 'AND', //default &&
                array(
                  'taxonomy'=>'pack_tax',
                  'field'=> 'term_id',
                  'terms'=>array($term_tax_id),
                  'include_children'=>true,
                  'operator'=>'AND',
                ),
             ),
            );
            $myquery_course = new WP_Query($args);
            if ($myquery_course->have_posts()) {
                echo "<pre> <p style='color: blue;'>Package Courses:    </p> ";
                while ($myquery_course->have_posts()) {  $myquery_course->the_post();
                    // start template; =============================
                    $term_id=get_post_meta(get_the_ID(), 'course_name', true)['term_taxonomy_id'];
                    the_title('<p><a href="'.get_term_link((int)$term_id).'" target="_blank" rel="noopener">', '</a></p>');
                    
                    // end template =============================
                    echo "<br />";
                } // end while
               echo "</pre>";
            } // endif
            $myquery_course->reset_postdata();
// ============================== end code
?>
	</div>

	<?php do_action( 'tha_entry_bottom' ); ?>

</article>

<?php do_action( 'tha_entry_after' ); ?>
