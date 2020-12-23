(function ($) {

  var el_form = $('#form-new-post'),
      el_form_submit = $('.submit', el_form);

  // Fires when the form is submitted.
  el_form.on('submit', function (e) {
      e.preventDefault();

      el_form_submit.attr('disabled', 'disabled');
      //var donotsell_email= jQuery('input[name="donotsell_email"]').val();
      //console.log(isEmail(donotsell_email));
      new_post();
  });
  /* function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  } */
  // Ajax request.
  function new_post() {
      $.ajax({
          url: localized_donot_sell_form.admin_donot_sell_ajax_url,
          type: 'POST',
          dataType: 'json',
          data: {
              action: 'donot_sell_save_post', // Set action without prefix 'wp_ajax_'.
              form_data: el_form.serialize()
          },
          cache: false
      }).done(function (r) {
          console.log(r);
          if (r.donotsellrequests !== '') {
              console.log('complete')
              jQuery('#donotsellmsg').addClass('donotsell-msg');
              jQuery('#donotsellmsg').removeClass('donotsell-error-msg');
              jQuery('#donotsellmsg').text('Request has been submitted successfully!!').delay(10000).fadeOut();
              //el_form_submit.attr('data-is-updated', 'true');
              //el_form_submit.text(el_form_submit.data('is-update-text'));
          }
          console.log(r.error)
          if(r.error !=='' && r.error != undefined){
            jQuery('#donotsellmsg').removeClass('donotsell-msg');
            jQuery('#donotsellmsg').addClass('donotsell-error-msg');
            jQuery('.donotsell-error-msg').text(r.error).delay(10000).fadeOut();
          }
          el_form_submit.removeAttr('disabled');
      });
  }

  // Used to trigger/simulate post submission without user action.
  function trigger_new_post() {
      el_form.trigger('submit');
  }

  // Sets interval so the post the can be updated automatically provided that it was already created.
  /* setInterval(function () {
      if (el_form_submit.attr('data-is-updated') === 'false') {
          return false;
      }

      trigger_new_post();
  }, 5000); // Set to 5 seconds. */

})(jQuery);