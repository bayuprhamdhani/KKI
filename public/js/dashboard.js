$(document).ready(function() {
    $('#service').on('change', function() {
      if ($(this).val() === 'Rent') {
        $('#RENT').show();
      }
      else {
        $('#RENT').hide();
      }
    });
  });