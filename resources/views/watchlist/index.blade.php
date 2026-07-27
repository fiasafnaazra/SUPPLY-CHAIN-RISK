@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            ⭐ Favorite Monitoring List
        </h2>

        <a href="{{ route('countries.index') }}" class="btn btn-primary">
            + Tambah Negara
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($watchlists->count() == 0)

        <div class="alert alert-info text-center">

            <h5>Belum ada negara yang dipantau.</h5>

            <p>
                Tambahkan negara dari halaman Countries untuk mulai memonitor risiko supply chain.
            </p>

        </div>

    @else

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th width="70">No</th>

                        <th>Negara</th>

                        <th>Kode</th>

                        <th>Ibu Kota</th>

                        <th>Benua</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($watchlists as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->country->country_name }}
                        </td>

                        <td>
                            {{ $item->country->country_code }}
                        </td>

                        <td>
                            {{ $item->country->capital }}
                        </td>

                        <td>
                            {{ $item->country->continent }}
                        </td>

                        <td>

                            <form action="{{ route('watchlist.destroy',$item->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus negara dari watchlist?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    @endif

</div>

@endsection