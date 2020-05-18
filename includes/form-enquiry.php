<div id="success_message" class="success" style="display:none"></div>

<form id="enquiry">





  <div class="form-group">
    <input type="text" name="fname" placeholder="Eesnimi (First Name)" required>
    <input type="text" name="lname" placeholder="Perekonnanimi (Last Name)" required>
  </div>
  <input type="email" name="email" placeholder="E-posti aadress (Email Address)" required>
  <textarea class="message" name="enquiry" rows="8" cols="80" placeholder="Kirja sisu (Message)"></textarea>
  <input type="submit" value="SAADA">
</form>

<div id="loadingDiv">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/loading.svg" alt="">
</div>

<script>


(function($){

  var $loading = $('#loadingDiv').hide();

  $('#enquiry').submit(function(event){


      $(document)
        .ajaxStart(function () {
          $('#enquiry').addClass('op-50');
          $loading.fadeIn(100);
        })
        .ajaxStop(function () {
          $loading.fadeOut(100);
          $('#enquiry').removeClass('op-50');
      });

      event.preventDefault();

      var endpoint = '<?php echo admin_url('admin-ajax.php'); ?>';

      var form = $('#enquiry').serialize();

      var formdata = new FormData;

      formdata.append('action', 'enquiry');
      formdata.append('nonce', '<?php echo wp_create_nonce('ajax-nonce'); ?>');
      formdata.append('enquiry', form);


      $.ajax(endpoint, {

          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,

          success: function(res){
              $('#enquiry').fadeOut(200);

              $('#success_message').text('Kiri saadetud!').show();

              $('#enquiry').trigger('reset');

              $('#enquiry').fadeIn(400);

          },

          error: function(err){
              alert(err.responseJSON.data);
          }

      })

  })

})(jQuery)



</script>
