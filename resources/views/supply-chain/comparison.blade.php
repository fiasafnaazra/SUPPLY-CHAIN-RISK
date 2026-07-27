@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    Perbandingan Negara
</h2>

<div class="card shadow border-0">

    <div class="card-header bg-primary text-white">
        Country Comparison Engine
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('comparison.compare') }}">

            <div class="row">

                <div class="col-md-5">

                    <label class="mb-2">
                        Negara 1
                    </label>

                    <select
                        name="country1"
                        class="form-select"
                        required>

                        <option value="">
                            -- Pilih Negara --
                        </option>

                        @foreach($countries as $country)

                            <option
                                value="{{ $country->country_code }}"
                                {{ request('country1') == $country->country_code ? 'selected' : '' }}>

                                {{ $country->country_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-5">

                    <label class="mb-2">
                        Negara 2
                    </label>

                    <select
                        name="country2"
                        class="form-select"
                        required>

                        <option value="">
                            -- Pilih Negara --
                        </option>

                        @foreach($countries as $country)

                            <option
                                value="{{ $country->country_code }}"
                                {{ request('country2') == $country->country_code ? 'selected' : '' }}>

                                {{ $country->country_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button class="btn btn-primary w-100">
                        Bandingkan
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@if(isset($country1) && isset($country2))

<div class="row mt-4">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                {{ $country1->country_name }}

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th>GDP</th>
                        <td>{{ optional($country1->economic)->gdp }}</td>
                    </tr>

                    <tr>
                        <th>Inflation</th>
                        <td>{{ optional($country1->economic)->inflation }} %</td>
                    </tr>

                    <tr>
                        <th>Currency</th>
                        <td>{{ optional($country1->currencyRate)->exchange_rate }}</td>
                    </tr>

                    <tr>
                        <th>Weather</th>
                        <td>{{ optional($country1->weather)->temperature }} °C</td>
                    </tr>

                    <tr>
                        <th>Risk Score</th>
                        <td>{{ optional($country1->riskScore)->total_score }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-danger text-white">

                {{ $country2->country_name }}

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th>GDP</th>
                        <td>{{ optional($country2->economic)->gdp }}</td>
                    </tr>

                    <tr>
                        <th>Inflation</th>
                        <td>{{ optional($country2->economic)->inflation }} %</td>
                    </tr>

                    <tr>
                        <th>Currency</th>
                        <td>{{ optional($country2->currencyRate)->exchange_rate }}</td>
                    </tr>

                    <tr>
                        <th>Weather</th>
                        <td>{{ optional($country2->weather)->temperature }} °C</td>
                    </tr>

                    <tr>
                        <th>Risk Score</th>
                        <td>{{ optional($country2->riskScore)->total_score }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endif

@endsection