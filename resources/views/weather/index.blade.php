@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        🌦 Data Cuaca Negara
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>

                        <th>No</th>
                        <th>Kode Negara</th>
                        <th>Temperatur</th>
                        <th>Curah Hujan</th>
                        <th>Kecepatan Angin</th>
                        <th>Risiko Badai</th>
                        <th>Update</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($weather as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->country_code }}</td>

                        <td>{{ $item->temperature }} °C</td>

                        <td>{{ $item->precipitation }} mm</td>

                        <td>{{ $item->wind_speed }} km/jam</td>

                        <td>

                            @if($item->storm_risk == 'High')

                                <span class="badge bg-danger">High</span>

                            @elseif($item->storm_risk == 'Medium')

                                <span class="badge bg-warning text-dark">Medium</span>

                            @else

                                <span class="badge bg-success">Low</span>

                            @endif

                        </td>

                        <td>{{ $item->fetched_at }}</td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Belum ada data cuaca.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection