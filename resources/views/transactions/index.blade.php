@extends('layout')

@section('content')
<body class="bg-light">
    <div class="container">

        <h1 class="text-center mb-4">Cars</h1>
        <div id="showproduct" class="row g-4">
        @foreach($cars as $car)
                <div class="col-12 col-md-6 col-lg-4">
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
                        <div class="card-footer bg-white border-top-0 d-flex">
                            <img src="{{ asset('storage/' . $car->logo) }}" class="card-img-top" style="width: 35px; height: 35px; object-fit: cover;">
                            <h5 class="card-title fw-bold mt-1">{{ $car->company }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection