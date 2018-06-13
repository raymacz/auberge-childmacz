<?php
/**
 * Custom page template
 *
 * Template Name: Fullwidth page
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */

/* translators: Custom page template name. */
__( 'Fullwidth page', 'auberge' );





get_header();

	while ( have_posts() ) : the_post();

		// get_template_part( 'template-parts/content', 'page' );
		get_template_part( 'template-parts/content', apply_filters( 'wmhook_single_content_type', get_post_format() ) );

	endwhile;

get_footer();
