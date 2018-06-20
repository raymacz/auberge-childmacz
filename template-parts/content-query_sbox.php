
<?php
//SANDBOX for WP QUERIES

// https://www.billerickson.net/customize-the-wordpress-query/
// https://www.billerickson.net/code/wp_query-arguments/
// https://premium.wpmudev.org/blog/creating-custom-queries-wordpress/
// https://presscustomizr.com/snippet/three-techniques-to-alter-the-query-in-wordpress/
// https://codex.wordpress.org/Global_Variables
// F:\MyTutorials\MyExercise\mynotes\Developer.notes\Wordpress in Depth-Andrew_Nacin-031818.php

/* //add to functions.php to call this template parts
add_action('shutdown', function(){
  if ( is_front_page() && is_page() ) :
    get_template_part( 'template-parts/content', 'query_sbox' );
  endif;
}, 10, 1);
*/
/*
 echo" //get_term_link: ". get_term_link(244); // to get url
*/


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

  /// ========================== PLAN B - Course Package


//    if (is_front_page() && is_main_query() && is_archive() && is_tax('menu_course') && is_post_type_archive('course_package') {
    if (is_front_page() && is_main_query()) {
//        $mytax= get_queried_object();
        $mytax = 'course_package';
//        $myterm_taxonomy_id= 244;
//        $mytax_obj =  get_term_by('id', 244, $mytax);
//        $myterms = get_the_terms(1872, 'nova_menu');

        echo" //======== get_term: ";
//        var_dump(get_term(244, $mytax));
        echo" //======== get_terms: ";
//        var_dump(get_terms($mytax));



        //https://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters


        $args = array(
    'post_type' => 'course_package',
    'posts_per_page' => -1,
  );

        // the query
        $myquery_package = new WP_Query($args);

        // The Loop
        if ($myquery_package->have_posts()) :
        echo "<pre> ";
        while ($myquery_package->have_posts()) : $myquery_package->the_post();
        echo "<p style='color: blue;'>Menu Package:    </p> ";
          // start template; =============================
          // echo" //the_post_thumbnail: "; // the_post_thumbnail();
          echo" //the_title: ";
          the_title($before = '<p>', $after = '</p>');
  //                echo" //the_excerpt: ";                the_excerpt();
          echo" //the_content: ".get_the_content($more_link_text = null, $strip_teaser = false);
  //                echo" //get_post_custom_keys: ".get_post_custom_keys()[6];
//          echo" //vardump: ";        var_dump(get_post_custom_keys());
          $term_taxonomy_id = get_post_meta(get_the_ID(), 'course_pack', true)['term_taxonomy_id'];
          echo" //get_post_meta_term_taxonomy_id: ".$term_taxonomy_id;
          echo" //the_time: ";
          the_time('F jS, Y');
          echo" //the_author: ";
          the_author();
          the_permalink();
          echo" <br /><br /><br /> ----- 1st template";

            //start new query ------------------------
            $args = array(
            'post_type' => 'course_pack',
            'posts_per_page' => -1,
            'tax_query' => array(
//                'relation' => 'AND', //default &&
                array(
                  'taxonomy'=>'pack_tax',
                  'field'=> 'term_id',
                  'terms'=>array($term_taxonomy_id),
                  'include_children'=>true,
                  'operator'=>'AND',
                ),
             ),
            );
            $myquery_course = new WP_Query($args);
            // The Loop
            if ($myquery_course->have_posts()) {
                echo "<pre> <p style='color: blue;'>Package Courses:    </p> ";
                while ($myquery_course->have_posts()) {
                    $myquery_course->the_post();
                    // start template; =============================
    //                  echo" //get_post_custom_keys: ";//.get_post_custom_keys()[4];
//                  echo" //vardump: ";     var_dump(get_post_custom_keys());

    //                  echo" //post_class: ";  post_class(array('left','post'));

                    echo" //get_post_meta_qty: ". get_post_meta(get_the_ID(), 'course_qty', true);
                    $term_id=get_post_meta(get_the_ID(), 'course_name', true)['term_taxonomy_id'];
                    the_title('<p><a href="'.get_term_link((int)$term_id).'" target="_blank" rel="noopener">', '</a></p>');


                    // end template =============================

                    echo "<br />";
                    echo" //======= END OF ITEM =======";

                } // end while
               echo "</pre>";
            } // endif
            $myquery_course->reset_postdata();
    //        wp_reset_postdata();

            //end new query


          // end template =============================

        endwhile;
        echo "</pre>";
        endif;

        wp_reset_postdata(); /* Restore original Post Data */
    } // is_main_query

  ?>
            </div>            <!-- wpb-wrapper -->
          </section>          <!-- mail-subscription -->
        </div>        <!-- col-md-7 -->
      </div>      <!-- row -->
      </section>      <!-- careers -->
    </div>    <!-- container -->
  </div>  <!-- container-fluid -->
