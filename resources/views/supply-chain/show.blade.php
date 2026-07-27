@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        🚢 Detail Supply Chain
    </h2>

    <!-- Informasi Negara -->
    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            {{ $country->country_name }}
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-2 text-center">

                    <img src="{{ $country->flag }}"
                         width="120"
                         class="img-fluid border rounded">

                </div>

                <div class="col-md-10">

                    <table class="table table-bordered">

                        <tr>
                            <th width="220">Kode Negara</th>
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


    <!-- Data Cuaca -->
    <div class="card shadow mt-4">

        <div class="card-header bg-success text-white">
            🌦 Data Cuaca
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">Suhu</th>
                    <td>{{ $country->weather->temperature ?? '-' }} °C</td>
                </tr>

                <tr>
                    <th>Curah Hujan</th>
                    <td>{{ $country->weather->precipitation ?? '-' }} mm</td>
                </tr>

                <tr>
                    <th>Kecepatan Angin</th>
                    <td>{{ $country->weather->wind_speed ?? '-' }} km/jam</td>
                </tr>

                <tr>
                    <th>Risiko Cuaca</th>
                    <td>

                        @if($country->weather)

                            @if($country->weather->storm_risk == 'High')

                                <span class="badge bg-danger">High</span>

                            @elseif($country->weather->storm_risk == 'Medium')

                                <span class="badge bg-warning text-dark">Medium</span>

                            @else

                                <span class="badge bg-success">Low</span>

                            @endif

                        @else

                            -

                        @endif

                    </td>
                </tr>

            </table>

        </div>

    </div>


    <!-- Data Ekonomi -->
    <div class="card shadow mt-4">

        <div class="card-header bg-warning text-dark">
            📈 Data Ekonomi
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">GDP</th>
                    <td>{{ number_format($country->economic->gdp ?? 0,2) }}</td>
                </tr>

                <tr>
                    <th>Inflasi</th>
                    <td>{{ $country->economic->inflation ?? '-' }} %</td>
                </tr>

                <tr>
                    <th>Ekspor</th>
                    <td>{{ number_format($country->economic->export ?? 0,2) }}</td>
                </tr>

                <tr>
                    <th>Impor</th>
                    <td>{{ number_format($country->economic->import ?? 0,2) }}</td>
                </tr>

            </table>

        </div>

    </div>


    <!-- Kurs Mata Uang -->
    <div class="card shadow mt-4">

        <div class="card-header bg-info text-white">
            💱 Kurs Mata Uang
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">Kode Mata Uang</th>
                    <td>{{ $country->currencyRate->currency_code ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Nilai Tukar</th>
                    <td>{{ $country->currencyRate->exchange_rate ?? '-' }}</td>
                </tr>

            </table>

        </div>

    </div>


    <!-- Risk Score -->
    <div class="card shadow mt-4 mb-4">

        <div class="card-header bg-danger text-white">
            ⚠ Risk Score
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">Weather Score</th>
                    <td>{{ $country->riskScore->weather_score ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Inflation Score</th>
                    <td>{{ $country->riskScore->inflation_score ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Currency Score</th>
                    <td>{{ $country->riskScore->currency_score ?? '-' }}</td>
                </tr>

                <tr>
                    <th>News Score</th>
                    <td>{{ $country->riskScore->news_score ?? '-' }}</td>
                </tr>

                <tr class="table-primary">

                    <th>Total Score</th>

                    <td>
                        <strong>{{ $country->riskScore->total_score ?? '-' }}</strong>
                    </td>

                </tr>

                <tr>

                    <th>Status Risiko</th>

                    <td>

                        @if($country->riskScore)

                            @if($country->riskScore->risk_level == 'High')

                                <span class="badge bg-danger">High Risk</span>

                            @elseif($country->riskScore->risk_level == 'Medium')

                                <span class="badge bg-warning text-dark">Medium Risk</span>

                            @else

                                <span class="badge bg-success">Low Risk</span>

                            @endif

                        @else

                            -

                        @endif

                    </td>

                </tr>

            </table>

        </div>

    </div>

</div>

@endsection