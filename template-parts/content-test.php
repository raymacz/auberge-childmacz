
<?php
 ?>
  <div class="container-fluid mail-career ">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 ">
          <section class="sbox-section">
            <div class="b-title">
              <h3 class="p-title" style="text-align: center;">Custom Queries</h3>
            </div>
            <div class="wpbx-wrapper">
                <h3> POD Test </h3>
              <?php
              $arg= array(
                  'nova_menu.term_id != 264',
              );
              
              $params = array(
                  'limit' => 10,
                  'where' => $arg,
                  'orderby' => 'post_date DESC',
              );

              $mypod = pods( 'nova_menu_item' )->find( $params );
              $frag = "<ul>";
              // Loop through the records returned
              while ( $mypod->fetch() ) {
                  echo $mypod->display( 'post_title' ) . "\n";
                  $frag .= '<li><a href="'.esc_url($mypod->display('guid')).'">'.$mypod->display( 'post_title' ).'</a></li>';
              }
              $frag .="</ul>";
              echo $frag;
               ?>

            </div>            <!-- wpb-wrapper -->
          </section>          <!-- mail-subscription -->
        </div>        <!-- col-md-7 -->
      </div>      <!-- row -->
      </section>      <!-- careers -->
    </div>    <!-- container -->
  </div>  <!-- container-fluid -->
