@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Sistemos vartotojai') }}</div>

                    <div class="card-body">
                        @include('components.flash-message')

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Vardas Pavardė</th>
                                <th scope="col">El. paštas</th>
                                <th scope="col">Tel. numeris</th>
                                <th scope="col">Rolė</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->getFullName() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $roles[$user->role] }}</td>
                                    <td>
                                        <a class="btn btn-link"
                                           href="{{ route('users.edit', $user->id) }}">Redaguoti</a>
                                        <form class="d-inline" action="{{ route('users.destroy', $user->id) }}"
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
