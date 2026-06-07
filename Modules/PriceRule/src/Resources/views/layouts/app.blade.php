<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-slate-100 antialiased">

<div x-data="{ sidebarOpen: false }" class="min-h-screen">

    <!-- Mobile Overlay -->
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 z-40 lg:hidden"
        @click="sidebarOpen = false">
    </div>

    <!-- Sidebar -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 border-r border-slate-800 transform transition-transform duration-300 lg:translate-x-0">

        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800">

            <div class="h-10 w-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold">
                P
            </div>

            <div class="ml-3">
                <h2 class="text-white font-semibold">
                    Pricing Engine
                </h2>

                <p class="text-xs text-slate-400">
                    Admin Dashboard
                </p>
            </div>

        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-1">

            <p class="text-xs uppercase text-slate-500 px-4 py-2">
                Main Menu
            </p>

            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">

                <span>📊</span>
                Dashboard

            </a>

            <a href="{{ route('admin.price-rules.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->routeIs('admin.price-rules.*')
                   ? 'bg-indigo-600 text-white'
                   : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <span>🏷️</span>
                Price Rules

            </a>

        </nav>

        <!-- User -->
        <div class="absolute bottom-0 left-0 right-0 border-t border-slate-800 p-4">

            <div class="flex items-center">

                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}
                </div>

                <div class="ml-3">
                    <p class="text-sm font-medium text-white">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>

                    <p class="text-xs text-slate-400">
                        Administrator
                    </p>
                </div>

            </div>

        </div>

    </aside>

    <!-- Main Content -->
    <div class="lg:pl-72">

        <!-- Header -->
        <header class="sticky top-0 z-30 bg-white border-b border-slate-200">

            <div class="h-16 px-6 flex items-center justify-between">

                <!-- Left -->
                <div class="flex items-center gap-4">

                    <button
                        @click="sidebarOpen = true"
                        class="lg:hidden p-2 rounded-lg hover:bg-slate-100">

                        ☰

                    </button>

                    <div>
                        <h1 class="font-semibold text-slate-800">
                            @yield('page-title')
                        </h1>

                        <p class="text-xs text-slate-500">
                            Welcome back 👋
                        </p>
                    </div>

                </div>

                <!-- Search -->
                <div class="hidden md:block w-full max-w-md mx-8">

                    <input
                        type="text"
                        placeholder="Search..."
                        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:outline-none">

                </div>

                <!-- Right -->
                <div class="flex items-center gap-4">

                    <button class="relative">

                        🔔

                        <span class="absolute -top-1 -right-1 h-4 w-4 rounded-full bg-red-500 text-white text-[10px] flex items-center justify-center">
                            3
                        </span>

                    </button>

                    {{-- <form method="POST" action="{{ route('logout') }}"> --}}
                        @csrf

                        <button
                            type="submit"
                            class="hidden md:block px-4 py-2 text-sm border border-red-200 text-red-600 rounded-lg hover:bg-red-50 transition">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </header>

        <!-- Content -->
        <main class="p-6">

            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>