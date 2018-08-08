<?php
// initialize

$fp_title1 = get_post_meta(701, '_RBTM1_title1', true);
$fp_title2 = get_post_meta(701, '_RBTM1_title2', true);
$fp_body1 = get_post_meta(701, '_RBTM1_body1', true);
$fp_body2 = get_post_meta(701, '_RBTM1_body2', true);
$fp_button1 = get_post_meta(701, '_RBTM1_button1', true);
$fp_button2 = get_post_meta(701, '_RBTM1_button2', true);
$fp_phone = get_post_meta(701, '_RBTM1_phone', true);


// initialize phone text & mobile
$fp_phone_text = sprintf("%s-%s-%s",
              substr($fp_phone, 2, 3),
              substr($fp_phone, 5, 3),
              substr($fp_phone, 8));
$fp_phone_href = sprintf("tel:001%s%s%s",
              substr($fp_phone, 2, 3),
              substr($fp_phone, 5, 3),
              substr($fp_phone, 8));

// refer to CPT Pages for URLs
$menu_page_obj=get_post(1877);
$catering_page_obj=get_post(2226);

//note: task to do - include upload of background image
?>

<section id="about-menu" style="background-image: url('<?php print get_template_directory_uri(); ?>-child/backup-files/img/bg/restaurant1.jpg');background-repeat:no-repeat; background-size:cover; background-attachment:fixed; background-position: 50% 0%;">
  <div class="container-fluid wrap-menu">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-lg-offset-5 blk-info">
          <div class=" block-tpl menus">
            <div class="b-title-white text-center">
                <h3 class="p-title"><?php echo isset($fp_title1) ? esc_html($fp_title1) : ''; ?></h3>
            </div>
            <div id="cuisine" class="text-center" >
              <?php echo isset($fp_body1) ? wpautop($fp_body1) : ''; ?>  
            </div>
            <div class="btn-label btn-wrap text-center">
              <a href="<?php echo esc_url($menu_page_obj->guid); ?>" class="btn btn-warning" >  <?php echo isset($fp_button1) ? esc_html($fp_button1) : ''; ?> </a>
            </div>
            <div id="occassion" class="b-title-white text-center" >
              <h3 class="p-title" ><?php echo isset($fp_title1) ? esc_html($fp_title2) : ''; ?></h3>
            </div>
            <div class=" text-center clearfix" data-os-animation="none" data-os-animation-delay="0s">
                 <?php echo isset($fp_body2) ? wpautop($fp_body2) : ''; ?>  
              <p class="phone-icon"><a href="<?php echo isset($fp_phone_href) ? esc_html($fp_phone_href) : ''; ?>"><i class="menu-icon fa fa-phone-square"></i>&nbsp;<?php echo isset($fp_phone_text) ? esc_html($fp_phone_text) : ''; ?></a></p>
            </div>
            <div class="btn-label btn-wrap text-center">
                <a href="<?php echo esc_url($catering_page_obj->guid);?>" class="btn btn-warning" >  <?php echo isset($fp_button2) ? esc_html($fp_button2) : ''; ?></a>
            </div>
            </div>
        </div>
      </div>   <!-- row -->
    </div> <!-- container -->
  </div>    <!-- container-fluid -->
</section>
