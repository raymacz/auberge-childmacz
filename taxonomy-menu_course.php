<?php
/**
 * Archives template
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */





get_header();


$mytax_obj= get_queried_object();
          

         var_dump($mytax_obj);
         
         
	?>

	<section class="archives-listing content-container">

		<?php  if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
                        
                        $archtitle =  '<h1 class="page-title">';
                        $archtitle .= $mytax_obj->name.wm_paginated_suffix( 'small' );
                        $archtitle .= '</h1>';        
                        print $archtitle;
                        echo" //get_query_var: ". get_query_var( 'taxonomy' );
                        
			the_archive_description( '<div class="taxonomy-description">', '</div>' );

			?>
		</header>

		<?php endif; ?>

		<?php get_template_part( 'template-parts/loop', 'archive' ); ?>

	</section>

	<?php

get_footer();