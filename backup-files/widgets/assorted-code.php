
<!-- Bootstrap Widget Tags -->

<div id="my-tags" class="card bg-light mb-3">
  <h5 class="card-header">Tags</h5>
  <div class="card-body">
    <?php
    $instance = array('title' => '', 'text' => 'Text', 'count' => 1 );
     the_widget( 'WP_Widget_Tag_Cloud', $instance); ?>
  </div>
</div>

<!-- Tags -->


<!-- New Food Products -->

<?php
       $arg= array(
      'nova_menu.term_id != 264',
  );

  $params = array(
      'limit' => 5,
      'where' => $arg,
      'orderby' => 'post_date DESC',
  );

  $mypod = pods( 'nova_menu_item' )->find( $params );
  $frag = "<ul>";
  // Loop through the records returned
  while ( $mypod->fetch() ) {
     $frag .= '<li><a href="'.esc_url($mypod->display('guid')).'">'.$mypod->display( 'post_title' ).'</a></li>';
  }
  $frag .="</ul>";
  echo $frag;
   ?>
<!-- New Food Products -->
