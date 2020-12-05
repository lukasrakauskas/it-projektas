@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Redaguoti vartotojo informaciją') }}</div>

                    <div class="card-body">
                        @include('components.flash-message')

                        <form action="{{ route('users.update', $id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="user-name">Vardas</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="user-name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="user-surname">Pavardė</label>
                                <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                       id="user-surname" name="surname" value="{{ old('surname') }}">
                                @error('surname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="user-email">El. paštas</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="user-email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="user-phone">Tel. numeris</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="user-phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="user-role">Vartotojo rolė</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="user-role" name="role">
                                    <option {{ old('role') == 'user' ? 'selected' : '' }} value="user">Vartotojas
                                    </option>
                                    <option {{ old('role') == 'worker' ? 'selected' : '' }} value="worker">Vadybininkas</option>
                                    <option {{ old('role') == 'admin' ? 'selected' : '' }} value="admin">Administratorius</option>
                                </select>
                                @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Išsaugoti atnaujintus vartotojo duomenis
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
