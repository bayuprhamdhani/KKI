@extends('layout')

@section('content')
<body class="bg-light">
    <div class="container">
        <h1 class="text-center mb-4">Companies</h1>
        <div id="showproduct" class="row g-4">
            @foreach($companies as $company)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <!-- Logo Perusahaan -->
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                        <!-- Konten Card -->
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $company->name }}</h5>
                            <p class="card-text text-muted">{{ $company->address }}</p>

                            <!-- Kategori Bank -->

                        </div>

                        <!-- Footer Card -->
                        <div class="card-footer bg-white border-top-0">
                        @php
                            $categoryColorClass = '';
                            $statusText = '';

                            if ($company->status == 1) {
                                $categoryColorClass = 'bg-success text-white';
                                $statusText = 'Available';
                            } elseif ($company->status == 2) {
                                $categoryColorClass = 'bg-danger text-white';
                                $statusText = 'Unavailable';
                            } else {
                                $categoryColorClass = 'bg-dark text-white';
                                $statusText = 'Error';
                            }
                        @endphp
                            <span class="badge {{ $categoryColorClass }} fs-6 px-1 py-2">{{ $statusText }}</span>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning mb-1">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection