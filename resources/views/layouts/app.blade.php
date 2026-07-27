<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Monitoring Risiko Supply Chain</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    @stack('styles')

    <style>

        body{
            background:#f4f6f9;
            margin:0;
            padding:0;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            top:0;
            left:0;
            background:#0d6efd;
            color:white;
            overflow-y:auto;
        }

        .sidebar h3{
            padding:20px;
            text-align:center;
            border-bottom:1px solid rgba(255,255,255,.2);
            margin:0;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 20px;
            transition:.3s;
        }

        .sidebar a:hover,
        .sidebar a.active{
            background:white;
            color:#0d6efd;
        }

        .content{
            margin-left:250px;
            min-height:100vh;
        }

        .navbar-custom{
            background:white;
            padding:15px 30px;
            box-shadow:0 2px 8px rgba(0,0,0,.08);
        }

        .page-content{
            padding:30px;
        }

        /* ==========================
           Dropdown Supply Chain
        ========================== */

        .sidebar .dropdown-menu{
            position:static !important;
            float:none;
            width:100%;
            background:#0d6efd;
            border:none;
            border-radius:0;
            padding:0;
            margin:0;
        }

        .sidebar .dropdown-toggle::after{
            float:right;
            margin-top:10px;
        }

        .sidebar .dropdown-item{
            color:white;
            background:#0d6efd;
            padding:12px 45px;
        }

        .sidebar .dropdown-item:hover{
            background:white;
            color:#0d6efd;
        }

    </style>

</head>

<body>

<div class="sidebar">

    <h3>Supply Chain</h3>

    {{-- ===========================
         Dashboard (AUTO ROLE)
    ============================ --}}

    @if(session('role') == 'admin')

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            Dashboard
        </a>

    @else

        <a href="/dashboard"
           class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            Dashboard
        </a>

    @endif


    <!-- Negara -->
    <a href="{{ route('countries.index') }}"
       class="{{ request()->is('countries*') ? 'active' : '' }}">
        <i class="fas fa-globe"></i>
        Data Negara
    </a>

    <!-- Cuaca -->
    <a href="{{ route('weather.index') }}"
       class="{{ request()->is('weather*') ? 'active' : '' }}">
        <i class="fas fa-cloud-sun"></i>
        Data Cuaca
    </a>

    <!-- Pelabuhan -->
    <a href="{{ route('ports.index') }}"
       class="{{ request()->is('ports*') ? 'active' : '' }}">
        <i class="fas fa-anchor"></i>
        Data Pelabuhan
    </a>

    <!-- Favorite Monitoring -->
    <a href="{{ route('watchlist.index') }}"
       class="{{ request()->is('watchlist*') ? 'active' : '' }}">
        <i class="fas fa-star"></i>
        Favorite Monitoring
    </a>

    <!-- Supply Chain Dropdown -->
    <div class="dropdown">

        <a href="#"
           class="dropdown-toggle {{ request()->is('supply-chain*') || request()->is('comparison*') ? 'active' : '' }}"
           data-bs-toggle="dropdown">

            <i class="fas fa-truck"></i>
            Supply Chain

        </a>

        <ul class="dropdown-menu">

            <li>
                <a class="dropdown-item"
                   href="{{ route('supply-chain.index') }}">
                    <i class="fas fa-list me-2"></i>
                    Data Supply Chain
                </a>
            </li>

            <li>
                <a class="dropdown-item"
                   href="{{ route('comparison.index') }}">
                    <i class="fas fa-scale-balanced me-2"></i>
                    Perbandingan Negara
                </a>
            </li>

        </ul>

    </div>

    <!-- Berita -->
    <a href="{{ route('news.index') }}"
       class="{{ request()->is('news*') ? 'active' : '' }}">
        <i class="fas fa-newspaper"></i>
        Berita
    </a>

    <!-- Logout -->
    <a href="/logout">
        <i class="fas fa-right-from-bracket"></i>
        Logout
    </a>

</div>

<div class="content">

    <div class="navbar-custom d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Platform Monitoring Risiko Supply Chain
        </h4>

        <b>{{ session('name') }}</b>

    </div>

    <div class="page-content">

        @yield('content')

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>
</html>