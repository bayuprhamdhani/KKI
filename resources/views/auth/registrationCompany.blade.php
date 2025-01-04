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
                              <label for="address" class="col-md-4 col-form-label text-right">Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="address" class="form-control" name="address" required autofocus>
                                  @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
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
                                  <input type="text" id="bank" class="form-control" name="bank" required autofocus>
                                  @if ($errors->has('bank'))
                                      <span class="text-danger">{{ $errors->first('bank') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="norek" class="col-md-4 col-form-label text-right">Nomor Rekening</label>
                              <div class="col-md-6">
                                  <input type="text" id="norek" class="form-control" name="norek" required autofocus>
                                  @if ($errors->has('norek'))
                                      <span class="text-danger">{{ $errors->first('norek') }}</span>
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
@endsection