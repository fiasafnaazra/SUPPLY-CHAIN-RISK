@extends('layouts.app')
@push('styles')

<link
rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<style>

#countryMap{

    height:500px;

    border-radius:10px;

}

</style>

@endpush

@section('content')

@php

function shortNumber($number)
{
    if (!$number) return '-';

    if ($number >= 1000000000000)
        return 'US$ '.number_format($number/1000000000000,1).' Triliun';

    if ($number >= 1000000000)
        return 'US$ '.number_format($number/1000000000,1).' Miliar';

    if ($number >= 1000000)
        return 'US$ '.number_format($number/1000000,1).' Juta';

    return 'US$ '.number_format($number,2);
}

@endphp

<div class="container-fluid">

<h2 class="mb-4">
🌍 Monitoring Negara
</h2>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('countries.search') }}" method="GET">

            <div class="input-group">

                <input
                    type="text"
                    class="form-control"
                    name="keyword"
                    placeholder="Cari negara..."
                    value="{{ request('keyword') }}">

                <button class="btn btn-primary">
                    🔍 Cari
                </button>

            </div>

        </form>

    </div>
</div>

@if(!request()->filled('keyword'))

<div class="card shadow mb-4">

    <div class="card-header bg-success text-white">

        🌍 Peta Negara

    </div>

    <div class="card-body">

        <div id="countryMap"></div>

    </div>

</div>

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        Daftar Negara
    </div>

    <div class="card-body p-0">

        <table class="table table-hover table-bordered mb-0">

            <thead class="table-light">

            <tr>

                <th>No</th>
                <th>Bendera</th>
                <th>Nama Negara</th>
                <th>Kode</th>
                <th>Ibukota</th>
                <th>Benua</th>
                <th>Populasi</th>
                <th>Mata Uang</th>
                <th>Aksi</th>

            </tr>

            </thead>

            <tbody>

            @foreach($countries as $country)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td width="80">

                    <img src="{{ $country->flag }}" width="50">

                </td>

                <td>{{ $country->country_name }}</td>

                <td>{{ $country->country_code }}</td>

                <td>{{ $country->capital }}</td>

                <td>{{ $country->continent }}</td>

                <td>{{ number_format($country->population) }}</td>

                <td>{{ $country->currency }}</td>

                <td width="120">

                    <a href="{{ route('countries.search',['keyword'=>$country->country_name]) }}"
                       class="btn btn-primary btn-sm">

                        Lihat

                    </a>

                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@else

@foreach($countries as $country)

<div class="card shadow mb-4">

<div class="card-body">

<div class="row">

<div class="col-md-2 text-center">

<img
src="{{ $country->flag }}"
class="img-fluid border rounded"
style="max-height:120px;">

</div>

<div class="col-md-10">

<div class="d-flex justify-content-between">

<h2>{{ $country->country_name }}</h2>

<form action="{{ route('watchlist.store',$country->country_code) }}"
      method="POST">

    @csrf

    <button class="btn btn-warning">

        ⭐ Tambah ke Watchlist

    </button>

</form>

</div>

<div class="card shadow mt-4 mb-4">

    <div class="card-header bg-success text-white">

        🌍 Lokasi Negara

    </div>

    <div class="card-body">

        <div id="countryMap"
             style="height:450px;border-radius:10px;">
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mapDiv = document.getElementById('countryMap');
            if(mapDiv){
                let map = L.map('countryMap').setView([
                    {{ $country->latitude ?? 0 }},
                    {{ $country->longitude ?? 0 }}
                ], 5);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                L.marker([
                    {{ $country->latitude ?? 0 }},
                    {{ $country->longitude ?? 0 }}
                ])
                .addTo(map)
                .bindPopup("<b>{{ $country->country_name }}</b><br>{{ $country->capital }}")
                .openPopup();
            }
        });
        </script>

    </div>

</div>

<div class="row mt-4">

<div class="col-md-3"><b>Kode Negara</b></div>
<div class="col-md-3">{{ $country->country_code }}</div>

<div class="col-md-3"><b>Ibukota</b></div>
<div class="col-md-3">{{ $country->capital }}</div>

<div class="col-md-3 mt-3"><b>Benua</b></div>
<div class="col-md-3 mt-3">{{ $country->continent }}</div>

<div class="col-md-3 mt-3"><b>Populasi</b></div>
<div class="col-md-3 mt-3">{{ number_format($country->population) }}</div>

<div class="col-md-3 mt-3"><b>Mata Uang</b></div>
<div class="col-md-3 mt-3">{{ $country->currency }}</div>

</div>

</div>

</div>

</div>

</div>

<h4>📈 Data Ekonomi</h4>

@if($country->economic)

<small class="text-muted">

Data World Bank Tahun {{ $country->economic->year }}

</small>

@endif

<div class="row mt-2 mb-4">

<div class="col-md-3">

<div class="card">

<div class="card-body text-center">

<h6>GDP</h6>

{{ shortNumber(optional($country->economic)->gdp) }}

</div>

</div>

</div>

<div class="col-md-3">

<div class="card">

<div class="card-body text-center">

<h6>Inflasi</h6>

{{ optional($country->economic)->inflation
? number_format($country->economic->inflation,2).' %'
: '-' }}

</div>

</div>

</div>

<div class="col-md-3">

<div class="card">

<div class="card-body text-center">

<h6>Ekspor</h6>

{{ shortNumber(optional($country->economic)->export) }}

</div>

</div>

</div>

<div class="col-md-3">

<div class="card">

<div class="card-body text-center">

<h6>Impor</h6>

{{ shortNumber(optional($country->economic)->import) }}

</div>

</div>

</div>

</div>

<div class="card shadow mb-4">

    <div class="card-header">
        🌦 Data Cuaca
    </div>

    <div class="card-body">

        @if($country->weather)

        <div class="row text-center">

            <div class="col-md-3">

                <div class="card border-primary">

                    <div class="card-body">

                        <h6>🌡 Temperatur</h6>

                        <h4>{{ $country->weather->temperature }} °C</h4>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-info">

                    <div class="card-body">

                        <h6>🌧 Curah Hujan</h6>

                        <h4>{{ $country->weather->precipitation }} mm</h4>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-warning">

                    <div class="card-body">

                        <h6>💨 Kecepatan Angin</h6>

                        <h4>{{ $country->weather->wind_speed }} km/jam</h4>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-danger">

                    <div class="card-body">

                        <h6>⛈ Risiko Badai</h6>

                        @if($country->weather->storm_risk == 'High')

                            <span class="badge bg-danger fs-6">
                                High
                            </span>

                        @elseif($country->weather->storm_risk == 'Medium')

                            <span class="badge bg-warning text-dark fs-6">
                                Medium
                            </span>

                        @else

                            <span class="badge bg-success fs-6">
                                Low
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-3 text-end text-muted">

            Update terakhir :

            {{ $country->weather->fetched_at }}

        </div>

        @else

        <div class="alert alert-warning mb-0">

            Belum tersedia data cuaca.

        </div>

        @endif

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-success text-white">

        💱 Kurs Mata Uang

    </div>

    <div class="card-body">

        @if($country->currencyRate)

        <div class="row text-center">

            <div class="col-md-4">

                <div class="card border-success">

                    <div class="card-body">

                        <h6>Kode Mata Uang</h6>

                        <h3>

                            {{ $country->currencyRate->currency_code }}

                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-primary">

                    <div class="card-body">

                        <h6>Kurs terhadap USD</h6>

                        <h3>

                            {{ number_format($country->currencyRate->exchange_rate,4) }}

                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-secondary">

                    <div class="card-body">

                        <h6>Update</h6>

                        <small>

                            {{ $country->currencyRate->fetched_at }}

                        </small>

                    </div>

                </div>

            </div>

        </div>

        @else

        <div class="alert alert-warning mb-0">

            Data kurs belum tersedia.

        </div>

        @endif

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-primary text-white">

        📊 Currency Impact Dashboard

    </div>

    <div class="card-body">

        <canvas id="currencyChart" height="90"></canvas>

    </div>

