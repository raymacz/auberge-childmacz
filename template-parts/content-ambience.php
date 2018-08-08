<?php
// CMB2 initialize
$fp_title=  get_post_meta(701, '_FPage3_title', true);
$fp_body=  get_post_meta(701, '_FPage3_body', true);
?>

<section id="about-ambi" style="background-image: url('<?php print get_template_directory_uri(); ?>-child/backup-files/img/bg/resto2.jpg');background-repeat:no-repeat; background-size:cover; background-attachment:fixed; background-position: 50% 0%;">
  <div class="container-fluid wrap-menu">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-lg-6 blk-info">
          <div class=" block-tpl menus">
            <div class="b-title-white text-center">
              <h3 class="p-title"><?php echo isset($fp_title) ? esc_html($fp_title) : ''; ?></h3>
            </div>
            <div id="myambience-two" class="text-center">
                 <?php echo isset($fp_body) ? wpautop($fp_body) : ''; ?>   
            </div>
          </div>
        </div>
      </div>      <!-- row -->
    </div>    <!-- container -->
  </div>  <!-- container-fluid -->
</section>
