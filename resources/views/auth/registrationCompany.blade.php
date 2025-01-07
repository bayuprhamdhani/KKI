@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register Company</div>
                  <div class="card-body">
  
                  <form action="{{ route('registerCompany.post') }} " method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row mt-3">
                              <label for="name" class="col-md-4 col-form-label text-right">Company Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
  
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

                          <div class="form-group row mt-3">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
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


<div class="form-group row mt-3">
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

                            <div class="form-group row mt-3">
                              <label for="logo" class="col-md-4 col-form-label text-right">Logo</label>
                                <div class="col-md-6">
                                    <img class="img-preview img-fluid mb-3 col-sm-2" style="display: none;">
                                    <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" onchange="previewImage()">
                                    @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                          <div class="form-group row mt-3">
                              <label for="bank" class="col-md-4 col-form-label text-right">Bank</label>
                              <div class="col-md-6">
                              <select class="form-select" id="bank" name="bank" required>
                                        <option value="">Choose</option>
                                        @foreach($banks as $val)
                                            <option value="{{ $val->id }}">{{ $val->bank }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('bank'))
                                        <span class="text-danger">{{ $errors->first('bank') }}</span>
                                    @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="norek" class="col-md-4 col-form-label text-right">Nomor Rekening</label>
                              <div class="col-md-6">
                                  <input type="number" id="norek" class="form-control" name="norek" required autofocus>
                                  @if ($errors->has('norek'))
                                      <span class="text-danger">{{ $errors->first('norek') }}</span>
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

  
                          <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                              <button type="submit" class="btn btn-primary">
                                  Submit
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
<script>
    function previewImage() {
        const logo = document.querySelector('#logo');
        const imgPreview = document.querySelector('.img-preview');


        const oFReader = new FileReader();
        oFReader.readAsDataURL(logo.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        imgPreview.style.display = 'block';

        }
    }
</script>
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
@endsection