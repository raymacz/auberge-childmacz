
(function($){
    "use strict"; // Start of use strict.

  $(document).ready(function() {

    // Smooth scrolling using jQuery easing.
    $('li.js-scroll-trigger a[href*="#"]:not([href="#"]), a.js-scroll-trigger.menu-group-nav-link[href*="#"]:not([href="#"]').click(function(e) {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: (target.offset().top - 54)
          }, 1000, "easeInOutExpo"); return false;
        }
      }
    });

    // Closes responsive menu when a scroll trigger link is clicked.
    $('li.js-scroll-trigger a, a.js-scroll-trigger.menu-group-nav-link').click(function() {
    // $('li.js-scroll-trigger a').click(function() {
      var wd = $(window).width();
      // hides depending on the viewport size
      if (wd > 600) {
        $('.main-navigation-inner').collapse('hide');
      }
    });

    // Activate scrollspy to add active class to navbar items on scroll.
    $('body').scrollspy({
      target: '#site-navigation',
      offset: 56
    });

    $('.modal-content button').on('click', function() {
      var $btndismiss = $(this).data('dismiss');
      if ($btndismiss == 'modal' ) {
         $('.mc4wp-response').find('.mc4wp-alert').remove();
      }
    });
    if ($('.mc4wp-response').find('.mc4wp-alert').length !==0) {
        $('#subscribeModal').modal({
          backdrop: 'static',
          keyboard: true
        });
    }
  });
})(jQuery);
