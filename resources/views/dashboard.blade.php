@extends('layouts.app')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h1>🌍</h1>
                <h5>Negara</h5>
                <p>Total Data Negara</p>
                <h3>{{ $totalCountry }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h1>🌦</h1>
                <h5>Cuaca</h5>
                <p>Data Cuaca</p>
                <h3>{{ $totalWeather }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h1>🚢</h1>
                <h5>Supply Chain</h5>
                <p>Risiko Tinggi</p>
                <h3>{{ $totalRisk }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h1>📰</h1>
                <h5>Berita</h5>
                <p>Internasional</p>
                <h3>{{ $totalNews }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4 shadow border-0">
    <div class="card-body">

        <h4>Selamat Datang</h4>

        <hr>

        <h5>{{ session('name') }}</h5>

        <p>
            Anda berhasil login ke Platform Monitoring Risiko Supply Chain.
        </p>

    </div>
</div>

<!-- Dashboard Analitik -->

<div class="row mt-4">

    <div class="col-md-6 mb-4">

        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">
                📈 GDP Trend
            </div>

            <div class="card-body">
                <canvas id="gdpChart"></canvas>
            </div>

        </div>

    </div>

    <div class="col-md-6 mb-4">

        <div class="card shadow border-0">

            <div class="card-header bg-warning">
                📊 Inflation Trend
            </div>

            <div class="card-body">
                <canvas id="inflationChart"></canvas>
            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-4">

        <div class="card shadow border-0">

            <div class="card-header bg-success text-white">
                💱 Currency Trend
            </div>

            <div class="card-body">
                <canvas id="currencyChart"></canvas>
            </div>

        </div>

    </div>

    <div class="col-md-6 mb-4">

        <div class="card shadow border-0">

            <div class="card-header bg-danger text-white">
                🚨 Risk Trend
            </div>

            <div class="card-body">
                <canvas id="riskChart"></canvas>
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

// GDP
new Chart(document.getElementById('gdpChart'), {
    type: 'bar',
    data: {
        labels: [
            @foreach($gdp as $item)
                "{{ $item->country_code }}",
            @endforeach
        ],
        datasets: [{
            label: 'GDP',
            data: [
                @foreach($gdp as $item)
                    {{ $item->gdp }},
                @endforeach
            ],
            backgroundColor: '#0d6efd'
        }]
    }
});

// Inflation
new Chart(document.getElementById('inflationChart'), {
    type: 'line',
    data: {
        labels: [
            @foreach($inflation as $item)
                "{{ $item->country_code }}",
            @endforeach
        ],
        datasets: [{
            label: 'Inflation',
            data: [
                @foreach($inflation as $item)
                    {{ $item->inflation }},
                @endforeach
            ],
            borderColor: '#ffc107',
            fill: false,
            tension: 0.3
        }]
    }
});

// Currency
new Chart(document.getElementById('currencyChart'), {
    type: 'bar',
    data: {
        labels: [
            @foreach($currency as $item)
                "{{ $item->country_code }}",
            @endforeach
        ],
        datasets: [{
            label: 'Exchange Rate',
            data: [
                @foreach($currency as $item)
                    {{ $item->exchange_rate }},
                @endforeach
            ],
            backgroundColor: '#198754'
        }]
    }
});

// Risk
new Chart(document.getElementById('riskChart'), {
    type: 'radar',
    data: {
        labels: [
            @foreach($risk as $item)
                "{{ $item->country_code }}",
            @endforeach
        ],
        datasets: [{
            label: 'Risk Score',
            data: [
                @foreach($risk as $item)
                    {{ $item->total_score }},
                @endforeach
            ]
        }]
    }
});

</script>

@endpush