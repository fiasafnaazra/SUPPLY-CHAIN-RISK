@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        📰 Berita & Sentiment Analysis
    </h2>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            Daftar Berita
        </div>

        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">

                <thead class="table-light">

                    <tr>
                        <th width="5%">No</th>
                        <th width="40%">Judul</th>
                        <th>Source</th>
                        <th>Kategori</th>
                        <th>Sentiment</th>
                        <th>Score</th>
                        <th>Tanggal</th>
                        <th>Link</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($news as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->title }}</td>

                        <td>{{ $item->source }}</td>

                        <td>{{ $item->category }}</td>

                        <td>

                            @if($item->sentiment == 'Positive')
                                <span class="badge bg-success">
                                    Positive
                                </span>

                            @elseif($item->sentiment == 'Negative')
                                <span class="badge bg-danger">
                                    Negative
                                </span>

                            @else
                                <span class="badge bg-warning text-dark">
                                    Neutral
                                </span>

                            @endif

                        </td>

                        <td>{{ $item->sentiment_score }}</td>

                        <td>

                            {{ $item->published_at
                                ? $item->published_at->format('d M Y H:i')
                                : '-' }}

                        </td>

                        <td>

                            <a href="{{ $item->url }}"
                               target="_blank"
                               class="btn btn-sm btn-primary">

                                Buka

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">
                            Belum ada berita.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection