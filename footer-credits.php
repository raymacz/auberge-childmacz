<?php
/**
 * Theme credits
 *
 * It is completely optional, but if you like this WordPress theme,
 * I would appreciate it if you keep the credit link in the footer.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0
 * @version  2.3.0
 */





/**
 * Helper variables
 */

    $custom_credits = (string) apply_filters('wmhook_wm_credits_output', '');



/**
 * Requirements check
 */

    if ('-' === $custom_credits) {
        return;
    }



?>

<div class="site-footer-area footer-area-site-info">
	<div class="site-info-container">

		<div class="site-info" role="contentinfo">
			<?php if (empty($custom_credits)) : ?>

				&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
				<span class="sep"> | </span>
				<a href="#top" id="back-to-top" class="back-to-top"><?php esc_html_e('Back to top &uarr;', 'auberge'); ?></a>

			<?php else : ?>

				<?php

                // This is already validated/sanitized when stored in customizer (with wp_kses_post())

                    echo $custom_credits;

                ?>

			<?php endif; ?>
		</div>

		<?php get_template_part('template-parts/menu', 'social'); ?>

	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel">Online Application Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <input type="text" class="form-control" id="recipient-name" placeholder="Your Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="recipient-email" placeholder="Your Email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="recipient-phone" placeholder="Your Phone">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="message-text" placeholder="Your Message" cols="30" rows="10"  ></textarea>
          </div>
          <div class="form-group">
            <p style="color: rgb(140, 140, 140); font-family: sans-serif;">Attach Your Resume (required)<br>
            <span class="wpcf7-form-control-wrap your-resume"><input name="your-resume" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" aria-required="true" aria-invalid="false" type="file"></span>
            </p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
