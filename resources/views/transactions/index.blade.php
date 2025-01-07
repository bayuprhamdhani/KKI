@extends('layout')

@section('content')
<body class="bg-light">
    <div class="container">

        <div id="showproduct" class="row g-4">
        @foreach($cars as $car)
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card h-100 shadow-sm">
                        <!-- Logo Perusahaan -->
                        <img src="{{ asset('storage/' . $car->pict) }}" alt="{{ $car->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                        <!-- Konten Card -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-bold">{{ $car->car_name }}</h5>
                                <h5 class="card-title fw-bold">Rp {{ $car->price }}</h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="card-text text-muted">Pick Up: {{ $car->pick_up }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                            <p class="card-text text-muted">Drop Off: {{ $car->drop_off }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="card-text text-muted">Rental Date: {{ $car->date_order }}</p>
                            </div>
                        </div>

                        <!-- Footer Card -->
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                            <div class="d-flex">
                            <img src="{{ asset('storage/' . $car->logo) }}" class="card-img-top" style="width: 35px; height: 35px; object-fit: cover;">
                            <h5 class="card-title fw-bold mt-1">{{ $car->company }}</h5>
                            </div>
                            <div class="d-flex">
    @can('companyadmin')
    <form action="{{ route('registerTransaction.post3', $car->transaction_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="payment_photo" id="payment_photo_{{ $car->transaction_id }}" class="d-none" onchange="this.form.submit()">

        @php
    $paymentStatus = $car->paymentStatus;  // Mengambil nilai dari kolom 'payment'
    $isPaymentEmpty = empty($car->pictPayment);
    $downloadUrl = asset('storage/' . $car->pictPayment);
    @endphp

    @if ($paymentStatus == "COD")
        @if ($user->role_id == 1)
            @if ($isPaymentEmpty)
            <a href="https://api.whatsapp.com/send/?phone=62{{ $car->contact }}&text=Halo+{{ $car->company }}+kami+dari+elogi,+bisa+upload+bukti+transfernya+pak ?+&type=phone_number&app_absent=0" class="btn btn-warning text-white" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
                Contact Company
            </a>
            @else
                <a href="{{ $downloadUrl }}" download class="btn btn-primary text-white" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
                    Download Payment
                </a>
            @endif
        @elseif ($user->role_id == 2)
            @if ($isPaymentEmpty)
                <label for="payment_photo_{{ $car->transaction_id }}" class="btn btn-success text-white" style="cursor: pointer; width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
                    Upload Payment
                </label>
            @else
                <a href="{{ $downloadUrl }}" download class="btn btn-primary text-white" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
                    Download Payment
                </a>
            @endif
        @endif
    @elseif ($paymentStatus == "Transfer")
        @if ($user->role_id == 1)
            @if ($isPaymentEmpty)
            <label for="payment_photo_{{ $car->transaction_id }}" class="btn btn-success text-white" style="cursor: pointer; width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
                    Upload Payment
                </label>
            @else
                <a href="{{ $downloadUrl }}" download class="btn btn-primary text-white" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
                    Download Payment
                </a>
            @endif
        @elseif ($user->role_id == 2)
            @if ($isPaymentEmpty)
                <a href="https://api.whatsapp.com/send/?phone=6281312424171&text=Halo+saya+dengan+perusahaan+{{ $car->company }}+?+&type=phone_number&app_absent=0" class="btn btn-dark text-white" style="width: 100px; height: 30px; font-size: 10px; font-weight: bold;">
                    Contact Admin
                </a>
            @else
                <a href="{{ $downloadUrl }}" download class="btn btn-primary text-white" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
                    Download Payment
                </a>
            @endif
        @endif
    @else
        <span class="btn btn-danger text-white" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
            Error
        </span>
    @endif
    </form>
    @endcan
    @can('company')
    <a href="https://api.whatsapp.com/send/?phone=62{{ $car->contactCustomer }}&text=Halo+{{ $car->customerName }}+kami+dari+{{ $car->company }}+&type=phone_number&app_absent=0" class="btn btn-warning" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
        Contact Customer
    </a>
    @endcan
    @can('customer')
    <a href="https://api.whatsapp.com/send/?phone=62{{ $car->contactCompany }}&text=Halo+apa+benar+ini+dengan+perusahan+{{ $car->company }}+?+&type=phone_number&app_absent=0" class="btn btn-warning text-white" style="width: 119px; height: 30px; font-size: 10px; font-weight: bold;">
        Contact Company
    </a>
    @endcan
</div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection