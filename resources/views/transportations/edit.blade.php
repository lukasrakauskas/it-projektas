@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Automobilio transportavimas') }}
                    </div>

                    <div class="card-body">
                        @include('components.flash-message')

                        <form method="POST" action="{{ route('transportations.update', $transportation->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <p class="col-sm-2 col-form-label font-weight-bold">Klientas</p>
                                <div class="col-sm-10 col-form-label">
                                    {{ $transportation->user->getFullName() }}
                                    {{' - '}}
                                    {{ $transportation->user->phone }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <p class="col-sm-2 col-form-label font-weight-bold">Miestas</p>
                                <div class="col-sm-10 col-form-label">
                                    {{ $transportation->city }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <p class="col-sm-2 col-form-label font-weight-bold">Užsakyta</p>
                                <div class="col-sm-10 col-form-label">
                                    {{ $transportation->created_at }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status"
                                       class="col-sm-2 col-form-label font-weight-bold">Statusas</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                        @foreach($statuses as $value => $label)
                                            <option
                                                {{ $value == $transportation->status ? 'selected' : '' }} value="{{ $value }}">
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button class="btn btn-primary">Pakeisti statusą</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
