@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Transaction</div>
                  <div class="card-body">
  
                  <form action="{{ route('registerTransaction.post2', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                          <h4 style="margin-left:0.7rem;">RENT ORDER</h4>

                          <div class="form-group row mt-3 d-none">
                              <label for="customer" class="col-md-4 col-form-label text-right">Customer</label>
                              <div class="col-md-6">
                                  <input type="text" id="customer" class="form-control" name="customer" value="{{ auth()->user()->user }}" readonly required autofocus>
                                  @if ($errors->has('customer'))
                                      <span class="text-danger">{{ $errors->first('customer') }}</span>
                                  @endif
                              </div>
                          </div> 

                          <div class="form-group row mt-3">
                              <label for="car" class="col-md-4 col-form-label text-right">Car</label>
                              <div class="col-md-6 d-none">
                                  <input type="text" id="car" class="form-control" name="car" value="{{ $car->id }}" readonly required autofocus>
                                  @if ($errors->has('car'))
                                      <span class="text-danger">{{ $errors->first('car') }}</span>
                                  @endif
                              </div>
                              <div class="col-md-6">
                                  <input type="text" id="car" class="form-control" name="car" value="{{ $car->name }}"disabled required autofocus>
                                  @if ($errors->has('car'))
                                      <span class="text-danger">{{ $errors->first('car') }}</span>
                                  @endif
                              </div>
                          </div>  
                          <!-- Pick Up Date -->
                          <div class="form-group row mt-3">
                              <label for="pick_up" class="col-md-4 col-form-label text-right">Pick Up Date</label>
                              <div class="col-md-6">
                                  <input type="date" id="pick_up" class="form-control" name="pick_up" readonly required onchange="calculatePrice()">
                                  @if ($errors->has('pick_up'))
                                      <span class="text-danger">{{ $errors->first('pick_up') }}</span>
                                  @endif
                              </div>
                          </div>

                          <!-- Drop Off Date -->
                          <div class="form-group row mt-3">
                              <label for="drop_off" class="col-md-4 col-form-label text-right">Drop Off Date</label>
                              <div class="col-md-6">
                                  <input type="date" id="drop_off" class="form-control" name="drop_off" readonly required onchange="calculatePrice()">
                                  @if ($errors->has('drop_off'))
                                      <span class="text-danger">{{ $errors->first('drop_off') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="date_order" class="col-md-4 col-form-label text-right">Order Date</label>
                              <div class="col-md-6">
                                  <input type="date" id="date_order" class="form-control" name="date_order" readonly required>
                                  @if ($errors->has('date_order'))
                                      <span class="text-danger">{{ $errors->first('date_order') }}</span>
                                  @endif
                              </div>
                          </div>
                          <!-- Price -->
                          <div class="form-group row mt-3 mb-5">
                              <label for="price" class="col-md-4 col-form-label text-right">Price</label>
                              <div class="col-md-6">
                                  <input type="text" id="price" class="form-control" name="price" value="{{ number_format($car->price) }}" readonly required>
                                  @if ($errors->has('price'))
                                      <span class="text-danger">{{ $errors->first('price') }}</span>
                                  @endif
                              </div>
                          </div>

                            <!-- Submit Button -->
                          <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                           </div>
                        </form>

                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
<script>
    // Set default value of input to today's date
    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date().toISOString().split('T')[0];  // Format: YYYY-MM-DD
        document.getElementById('date_order').value = today;
    });
</script>
<script>
document.getElementById('cvv').addEventListener('input', function (e) {
    let value = e.target.value;
    // Menghapus karakter non-angka
    value = value.replace(/\D/g, '');
    // Batasi panjang input hanya 3 karakter
    if (value.length > 4) {
        value = value.substring(0, 4);
    }
    e.target.value = value;
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Handle country change
    $('#country').on('change', function() {
        var countryId = $(this).val();

        if (countryId) {
            $.ajax({
                url: "{{ route('getProvinces') }}",
                type: "GET",
                data: { country_id: countryId },
                success: function(response) {
                    console.log('Provinces:', response); // Debug response
                    $('#province').empty();
                    $('#province').append('<option value="">Choose</option>');
                    $.each(response, function(index, province) {
                        $('#province').append('<option value="' + province.id + '">' + province.province + '</option>');
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseJSON); // Debug error
                    alert('Error loading provinces: ' + xhr.responseJSON.error);
                }
            });
        } else {
            $('#province').empty().append('<option value="">Choose</option>');
            $('#city').empty().append('<option value="">Choose</option>');
            $('#subdistrict').empty().append('<option value="">Choose</option>');
        }
    });
});
</script>
<script>//city
$(document).ready(function() {
    $('#province').on('change', function() {
        var provinceId = $(this).val();

        if (provinceId) {
            $.ajax({
                url: "{{ route('getCities') }}", // Route yang dituju
                type: "GET",
                data: { province_id: provinceId }, // Kirim province_id
                success: function(response) {
                    console.log('Success:', response); // Debug response dari server
                    $('#city').empty();
                    $('#city').append('<option value="">Choose</option>');
                    $.each(response, function(index, city) {
                        $('#city').append('<option value="' + city.id + '">' + city.city + '</option>');
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseJSON); // Debug error
                    alert('Error: ' + xhr.responseJSON.error);
                }
            });
        } else {
            $('#city').empty().append('<option value="">Choose</option>');
            $('#subdistrict').empty().append('<option value="">Choose</option>');
        }
    });
});

</script>
<script>
$(document).ready(function() {
    // Handle city change
    $('#city').on('change', function() {
        var cityId = $(this).val();

        if (cityId) {
            $.ajax({
                url: "{{ route('getSubdistricts') }}",
                type: "GET",
                data: { city_id: cityId },
                success: function(response) {
                    console.log('Subdistricts:', response); // Debug response
                    $('#subdistrict').empty();
                    $('#subdistrict').append('<option value="">Choose</option>');
                    $.each(response, function(index, subdistrict) {
                        $('#subdistrict').append('<option value="' + subdistrict.id + '">' + subdistrict.subdistrict + '</option>');
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseJSON); // Debug error
                    alert('Error loading subdistricts: ' + xhr.responseJSON.error);
                }
            });
        } else {
            $('#subdistrict').empty().append('<option value="">Choose</option>');
        }
    });
});
</script>
<script>
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const pickUpDate = urlParams.get('pick_up');
    const dropOffDate = urlParams.get('drop_off');

    // Jika parameter ada, isi input dengan tanggal tersebut
    if (pickUpDate) {
        document.getElementById('pick_up').value = pickUpDate;
    }
    if (dropOffDate) {
        document.getElementById('drop_off').value = dropOffDate;
    }

    // Panggil fungsi untuk menghitung harga setelah tanggal dimasukkan
    calculatePrice();
};

function calculatePrice() {
    const pickUpDate = document.getElementById('pick_up').value;
    const dropOffDate = document.getElementById('drop_off').value;

    if (pickUpDate && dropOffDate) {
        const pickUp = new Date(pickUpDate);
        const dropOff = new Date(dropOffDate);

        // Hitung selisih hari antara pick up dan drop off
        const timeDiff = dropOff - pickUp;
        const dayDiff = timeDiff / (1000 * 3600 * 24);  // Menghitung selisih hari

        if (dayDiff >= 0) {
            // Ambil harga per hari mobil (car price) dari server (seharusnya di-load dari backend)
            const pricePerDay = {{ $car->price }};  // Mengambil harga per hari dari data mobil

            // Hitung total harga
            const totalPrice = dayDiff * pricePerDay;
            document.getElementById('price').value = totalPrice; // Format harga dengan pemisah ribuan
        } else {
            document.getElementById('price').value = "Invalid date range";
        }
    }
}

</script>

@endsection