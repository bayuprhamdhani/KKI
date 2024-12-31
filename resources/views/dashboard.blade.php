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
        <h5 class="">Around The World With -eLOGI !</h5>
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
                        <h6 style="margin-left: 15px;" id="lcity">COUNTRY</h6>
                        <select class="custom-select" id="country" name="country" aria-label="country" style="width: 130px; margin-left: 15px;">
                            <option value="">CHOOSE</option>
                            @foreach($countries as $val)
                                <option value="{{ $val->id }}">{{ $val->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h6 style="margin-left: 15px;">PROVINCE</h6>
                        <select class="custom-select" id="province" name="province" aria-label="province" style="width: 130px; margin-left: 15px;">
                            <option value="">Choose</option>
                        </select>
                    </div>
<form id="filterForm" class="d-flex">

    <div class="form-group">
        <h6 style="margin-left: 15px;">CITY</h6>
        <select class="custom-select" id="city" name="city" aria-label="city" style="width: 130px; margin-left: 15px;">
            <option value="">Select City</option>
            @foreach ($cities as $city)
                <option value="{{ $city->name }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Input Tanggal Pick-up -->
    <div class="form-group" style="margin-left: 15px;">
        <h6 >Pick Up Date</h6>
        <input type="date" id="pick_up" name="pick_up" class="form-control">
    </div>

    <!-- Input Tanggal Drop-off -->
    <div class="form-group" style="margin-left: 15px;">
        <h6 >Drop Off Date</h6>
        <input type="date" id="drop_off" name="drop_off" class="form-control">
    </div>

    <button type="submit" class="btn btn-warning" style="margin-left: 15px;">Show Cars</button>
</form>

                </div>
            </div>
        </div>
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
                        $('#city').append('<option value="' + city.city + '">' + city.city + '</option>');
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

@endsection