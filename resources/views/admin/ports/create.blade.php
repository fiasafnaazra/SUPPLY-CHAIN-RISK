@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        <i class="fas fa-plus-circle"></i>
        Tambah Pelabuhan
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('admin.ports.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Pelabuhan</label>
                    <input type="text" name="port_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Alternatif</label>
                    <input type="text" name="alternate_name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Negara</label>
                    <input type="text" name="country_code" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Wilayah</label>
                    <input type="text" name="region" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Perairan</label>
                    <input type="text" name="water_body" class="form-control">
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" class="form-control">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" class="form-control">
                        </div>

                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Harbor Type</label>
                    <input type="text" name="harbor_type" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Harbor Size</label>
                    <input type="text" name="harbor_size" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Harbor Use</label>
                    <input type="text" name="harbor_use" class="form-control">
                </div>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
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