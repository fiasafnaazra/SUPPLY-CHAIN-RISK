@extends('layouts.admin')

@section('content')

<h2 class="mb-4">
    Dashboard Admin
</h2>

<div class="row">

    <!-- Total User -->
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 bg-primary text-white">
            <div class="card-body text-center">

                <i class="fas fa-users fa-3x mb-3"></i>

                <h2>{{ $totalUser ?? 0 }}</h2>

                <p class="mb-0">
                    Total User
                </p>

            </div>
        </div>
    </div>

    <!-- Total Pelabuhan -->
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 bg-success text-white">
            <div class="card-body text-center">

                <i class="fas fa-anchor fa-3x mb-3"></i>

                <h2>{{ $totalPort ?? 0 }}</h2>

                <p class="mb-0">
                    Total Pelabuhan
                </p>

            </div>
        </div>
    </div>

    <!-- Total Artikel -->
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 bg-warning text-white">
            <div class="card-body text-center">

                <i class="fas fa-newspaper fa-3x mb-3"></i>

                <h2>{{ $totalArticle ?? 0 }}</h2>

                <p class="mb-0">
                    Total Artikel Analisis
                </p>

            </div>
        </div>
    </div>

</div>

<div class="card shadow border-0 mt-4">

    <div class="card-body">

        <h4>Selamat Datang, {{ session('name') }}</h4>

        <hr>

        <p>
            Dashboard Admin digunakan untuk mengelola data sistem.
        </p>

        <ul>
            <li>Kelola User</li>
            <li>Kelola Dataset Pelabuhan</li>
            <li>Kelola Artikel Analisis</li>
        </ul>

    </div>

</div>

@endsection