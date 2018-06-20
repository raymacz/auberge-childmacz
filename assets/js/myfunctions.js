
(function($){

  // prevent event when the modal is about to hide
  // $('#subscribeModal').on('hide.bs.modal', function (e) {
      // e.preventDefault();
      // e.stopPropagation();
      // return false;
  // });

  // prevent event when the modal is about to hide
  // $('#careerModal').on('hide.bs.modal', function (e) {
      // e.preventDefault();
      // e.stopPropagation();
      // return false;
  // });

 // $('#subscribeModal').on('click', function(){
$('.modal-content button').on('click', function() {
  var $test = $(this).data('dismiss');
  if ($test == 'modal' ) {
     // $('.mc4wp-response').find('.mc4wp-alert.mc4wp-notice').removeClass('.mc4wp-notice').removeClass('.mc4wp-alert');
     $('.mc4wp-response').find('.mc4wp-alert').remove();
  }
});
if ($('.mc4wp-response').find('.mc4wp-alert').length !==0) {
  // if ($('#subscribeModal').hasClass('show')) {
    $('#subscribeModal').modal({
      backdrop: 'static',
      keyboard: true
    });
  // }
}



  // $('#careerModal').modal({
    // backdrop: 'static',
    // keyboard: true
  // })

})(jQuery);
