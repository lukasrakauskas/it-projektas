@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Automobiliai') }}
                        <a href="{{ route('vehicles.create') }}">Pridėti automobilį</a>
                    </div>

                    <div class="card-body">
                        @include('components.flash-message')

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Modelis</th>
                                <th scope="col">Miestas</th>
                                <th scope="col">Užimtas</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->license_plate }}</td>
                                    <td>{{ $vehicle->brand }} {{ $vehicle->model }}</td>
                                    <td class="">{{ $vehicle->city }}</td>
                                    <td class="{{ $vehicle->available == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $vehicle->available == 1 ? 'Laisvas' : 'Užimtas' }}
                                    </td>
                                    <td>
                                        <a class="btn btn-link" href="{{ route('vehicles.edit', $vehicle->id) }}">Redaguoti</a>
                                        <form class="d-inline" action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button href="#" class="btn btn-link text-danger">Pašalinti</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
