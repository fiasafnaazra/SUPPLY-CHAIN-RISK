@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            ✏️ Edit Data Negara

        </h2>

        <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('admin.countries.update',$country->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nama Negara

                        </label>

                        <input
                            type="text"
                            name="country_name"
                            class="form-control"
                            value="{{ old('country_name',$country->country_name) }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Kode Negara

                        </label>

                        <input
                            type="text"
                            name="country_code"
                            class="form-control"
                            value="{{ old('country_code',$country->country_code) }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Ibukota

                        </label>

                        <input
                            type="text"
                            name="capital"
                            class="form-control"
                            value="{{ old('capital',$country->capital) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Benua

                        </label>

                        <input
                            type="text"
                            name="continent"
                            class="form-control"
                            value="{{ old('continent',$country->continent) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Populasi

                        </label>

                        <input
                            type="number"
                            name="population"
                            class="form-control"
                            value="{{ old('population',$country->population) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Mata Uang

                        </label>

                        <input
                            type="text"
                            name="currency"
                            class="form-control"
                            value="{{ old('currency',$country->currency) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Latitude

                        </label>

                        <input
                            type="text"
                            name="latitude"
                            class="form-control"
                            value="{{ old('latitude',$country->latitude) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Longitude

                        </label>

                        <input
                            type="text"
                            name="longitude"
                            class="form-control"
                            value="{{ old('longitude',$country->longitude) }}">

                    </div>

                    <div class="col-md-12 mb-4">

                        <label class="form-label">

                            URL Bendera

                        </label>

                        <input
                            type="text"
                            name="flag"
                            class="form-control"
                            value="{{ old('flag',$country->flag) }}">

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="fas fa-save"></i>

                    Update Data

                </button>

                <a
                    href="{{ route('admin.countries.index') }}"
                    class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>

@endsection