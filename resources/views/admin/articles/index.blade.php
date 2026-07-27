@extends('layouts.admin')

@section('content')

<h2 class="mb-4">
    Kelola Artikel Analisis
</h2>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow border-0">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Daftar Artikel
        </h5>

        <a href="{{ route('admin.articles.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>
            Tambah Artikel

        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-primary">

            <tr>

                <th width="60">No</th>

                <th>Judul</th>

                <th>Negara</th>

                <th>Risiko</th>

                <th>Tanggal</th>

                <th width="220">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($articles as $article)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $article->title }}
                </td>

                <td>
                    {{ $article->country_code }}
                </td>

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

                <td>

                    {{ $article->published_at }}

                </td>

                <td>

                    <a href="{{ route('admin.articles.show',$article->id) }}"
                       class="btn btn-info btn-sm">

                        Detail

                    </a>

                    <a href="{{ route('admin.articles.edit',$article->id) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form
                        action="{{ route('admin.articles.destroy',$article->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus artikel ini?')">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center">

                    Belum ada artikel.

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        {{ $articles->links() }}

    </div>

</div>

@endsection