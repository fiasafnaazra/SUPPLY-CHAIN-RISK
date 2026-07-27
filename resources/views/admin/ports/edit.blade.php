@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        <i class="fas fa-edit"></i>
        Edit Pelabuhan
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('admin.ports.update',$port->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Pelabuhan</label>
                    <input
                        type="text"
                        name="port_name"
                        class="form-control"
                        value="{{ $port->port_name }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Alternatif</label>
                    <input
                        type="text"
                        name="alternate_name"
                        class="form-control"
                        value="{{ $port->alternate_name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Negara</label>
                    <input
                        type="text"
                        name="country_code"
                        class="form-control"
                        value="{{ $port->country_code }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Wilayah</label>
                    <input
                        type="text"
                        name="region"
                        class="form-control"
                        value="{{ $port->region }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Perairan</label>
                    <input
                        type="text"
                        name="water_body"
                        class="form-control"
                        value="{{ $port->water_body }}">
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Latitude</label>
                            <input
                                type="text"
                                name="latitude"
                                class="form-control"
                                value="{{ $port->latitude }}">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Longitude</label>
                            <input
                                type="text"
                                name="longitude"
                                class="form-control"
                                value="{{ $port->longitude }}">
                        </div>

                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Harbor Type</label>
                    <input
                        type="text"
                        name="harbor_type"
                        class="form-control"
                        value="{{ $port->harbor_type }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Harbor Size</label>
                    <input
                        type="text"
                        name="harbor_size"
                        class="form-control"
                        value="{{ $port->harbor_size }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Harbor Use</label>
                    <input
                        type="text"
                        name="harbor_use"
                        class="form-control"
                        value="{{ $port->harbor_use }}">
                </div>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update
                </button>

                <a href="{{ route('admin.ports.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection