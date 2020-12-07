@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Automobilio transportavimas') }}
                    <a href="{{ route('transportations.create') }}">Užsakyti transportavimą</a>
                </div>

                <div class="card-body">
                    @include('components.flash-message')

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Miestas</th>
                                <th scope="col">Statusas</th>
                                <th scope="col">Užsakymo data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($transportations as $transportation)
                            <tr>
                                <td>{{ $transportation->city }}</td>
                                <td>{{ $statuses[$transportation->status] }}</td>
                                <td>{{ $transportation->created_at }}</td>
                                <td>
                                    @if ($transportation->status != 'done')
                                        <form action="{{ route('transportations.destroy', $transportation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button href="#" class="btn btn-link text-danger">Atšaukti</button>
                                        </form>
                                    @endif
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
