@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Automobilio transportavimas') }}
                    <a href="{{ route('transportations.create') }}">Užsakyti transportavimą</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Miestas</th>
                                <th scope="col">Atlikta</th>
                                <th scope="col">Užsakymo data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($transportations as $transportation)
                            <tr>
                                <th>{{ $transportation->city }}</th>
                                <td>
                                    @if ($transportation->complete)
                                        Atlikta
                                    @else
                                        Neatlikta
                                    @endif
                                </td>
                                <td>{{ $transportation->created_at }}</td>
                                <td>
                                    @if (!$transportation->complete)
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
