<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #343a40;
        }

        .sidebar a {
            color: #ddd;
            display: block;
            padding: 12px 15px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }

        .sidebar .active {
            background: #0d6efd;
            color: #fff;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 20px;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="sidebar position-fixed">
    <h4 class="text-white p-3">
        {{ config('app.name', 'App') }}
    </h4>

    <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : '#' }}">
        Dashboard
    </a>

    <a href="{{ route('admin.price-rules.index') }}"
       class="{{ request()->routeIs('admin.price-rules.*') ? 'active' : '' }}">
        Price Rules
    </a>
</div>

<div class="content">
    <div class="topbar d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">
            @yield('page-title', 'Dashboard')
        </h5>

        <div>
            <span class="me-3">
                Hi, {{ auth()->user()->name ?? 'Admin' }}
            </span>

            @if(Route::has('logout'))
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        Logout
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>