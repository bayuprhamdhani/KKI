@extends('layout')

@section('content')
<link href="css/dashboard.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="js/dashboard.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h1 class="logo-text" style="font-weight: bold; font-size: 40px;">Travel & Agent</h1>
                    <h5 class="">
                    <h5 class="" style="">Around The World With -eLOGI !</h5>
                    <div style="display: flex;">
                        <div>
                                <h6>SERVICE</h6>
                                <select class="custom-select" id="service" name="service" aria-label="service" style="width: 120px;">
                                <option value="">CHOOSE</option>
                                    @foreach($services as $val)
                                        <option value="{{$val->Service_Name}}">{{$val->Service_Name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div id="RENT" style="display: none;">
                            <div style="display: flex;">
                                <div>
                                    <h6 style="margin-left: 15px;" id="lcity">CITY</h6>
                                    <select class="custom-select" id="city" name="service" aria-label="service" style="width: 130px; margin-left: 15px;">
                                    <option value="Choose City">CHOOSE</option>
                                        @foreach($cities as $val)
                                            <option value="{{$val->City_Name}}">{{$val->City_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group position-relative" style="width: 120px; margin-left: 15px;">
                                    <h6 class="mb-2">PICK UP DATE</h6>
                                    <input type="date" id="Date_Rent" class="form-control" name="Date_Rent">
                                </div>
                                <div class="form-group position-relative" style="width: 120px; margin-left: 15px;">
                                    <h6 class="mb-2">DROP OFF DATE</h6>
                                    <input type="date" id="Date_Back" class="form-control" name="Date_Rent">
                                </div>
                                <button class="btn btn-secondary" type="button" style="width: 120px; margin-left: 15px;">SEARCH</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="tasikmalaya" style="display: none; margin-top: 1rem;">
                    <div class="card-header">Choose Vehicle</div>
                <div class="card-body">
                    <ul class="navbar-nav mr-auto align-items-center right-nav-link d-flex flex-row flex-wrap justify-space-between">
                    @foreach(['bus.jpg', 'bus.jpg', 'bus.jpg', 'bus.jpg', 'bus.jpg', 'bus.jpg'] as $image)
                        <li class="nav-item">
                        <div class="rent" id="busimage" style="background-image: url('{{ asset('images/bus.jpg') }}'); background-size: cover;">
                        </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>

            <div class="card" id="bustasik" style="margin-top: 1rem; display: none;">
		        <div class="card-header">
                    <div class="">
                        <button class="btn btn-secondary" onclick="backtasikmalaya()" id="backtasikmalaya" type="button" style="width: 120px;">BACK</button>
                        <i style="font-size: 25px; vertical-align: middle; font-style: normal;"> Bus Rent in Tasikmalaya</i>
                    </div>  
                </div>
                <div class="card-body">
                    <ul class="navbar-nav mr-auto align-items-center right-nav-link d-flex flex-row flex-wrap justify-content-between">
                        <li class="nav-item">
                            <div class="tour mt-4"  style="background-color: black; height: 325px; background-size: cover;">
                                <img src="images/budiman.jpg" class="rounded-t-2xl" style="border-radius: 5px 5px 0 0; width: 250px;">
                                <h5 class="rentPrice">Rp1.000.000 / Day</h5>
                                <h5 class="stock">1 Units of Bus</h5>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btn btn-secondary" id="buttonorder1" onclick="buttonorder1()" type="button" style="margin-left: 10px">ORDER</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="tour mt-4"  style="background-color: black; height: 325px; background-size: cover;">
                                <img src="images/mayasari.jpg" class="rounded-t-2xl" style="border-radius: 5px 5px 0 0; width: 250px;">
                                <h5 class="rentPrice">Rp1.500.000 / Day</h5>
                                <h5 class="stock">7 Units of Bus</h5>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btn btn-secondary" id="buttonorder2" onclick="buttonorder2()" type="button" style="margin-left: 10px">ORDER</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="tour mt-4"  style="background-color: black; height: 325px; background-size: cover;">
                                <img src="images/primajasa.jpg" class="rounded-t-2xl" style="border-radius: 5px 5px 0 0; width: 250px;">
                                <h5 class="rentPrice">Rp950.000 / Day</h5>
                                <h5 class="stock">0 Units of Bus</h5>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                   <button class="btn disabled" type="button" style="margin-left: 10px">OVER</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="tour mt-4"  style="background-color: black; height: 325px; background-size: cover;">
                                <img src="images/doa.jpg" class="rounded-t-2xl" style="border-radius: 5px 5px 0 0; width: 250px;">
                                <h5 class="rentPrice">Rp1.100.000 / Day</h5>
                                <h5 class="stock">3 Units of Bus</h5>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btn btn-secondary" id="buttonorder3" onclick="buttonorder3()" type="button" style="margin-left: 10px">ORDER</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card " id="formrentbusbudimantasik" style="margin-top: 1rem; display: none;">
		        <div class="card-header">
                    <button class="btn btn-secondary" id="backbustasik" onclick="backbustasik()" type="button" style="">BACK</button>
                    <i style="font-size: 25px; vertical-align: middle; font-style: normal;"> Transaction</i>
                </div>
                <div class="card-body">
                    <form action="#" method="post" novalidate="novalidate">
                        <div class="form-group text-center">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="text-muted fa fa-cc-visa fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-mastercard fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-amex fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-discover fa-2x"></i></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="place">
                            <div style="width: 49%">
                                <label for="cc-payment" class="control-label mb-1">SUBDISTRICT</label>
                                <div>
                                    <select class="custom-select" id="city" name="service" aria-label="service" style="">
                                        <option value="Choose Subdistrict">Choose Subdistrict</option>
                                            @foreach($subdistricts as $val)
                                                <option value="{{$val->Subdistrict_Name}}">{{$val->Subdistrict_Name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="width: 49%">
                                <label for="cc-number" class="control-label mb-1">DESTINATION</label>
                                <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number">
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            </div>
                        </div>
                        <div class="date">
                           <div style="width: 49%">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">date rent</label>
                                    <input type="date" id="Date_Rent" class="form-control" name="Date_Rent">
                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div style="width: 49%">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">date back</label>
                                    <input type="date" id="Date_Back" class="form-control" name="Date_Back">
                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>
                        <label for="cc-exp" class="control-label mb-1">Input Sponsion</label>
                        <div class="sponsion">
                            <div style="width: 95%">
                                <div class="form-group">
                                    <input type="text" id="Date_Rent" class="form-control" name="Date_Rent" placeholder="Sponsion Type">
                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div style="width: 3.5%">
                                <button onclick="input()" type="file" class="buttonn" id="file">
                                    <i class="fa  fa-folder"></i>
                                    <input type="file" id="fileinput" name="fileinput" class="form-control-file" style="display: none;" onchange="handleFileInput(this)">
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Number HP / WA</label>
                            <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number">
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                        </div>
                        <div>
                            <button id="payment-button" type="button" class="btn btn-lg btn-info btn-block" style="margin-top: 1rem;">
                                <i class="fa fa-lock fa-lg"></i>
                                <span id="paymentbutton" onclick="buttonpay()">Pay Rp1.000.000</span>
                            </button>
                        </div>
                        <div>
                            <button id="sending-button" type="button" class="btn btn-lg btn-info btn-block" style="display:none;">
                                <i class="fa fa-lock fa-lg"></i>
                                <span id="paymentbutton1">SENDING...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card" style="margin-top: 1rem">
                  <div class="card-header">Add Product</div>
                  <div class="card-body">

                      <form action="{{ route('products.store') }}" method="POST">
                          @csrf
                          <div class="form-group row mt-3">
                              <label for="product_name" class="col-md-4 col-form-label text-right">Product Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="product_name" class="form-control" name="product_name" required autofocus>
                                  @if ($errors->has('product_name'))
                                      <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="qty" class="col-md-4 col-form-label text-right">QTY</label>
                              <div class="col-md-6">
                                  <input type="text" id="qty" class="form-control" name="qty" required autofocus>
                                  @if ($errors->has('qty'))
                                      <span class="text-danger">{{ $errors->first('qty') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="selling_price" class="col-md-4 col-form-label text-right">Selling Price</label>
                              <div class="col-md-6">
                                  <input type="text" id="selling_price" class="form-control" name="selling_price" required>
                                  @if ($errors->has('selling_price'))
                                      <span class="text-danger">{{ $errors->first('selling_price') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="buying_price" class="col-md-4 col-form-label text-right">Buying Price</label>
                              <div class="col-md-6">
                                  <input type="text" id="buying_price" class="form-control" name="buying_price" required>
                                  @if ($errors->has('buying_price'))
                                      <span class="text-danger">{{ $errors->first('buying_price') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="product_type" class="col-md-4 col-form-label text-right">Product Type</label>
                            <div class="col-md-6">
                                <select class="form-select" id="product_type" name="product_type" aria-label="product_type">
                                    <option value="">Choose</option>

                                </select>
                                @if ($errors->has('product_type'))
                                    <span class="text-danger">{{ $errors->first('product_type') }}</span>
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
@endsection