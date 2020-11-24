@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @error('lat')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <p>Sveiki atvykę į skubios techninės pagalbos kelyje puslapį.</p>
                        @auth
                            <p>Galite pasirinkti norimą paslaugą: </p>
                            <p><a id="roadside-assistance" href="{{ url('/roadside-assistance') }}">Techninė pagalba įvykio vietoje</a></p>
                            <p class="mb-0"><a href="{{ url('/transportations') }}">Automobilio transportavimas visoje Lietuvoje</a></p>
                        @else
                            <p class="mb-0">
                                Jei norite užsisakyti paslaugą jums reiks
                                <a href="{{ route('login') }}">prisijungti</a>
                                arba
                                <a href="{{ route('register') }}">užsiregistruoti</a>.
                            </p>
                        @endauth
                    </div>
                    <div class="card-footer">
                        <p class="mb-0">21 MV - Skubios techninės pagalbos kelyje portalas</p>
                        <p class="mb-0">Lukas Rakauskas IFF-8/1</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        navigator.geolocation.getCurrentPosition(function(position) {
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            let link = document.getElementById('roadside-assistance');
            let href = link.getAttribute('href');
            link.setAttribute('href', `${href}?lat=${lat}&lng=${lng}`);
        });
    </script>
@endpush
