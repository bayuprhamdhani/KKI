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
                    <div class="card-body rounded shadow">
                        @guest
                            <h1 class="logo-text" style="font-weight: bold; font-size: 40px;">Travel & Agent</h1>
                            <h5 class="">Around The World With -eLOGI !</h5>
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    <h6>SERVICE</h6>
                                    <select class="custom-select" id="service" name="service" aria-label="service">
                                        <option value="">Choose</option>
                                        @foreach($services as $val)
                                            <option value="{{$val->Service_Name}}">{{$val->Service_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="RENT" class="row col-12 col-md-12" style="display: none;">
                                        <form id="filterForm" class="d-flex flex-wrap justify-content-between">
                                        <div class="col-3 col-md-2">
                                        <h6 id="lcity">COUNTRY</h6>
                                            <select class="custom-select" id="country" name="country" aria-label="country">
                                                <option value="">Choose</option>
                                                @foreach($countries as $val)
                                                    <option value="{{ $val->id }}">{{ $val->country }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-4 col-md-2">
                                            <h6>PROVINCE</h6>
                                            <select class="custom-select" id="province" name="province" aria-label="province">
                                                <option value="">Choose</option>
                                            </select>
                                        </div>

                                            <div class="form-group col-4 col-md-2">
                                                <h6>CITY</h6>
                                                <select class="custom-select" id="city" name="city" aria-label="city">
                                                    <option value="">Choose</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-4 col-md-2">
                                                <h6>Pick Up</h6>
                                                <input type="date" id="pick_up" name="pick_up" class="form-control">
                                            </div>

                                            <div class="form-group col-4 col-md-2">
                                                <h6>Drop Off</h6>
                                                <input type="date" id="drop_off" name="drop_off" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-warning col-3 col-md-1 col-lg-1" >Show Cars</button>
                                        </form>
                                </div>
                            </div>
                        @else
                            @can('admin')
                                <div class="row justify-content-between" id="dashboard">
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Car</h5>
                                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $carTotal }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Company</h5>
                                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $companyTotal }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Customer</h5>
                                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $customerTotal }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Transaction</h5>
                                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $transactionTotal }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">User</h5>
                                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $user }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <h1>Transaction Graphict by</h1>
                                    <select class="custom-select mt-2" id="chartTransaction" name="chartTransaction" aria-label="chartTransaction" style="width: 120px; margin-left: 10px;">
                                        <option value="">CHOOSE</option>
                                        @foreach($charts as $val)
                                            <option value="{{$val->chart}}">{{$val->chart}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endcan
                            @can('company')
                                <div class="row" id="dashboard">
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Car</h5>
                                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $carTotal }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Transaction</h5>
                                                <h1 class="card-subtitle mb-2 text-body-secondary">{{ $transactionTotal }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <h1>Transaction Graphict by</h1>
                                    <select class="custom-select mt-2" id="chartTransaction" name="chartTransaction" aria-label="chartTransaction" style="width: 120px; margin-left: 10px;">
                                        <option value="">CHOOSE</option>
                                        @foreach($charts as $val)
                                            <option value="{{$val->chart}}">{{$val->chart}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endcan
                            @can('customer')
                            <h1 class="logo-text" style="font-weight: bold; font-size: 40px;">Travel & Agent</h1>
                            <h5 class="">Around The World With -eLOGI !</h5>
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    <h6>SERVICE</h6>
                                    <select class="custom-select" id="service" name="service" aria-label="service">
                                        <option value="">Choose</option>
                                        @foreach($services as $val)
                                            <option value="{{$val->Service_Name}}">{{$val->Service_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="RENT" class="row col-12 col-md-12" style="display: none;">
                                        <form id="filterForm" class="d-flex flex-wrap justify-content-between">
                                        <div class="col-3 col-md-2">
                                        <h6 id="lcity">COUNTRY</h6>
                                            <select class="custom-select" id="country" name="country" aria-label="country">
                                                <option value="">Choose</option>
                                                @foreach($countries as $val)
                                                    <option value="{{ $val->id }}">{{ $val->country }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-4 col-md-2">
                                            <h6>PROVINCE</h6>
                                            <select class="custom-select" id="province" name="province" aria-label="province">
                                                <option value="">Choose</option>
                                            </select>
                                        </div>

                                            <div class="form-group col-4 col-md-2">
                                                <h6>CITY</h6>
                                                <select class="custom-select" id="city" name="city" aria-label="city">
                                                    <option value="">Choose</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-4 col-md-2">
                                                <h6>Pick Up</h6>
                                                <input type="date" id="pick_up" name="pick_up" class="form-control">
                                            </div>

                                            <div class="form-group col-4 col-md-2">
                                                <h6>Drop Off</h6>
                                                <input type="date" id="drop_off" name="drop_off" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-warning col-3 col-md-1 col-lg-1" >Show Cars</button>
                                        </form>
                                </div>
                            </div>
                            @endcan
                        @endguest
                    </div>
                </div>
                <div id="carResults" class="row g-4 mt-1">
            
                </div>
                <div id="loading-spinner" class="text-center py-5 mt-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <!--chart-->
                <div class="col=md-12 mt-3" id="TbyCar" style="display: none;">
                    <div class="card">
                        <div class="card-header">{{ __('Grafict Transactions By Car') }}</div>
                            <div class="p-6 m-20 bg-white rounded shadow">
                                {!! $chart->container() !!}
                            </div>
                    </div>
                </div>
                <div class="col=md-12 mt-3" id="TbyMonth" style="display: none;">
                    <div class="card">
                        <div class="card-header">{{ __('Grafict Transactions By Month') }}</div>
                            <div class="p-6 m-20 bg-white rounded shadow">
                                {!! $chart2->container() !!}
                            </div>
                    </div>
                </div>
                <div class="col=md-12 mt-3" id="TbyCompany" style="display: none;">
                    <div class="card">
                        <div class="card-header">{{ __('Grafict Transactions By Company') }}</div>
                            <div class="p-6 m-20 bg-white rounded shadow">
                                {!! $chart3->container() !!}
                            </div>
                    </div>
                </div>
                <div class="col=md-12 mt-3" id="TbyCustomer" style="display: none;">
                    <div class="card">
                        <div class="card-header">{{ __('Grafict Transactions By Customer') }}</div>
                            <div class="p-6 m-20 bg-white rounded shadow">
                                {!! $chart4->container() !!}
                            </div>
                    </div>
                </div>

        </div>
    </div>
</div>
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
        let showProductSection = document.getElementById('carResults');

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
            showProductSection.style.display = 'none';
        } else {
            $('#city').empty().append('<option value="">Choose</option>');
            $('#subdistrict').empty().append('<option value="">Choose</option>');
            showProductSection.style.display = 'none';

        }
    });
});
</script>
<script>
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();  // Hindari reload halaman

        let city = document.getElementById('city').value;
        let pickUp = document.getElementById('pick_up').value;
        let dropOff = document.getElementById('drop_off').value;
        let showProductSection = document.getElementById('carResults');
        let spinner = document.getElementById('loading-spinner');

        // Validasi tanggal
        if (!city || !pickUp || !dropOff) {
            alert('Please fill in all filters!');
            return;
        }

        // Sembunyikan hasil sementara dan tampilkan spinner
        showProductSection.style.display = 'none';
        spinner.style.display = 'block';

        // Kirim request dengan parameter kota dan tanggal
        fetch(`/filter-cars?city=${city}&pick_up=${pickUp}&drop_off=${dropOff}`)
            .then(response => response.json())
            .then(data => {
                showProductSection.innerHTML = data.html;  // Tampilkan hasil mobil
                spinner.style.display = 'none';  // Hilangkan spinner
                showProductSection.style.display = 'flex';
            })
            .catch(error => {
                console.error('Error:', error);
                spinner.style.display = 'none';  // Hilangkan spinner jika error
            });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);

    // Format tanggal ke yyyy-mm-dd
    function formatDate(date) {
        let day = date.getDate().toString().padStart(2, '0');
        let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Bulan dimulai dari 0
        let year = date.getFullYear();
        return `${year}-${month}-${day}`;
    }

    // Set minimal tanggal pick up ke besok
    const dateRentInput = document.getElementById("pick_up");
    const dateBackInput = document.getElementById("drop_off");

    dateRentInput.min = formatDate(tomorrow);

    // Validasi drop off date berdasarkan pick up date
    dateRentInput.addEventListener("change", function () {
        const pick_up = new Date(this.value);

        if (pick_up) {
            const dropOffMinDate = new Date(pick_up);
            dropOffMinDate.setDate(pick_up.getDate() + 1);
            dateBackInput.min = formatDate(dropOffMinDate);
            dateBackInput.value = ""; // Reset drop off date
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        // Ketika form filter disubmit
        $('#filterForm').on('submit', function(event) {
            event.preventDefault();

            var formData = {
                city: $('#city').val(),
                pick_up: $('#pick_up').val(),
                drop_off: $('#drop_off').val()
            };

            $.ajax({
                url: '/filter-cars', // Rute untuk filter
                method: 'GET',
                data: formData,
                success: function(response) {
                    // Memperbarui bagian hasil mobil yang tersedia
                    $('#carResults').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error("There was an error filtering the cars: " + error);
                }
            });
        });
    });
</script>
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

<script src="{{ $chart2->cdn() }}"></script>
{{ $chart2->script() }}

<script src="{{ $chart3->cdn() }}"></script>
{{ $chart3->script() }}

<script src="{{ $chart4->cdn() }}"></script>
{{ $chart4->script() }}
@endsection