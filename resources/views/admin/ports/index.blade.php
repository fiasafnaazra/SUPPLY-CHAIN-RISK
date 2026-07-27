@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            <i class="fas fa-anchor"></i>
            Kelola Pelabuhan
        </h2>

        <a href="{{ route('admin.ports.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Pelabuhan
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-primary">

                        <tr>

                            <th>No</th>

                            <th>Nama Pelabuhan</th>

                            <th>Negara</th>

                            <th>Wilayah</th>

                            <th>Harbor Type</th>

                            <th>Harbor Size</th>

                            <th width="170">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($ports as $port)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                {{ $port->port_name }}

                                @if($port->alternate_name)

                                    <br>

                                    <small class="text-muted">

                                        {{ $port->alternate_name }}

                                    </small>

                                @endif

                            </td>

                            <td>

                                {{ $port->country_code }}

                            </td>

                            <td>

                                {{ $port->region }}

                            </td>

                            <td>

                                {{ $port->harbor_type }}

                            </td>

                            <td>

                                {{ $port->harbor_size }}

                            </td>

                            <td>

                                <a href="{{ route('admin.ports.edit',$port->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form
                                    action="{{ route('admin.ports.destroy',$port->id) }}"
                                    method="POST"
                                    style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data pelabuhan ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                Belum ada data pelabuhan.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $ports->links() }}

            </div>

        </div>

    </div>

</div>

@endsection