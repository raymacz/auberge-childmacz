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

<?php do_action('tha_entry_before'); ?>

<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); echo apply_filters('wmhook_entry_container_atts', ''); ?>>

	<?php do_action('tha_entry_top');  ?>

	<div class="entry-content"<?php echo wm_schema_org('entry_body'); ?>>

		<?php do_action('tha_entry_content_before'); ?>

		<?php

        if (is_single()) {
            the_content(apply_filters('wmhook_wm_excerpt_continue_reading', ''));
        } else {
            the_excerpt();
        }
        ?>

		<?php do_action('tha_entry_content_after'); ?>
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
            $my_unicode = '<mark class="unicode" title="U+1F374: FORK AND KNIFE" style="color: black;">🍴</mark>';
            $myquery_course = new WP_Query($args);
            if ($myquery_course->have_posts()) {
                ?>
                <div id="course-list" class="wrap-course">
                <h4>COURSES </h4>
                <p>For this package, you can choose your own courses below:    </p>
                    <ul>
                <?php
                while ($myquery_course->have_posts()) :  $myquery_course->the_post(); ?>
                     <li>
                            <mark class="unicode" data-bg-icon="&#x<?php echo get_post_meta(get_the_ID(), 'c_uni', true); ?>"></mark>
                            <?php $term_id=get_post_meta(get_the_ID(), 'course_name', true)['term_taxonomy_id']; ?>
                            <a href="<?php echo get_term_link((int)$term_id) ?>" target="_blank" rel="noopener"> <span class="txt"> <?php echo get_the_title(); ?></span></a>
                            <span class="qty"><?php echo get_post_meta(get_the_ID(), 'course_qty', true); ?></span>
                     </li>
               <?php endwhile; // end while ?>
                    </ul>
                </div>
    <?php } // endif
            $myquery_course->reset_postdata();
// ============================== end code
?>
	</div>

	<?php do_action('tha_entry_bottom'); ?>

</article>

<?php do_action('tha_entry_after'); ?>
