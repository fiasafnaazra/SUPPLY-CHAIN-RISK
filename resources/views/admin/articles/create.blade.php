@extends('layouts.admin')

@section('content')

<h2 class="mb-4">
    Tambah Artikel Analisis
</h2>

<div class="card shadow border-0">

    <div class="card-body">

        <form action="{{ route('admin.articles.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Judul Artikel
                </label>

                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title') }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Kode Negara
                </label>

                <input type="text"
                       name="country_code"
                       class="form-control"
                       value="{{ old('country_code') }}"
                       placeholder="Contoh : ID, SG, MY"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Level Risiko
                </label>

                <select name="risk_level"
                        class="form-select"
                        required>

                    <option value="">-- Pilih --</option>

                    <option value="Low">Low</option>

                    <option value="Medium">Medium</option>

                    <option value="High">High</option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Ringkasan
                </label>

                <textarea name="summary"
                          rows="3"
                          class="form-control"
                          required>{{ old('summary') }}</textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Isi Artikel
                </label>

                <textarea name="content"
                          rows="8"
                          class="form-control"
                          required>{{ old('content') }}</textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Gambar
                </label>

                <input type="file"
                       name="image"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Tanggal Publikasi
                </label>

                <input type="date"
                       name="published_at"
                       class="form-control"
                       value="{{ old('published_at') }}"
                       required>

            </div>

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>
                Simpan

            </button>

            <a href="{{ route('admin.articles.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection