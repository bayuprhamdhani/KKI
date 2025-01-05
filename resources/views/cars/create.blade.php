@extends('layout')
  
@section('content')
<!-- < <h1>Hello, {{ auth()->user()->name }}</h1>
 <h1>Hello, {{ auth()->user()->path }}</h1>
<img src="{{ asset('storage/' . auth()->user()->path) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;">
-->
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Add Car</div>
                  <div class="card-body">
  
                  <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Car Name -->
    <div class="form-group row mt-3">
        <label for="name" class="col-md-4 col-form-label text-right">Car Name</label>
        <div class="col-md-6">
            <input type="text" id="name" class="form-control" name="name" required autofocus>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <!-- Chair Quantity -->
    <div class="form-group row mt-3">
        <label for="qty" class="col-md-4 col-form-label text-right">Chair Quantity</label>
        <div class="col-md-6">
            <input type="number" id="qty" class="form-control" name="qty" required>
            @if ($errors->has('qty'))
                <span class="text-danger">{{ $errors->first('qty') }}</span>
            @endif
        </div>
    </div>

    <!-- Transmisi -->
    <div class="form-group row mt-3">
        <label for="transmisi" class="col-md-4 col-form-label text-right">Transmisi</label>
        <div class="col-md-6">
            <select class="form-select" id="transmisi" name="transmisi" required>
                <option value="">Choose</option>
                @foreach($transmisies as $val)
                    <option value="{{ $val->id }}">{{ $val->transmisi }}</option>
                @endforeach
            </select>
            @if ($errors->has('transmisi'))
                <span class="text-danger">{{ $errors->first('transmisi') }}</span>
            @endif
        </div>
    </div>

    <!-- Price -->
    <div class="form-group row mt-3">
        <label for="price" class="col-md-4 col-form-label text-right">Price</label>
        <div class="col-md-6">
            <input type="number" id="price" class="form-control" name="price">
            @if ($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
    </div>

    <!-- Car Pict -->
    <div class="form-group row mt-3">
        <label for="pict" class="col-md-4 col-form-label text-right">pict</label>
        <div class="col-md-6">
            <img class="img-preview img-fluid mb-3 col-sm-2" style="display: none;">
            <input class="form-control @error('pict') is-invalid @enderror" type="file" id="pict" name="pict" onchange="previewImage()">
            @error('pict')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- Status -->
    <div class="form-group row mt-3">
        <label for="status" class="col-md-4 col-form-label text-right">Status</label>
        <div class="col-md-6">
            <select class="form-select" id="status" name="status" required>
                <option value="">Choose</option>
                @foreach($statuses as $val)
                    <option value="{{ $val->id }}">{{ $val->status }}</option>
                @endforeach
            </select>
            @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row mt-3 d-none">
        <label for="company" class="col-md-4 col-form-label text-right">Company</label>
        <div class="col-md-6">
            <input type="text" id="company" class="form-control" name="company" value="{{ auth()->user()->user }}" required>
            @if ($errors->has('company'))
                <span class="text-danger">{{ $errors->first('company') }}</span>
            @endif
        </div>
    </div>

    <!-- Submit Button -->
    <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
<script>
    function previewImage() {
        const logo = document.querySelector('#pict');
        const imgPreview = document.querySelector('.img-preview');


        const oFReader = new FileReader();
        oFReader.readAsDataURL(logo.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        imgPreview.style.display = 'block';

        }
    }

    function formatRupiah(input) {
        // Ambil nilai input dan hilangkan semua karakter selain angka
        let value = input.value.replace(/[^\d]/g, "");
        
        // Format nilai menjadi Rupiah
        let formatted = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0
        }).format(value);

        // Tambahkan "Rp" di awal
        input.value = value ? `Rp ${formatted}` : "";
    }
</script>
@endsection