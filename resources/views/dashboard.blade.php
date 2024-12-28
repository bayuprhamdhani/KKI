@extends('layout')

@section('content')
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
    const dateRentInput = document.getElementById("Date_Rent");
    const dateBackInput = document.getElementById("Date_Back");

    dateRentInput.min = formatDate(tomorrow);

    // Validasi drop off date berdasarkan pick up date
    dateRentInput.addEventListener("change", function () {
        const pickUpDate = new Date(this.value);

        if (pickUpDate) {
            const dropOffMinDate = new Date(pickUpDate);
            dropOffMinDate.setDate(pickUpDate.getDate() + 1);
            dateBackInput.min = formatDate(dropOffMinDate);
            dateBackInput.value = ""; // Reset drop off date
        }
    });
});
</script>

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
                                    <h6 style="margin-left: 15px;" id="lcity">COUNTRY</h6>
                                    <select class="custom-select" id="country" name="country" aria-label="country" style="width: 130px; margin-left: 15px;">
                                    <option value="">CHOOSE</option>
                                        @foreach($countries as $val)
                                            <option value="{{ $val->id }}">{{ $val->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <h6 style="margin-left: 15px;" id="lprovince">PROVINCE</h6>
                                    <select class="custom-select" id="province" name="province" aria-label="province" style="width: 130px; margin-left: 15px;">
                                    <option value="">Choose</option>
                                    </select>
                                </div>
                                <div>
                                    <h6 style="margin-left: 15px;" id="lcity">CITY</h6>
                                    <select class="custom-select" id="city" name="service" aria-label="service" style="width: 130px; margin-left: 15px;">
                                    <option value="">Choose</option>
                                    </select>
                                </div>

                                <div class="form-group position-relative" style="width: 130px; margin-left: 15px;">
                                    <h6 class="mb-2">PICK UP DATE</h6>
                                    <input type="date" id="Date_Rent" class="form-control" name="Date_Rent">
                                </div>
                                <div class="form-group position-relative" style="width: 130px; margin-left: 15px;">
                                    <h6 class="mb-2">DROP OFF DATE</h6>
                                    <input type="date" id="Date_Back" class="form-control" name="Date_Back">
                                </div>

                                <button class="btn btn-sm btn-warning" type="button" style="backgrounc-color: black; width: 120px; margin-left: 15px;">SEARCH</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div id="showproduct" class="row g-4">
            @foreach($cars as $car)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Logo Perusahaan -->
                        <img src="{{ asset('storage/' . $car->pict) }}" alt="{{ $car->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                        <!-- Konten Card -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-bold">{{ $car->name }}</h5>
                            <h5 class="card-title fw-bold">{{ $car->price }}</h5>
                            </div>
                        @php
                            $transmisiText = '';

                            if ($car->transmisi == 1) {
                                $transmisiText = 'Manual';
                            } elseif ($car->transmisi == 2) {
                                $transmisiText = 'Matic';
                            } else {
                                $transmisiText = 'Error';
                            }
                        @endphp
                            <div class="d-flex justify-content-between">
                            <p class="card-text text-muted">Transmisi : {{ $transmisiText }}</p>
                            <p class="card-text text-muted">Chair : {{ $car->qty }}</p>
                            </div>
                            <!-- Kategori Bank -->

                        </div>

                        <!-- Footer Card -->
                        <div class="card-footer bg-white border-top-0">
                        @php
                            $categoryColorClass = '';
                            $statusText = '';

                            if ($car->status == 1) {
                                $categoryColorClass = 'bg-success text-white';
                                $statusText = 'Available';
                            } elseif ($car->status == 2) {
                                $categoryColorClass = 'bg-danger text-white';
                                $statusText = 'Unavailable';
                            } else {
                                $categoryColorClass = 'bg-dark text-white';
                                $statusText = 'Error';
                            }
                        @endphp
                            <img src="{{ asset('storage/' . $car->company_logo) }}" class="card-img-top" style="width: 35px; height: 35px; object-fit: cover;">
                            <span class="badge {{ $categoryColorClass }} fs-6 px-1 py-2">{{ $statusText }}</span>
                            <a href="{{ route('registerTransaction', ['id' => $car->id]) }}" class="btn btn-sm btn-warning mb-1">
                                ORDER
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
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

@endsection