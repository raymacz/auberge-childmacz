<?php
// CMB2 initialize
$fp_title=  get_post_meta(701, '_FPage5_title', true);
$fp_entries =  get_post_meta(701, '_FPage5__rg_location', true);

?>

<div id="cont-loc" class="container-fluid wrap-location text-center">
  <div class="container">
    <section class="logos">
      <div class="row">
        <div class="col-sm-12 b-title">
            <h3 class="p-title" style="text-align: center;"><?php echo isset($fp_title) ? esc_html($fp_title) : ''; ?></h3>
        </div>
      </div>      <!-- row -->
      <div class="row">
        <?php foreach ((array)$fp_entries as $key => $entry) { ?>
            <div class="col-lg-3 col-sm-6 loc-blk">
              <div class="entry-media">
                <figure>
                  <a href="#">
                     <img class="img-fluid d-block mx-auto" src="<?php echo isset($entry['_FPage5_image']) ? esc_url($entry['_FPage5_image']) : '#'; ?>" alt="">
                   </a>
                </figure>
              </div> <!-- entry-media -->
              <h5><?php echo isset($entry['_FPage5_state']) ? esc_html($entry['_FPage5_state']) : ''; ?></h5>
              <small><?php echo isset($entry['_FPage5_desc']) ? esc_html($entry['_FPage5_desc']) : ''; ?></small>
              <?php 
                  $fp_phone = esc_html($entry['_FPage5_phone']);
                  // initialize phone text & mobile
                  $fp_phone_text = sprintf("%s-%s-%s",
                                substr($fp_phone, 2, 3),
                                substr($fp_phone, 5, 3),
                                substr($fp_phone, 8));
                  $fp_phone_href = sprintf("tel:001%s%s%s",
                                substr($fp_phone, 2, 3),
                                substr($fp_phone, 5, 3),
                                substr($fp_phone, 8));
              ?>
              <p class="phone-icon"><a href="<?php echo isset($fp_phone_href) ? esc_html($fp_phone_href) : ''; ?>"><i class="menu-icon fa fa-phone-square"></i>&nbsp;<?php echo isset($fp_phone_text) ? esc_html($fp_phone_text) : ''; ?></a></p>
              <!-- <div class="confit-address" itemscope=""  itemprop="address"><a href="https://goo.gl/maps/Rzpzum6P1Z32" target="_blank">21512 Norwalk Blvd, Cerritos, CA 90703, USA</a></div> -->
              <div class="confit-address" itemscope="" itemtype="http://www.jollibeeusa.com/" itemprop="address"><a href="<?php echo isset($entry['_FPage5_gmap']) ? esc_url($entry['_FPage5_gmap']) : ''; ?>" target="_blank"><i class="fas fa-map-marked-alt"></i><?php echo isset($entry['_FPage5_address']) ? esc_html($entry['_FPage5_address']) : ''; ?></a></div>
            </div>  <!-- loc-block  -->
        <?php } ?>
      </div>  <!-- row -->
    </section>
    <!-- logos -->
  </div>
</div>
<!-- wrap-location -->
