$(document).ready(function() {
    $('#service').on('change', function() {
      if ($(this).val() === 'Rent') {
        $('#RENT').show();
      }
      else {
        $('#RENT').hide();
        $('#tasikmalaya').hide();
      }
    });
  });

  $(document).ready(function() {
    $('#busimage').on('click', function() {
      if (bustasik.style.display === 'none' || bustasik.style.display === '') {
        bustasik.style.display = 'block';
        tasikmalaya.style.display = 'none';
      } else {
        bustasik.style.display = 'none';
      }
    });
  });

  function buttonorder1() {
    var formrent = document.getElementById('formrentbusbudimantasik');
    var bustasik = document.getElementById('bustasik');
    formrent.style.display = (formrent.style.display === "none") ? "block" : "none";
    bustasik.style.display = (formrent.style.display === "none") ? "block" : "none";
  }
  