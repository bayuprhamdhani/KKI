@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Edit Company</div>
                  <div class="card-body">
  
                      <form action="{{ route('companies.update', $company->id ) }} " method="POST">
                          @csrf
                          @method('PUT')
                          <div class="form-group row mt-3">
                              <label for="name" class="col-md-4 col-form-label text-right">Company Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" value="{{ $company->name }}" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row mt-3">
                              <label for="email_address" class="col-md-4 col-form-label text-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" value="{{ $company->email }}" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row mt-3">
                              <label for="password" class="col-md-4 col-form-label text-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password">
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="address" class="col-md-4 col-form-label text-right">Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="address" class="form-control" name="address" value="{{ $company->address }}" required autofocus>
                                  @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="logo" class="col-md-4 col-form-label text-right">Logo</label>
                              <div class="col-md-6">
                                  <input type="text" id="logo" class="form-control" name="logo" value="{{ $company->logo }}" required autofocus>
                                  @if ($errors->has('logo'))
                                      <span class="text-danger">{{ $errors->first('logo') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="bank" class="col-md-4 col-form-label text-right">Bank</label>
                              <div class="col-md-6">
                                  <input type="text" id="bank" class="form-control" name="bank" value="{{ $company->bank }}" required autofocus>
                                  @if ($errors->has('bank'))
                                      <span class="text-danger">{{ $errors->first('bank') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="norek" class="col-md-4 col-form-label text-right">Nomor Rekening</label>
                              <div class="col-md-6">
                                  <input type="text" id="norek" class="form-control" name="norek" value="{{ $company->norek }}" required autofocus>
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
@endsection