@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Add Customer</div>
                  <div class="card-body">
  
                      <form action="{{ route('customers.store') }} " method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row mt-3">
                              <label for="name" class="col-md-4 col-form-label text-right">Customer Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="name" class="form-control" name="name" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row mt-3">
                              <label for="email_address" class="col-md-4 col-form-label text-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
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
                              <label for="contact" class="col-md-4 col-form-label text-right">Contact</label>
                              <div class="col-md-6">
                                  <input type="text" id="contact" class="form-control" name="contact" required autofocus>
                                  @if ($errors->has('contact'))
                                      <span class="text-danger">{{ $errors->first('contact') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="country" class="col-md-4 col-form-label text-right">Country</label>
                              <div class="col-md-6">
                                  <input type="text" id="country" class="form-control" name="country" required autofocus>
                                  @if ($errors->has('country'))
                                      <span class="text-danger">{{ $errors->first('country') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="province" class="col-md-4 col-form-label text-right">Province</label>
                              <div class="col-md-6">
                                  <input type="text" id="province" class="form-control" name="province" required autofocus>
                                  @if ($errors->has('province'))
                                      <span class="text-danger">{{ $errors->first('province') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="city" class="col-md-4 col-form-label text-right">City</label>
                              <div class="col-md-6">
                                  <input type="text" id="city" class="form-control" name="city" required autofocus>
                                  @if ($errors->has('city'))
                                      <span class="text-danger">{{ $errors->first('city') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="subdistrict" class="col-md-4 col-form-label text-right">Subdistrict</label>
                              <div class="col-md-6">
                                  <input type="text" id="subdistrict" class="form-control" name="subdistrict" required autofocus>
                                  @if ($errors->has('subdistrict'))
                                      <span class="text-danger">{{ $errors->first('subdistrict') }}</span>
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
                                  <input type="text" id="card_number" class="form-control" name="card_number" required autofocus>
                                  @if ($errors->has('card_number'))
                                      <span class="text-danger">{{ $errors->first('card_number') }}</span>
                                  @endif
                              </div>
                          </div>

                            <div class="form-group row mt-3">
                              <label for="card_owner" class="col-md-4 col-form-label text-right">Card Owner</label>
                              <div class="col-md-6">
                                  <input type="text" id="card_owner" class="form-control" name="card_owner" required autofocus>
                                  @if ($errors->has('card_owner'))
                                      <span class="text-danger">{{ $errors->first('card_owner') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="car_expired" class="col-md-4 col-form-label text-right">Card Expired</label>
                              <div class="col-md-6">
                                  <input type="text" id="car_expired" class="form-control" name="car_expired" required autofocus>
                                  @if ($errors->has('car_expired'))
                                      <span class="text-danger">{{ $errors->first('car_expired') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="cvv" class="col-md-4 col-form-label text-right">CVV</label>
                              <div class="col-md-6">
                                  <input type="text" id="cvv" class="form-control" name="cvv" required autofocus>
                                  @if ($errors->has('cvv'))
                                      <span class="text-danger">{{ $errors->first('cvv') }}</span>
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