</div>

<div class="card shadow mb-5">

    <div class="card-header bg-danger text-white">

        🚢 Risk Scoring Engine

    </div>

    <div class="card-body">

        @if($country->riskScore)

        <div class="row text-center mb-4">

            <div class="col-md-3">

                <div class="card border-primary">

                    <div class="card-body">

                        <h6>Weather</h6>

                        <h3>{{ $country->riskScore->weather_score }}</h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-warning">

                    <div class="card-body">

                        <h6>Inflation</h6>

                        <h3>{{ $country->riskScore->inflation_score }}</h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-success">

                    <div class="card-body">

                        <h6>Currency</h6>

                        <h3>{{ $country->riskScore->currency_score }}</h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card border-info">

                    <div class="card-body">

                        <h6>News</h6>

                        <h3>{{ $country->riskScore->news_score }}</h3>

                    </div>

                </div>

            </div>

        </div>

        <div class="text-center mb-4">

            <h2>

                Total Score :
                {{ $country->riskScore->total_score }}

            </h2>

        </div>

        @if($country->riskScore->risk_level == 'High')

            <div class="alert alert-danger text-center">

                <h3>🔴 HIGH RISK</h3>

                Risiko supply chain sangat tinggi.

            </div>

        @elseif($country->riskScore->risk_level == 'Medium')

            <div class="alert alert-warning text-center">

                <h3>🟡 MEDIUM RISK</h3>

                Risiko supply chain sedang.

            </div>

        @else

            <div class="alert alert-success text-center">

                <h3>🟢 LOW RISK</h3>

                Supply chain relatif aman.

            </div>

        @endif

        @else

            <div class="alert alert-warning">

                Risk Score belum tersedia.

            </div>

        @endif

    </div>

</div>

<!-- Berita Terkini -->
<div class="card shadow mb-4">

    <div class="card-header bg-success text-white">
        📰 Berita Terkini
    </div>

    <div class="card-body">

        @if(isset($news) && $news->count())

            @foreach($news as $item)

                <div class="border rounded p-3 mb-3">

                    <h5>{{ $item->title }}</h5>

                    <small class="text-muted">
                        {{ $item->source }}
                        |
                         {{ $item->published_at->format('d M Y H:i') }}
                    </small>

                    <p class="mt-2">
                        {{ $item->description }}
                    </p>

                    <span class="badge
                        @if($item->sentiment=='Positive') bg-success
                        @elseif($item->sentiment=='Negative') bg-danger
                        @else bg-warning text-dark
                        @endif">
                        {{ $item->sentiment }}
                    </span>

                    <span class="badge bg-secondary">
                        Score : {{ $item->sentiment_score }}
                    </span>

                    <a href="{{ $item->url }}"
                       target="_blank"
                       class="btn btn-primary btn-sm float-end">

                        Baca Selengkapnya

                    </a>

                    <div class="clearfix"></div>

                </div>

            @endforeach

        @else

            <div class="alert alert-warning mb-0">
                Belum ada berita.
            </div>

        @endif

    </div>

</div>

@endforeach

@endif

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('currencyChart');

if(ctx){

new Chart(ctx,{

type:'line',

data:{

labels:['1','2','3','4','5','6','7'],

datasets:[{

label:'Exchange Rate',

data:[1,1,1,1,1,1,1],

borderWidth:2,

fill:false,

tension:0.3

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:true

}

}

}

});

}

</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@if(!request()->filled('keyword'))
<script>
const mapDiv = document.getElementById('countryMap');
if(mapDiv){

    let map = L.map('countryMap').setView([20,0],2);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution:'© OpenStreetMap'
        }
    ).addTo(map);

    @foreach($countries as $c)
        @if(!empty($c->latitude) && !empty($c->longitude))
        L.marker([
            {{ $c->latitude }},
            {{ $c->longitude }}
        ])
        .addTo(map)
        .bindPopup("<b>{{ $c->country_name }}</b><br>{{ $c->capital }}");
        @endif
    @endforeach

}
</script>
@endif

@endsection