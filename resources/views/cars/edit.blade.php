@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Edit Mobil</div>
                  <div class="card-body">
  
                      <form action="{{ route('cars.update', $car->id ) }} " method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <!-- Car Name -->
    <div class="form-group row mt-3">
        <label for="name" class="col-md-4 col-form-label text-right">Car Name</label>
        <div class="col-md-6">
            <input type="text" id="name" class="form-control" name="name" value="{{ $car->name }}" required autofocus>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <!-- Chair Quantity -->
    <div class="form-group row mt-3">
        <label for="qty" class="col-md-4 col-form-label text-right">Chair Quantity</label>
        <div class="col-md-6">
            <input type="text" id="qty" class="form-control" name="qty" value="{{ $car->qty }}" required>
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
                    <option value="{{$val->id}}" {{ ($car->transmisi == $val->id) ? 'selected' : '' }}>{{$val->transmisi}}</option>
                @endforeach
            </select>
            @if ($errors->has('transmisi'))
                <span class="text-danger">{{ $errors->first('transmisi') }}</span>
            @endif
        </div>
    </div>

    <!-- Mileage -->
    <div class="form-group row mt-3">
        <label for="mileage" class="col-md-4 col-form-label text-right">Mileage</label>
        <div class="col-md-6">
            <input type="text" id="mileage" class="form-control" name="mileage" value="{{ $car->mileage }}" required>
            @if ($errors->has('mileage'))
                <span class="text-danger">{{ $errors->first('mileage') }}</span>
            @endif
        </div>
    </div>

    <!-- Price -->
    <div class="form-group row mt-3">
        <label for="price" class="col-md-4 col-form-label text-right">Price</label>
        <div class="col-md-6">
            <input type="text" id="price" class="form-control" name="price" value="{{ $car->price }}" required>
            @if ($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
    </div>

    <!-- Car Pict -->
    <div class="form-group row mt-3">
        <label for="pict" class="col-md-4 col-form-label text-right">pict</label>
        <div class="col-md-6">
            <img class="img-preview img-fluid mb-3 col-sm-2" src="{{ asset('storage/' . $car->pict) }}">
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
                <option value="{{$val->id}}" {{ ($car->status == $val->id) ? 'selected' : '' }}>{{$val->status}}</option>
                @endforeach
            </select>
            @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
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
</script>
@endsection