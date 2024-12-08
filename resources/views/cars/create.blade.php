@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Tambah Mobil</div>
                  <div class="card-body">
  
                  <form action="{{ route('cars.store') }}" method="POST">
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
            <input type="text" id="qty" class="form-control" name="qty" required>
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

    <!-- Mileage -->
    <div class="form-group row mt-3">
        <label for="mileage" class="col-md-4 col-form-label text-right">Mileage</label>
        <div class="col-md-6">
            <input type="text" id="mileage" class="form-control" name="mileage" required>
            @if ($errors->has('mileage'))
                <span class="text-danger">{{ $errors->first('mileage') }}</span>
            @endif
        </div>
    </div>

    <!-- Price -->
    <div class="form-group row mt-3">
        <label for="price" class="col-md-4 col-form-label text-right">Price</label>
        <div class="col-md-6">
            <input type="text" id="price" class="form-control" name="price" required>
            @if ($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
    </div>

    <!-- Car Pict -->
    <div class="form-group row mt-3">
        <label for="pict" class="col-md-4 col-form-label text-right">Car Pict</label>
        <div class="col-md-6">
            <input type="text" id="pict" class="form-control" name="pict" required>
            @if ($errors->has('pict'))
                <span class="text-danger">{{ $errors->first('pict') }}</span>
            @endif
        </div>
    </div>

    <!-- Status -->
    <div class="form-group row mt-3">
        <label for="status" class="col-md-4 col-form-label text-right">Status</label>
        <div class="col-md-6">
            <select class="form-select" id="status" name="status" required>
                <option value="">Choose</option>
                @foreach($statuses as $val)
                    <option value="{{ $val->status }}">{{ $val->status }}</option>
                @endforeach
            </select>
            @if ($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
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
@endsection