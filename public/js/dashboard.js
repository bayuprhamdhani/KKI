$(document).ready(function() {
    $('#service').on('change', function() {
      if ($(this).val() === 'Rent') {
        $('#RENT').show();
      }
      else {
        $('#RENT').hide();
        $('#carResults').hide();
      }
    });
  });

  $(document).ready(function() {
    $('#chartTransaction').on('change', function() {
      const selectedValue = $(this).val();
      
      // Daftar elemen yang akan disembunyikan atau ditampilkan
      const elements = {
        'Car': '#TbyCar',
        'Month': '#TbyMonth',
        'Company': '#TbyCompany',
        'Customer': '#TbyCustomer'
      };
  
      // Sembunyikan semua elemen terlebih dahulu
      $('#TbyCar, #TbyMonth, #TbyCompany, #TbyCustomer').hide();
  
      // Tampilkan elemen yang sesuai dengan nilai yang dipilih
      if (elements[selectedValue]) {
        $(elements[selectedValue]).show();
      }
    });
  });
  