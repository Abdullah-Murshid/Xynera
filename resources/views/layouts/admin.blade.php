<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ── Favicon & Title Bar Icon ─────────────────────────────────── --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}?v={{ time() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}?v={{ time() }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png') }}?v={{ time() }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#EC5B13">
    <meta name="msapplication-TileColor" content="#EC5B13">
    <title>{{ config('app.name', 'Xynera') }} Admin &mdash; @yield('title', 'Dashboard')</title>

    <!-- Google Fonts: Public Sans & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD@400,0,0&display=swap" rel="stylesheet">

    <!-- CSS (Pure CSS3) -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>

    <!-- ══ SIDEBAR ══ -->
    <aside>
        <div class="brand" style="display: flex; items-center; gap: 8px;">
            <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Xynera') }}" style="height: 28px; width: auto; object-fit: contain;">
           
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                <span class="material-symbols-outlined">dashboard</span> Overview
            </a>
            <a href="{{ route('admin.portfolio') }}" class="nav-item {{ Route::currentRouteName() == 'admin.portfolio' ? 'active' : '' }}">
                <span class="material-symbols-outlined">folder_managed</span> Portfolio
            </a>
            <a href="{{ route('admin.services') }}" class="nav-item {{ Route::currentRouteName() == 'admin.services' ? 'active' : '' }}">
                <span class="material-symbols-outlined">design_services</span> Services
            </a>
            <a href="{{ route('admin.messages') }}" class="nav-item {{ Route::currentRouteName() == 'admin.messages' ? 'active' : '' }}">
                <span class="material-symbols-outlined">mail</span> Messages
            </a>
            
            <a href="{{ route('admin.seo') }}" class="nav-item {{ Route::currentRouteName() == 'admin.seo' ? 'active' : '' }}">
                <span class="material-symbols-outlined">search</span> SEO Meta
            </a>
            <a href="{{ route('admin.faqs') }}" class="nav-item {{ Route::currentRouteName() == 'admin.faqs' ? 'active' : '' }}">
                <span class="material-symbols-outlined">help</span> FAQs
            </a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin-top: auto; padding: 0.5rem 1.5rem;">
                @csrf
                <button type="submit" class="nav-item" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer; color: var(--text-muted);">
                    <span class="material-symbols-outlined">logout</span> Logout
                </button>
            </form>

            <a href="{{ route('admin.settings') }}" class="nav-item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" style="margin-top: 1rem;">
                <span class="material-symbols-outlined">settings</span> Settings
            </a>
        </nav>
    </aside>

    <!-- ══ MAIN CONTENT ══ -->
    <main>
        <header>
            <div class="header-title">
                <h1>@yield('header_title', 'Dashboard Overview')</h1>
            </div>
            <div class="header-actions">
                @yield('header_actions')
                <button class="theme-toggle" id="themeToggleBtn" aria-label="Toggle Theme">
                    <span class="material-symbols-outlined" id="themeIcon">light_mode</span>
                </button>
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>
    </main>

    @yield('modals')

    <x-notifications />

    <!-- JS (Vanilla) -->
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
