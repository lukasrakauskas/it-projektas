@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Automobilio transportavimas') }}</div>

                <div class="card-body">
                    @include('components.flash-message')

                    <form action="{{ route('transportations.store') }}" method="POST">
                        @csrf
                        <p class="mb-0">Pasirinkite saugijimo aikštelę:</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="city" id="city1" value="Vilnius">
                            <label class="form-check-label" for="city1">
                                Vilnius
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="city" id="city2" value="Kaunas">
                            <label class="form-check-label" for="city2">
                                Kaunas
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="city" id="city3" value="Klaipėda">
                            <label class="form-check-label" for="city3">
                                Klaipėda
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="city" id="city4" value="Šiauliai">
                            <label class="form-check-label" for="city4">
                                Šiauliai
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="city" id="city5" value="Panevėžys">
                            <label class="form-check-label" for="city5">
                                Panevėžys
                            </label>
                        </div>
                        @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Užsakyti automobilio transportavimą</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
