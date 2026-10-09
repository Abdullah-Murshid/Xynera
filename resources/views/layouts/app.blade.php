<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ── Favicon & Title Bar Icon ─────────────────────────────────── --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}?v={{ time() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}?v={{ time() }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png') }}?v={{ time() }}">
    {{-- Webapp manifest — ties the icon set together for installable PWA --}}
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    {{-- Browser/OS chrome colour on mobile --}}
    <meta name="theme-color" content="#EC5B13">
    <meta name="msapplication-TileColor" content="#EC5B13">

    @php
        $routeName = Route::currentRouteName();
        $seo = $routeName ? \App\Models\SeoMeta::getBySlug($routeName) : null;

        // Page-level defaults — views can override by publishing a 'title' section
        $defaultTitle = View::yieldContent('title', 'Build the Future');
    @endphp

    {{-- Render all meta tags via the reusable component --}}
    <x-seo-meta
        :seo="$seo"
        :defaults="[
            'title'       => $defaultTitle,
            'description' => 'Xynera is a premium web design & development agency building expressive digital experiences.',
            'url'         => url()->current(),
            'og_type'     => 'website',
        ]"
    />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,300;0,400;0,700;0,900;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Vite Asset Management (Tailwind v4) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-agency-dark text-agency-text font-sans antialiased overflow-x-hidden">

<!-- ── Background Orbs ── -->
<div class="fixed top-[-250px] left-[-200px] w-[700px] h-[700px] rounded-full bg-[radial-gradient(circle,rgba(236,91,19,0.13)_0%,transparent_70%)] blur-[130px] pointer-events-none z-0 animate-drift"></div>
<div class="fixed top-[40%] right-[-180px] w-[500px] h-[500px] rounded-full bg-[radial-gradient(circle,rgba(236,91,19,0.07)_0%,transparent_70%)] blur-[130px] pointer-events-none z-0 animate-drift [animation-delay:-7s]"></div>
<div class="fixed bottom-[15%] left-[30%] w-[350px] h-[350px] rounded-full bg-[radial-gradient(circle,rgba(251,146,60,0.06)_0%,transparent_70%)] blur-[130px] pointer-events-none z-0 animate-drift [animation-delay:-14s]"></div>

<!-- ══ HEADER ══ -->
<header class="sticky top-0 z-50 w-full border-b border-agency-stroke bg-agency-dark/80 backdrop-blur-xl px-6 md:px-20 transition-all duration-300" id="main-header">
  <div class="max-w-7xl mx-auto flex items-center justify-between h-[68px]">
    <a class="flex items-center gap-2.5 no-underline group" href="{{ route('home') }}">
      <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Xynera') }}" class="h-8 w-auto object-contain transition-transform group-hover:scale-105">
    </a>
    
    <nav class="hidden md:flex items-center gap-10">
      @php $navItems = ['home' => 'Home', 'services' => 'Services', 'portfolio' => 'Portfolio', 'contact' => 'Contact']; @endphp
      @foreach($navItems as $route => $label)
        <a href="{{ route($route) }}" class="text-[0.8rem] font-semibold tracking-wide transition-colors {{ Route::currentRouteName() == $route ? 'text-agency-accent' : 'text-white/55 hover:text-white' }}">
          {{ $label }}
        </a>
      @endforeach
    </nav>

    <div class="flex items-center gap-3">
      <x-button variant="primary" size="sm" :href="route('contact')" class="hidden sm:inline-flex">Start Project</x-button>
      <button class="md:hidden flex items-center justify-center w-9 h-9 rounded-lg border border-agency-stroke text-agency-text hover:bg-white/5 transition-colors" id="hamburger">
        <span class="material-symbols-outlined !text-[1.1rem]">menu</span>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden flex-col gap-4 py-5 border-t border-agency-stroke animate-menu-in">
    @foreach($navItems as $route => $label)
      <a href="{{ route($route) }}" class="text-[0.85rem] font-semibold transition-colors {{ Route::currentRouteName() == $route ? 'text-agency-accent' : 'text-white/60' }}">
        {{ $label }}
      </a>
    @endforeach
  </div>
</header>

<main class="relative z-10">
    @yield('content')
</main>

<!-- ══ FOOTER ══ -->
<footer class="relative z-10 border-t border-agency-stroke bg-agency-dark pt-20 pb-10 px-6 md:px-20 mt-20">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
      <div class="flex flex-col gap-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 no-underline w-fit">
          <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Xynera') }}" class="h-8 w-auto object-contain">
        </a>
        <p class="text-agency-muted text-[0.92rem] leading-relaxed max-w-xs font-light">
          Architecting the future through expressive minimalism and superior software engineering.
        </p>
        <div class="flex gap-4">
          <a href="mailto:info@xynera.solutions" title="Email Us" class="w-10 h-10 rounded-full border border-agency-stroke flex items-center justify-center text-agency-muted hover:text-agency-accent hover:border-agency-accent/30 transition-all">
            <span class="material-symbols-outlined !text-[1.1rem]">mail</span>
          </a>
          <a href="{{ route('contact') }}" title="Contact" class="w-10 h-10 rounded-full border border-agency-stroke flex items-center justify-center text-agency-muted hover:text-agency-accent hover:border-agency-accent/30 transition-all">
            <span class="material-symbols-outlined !text-[1.1rem]">share</span>
          </a>
          <a href="{{ route('services') }}" title="Services" class="w-10 h-10 rounded-full border border-agency-stroke flex items-center justify-center text-agency-muted hover:text-agency-accent hover:border-agency-accent/30 transition-all">
            <span class="material-symbols-outlined !text-[1.1rem]">hub</span>
          </a>
          <a href="{{ route('portfolio') }}" title="Portfolio" class="w-10 h-10 rounded-full border border-agency-stroke flex items-center justify-center text-agency-muted hover:text-agency-accent hover:border-agency-accent/30 transition-all">
            <span class="material-symbols-outlined !text-[1.1rem]">groups</span>
          </a>
        </div>
      </div>

      <div>
        <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-6">Capabilities</h4>
        <ul class="flex flex-col gap-3">
          @php
            $capabilities = [
              'Development' => route('services'),
              'Design' => route('services'),
              'SEO' => route('services'),
              'Mobile Apps' => route('services'),
              'Consultation' => route('contact'),
            ];
          @endphp
          @foreach($capabilities as $item => $url)
            <li><a href="{{ $url }}" class="text-agency-muted text-[0.85rem] hover:text-agency-accent transition-colors">{{ $item }}</a></li>
          @endforeach
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-6">Company</h4>
        <ul class="flex flex-col gap-3">
          @php
            $companyLinks = [
              'Home' => route('home'),
              'Services' => route('services'),
              'Portfolio' => route('portfolio'),
              'Contact' => route('contact'),
            ];
          @endphp
          @foreach($companyLinks as $item => $url)
            <li><a href="{{ $url }}" class="text-agency-muted text-[0.85rem] hover:text-agency-accent transition-colors">{{ $item }}</a></li>
          @endforeach
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-6">Office</h4>
        <address class="not-italic text-agency-muted text-[0.85rem] leading-relaxed">
          Palo Alto, CA 94301<br>
          <a href="mailto:info@xynera.solutions" class="hover:text-agency-accent transition-colors">info@xynera.solutions</a>
        </address>
      </div>
    </div>

    <div class="pt-8 border-t border-agency-stroke flex flex-col md:flex-row justify-between items-center gap-4 text-agency-muted text-xs font-medium uppercase tracking-widest">
      <p>© {{ date('Y') }} Xynera Studio. All rights reserved.</p>
      <div class="flex gap-8">
        <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
        <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
</footer>

<x-notifications />

@stack('scripts')
</body>
</html>
