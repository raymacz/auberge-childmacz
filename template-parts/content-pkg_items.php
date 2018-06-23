<?php
/**
 * Food menu post content
 *
 * The link to single post page will be applied only if the
 * post has some content.
 *
 * @package    Auberge
 * @author     Raymacz
 *
 * @since    1.0
 * @version  2.0
 */



?>

<?php do_action( 'tha_entry_before' ); ?>

<aside id="post-<?php the_ID(); ?>" <?php post_class('type-nova_menu_item'); ?> <?php echo apply_filters( 'wmhook_entry_container_atts', '' ); ?>>

	<?php echo do_action( 'tha_entry_top' );  ?>

	<div class="entry-content"<?php echo wm_schema_org( 'entry_body' ); ?>>

		<?php do_action( 'tha_entry_content_before' ); ?>

		<?php

		if ( is_single() ) {

			the_content( apply_filters( 'wmhook_wm_excerpt_continue_reading', '' ) );

		} else {
			the_excerpt();

		}

		?>

		<?php do_action( 'tha_entry_content_after' ); ?>

	</div>

	<?php do_action( 'tha_entry_bottom' ); ?>

</aside>

<?php do_action( 'tha_entry_after' ); ?>
