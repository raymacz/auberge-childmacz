<?php
/**
 * Display Aside post format on index pages.
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

	<?php  if (! has_post_format('quote')) {	do_action( 'tha_entry_top' );	}	 ?>

	<div class="entry-content"<?php echo wm_schema_org( 'entry_body' ); ?>>

		<?php do_action( 'tha_entry_content_before' ); ?>

		<?php

      // echo "THE_CONTENTzzz";
    	the_content();
			$pm = get_post_meta( get_the_ID());
			$pmdat = get_metadata('post',get_the_ID());
			// echo "<pre>".print_r($pmdat)."</pre>";
			 // echo $pm['quote_source'][0];
			 print '<blockquote style="text-align:right">- '.$pmdat["quote_source"][0].'</blockquote>';
			 // foreach ($pm['quote_source'] as $pme) {
			 // 	echo $pme;
			 // }
				?>

		<?php do_action( 'tha_entry_content_after' ); ?>

	</div>

	<?php do_action( 'tha_entry_bottom' ); ?>

</article>

<?php do_action( 'tha_entry_after' ); ?>
