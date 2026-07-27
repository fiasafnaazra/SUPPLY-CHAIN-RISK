@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            🌍 Kelola Data Negara
        </h2>

        <a href="{{ route('admin.countries.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i>
            Tambah Negara
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card shadow">

        <div class="card-header">

            <form action="{{ route('admin.countries.index') }}" method="GET">

                <div class="row">

                    <div class="col-md-10">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari Nama Negara / Kode Negara..."
                            value="{{ request('keyword') }}">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary w-100">

                            <i class="fas fa-search"></i>

                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary text-center">

                <tr>

                    <th width="60">No</th>

                    <th>Nama Negara</th>

                    <th>Kode</th>

                    <th>Ibukota</th>

                    <th>Benua</th>

                    <th>Mata Uang</th>

                    <th width="240">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($countries as $country)

                    <tr>

                        <td class="text-center">

                            {{ $countries->firstItem() + $loop->index }}

                        </td>

                        <td>

                            {{ $country->country_name }}

                        </td>

                        <td>

                            {{ $country->country_code }}

                        </td>

                        <td>

                            {{ $country->capital }}

                        </td>

                        <td>

                            {{ $country->continent }}

                        </td>

                        <td>

                            {{ $country->currency }}

                        </td>

                        <td class="text-center">

                            <a href="{{ route('admin.countries.show',$country->id) }}"
                               class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                                Detail

                            </a>

                            <a href="{{ route('admin.countries.edit',$country->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.countries.destroy',$country->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus negara ini?')">

                                    <i class="fas fa-trash"></i>

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Tidak ada data negara.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $countries->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@endsection