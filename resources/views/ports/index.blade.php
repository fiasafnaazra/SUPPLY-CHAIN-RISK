@extends('layouts.app')

@section('content')

<link
rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<div class="container-fluid">

<h2 class="mb-4">
🚢 World Port Map
</h2>

<div class="card shadow mb-4">

<div class="card-body">

<form method="GET" action="{{ route('ports.index') }}">

<div class="input-group">

<input
type="text"
class="form-control"
name="keyword"
placeholder="Cari pelabuhan / negara..."
value="{{ request('keyword') }}">

<button class="btn btn-primary">

🔍 Cari

</button>

</div>

</form>

</div>

</div>


<div class="card shadow mb-4">

<div class="card-header bg-primary text-white">

🌍 Peta Pelabuhan Dunia

</div>

<div class="card-body">

<div
id="map"
style="height:600px;"></div>

</div>

</div>


<div class="card shadow">

<div class="card-header bg-success text-white">

📋 Daftar Pelabuhan

</div>

<div class="card-body p-0">

<table class="table table-bordered table-hover mb-0">

<thead>

<tr>

<th>No</th>
<th>Pelabuhan</th>
<th>Negara</th>
<th>Region</th>
<th>Tipe</th>
<th>Ukuran</th>

</tr>

</thead>

<tbody>

@forelse($ports as $port)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $port->port_name }}</td>

<td>{{ $port->country_code }}</td>

<td>{{ $port->region }}</td>

<td>{{ $port->harbor_type }}</td>

<td>{{ $port->harbor_size }}</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center">

Tidak ada data.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<div class="mt-3">

{{ $ports->withQueryString()->links() }}

</div>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([20,0],2);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
maxZoom:18,
attribution:'© OpenStreetMap'
}
).addTo(map);

@foreach($ports as $port)

@if($port->latitude && $port->longitude)

L.marker([
{{ $port->latitude }},
{{ $port->longitude }}
]).addTo(map)

.bindPopup(`
<b>{{ $port->port_name }}</b><br>

Negara :
{{ $port->country_code }}

<br>

Region :
{{ $port->region }}

<br>

Tipe :
{{ $port->harbor_type }}

<br>

Ukuran :
{{ $port->harbor_size }}

`);

@endif

@endforeach

</script>

@endsection