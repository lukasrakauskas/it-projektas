@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Redaguoti automobilio informaciją') }}</div>

                    <div class="card-body">
                        @include('components.flash-message')

                        <form action="{{ route('vehicles.update', $id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="license_plate">Valstybiniai numeriai</label>
                                <input type="text" class="form-control @error('license_plate') is-invalid @enderror"
                                       id="license_plate" name="license_plate" value="{{ old('license_plate') }}">
                                @error('license_plate')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="brand">Markė</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                           id="brand" name="brand" value="{{ old('brand') }}">
                                    @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="model">Modelis</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror"
                                           id="model" name="model" value="{{ old('model') }}">
                                    @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city">Miestas</label>
                                <input type="text" class="form-control" disabled
                                       id="city" name="city" value="{{ old('city') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Išsaugoti atnaujintą automobilio informaciją
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
