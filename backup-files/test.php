<?php
error_reporting(E_ALL); //during developement, add this to help in making WP plugins
/**
* Plugin Name: <%= Title %> Twitter Shortcode
* Description: Displays any messages designated.
* Version: 0.1.0
* Author: Raymacz
* Author URI: http:mqassist.com
* Text Domain: cwpl
* License: GPL2+
*
*/ ?>

wp__body_class
<?php
/**
 * Standard post content
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.0
 */


//https://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters


//https://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters



?>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
    [text* your-name id:name class:form-control placeholder "Your Name*"]
   </div>
  <div class="form-group">
    [email* your-email id:email class:form-control placeholder "Your Email*"]
  </div>
   <div class="form-group">
   [tel tel-664 id:phone class:form-control placeholder "Your Phone"]
   </div>
   <div class="form-group">
   [text* your-subject id:subject class:form-control placeholder "Your Subject*"]
   </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    [textarea* your-message id:message class:form-control placeholder "Your Message*"]
   </div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12 text-center">
[submit id:sendMessageButton class:btn class:btn-primary class:btn-xl class:text-uppercase "Send Message"]
</div>
</div>




<form>
  <div class="form-group">
    [text* your-name id:recipient-name class:form-control placeholder "Your Name*"]
  </div>
  <div class="form-group">
      [email* your-email id:recipient-emai class:form-control placeholder "Your Email*"]
  </div>
  <div class="form-group">
    [tel* your-phone id:recipient-phone class:form-control placeholder "Your Phone"]
  </div>
  <div class="form-group">
    [textarea your-message 30x5 id:message-text class:form-control placeholder "Your Message*"]
  </div>
  <div class="form-group">
    <label style="color: rgb(140, 140, 140); font-family: sans-serif;">Attach Your Resume (required)<br>
    [file* your-file filetypes:png|jpg|jpeg|pdf|doc|docx limit:2mb id:resume-upload class:form-control ]
  </label>
  </div>
  <label>
        [submit sMButton-cattrib class:btn class:btn-primary class:btn-xl class:text-uppercase "Send Message"]
  </label>
</form>








  <input type="submit" data-backdrop="static" data-keyboard="true" value="Send Message">


#myid.wrap.myclass[title="titlename"]>ul>(li#myid$$>span.style>a[href="#"]{mytext$$})*3
            <!--ctrl+e-->
