<?php
// CMB2 initialize
$fp_mail=  get_post_meta(701, '_FPage6__rg_mail', true);
$fp_work=  get_post_meta(701, '_FPage6__rg_work', true);

?>
  <div id="mywork" class="container-fluid mail-career ">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <section class="mail-subscription">
            <div class="b-title">
                <h3 class="p-title" style="text-align: center;"><?php echo isset($fp_mail[0]['_FPage6_mw-title']) ? esc_html($fp_mail[0]['_FPage6_mw-title']) : '';?></h3>
            </div>
            <?php echo isset($fp_mail[0]['_FPage6_mw-desc']) ? wpautop($fp_mail[0]['_FPage6_mw-desc']) : '';?> 
            <div class="wpb-wrapper">
              <div class=" btn-wrap text-center">
                <button type="button" class="btn btn-warning" data-backdrop="static" data-keyboard="true" data-toggle="modal" data-target="#subscribeModal" data-whatever="invgamez@gmail.com"><?php echo isset($fp_mail[0]['_FPage6_mw-title']) ? esc_html($fp_mail[0]['_FPage6_mw-button']) : '';?></button>
                <!-- <a href="https://mailchi.mp/ed7b8db93cdf/slpage-resto" class="btn btn-warning" target="_blank">  Click here to subscribe </a> -->
              </div>
            </div>            <!-- wpb-wrapper -->
          </section>          <!-- mail-subscription -->
        </div>        <!-- col-md-7 -->
        <div class="col-lg-5">
          <section class="careers">
            <div class="b-title">
                <h3 class="p-title" style="text-align: center;"><?php echo isset($fp_work[0]['_FPage6_mw-title']) ? esc_html($fp_work[0]['_FPage6_mw-title']) : '';?></h3>
            </div>
            <?php echo isset($fp_work[0]['_FPage6_mw-desc']) ? wpautop($fp_work[0]['_FPage6_mw-desc']) : '';?>   
            <div class="btn-wrap text-center">
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#careerModal" data-whatever="invgamez@gmail.com"><?php echo isset($fp_work[0]['_FPage6_mw-title']) ? esc_html($fp_work[0]['_FPage6_mw-button']) : '';?></button>
            </div>
        </div>        <!-- col-md-6 -->
      </div>      <!-- row -->
      </section>      <!-- careers -->
    </div>    <!-- container -->
  </div>  <!-- container-fluid -->
