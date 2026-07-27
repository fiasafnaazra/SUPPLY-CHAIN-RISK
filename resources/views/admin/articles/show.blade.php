@extends('layouts.admin')

@section('content')

<h2 class="mb-4">
    Detail Artikel Analisis
</h2>

<div class="card shadow border-0">

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">Judul</th>
                <td>{{ $article->title }}</td>
            </tr>

            <tr>
                <th>Negara</th>
                <td>{{ $article->country_code }}</td>
            </tr>

            <tr>
                <th>Level Risiko</th>
                <td>

                    @if($article->risk_level == 'High')

                        <span class="badge bg-danger">
                            High
                        </span>

                    @elseif($article->risk_level == 'Medium')

                        <span class="badge bg-warning text-dark">
                            Medium
                        </span>

                    @else

                        <span class="badge bg-success">
                            Low
                        </span>

                    @endif

                </td>
            </tr>

            <tr>
                <th>Ringkasan</th>
                <td>{{ $article->summary }}</td>
            </tr>

            <tr>
                <th>Isi Artikel</th>
                <td style="white-space: pre-line;">
                    {{ $article->content }}
                </td>
            </tr>

            <tr>
                <th>Tanggal Publikasi</th>
                <td>{{ $article->published_at }}</td>
            </tr>

            <tr>
                <th>Gambar</th>

                <td>

                    @if($article->image)

                        <img
                            src="{{ asset('uploads/articles/'.$article->image) }}"
                            width="350"
                            class="img-thumbnail">

                    @else

                        <span class="text-muted">
                            Tidak ada gambar
                        </span>

                    @endif

                </td>

            </tr>

        </table>

        <a href="{{ route('admin.articles.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

        <a href="{{ route('admin.articles.edit',$article->id) }}"
           class="btn btn-warning">

            Edit

        </a>

    </div>

</div>

@endsection