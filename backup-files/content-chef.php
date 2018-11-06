<?php
// CMB2 initialize

$fp_title=  get_post_meta(701, '_FPage2_title', true);
$fp_body=  get_post_meta(701, '_FPage2_body', true);
$fp_image=  get_post_meta(701, '_FPage2_image', true);

?>
<section id="about-chef" >
  <div class="container">
    <div class="row">
      <div class="col-lg-5 photo-wrap">
          <img src="<?php echo isset($fp_image) ? esc_url($fp_image) : '#'; ?>" alt="person">
      </div>
      <div class="col-lg-7 col-lg-offset-0 blk-info">
        <div class=" block-tpl chefs">
          <div class="b-title text-center">
            <h3 class="p-title"><?php echo isset($fp_title) ? esc_html($fp_title) : ''; ?></h3>
          </div>
          <div class="text-center" >
            <?php echo isset($fp_body) ? wpautop($fp_body) : ''; ?>
          </div>
        </div>
      </div>
    </div>
  </div>    <!-- container -->
</section>
