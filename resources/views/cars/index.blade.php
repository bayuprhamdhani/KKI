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
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <img src="{{ asset('storage/' . $car->company_logo) }}" class="card-img-top" style="width: 35px; height: 35px; object-fit: cover;">
                                <h6 class="card-title fw-bold mt-2">{{ $car->company_name }}</h6>
                            </div>
                            <div class="mt-2">
                                <span class="badge {{ $categoryColorClass }} fs-7 px-1 py-2">{{ $statusText }}</span>
                                @can('company')
                                    <a href="{{ route('cars.edit', $car->id) }}" class="ml-3 btn btn-sm btn-warning" style="height: 27px; padding: 1px; width: 35px;">
                                        Edit
                                    </a>
                                    <form action="{{ route('cars.destroy',$car->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Do you really want to delete {{ $car->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="height: 27px; padding: 1px; width: 65px;">
                                            <span class="badge">
                                                Delete
                                            </span>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection