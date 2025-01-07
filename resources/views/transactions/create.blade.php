@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Transaction</div>
                  <div class="card-body">
  
                  <form action="{{ route('registerTransaction.post', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                          <h4 style="margin-left:0.7rem;">RENT ORDER</h4>

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
                                  <input type="text" id="price" class="form-control" name="price" value="Rp {{ number_format($car->price) }}" readonly required>
                                  @if ($errors->has('price'))
                                      <span class="text-danger">{{ $errors->first('price') }}</span>
                                  @endif
                              </div>
                          </div>

                          <h4 style="margin-left:0.7rem;">REGISTER ACCOUNT</h4>
                          <div class="form-group row mt-3">
                              <label for="email" class="col-md-4 col-form-label text-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row mt-3">
                              <label for="password" class="col-md-4 col-form-label text-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3 mb-5">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>

                          <h4 style="margin-left:0.7rem;">BIODATA CUSTOMER</h4>
                          <div class="form-group row">
                              <label for="customer" class="col-md-4 col-form-label text-right">Customer Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="customer" class="form-control" name="customer" required autofocus>
                                  @if ($errors->has('customer'))
                                      <span class="text-danger">{{ $errors->first('customer') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row mt-3">
                            <label for="contact" class="col-md-4 col-form-label text-right">Contact</label>
                            <div class="col-md-1">
                                <h5 for="">+62</h5>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="contact" class="form-control" name="contact" required autofocus oninput="this.value = this.value.replace(/^0/, '')">
                                @if ($errors->has('contact'))
                                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group row mt-3">
                              <label for="country" class="col-md-4 col-form-label text-right">Country</label>
                              <div class="col-md-6">
                              <select class="form-select" id="country" name="country" required>
                                        <option value="">Choose</option>
                                        @foreach($countries as $val)
                                            <option value="{{ $val->id }}">{{ $val->country }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="text-danger">{{ $errors->first('country') }}</span>
                                    @endif
                              </div>
                          </div>

<div class="form-group row mt-3">
    <label for="province" class="col-md-4 col-form-label text-right">Province</label>
    <div class="col-md-6">
        <select class="form-select" id="province" name="province" required>
            <option value="">Choose</option>
        </select>
        @if ($errors->has('province'))
            <span class="text-danger">{{ $errors->first('province') }}</span>
        @endif
    </div>
</div>

<div class="form-group row mt-3">
    <label for="city" class="col-md-4 col-form-label text-right">City</label>
    <div class="col-md-6">
        <select class="form-select" id="city" name="city" required>
            <option value="">Choose</option>
        </select>
        @if ($errors->has('city'))
            <span class="text-danger">{{ $errors->first('city') }}</span>
        @endif
    </div>
</div>


<div class="form-group row mt-3 mb-5">
    <label for="subdistrict" class="col-md-4 col-form-label text-right">Subdistrict</label>
    <div class="col-md-6">
        <select class="form-select" id="subdistrict" name="subdistrict" required>
            <option value="">Choose</option>
        </select>
        @if ($errors->has('subdistrict'))
            <span class="text-danger">{{ $errors->first('subdistrict') }}</span>
        @endif
    </div>
</div>

                          <h4 style="margin-left:0.7rem;">PAYMENT</h4>
                          <div class="form-group row">
                                <label for="payment" class="col-md-4 col-form-label text-right">Payment</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="payment" name="payment" required>
                                        <option value="">Choose</option>
                                        @foreach($payments as $val)
                                            <option value="{{ $val->id }}">{{ $val->payment }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('payment'))
                                        <span class="text-danger">{{ $errors->first('payment') }}</span>
                                    @endif
                                </div>
                            </div>

                          <div class="form-group row mt-3">
                                <label for="card_type" class="col-md-4 col-form-label text-right">Card Type</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="card_type" name="card_type" required>
                                        <option value="">Choose</option>
                                        @foreach($card_types as $val)
                                            <option value="{{ $val->id }}">{{ $val->card_type }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('card_type'))
                                        <span class="text-danger">{{ $errors->first('card_type') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                              <label for="card_number" class="col-md-4 col-form-label text-right">Card Number</label>
                              <div class="col-md-6">
                                  <input type="number" id="card_number" class="form-control" name="card_number" required autofocus>
                                  @if ($errors->has('card_number'))
                                      <span class="text-danger">{{ $errors->first('card_number') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="card_expired" class="col-md-4 col-form-label text-right">Card Expired</label>
                              <div class="col-md-6">
                                  <input type="date" id="card_expired" class="form-control" name="card_expired" required autofocus>
                                  @if ($errors->has('card_expired'))
                                      <span class="text-danger">{{ $errors->first('card_expired') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="cvv" class="col-md-4 col-form-label text-right">CVV</label>
                              <div class="col-md-6">
                                  <input type="number" id="cvv" class="form-control" name="cvv" required autofocus>
                                  @if ($errors->has('cvv'))
                                      <span class="text-danger">{{ $errors->first('cvv') }}</span>
                                  @endif
                              </div>
                          </div>

                            <!-- Submit Button -->
                            <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                                <button type="submit" class="btn btn-primary" onclick="return confirmSubmit()">Submit</button>
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
            document.getElementById('price').value =totalPrice; // Format harga dengan pemisah ribuan
        } else {
            document.getElementById('price').value = "Invalid date range";
        }
    }
}

</script>
<script>
function confirmSubmit() {
    // Ambil nilai dari input payment
    var payment = document.getElementById('payment').value;

    // Jika nilai payment adalah 2, tampilkan konfirmasi
    if (payment == 2) {
        return confirm("Sudah transfer ?");
    }

    // Jika payment bukan 2, lanjutkan pengiriman tanpa konfirmasi
    return true;
}

</script>
@endsection