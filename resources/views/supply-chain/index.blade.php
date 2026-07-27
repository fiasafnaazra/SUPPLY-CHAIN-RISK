@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        🚢 Supply Chain Risk Monitoring
    </h2>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            Daftar Risiko Supply Chain

        </div>

        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">

                <thead class="table-light">

                    <tr>

                        <th>No</th>
                        <th>Negara</th>
                        <th>Weather</th>
                        <th>Inflation</th>
                        <th>Currency</th>
                        <th>News</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($countries as $country)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $country->country_name }}</td>

                        <td>{{ optional($country->riskScore)->weather_score ?? '-' }}</td>

                        <td>{{ optional($country->riskScore)->inflation_score ?? '-' }}</td>

                        <td>{{ optional($country->riskScore)->currency_score ?? '-' }}</td>

                        <td>{{ optional($country->riskScore)->news_score ?? '-' }}</td>

                        <td>
                            <strong>
                                {{ optional($country->riskScore)->total_score ?? '-' }}
                            </strong>
                        </td>

                        <td>

                            @if(optional($country->riskScore)->risk_level == 'High')

                                <span class="badge bg-danger">
                                    High
                                </span>

                            @elseif(optional($country->riskScore)->risk_level == 'Medium')

                                <span class="badge bg-warning text-dark">
                                    Medium
                                </span>

                            @elseif(optional($country->riskScore)->risk_level == 'Low')

                                <span class="badge bg-success">
                                    Low
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    -
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('supply-chain.show',$country->country_code) }}"
                                class="btn btn-primary btn-sm">

                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            Belum ada data Supply Chain.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection