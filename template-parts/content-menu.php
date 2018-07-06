<?php
$menu_page_obj=get_post(1877);
$catering_page_obj=get_post(2226);
?>
<section id="about-menu" style="background-image: url('<?php print get_template_directory_uri(); ?>-child/backup-files/img/bg/restaurant1.jpg');background-repeat:no-repeat; background-size:cover; background-attachment:fixed; background-position: 50% 0%;">
  <div class="container-fluid wrap-menu">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-lg-offset-5 blk-info">
          <div class=" block-tpl menus">
            <div class="b-title-white text-center">
                <h3 class="p-title">Our Menus</h3>
            </div>
            <div id="cuisine" class="text-center" >
              <p>The cuisine at <strong>Mars</strong> is inspired by the many culture of all regions of Spain.</p>
              <p>Executive Chef Raymacz's focus is on classic and modern cooking methods. Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before. Many say exploration is part of our destiny.</p>
              <p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before. Many say exploration is part of our destiny, but it’s actually our duty to future generations and their quest to ensure the survival of the human species.</p>
            </div>
            <div class="btn-label btn-wrap text-center">
              <a href="<?php echo esc_url($menu_page_obj->guid); ?>" class="btn btn-warning"  target="_blank">  View Our <?php echo $menu_page_obj->post_title; ?> </a>
            </div>
            <div id="occassion" class="b-title-white text-center" >
              <h3 class="p-title" >Planning a Special Occasion?</h3>
            </div>
            <div class=" text-center clearfix" data-os-animation="none" data-os-animation-delay="0s">
              <p >Our intimate private dining room is ideal for all types of gatherings and private events. Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before. Many say exploration is part of our destiny, but it’s actually our duty to future generations and their quest to ensure the survival of the human species.</p>
              <p class="phone-icon"><a href="tel:0014049693233"><i class="menu-icon fa fa-phone-square"></i>&nbsp;000-111-3233</a></p>
            </div>
            <div class="btn-label btn-wrap text-center">
                <a href="<?php echo esc_url($catering_page_obj->guid);?>" class="btn btn-warning"  target="_blank">  View Our <?php echo $catering_page_obj->post_title.' '.$menu_page_obj->post_title; ?></a>
            </div>
            </div>
        </div>
      </div>   <!-- row -->
    </div> <!-- container -->
  </div>    <!-- container-fluid -->
</section>
