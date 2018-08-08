<?php
// CMB2 initialize
$fp_entries=  get_post_meta(701, '_FPage4__rg_testimonial', true);

?>

<div id="cont-testi" class="container-fluid wrap-testi">
  <div class="row">
   <?php foreach ((array)$fp_entries as $key => $entry) { ?>
        <!--<blockquote class="col-lg-6 col-xl-3 bgtesti" style="background: url('<?php// bloginfo('template_directory'); ?>-child/backup-files/img/testimonial/testimonial-janeh.jpg') no-repeat center center; background-size: cover;">-->
      <blockquote class="col-lg-6 col-xl-3 bgtesti" style="background: url('<?php echo isset($entry['_FPage4_image']) ? esc_url($entry['_FPage4_image']) : '#'; ?>') no-repeat center center; background-size: cover;">
          <div class="quote">
            <span class="intro"><?php echo isset($entry['_FPage4_intro']) ? esc_html($entry['_FPage4_intro']) : ''; ?></span>
            <span class="more"><?php echo isset($entry['_FPage4_more']) ? wpautop($entry['_FPage4_more']) : ''; ?></span>
            <span class="client"><?php echo isset($entry['_FPage4_customer']) ? esc_html($entry['_FPage4_customer']) : ''; ?></span>
          </div>
        </blockquote>
    <?php } ?>
  </div>    <!-- row -->
</div>  <!-- container-fluid -->
