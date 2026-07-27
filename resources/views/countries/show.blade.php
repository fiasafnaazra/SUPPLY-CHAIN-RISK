@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">🌍 Monitoring Negara</h2>

    <!-- Pencarian -->
    <form action="{{ route('countries.search') }}" method="GET" class="mb-4">

        <div class="input-group">

            <input
                type="text"
                name="keyword"
                class="form-control"
                placeholder="Cari negara..."
                value="{{ request('keyword') }}">

            <button class="btn btn-primary">
                Cari
            </button>

        </div>

    </form>

    @if(isset($country))

    <!-- Informasi Negara -->
    <div class="card shadow mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-2 text-center">

                    <img src="{{ $country->flag }}" width="120">

                </div>

                <div class="col-md-10">

                    <h3>{{ $country->country_name }}</h3>

                    <table class="table table-borderless">

                        <tr>
                            <th width="180">Kode Negara</th>
                            <td>{{ $country->country_code }}</td>
                        </tr>

                        <tr>
                            <th>Ibukota</th>
                            <td>{{ $country->capital }}</td>
                        </tr>

                        <tr>
                            <th>Benua</th>
                            <td>{{ $country->continent }}</td>
                        </tr>

                        <tr>
                            <th>Populasi</th>
                            <td>{{ number_format($country->population) }}</td>
                        </tr>

                        <tr>
                            <th>Mata Uang</th>
                            <td>{{ $country->currency }}</td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- Data Ekonomi -->
    <h4 class="mb-3">📈 Data Ekonomi</h4>

    <div class="row">

        <div class="col-md-3">

            <div class="card text-center shadow">

                <div class="card-body">

                    <h6>GDP</h6>

                    <h5>
                        {{ number_format($country->economic->gdp ?? 0,2) }}
                    </h5>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card text-center shadow">

                <div class="card-body">

                    <h6>Inflasi</h6>

                    <h5>
                        {{ $country->economic->inflation ?? '-' }} %
                    </h5>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card text-center shadow">

                <div class="card-body">

                    <h6>Ekspor</h6>

                    <h5>
                        {{ number_format($country->economic->export ?? 0,2) }}
                    </h5>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card text-center shadow">

                <div class="card-body">

                    <h6>Impor</h6>

                    <h5>
                        {{ number_format($country->economic->import ?? 0,2) }}
                    </h5>

                </div>

            </div>

        </div>

    </div>

    <!-- Cuaca -->
    <div class="card mt-4 shadow">

        <div class="card-header">

            🌦 Data Cuaca

        </div>

        <div class="card-body">

            Belum tersedia

        </div>

    </div>

    <!-- Supply Chain -->
    <div class="card mt-4 shadow">

        <div class="card-header">

            🚢 Supply Chain Risk

        </div>

        <div class="card-body">

            Belum tersedia

        </div>

    </div>

    <!-- Berita -->
    <div class="card mt-4 shadow">

        <div class="card-header">

            📰 Berita

        </div>

        <div class="card-body">

            Belum tersedia

        </div>

    </div>

    @endif

</div>

@endsection