<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - Platform Monitoring Risiko Supply Chain</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    @stack('styles')

    <style>

        body{
            margin:0;
            padding:0;
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            background:#0d6efd;
            color:white;
            overflow-y:auto;
        }

        .sidebar h3{
            text-align:center;
            padding:20px;
            margin:0;
            border-bottom:1px solid rgba(255,255,255,.2);
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

    </style>

</head>

<body>

<!-- ===========================
        SIDEBAR ADMIN
=========================== -->

<div class="sidebar">

    <h3>Admin Panel</h3>

    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">

        <i class="fas fa-home"></i>
        Dashboard

    </a>

    <!-- Kelola User -->
    <a href="{{ route('admin.users.index') }}"
       class="{{ request()->is('admin/users*') ? 'active' : '' }}">

        <i class="fas fa-users"></i>
        Kelola User

    </a>

    <!-- Kelola Pelabuhan -->
    <a href="{{ route('admin.ports.index') }}"
       class="{{ request()->is('admin/ports*') ? 'active' : '' }}">

        <i class="fas fa-anchor"></i>
        Kelola Pelabuhan

    </a>

    <!-- Artikel Analisis -->
    <a href="{{ route('admin.articles.index') }}"
       class="{{ request()->is('admin/articles*') ? 'active' : '' }}">

        <i class="fas fa-newspaper"></i>
        Artikel Analisis

    </a>

    <!-- Logout -->
    <a href="{{ url('/logout') }}">

        <i class="fas fa-right-from-bracket"></i>
        Logout

    </a>

</div>

<!-- ===========================
        CONTENT
=========================== -->

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

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>
</html>