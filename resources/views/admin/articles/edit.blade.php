@extends('layouts.admin')

@section('content')

<h2 class="mb-4">
    Edit Artikel Analisis
</h2>

<div class="card shadow border-0">

    <div class="card-body">

        <form action="{{ route('admin.articles.update',$article->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Judul Artikel
                </label>

                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title',$article->title) }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Kode Negara
                </label>

                <input type="text"
                       name="country_code"
                       class="form-control"
                       value="{{ old('country_code',$article->country_code) }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Level Risiko
                </label>

                <select name="risk_level"
                        class="form-select"
                        required>

                    <option value="Low"
                        {{ $article->risk_level=='Low' ? 'selected' : '' }}>
                        Low
                    </option>

                    <option value="Medium"
                        {{ $article->risk_level=='Medium' ? 'selected' : '' }}>
                        Medium
                    </option>

                    <option value="High"
                        {{ $article->risk_level=='High' ? 'selected' : '' }}>
                        High
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Ringkasan
                </label>

                <textarea
                    name="summary"
                    rows="3"
                    class="form-control"
                    required>{{ old('summary',$article->summary) }}</textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Isi Artikel
                </label>

                <textarea
                    name="content"
                    rows="8"
                    class="form-control"
                    required>{{ old('content',$article->content) }}</textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Gambar Baru
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control">

            </div>

            @if($article->image)

            <div class="mb-3">

                <img src="{{ asset('uploads/articles/'.$article->image) }}"
                     width="250"
                     class="img-thumbnail">

            </div>

            @endif

            <div class="mb-3">

                <label class="form-label">
                    Tanggal Publikasi
                </label>

                <input
                    type="date"
                    name="published_at"
                    class="form-control"
                    value="{{ $article->published_at }}"
                    required>

            </div>

            <button class="btn btn-success">

                <i class="fas fa-save"></i>
                Update Artikel

            </button>

            <a href="{{ route('admin.articles.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection