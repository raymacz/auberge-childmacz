
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
            <div class="wpb-wrapper">
 <?php
//    if (is_front_page() && is_main_query() && is_archive() && is_tax('menu_course') && is_post_type_archive('course_package') {
    if (is_front_page() && is_main_query()) {
        $args = array(
          'post_type' => 'course_package',
          'posts_per_page' => -1,
        );
        $myquery_package = new WP_Query($args);
        if ($myquery_package->have_posts()) :
        echo "<pre> ";
        while ($myquery_package->have_posts()) : $myquery_package->the_post();
          echo "<h5 style='color: blue;'>Menu Package:    </h5> ";
          echo " //the_title: ";
          the_title($before = '<p>', $after = '</p>');
          echo " //get_post_meta_package_price: ". strip_tags( get_post_meta( get_the_ID(), 'package_price', true ));
          echo" //the_excerpt: ";                the_excerpt();
          echo " //the_content: ".get_the_content($more_link_text = null, $strip_teaser = false);
          $term_tax_id = get_post_meta(get_the_ID(), 'course_pack', true)['term_taxonomy_id'];
          print "//get_post_meta_term_taxonomy_id: ".$term_tax_id;
          echo" //the_time: ";  the_time('F j, Y');
          echo" //the_author: ";  the_author();
          echo" //the_author: "; the_permalink();
          echo" <br /> <h6> Package Courses </h6>";
            //start new query ------------------------
            $args = array(
            'post_type' => 'course_pack',
            'posts_per_page' => -1,
            'tax_query' => array(
//                'relation' => 'AND', //default &&
                array(
                  'taxonomy'=>'pack_tax',
                  'field'=> 'term_id',
                  'terms'=>array($term_tax_id),
                  'include_children'=>true,
                  'operator'=>'AND',
                ),
             ),
            );
            $myquery_course = new WP_Query($args);
            // The Loop
            if ($myquery_course->have_posts()) {
                echo "<pre> ";
                while ($myquery_course->have_posts()) {  $myquery_course->the_post();
                    echo" //get_post_meta_qty: ". get_post_meta(get_the_ID(), 'course_qty', true);
                    $term_id=get_post_meta(get_the_ID(), 'course_name', true)['term_taxonomy_id'];
                    the_title('<p><a href="'.get_term_link((int)$term_id).'" target="_blank" rel="noopener">', '</a></p>');
                } // end while
               echo "</pre>";
               $myquery_course->reset_postdata();
            } // endif

            //end new query ------------------------
        endwhile;
        echo "</pre>";
        wp_reset_postdata(); /* Restore original Post Data */
        endif;
    } // is_main_query
  ?>
            </div>            <!-- wpb-wrapper -->
          </section>          <!-- mail-subscription -->
        </div>        <!-- col-md-7 -->
      </div>      <!-- row -->
      </section>      <!-- careers -->
    </div>    <!-- container -->
  </div>  <!-- container-fluid -->
