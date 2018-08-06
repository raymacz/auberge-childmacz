<?php
/**
 * Functions for CMB2 plugin that creats custom fileds in metaboxes.
 *
 * @package auberge-child
 * @subpackage auberge
 * @since 1.0
 */


/**
 * Define the metabox and field configurations.
 */
function RBTM_fpage_cmb2() {

    //initialize cmb2 config
     $cmb2_box_config_default = array(
        'id'            => 'default_section',
        'title'         => __( 'Default Section', 'rbtm' ),
        'object_types'  => array( 'page', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        'closed'     => true, // Keep the metabox closed by default
        //   'remove_box_wrap' => true,
        // 'classes' => array('fpage-mb',),
        'show_on' => array( 'id' => 701),
        'cmb_styles' => true,
        'enqueue_js' => true,
        //'taxonomies' => array( 'category', 'post_tag' ), // Tells CMB2 which taxonomies should have these fields.
        // 'menu_title' => 'Site Options',
        // 'capability' => 'edit_posts',
        'icon_url' => 'dashicons-chart-pie',
        'position' => 1,
    );
     //initialize image config
    $cmb2_image_config_default = array(
        'name'    => __( 'Photo Upload: ', 'rbtm' ),
        'desc'    => __( 'Upload an image or enter an URL.', 'rbtm' ),
        'id'      => '_image_def',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => true, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
            ),
        ),
        'preview_size' => array( 100, 100 ), //'large', // Image size to use when previewing in the admin.
    );
    //initialize repeat group config
    $cmb2_rg_config_default = array(
        'id'          => '_rg_default',
        'type'        => 'group',
        'description' => __( 'Input Box', 'rbtm' ),
//         'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'   => __( 'Entry {#}', 'rbtm' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Add Another Entry', 'rbtm' ),
            'remove_button' => __( 'Remove Entry', 'rbtm' ),
            'sortable'      => true, // beta
            'closed'     => true, // true to have the groups closed by default
        ),
    );



    /**
     * Services Section
     */

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_RBTM0_';

    $cmb2_box_config =  array(
        'id'            => 'service_section',
        'title'         => __( 'Our Services Section', 'rbtm' ),
    );
    $cmb2_box_config = array_merge($cmb2_box_config_default, $cmb2_box_config);

    $cmb = [];
    $cmb[] = new_cmb2_box( $cmb2_box_config );

    // Regular text field
    $cmb[0]->add_field( array(
        'name'       => __( 'Title', 'rbtm' ),
        'desc'       => __( 'Input Services Section Title', 'rbtm' ),
        'id'         => $prefix . 'title1',
        'type'       => 'text_medium',
        'default_cb' => 'Services Section',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        'attributes' => array(
      		'data-validation' => 'required',
                'required'    => 'required',
      	),
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'on_front'        => false, // Optionally designate a field to wp-admin only
        // 'repeatable'      => true,
    ) );

    // Regular text field
    $cmb[0]->add_field( array(
        'name'       => __( 'Description', 'rbtm' ),
        'desc'       => __( 'Input Service Section Description', 'rbtm' ),
        'id'         => $prefix . 'description2',
        'type'       => 'textarea_small',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        'attributes'  => array(
		'placeholder' => 'A small amount of text',
		'rows'        => 3,
		'required'    => 'required',
	),
    ) );


    //services repeat group
    $cmb2_rg_config =  array(
     'id'          => $prefix. '_rg_services',
     'description' => __( 'Input Services', 'rbtm' ),
    );
    $cmb2_rg_config = array_merge($cmb2_rg_config_default, $cmb2_rg_config);
    $group_field_id = $cmb[0]->add_field($cmb2_rg_config);

    //font awesome
    $cmb[0]->add_group_field($group_field_id, array(
        'name'       => __( 'FA Icon Code', 'rbtm' ),
        'desc'       => __( '(e.g. fa-laptop - https://fontawesome.com/v4.7.0/icon/laptop/ )', 'rbtm' ),
        'id'         => $prefix . 'item-fa',
        'type'       => 'text_small',
        'default_cb' => 'fa-lock',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    //item title
    $cmb[0]->add_group_field($group_field_id, array(
        'name'       => __( 'Service Item Title', 'rbtm' ),
        'desc'       => __( 'Input service item title', 'rbtm' ),
        'id'         => $prefix . 'item-title',
        'type'       => 'text_medium',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    //item description
    $cmb[0]->add_group_field($group_field_id, array(
        'name'       => __( 'Service Item Description', 'rbtm' ),
        'desc'       => __( 'Input service item description', 'rbtm' ),
        'id'         => $prefix . 'item-desc',
        'type'       => 'textarea_small',
        'attributes'  => array(
		'placeholder' => 'A small amount of text',
		'rows'        => 2,
		'required'    => 'required',
	),
    ) );

    
    /**
     * Our Menu Section
     */

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_RBTM1_';

    $cmb2_box_config =  array(
        'id'            => 'ourmenu_section',
        'title'         => __( 'Our Menu Section', 'rbtm' ),
        'position'      => 2,
    );
    $cmb2_box_config = array_merge($cmb2_box_config_default, $cmb2_box_config);
    $cmb[] = new_cmb2_box( $cmb2_box_config );

    //title 1
    $cmb[1]->add_field( array(
        'name'       => __( 'First Title', 'rbtm' ),
        'desc'       => __( 'Input our 1st menu section title', 'rbtm' ),
        'id'         => $prefix . 'title1',
        'type'       => 'text_medium',
        'default_cb' => 'Our Menu',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        'attributes' => array(
      		'data-validation' => 'required',
                'required'    => 'required',
      	),
    ) );

    // tinymce settings
    $wysiwyg_option = array(
            'textarea_rows' => get_option('default_post_edit_rows', 5),
            'tinymce' => true,
            'quicktags' => true,
            'tabindex' => '',
            'media_buttons' => false,
            'teeny' => true,
            'wpautop' => true,
        );

    // body 1
    $cmb[1]->add_field( array(
        'name'       => __( 'First Body', 'rbtm' ),
        'desc'       => __( 'Input our 1st menu section description', 'rbtm' ),
        'id'         => $prefix . 'body1',
        'type'       => 'wysiwyg',
        'options' => $wysiwyg_option,
    ) );

    // button 1
    $cmb[1]->add_field( array(
        'name'       => __( 'First Button Label', 'rbtm' ),
        'desc'       => __( 'Change 1st button label', 'rbtm' ),
        'id'         => $prefix . 'button1',
        'type'       => 'text_small',
        'default_cb' => 'View Our Menu',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );


    // title 2
    $cmb[1]->add_field( array(
        'name'       => __( 'Second Title', 'rbtm' ),
        'desc'       => __( 'Input our 2nd menu section title', 'rbtm' ),
        'id'         => $prefix . 'title2',
        'type'       => 'text_medium',
        'default_cb' => 'Our Menu',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        'attributes' => array(
      		'data-validation' => 'required',
                'required'    => 'required',
      	),
    ) );

    // body 2
    $cmb[1]->add_field( array(
        'name'       => __( 'Second Body', 'rbtm' ),
        'desc'       => __( 'Input our 2nd menu section description', 'rbtm' ),
        'id'         => $prefix . 'body2',
        'type'       => 'wysiwyg',
        'options' => $wysiwyg_option,
    ) );

    // phone
     $cmb[1]->add_field( array(
        'name'       => __( 'Phone Number: ', 'rbtm' ),
        'desc'       => __( 'e.g. +12223334444', 'rbtm' ),
        'id'         => $prefix . 'phone',
        'type'       => 'text_small',
        'default_cb' => '+12223334444',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    // button 2
    $cmb[1]->add_field( array(
        'name'       => __( 'Second Button Label', 'rbtm' ),
        'desc'       => __( 'Change 2nd button label', 'rbtm' ),
        'id'         => $prefix . 'button2',
        'type'       => 'text_small',
        'default_cb' => 'View Our Catering Menu',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    
    /**
     * Our Chef Section
     */
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_FPage2_';

   $cmb2_box_config =  array(
        'id'            => 'ourchef_section',
        'title'         => __( 'Our Chef Section', 'rbtm' ),
        'position'      => 3,
    );
    $cmb2_box_config = array_merge($cmb2_box_config_default, $cmb2_box_config);

    $cmb[] = new_cmb2_box( $cmb2_box_config );

    //title 1
    $cmb[2]->add_field( array(
        'name'       => __( 'Title', 'rbtm' ),
        'desc'       => __( 'Input our 1st chef section title', 'rbtm' ),
        'id'         => $prefix . 'title',
        'type'       => 'text_medium',
        'default_cb' => 'Our Chef',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        'attributes' => array(
      		'data-validation' => 'required',
                'required'    => 'required',
      	),
    ) );

    // body 1
    $cmb[2]->add_field( array(
        'name'       => __( 'Body', 'rbtm' ),
        'desc'       => __( 'Input our section description', 'rbtm' ),
        'id'         => $prefix . 'body',
        'type'       => 'wysiwyg',
        'options' => $wysiwyg_option,
    ) );

    // photo 1
    $cmb[2]->add_field( array(
    'name'    => __( 'Photo Upload: ', 'rbtm' ),
    'desc'    => __( 'Upload an image or enter an URL.', 'rbtm' ),
    'id'      => $prefix .'image',
    'type'    => 'file',
    // Optional:
    'options' => array(
        'url' => true, // Hide the text input for the url
    ),
    'text'    => array(
        'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
    ),
    // query_args are passed to wp.media's library query.
    'query_args' => array(
        'type' => 'application/pdf', // Make library only display PDFs.
        // Or only allow gif, jpg, or png images
        'type' => array(
            'image/gif',
            'image/jpeg',
            'image/png',
        ),
    ),
    'preview_size' => array( 100, 100 ),//'large', // Image size to use when previewing in the admin.
) );


    /**
     * Our Ambience Section
     */
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_FPage3_';

   $cmb2_box_config =  array(
        'id'            => 'ambience_section',
        'title'         => __( 'Our Ambience Section', 'rbtm' ),
        'position'      => 4,
    );
    $cmb2_box_config = array_merge($cmb2_box_config_default, $cmb2_box_config);

    $cmb[] = new_cmb2_box( $cmb2_box_config );

    //title 1
    $cmb[3]->add_field( array(
        'name'       => __( 'Title', 'rbtm' ),
        'desc'       => __( 'Input our section title', 'rbtm' ),
        'id'         => $prefix . 'title',
        'type'       => 'text_medium',
        'default_cb' => 'Our Ambience',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        'attributes' => array(
      		'data-validation' => 'required',
                'required'    => 'required',
      	),
    ) );

    // body 1
    $cmb[3]->add_field( array(
        'name'       => __( 'Body', 'rbtm' ),
        'desc'       => __( 'Input our section description', 'rbtm' ),
        'id'         => $prefix . 'body',
        'type'       => 'wysiwyg',
        'options' => $wysiwyg_option,
    ) );

    
    /**
     * Our Testimonial Section
     */
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_FPage4_';

   $cmb2_box_config =  array(
        'id'            => 'testimonial_section',
        'title'         => __( 'Our Testimonial Section', 'rbtm' ),
        'position'      => 5,
    );
    $cmb2_box_config = array_merge($cmb2_box_config_default, $cmb2_box_config);
    $cmb[] = new_cmb2_box( $cmb2_box_config );

     // repeat group 1
    $cmb2_rg_config =  array(
     'id'          => $prefix. '_rg_testimonial',
     'description' => __( 'Input Testimonials', 'rbtm' ),
    );
    $cmb2_rg_config = array_merge($cmb2_rg_config_default, $cmb2_rg_config);
    $group_field_id = $cmb[4]->add_field($cmb2_rg_config);

    // photo 1
    $cmb2_image_config =  array(
     'id'      => $prefix .'image',
     'desc'    => __( 'Upload an image or enter an URL (size: 576x500).', 'rbtm' ),
    );
    $cmb2_image_config = array_merge($cmb2_image_config_default, $cmb2_image_config);
    $cmb[4]->add_group_field($group_field_id, $cmb2_image_config );

    //intro
    $cmb[4]->add_group_field($group_field_id, array(
        'name'       => __( 'Introduction', 'rbtm' ),
        'desc'       => __( 'Input introduction', 'rbtm' ),
        'id'         => $prefix . 'intro',
        'type'       => 'text',
        'default_cb' => 'Simply Amazing!',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    //more
    $cmb[4]->add_group_field($group_field_id, array(
        'name'       => __( 'Testimonial Content', 'rbtm' ),
        'desc'       => __( 'What does the customer have to say?', 'rbtm' ),
        'id'         => $prefix . 'more',
        'default_cb' => 'Excellent Service!',
        'type'       => 'textarea_small',
        'attributes'  => array(
		'placeholder' => 'A small amount of text',
		'rows'        => 3,
		'required'    => 'required',
	),
    ) );

    //client
    $cmb[4]->add_group_field($group_field_id, array(
        'name'       => __( 'Customer Name', 'rbtm' ),
        'desc'       => __( 'Input customer name', 'rbtm' ),
        'id'         => $prefix . 'customer',
        'type'       => 'text_medium',
        'default_cb' => 'Our customer',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    /**
     * Our Location Section
     */
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_FPage5_';

   $cmb2_box_config =  array(
        'id'            => 'location_section',
        'title'         => __( 'Our Location Section', 'rbtm' ),
        'position'      => 6,
    );
    $cmb2_box_config = array_merge($cmb2_box_config_default, $cmb2_box_config);
    $cmb[] = new_cmb2_box( $cmb2_box_config );
    
        //title 1
    $cmb[5]->add_field( array(
        'name'       => __( 'Title', 'rbtm' ),
        'desc'       => __( 'Input location section title', 'rbtm' ),
        'id'         => $prefix . 'title',
        'type'       => 'text_medium',
        'default_cb' => 'Our Location',
        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        'attributes' => array(
                'required'    => 'required',
      	),
    ));

     // repeat group 1
    $cmb2_rg_config =  array(
     'id'          => $prefix. '_rg_location',
     'description' => __( 'Input branch locations', 'rbtm' ),
    );
    $cmb2_rg_config = array_merge($cmb2_rg_config_default, $cmb2_rg_config);
    $group_field_id = $cmb[5]->add_field($cmb2_rg_config);

    // photo 
    $cmb2_image_config =  array(
     'id'      => $prefix .'image',
     'desc'    => __( 'Upload an image or enter an URL (size: 576x500).', 'rbtm' ),
    );
    $cmb2_image_config = array_merge($cmb2_image_config_default, $cmb2_image_config);
    $cmb[5]->add_group_field($group_field_id, $cmb2_image_config );
    
    
    // state
    $cmb[5]->add_group_field($group_field_id, array(
        'name'       => __( 'State', 'rbtm' ),
        'desc'       => __( 'Input State', 'rbtm' ),
        'id'         => $prefix . 'state',
        'type'       => 'select',
        'show_option_none' => true,
        'default' => 'none',
        'options' => array(
            'LA' => __( 'Los Angeles', 'rbtm' ),
            'TX'   => __( 'Texas', 'rbtm' ),
            'GA'   => __( 'Georgia', 'rbtm' ),
            'NY'   => __( 'New York', 'rbtm' ),
            'none'     => __( 'None', 'rbtm' ),
        ),
    ));
    
    // description
    $cmb[5]->add_group_field($group_field_id, array(
        'name'       => __( 'Description', 'rbtm' ),
        'desc'       => __( 'Input the description?', 'rbtm' ),
        'id'         => $prefix . 'desc',
        'type'       => 'textarea_small',
        'attributes'  => array(
		'placeholder' => 'A small amount of text',
		'rows'        => 3,
		'required'    => 'required',
	),
    ) );

    // Phone 
    $cmb[5]->add_group_field($group_field_id, array(
        'name'       => __( 'Phone Number: ', 'rbtm' ),
        'desc'       => __( 'e.g. +12223334444', 'rbtm' ),
        'id'         => $prefix . 'phone',
        'type'       => 'text_small',
        'default_cb' => '+12223334444',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );
     
    
    //google map-url 
    $cmb[5]->add_group_field($group_field_id, array(
        'name'       => __( 'Google Map Link: ', 'rbtm' ),
        'desc'       => __( 'Paste here the Google Map Link', 'rbtm' ),
        'id'         => $prefix . 'gmap',
        'type'       => 'text_url',
        'default_cb' => '#',
        'protocols' => array('http', 'https'), // Array of allowed protocols
    ));
    
    //google full-address 
    $cmb[5]->add_group_field($group_field_id, array(
        'name'       => __( 'Full Address: ', 'rbtm' ),
        'desc'       => __( 'Input full address', 'rbtm' ),
        'id'         => $prefix . 'address',
        'type'       => 'text',
        'attributes' => array(
                'required'    => 'required',
      	),
    ));
    
    
    
    /**
     * Our Mail & Work Section
     */
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_FPage6_';

   $cmb2_box_config =  array(
        'id'            => 'mail_work_section',
        'title'         => __( 'Mail & Work Section', 'rbtm' ),
        'position'      => 7,
    );
    $cmb2_box_config = array_merge($cmb2_box_config_default, $cmb2_box_config);
    $cmb[] = new_cmb2_box( $cmb2_box_config );

    //subscription repeat group
    $cmb2_rg_config =  array(
        'id'          => $prefix. '_rg_mail',
        'description' => __( 'Mail description', 'rbtm' ),
        'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'   => __( 'Subscription', 'rbtm' ),
    ),

    );
    $cmb2_rg_config = array_merge($cmb2_rg_config_default, $cmb2_rg_config);
    $group_field_id = $cmb[6]->add_field($cmb2_rg_config);

    //Subscription title
    $cmb[6]->add_group_field($group_field_id, array(
        'name'       => __( 'Subscription Title', 'rbtm' ),
        'desc'       => __( 'Input title', 'rbtm' ),
        'id'         => $prefix . 'mw-title',
        'type'       => 'text_medium',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    //Subscription description
    $cmb[6]->add_group_field($group_field_id, array(
        'name'       => __( 'Subscription Description', 'rbtm' ),
        'desc'       => __( 'Input description', 'rbtm' ),
        'id'         => $prefix . 'mw-desc',
        'type'       => 'textarea_small',
        'attributes'  => array(
		'placeholder' => 'A small amount of text',
		'rows'        => 3,
		'required'    => 'required',
	),
    ) );

    //Subscription button
    $cmb[6]->add_group_field($group_field_id, array(
        'name'       => __( 'Subscription Button Label', 'rbtm' ),
        'desc'       => __( 'Change button label', 'rbtm' ),
        'id'         => $prefix . 'mw-button',
        'type'       => 'text_small',
        'default_cb' => 'Click here to Subscribe',
        'attributes' => array(
                'required'    => 'required',
      	),
    ));


    //Career repeat group
    $cmb2_rg_config =  array(
        'id'          => $prefix. '_rg_work',
        'description' => __( 'Work description', 'rbtm' ),
        'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'   => __( 'Career', 'rbtm' ),
    ),

    );
    $cmb2_rg_config = array_merge($cmb2_rg_config_default, $cmb2_rg_config);
    $group_field_id = $cmb[6]->add_field($cmb2_rg_config);

    //career title
    $cmb[6]->add_group_field($group_field_id, array(
        'name'       => __( 'Career Title', 'rbtm' ),
        'desc'       => __( 'Input title', 'rbtm' ),
        'id'         => $prefix . 'mw-title',
        'type'       => 'text_medium',
        'attributes' => array(
                'required'    => 'required',
      	),
    ) );

    //career description
    $cmb[6]->add_group_field($group_field_id, array(
        'name'       => __( 'Career Description', 'rbtm' ),
        'desc'       => __( 'Input description', 'rbtm' ),
        'id'         => $prefix . 'mw-desc',
        'type'       => 'textarea_small',
        'attributes'  => array(
		'placeholder' => 'A small amount of text',
		'rows'        => 3,
		'required'    => 'required',
	),
    ) );

     //career button
    $cmb[6]->add_group_field($group_field_id, array(
        'name'       => __( 'Career Button Label', 'rbtm' ),
        'desc'       => __( 'Change button label', 'rbtm' ),
        'id'         => $prefix . 'mw-button',
        'type'       => 'text_small',
        'default_cb' => 'Online Application Form',
        'attributes' => array(
                'required'    => 'required',
      	),
    ));

    
} //function end

add_action( 'cmb2_admin_init', 'RBTM_fpage_cmb2' );



?>
