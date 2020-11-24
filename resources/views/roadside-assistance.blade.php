@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Techninė pagalba įvykio vietoje') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Automobilis yra mieste: {{ $vehicle->city }}</p>
                    <p>Atstumas iki automobilio: {{ round($distance, 2) }}km</p>
                    <a href="/roadside-assistance/cancel" class="btn btn-danger">Atsisakyti paslaugos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
