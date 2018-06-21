<?php
error_reporting(E_ALL); //during developement, add this to help in making WP plugins
/**
* Plugin Name: <%= Title %> Twitter Shortcode
* Description: Displays any messages designated.
* Version: 0.1.0
* Author: Raymacz
* Author URI: http:mqassist.com
* Text Domain: cwpl
* License: GPL2+
*
*/ ?>


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

	</div>

	<?php do_action( 'tha_entry_bottom' ); ?>

</article>

<?php do_action( 'tha_entry_after' ); ?>
