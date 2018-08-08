<!-- Services -->
<?php

// initialize display
$fp_title=  get_post_meta(701, '_RBTM0_title1', true);
$fp_desc=  get_post_meta(701, '_RBTM0_description2', true);
$fp_entries=  get_post_meta(701, '_RBTM0__rg_services', true);

?>
  <section id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 b-title text-center">
          <h3 class="section-heading text-uppercase p-title"><?php echo __($fp_title); ?></h2>
				 </div>
			 </div>
			 <div class="row text-center">
        <?php foreach ((array)$fp_entries as $key => $entry) { ?>
				 <div class="col-md-4">
					 <span class="fa-stack fa-4x">
						 <i class="fa fa-circle fa-stack-2x text-primary"></i>
						 <i class="fa <?php echo isset($entry['_RBTM0_item-fa']) ? esc_html($entry['_RBTM0_item-fa']) : ''; ?> fa-stack-1x fa-inverse"></i>
					 </span>
					 <h4 class="service-heading"><?php echo isset($entry['_RBTM0_item-title']) ? esc_html($entry['_RBTM0_item-title']) : ''; ?></h4>
					 <p class="text-muted"><?php echo isset($entry['_RBTM0_item-desc']) ? wpautop($entry['_RBTM0_item-desc']) : ''; ?></p>
				 </div>
       <?php } ?>
         <div class="col-lg-12 text-center">
               <p class="text-muted"><?php echo __($fp_desc); ?></p>
         </div>
			 </div>       <!-- row -->
		 </div>     <!-- container -->
	 </section>
