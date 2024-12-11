@extends('layout')

@section('content')
<body class="bg-light">
    <div class="container">
        <h1 class="text-center mb-4">Cars</h1>
        <div id="showproduct" class="row g-4">
            @foreach($cars as $car)
                <div class="col-12 col-md-6 col-lg-3">
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
                            <span class="badge {{ $categoryColorClass }} fs-6 px-1 py-2">{{ $statusText }}</span>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-warning mb-1">
                                Edit
                            </a>
                            <form action="{{ route('cars.destroy',$car->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Do you really want to delete {{ $car->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="text-muted">
                                                Delete
                                            </span></button>
                                    </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection