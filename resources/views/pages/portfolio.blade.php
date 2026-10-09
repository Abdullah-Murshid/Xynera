@extends('layouts.app')

@section('title', 'Portfolio — Selected Digital Products & Web Applications')
@section('meta_description', 'Explore the Xynera portfolio showcasing custom web applications, AI automation platforms, and brand designs delivered for client success.')

@section('content')
<!-- ─── Hero ─── -->
<section class="px-6 md:px-20 py-28 md:py-40 max-w-7xl mx-auto">
  <div class="max-w-4xl">
    <x-eyebrow label="Our Expertise" :reveal="true" />
    
    <h1 class="text-[clamp(2.5rem,9vw,8rem)] font-black uppercase tracking-[-0.05em] leading-[0.88] mb-8 animate-fade-up [animation-delay:0.1s]">
      Selected<br>
      <span class="text-grad">Work</span>
    </h1>
    
    <p class="text-agency-muted text-[1.1rem] md:text-[1.25rem] leading-relaxed font-light max-w-2xl animate-fade-up [animation-delay:0.2s]">
      A curated collection of digital products, applications, and brand identities crafted for visionary founders and enterprises.
    </p>
  </div>
</section>

<!-- ─── Filters & Search ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 mb-20 animate-fade-up [animation-delay:0.3s]">
  @php
      $currentSlug = $activeSlug ?? 'all';
      $filterButtons = [
          'all'              => ['label' => 'All Projects',     'url' => route('portfolio')],
          'web-apps'         => ['label' => 'Web Apps',         'url' => route('portfolio', ['category' => 'web-apps'])],
          'mobile'           => ['label' => 'Mobile',           'url' => route('portfolio', ['category' => 'mobile'])],
          'branding'         => ['label' => 'Branding',         'url' => route('portfolio', ['category' => 'branding'])],
          'enterprise-cloud' => ['label' => 'Enterprise Cloud', 'url' => route('portfolio', ['category' => 'enterprise-cloud'])],
      ];

      $categoryToSlugMap = [
          'Web Application'  => 'web-apps',
          'Mobile App'       => 'mobile',
          'Brand & Web'      => 'branding',
          'Enterprise Cloud' => 'enterprise-cloud',
      ];
  @endphp

  <nav aria-label="Portfolio category filter" class="flex flex-wrap items-center justify-center gap-4">
    @foreach($filterButtons as $slug => $btn)
        @php $isActive = ($currentSlug === $slug); @endphp
        <a href="{{ $btn['url'] }}" 
           data-filter-slug="{{ $slug }}"
           aria-current="{{ $isActive ? 'true' : 'false' }}"
           class="portfolio-filter-btn px-6 py-2.5 rounded-full text-[0.75rem] font-bold uppercase tracking-widest border transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-agency-accent focus-visible:ring-offset-2 focus-visible:ring-offset-agency-dark {{ $isActive ? 'bg-agency-accent border-agency-accent text-white' : 'border-agency-stroke text-agency-muted hover:border-white/20 hover:bg-white/5' }}">
            {{ $btn['label'] }}
        </a>
    @endforeach
  </nav>
</section>

<!-- ─── Portfolio Grid ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-10">
  @php
      $visibleCount = 0;
      foreach ($projects as $p) {
          $s = $categoryToSlugMap[$p->category] ?? 'all';
          if ($currentSlug === 'all' || $currentSlug === $s) {
              $visibleCount++;
          }
      }
      $useCenteredFlex = ($visibleCount > 0 && $visibleCount < 3);
  @endphp

  <div id="portfolio-grid" 
       class="reveal transition-all duration-300 {{ $useCenteredFlex ? 'flex flex-wrap justify-center gap-6 md:gap-8' : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8' }}">
    @foreach($projects as $index => $project)
    @php
        $cardSlug = $categoryToSlugMap[$project->category] ?? 'all';
        $isShown = ($currentSlug === 'all' || $currentSlug === $cardSlug);
    @endphp
    <a href="{{ route('portfolio.show', $project->slug) }}" 
       data-category="{{ $project->category }}"
       data-category-slug="{{ $cardSlug }}"
       data-project-id="{{ $project->id }}"
       class="project-card group relative overflow-hidden rounded-[32px] border border-agency-stroke bg-agency-surface min-h-[380px] w-full max-w-md {{ $useCenteredFlex ? 'flex-1 min-w-[300px] max-w-[420px]' : '' }} {{ $isShown ? '' : 'hidden' }}"
       style="view-transition-name: project-card-{{ $project->id }}; transition: opacity 150ms ease, transform 150ms ease;">
      
      <!-- Card Image Background with Explicit Width, Height, and Lazy Loading -->
      <div class="absolute inset-0 bg-agency-surface overflow-hidden">
        @if($project->image_path)
          <img src="{{ asset('storage/' . $project->image_path) }}" 
               alt="{{ $project->title }} — {{ $project->category }} case study cover image"
               width="800"
               height="500"
               loading="lazy"
               class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-agency-dark via-agency-dark/30 to-transparent opacity-85 group-hover:opacity-95 transition-opacity"></div>
      </div>
      
      <!-- Content Overlay -->
      <div class="relative z-10 p-8 min-h-[380px] flex flex-col justify-end">
        <div class="flex items-center gap-3 mb-4">
          <span class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-agency-accent">{{ $project->category }}</span>
          <span class="w-1 h-1 rounded-full bg-white/20"></span>
          <span class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-agency-muted">{{ $project->year }}</span>
        </div>
        <h3 class="text-2xl font-black mb-2 tracking-tight group-hover:text-agency-accent transition-colors">{{ $project->title }}</h3>
        <p class="text-agency-muted text-[0.85rem] leading-relaxed font-light mb-6 opacity-0 group-hover:opacity-100 transition-all transform translate-y-4 group-hover:translate-y-0 line-clamp-2 max-w-sm">{{ $project->description }}</p>
        <span class="flex items-center gap-2 text-[0.7rem] font-bold uppercase tracking-widest text-white opacity-60 group-hover:opacity-100 transition-all">
            View Case Study <span class="material-symbols-outlined !text-sm">arrow_forward</span>
        </span>
      </div>
    </a>
    @endforeach
  </div>

  <!-- Empty state message when no projects match filter -->
  <div id="no-projects-msg" class="{{ $visibleCount === 0 ? '' : 'hidden' }} max-w-xl mx-auto py-20 text-center">
    <div class="w-16 h-16 rounded-full bg-white/5 border border-agency-stroke flex items-center justify-center mx-auto mb-6 text-agency-muted">
      <span class="material-symbols-outlined !text-2xl">folder_off</span>
    </div>
    <h3 class="text-xl font-bold mb-2">No projects in this category yet</h3>
    <p class="text-agency-muted text-sm font-light">We are constantly adding new work. Check back soon or view all projects.</p>
  </div>
</section>

<!-- ─── CTA ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-40 text-center">
  <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tight leading-[0.9] mb-12">
    Ready to build the<br><span class="italic font-light">next big thing?</span>
  </h2>
  <div class="flex flex-wrap justify-center gap-6">
    <x-button variant="primary" size="xl" :href="route('contact')" icon="rocket_launch">Start a Project</x-button>
    <x-button variant="outline" size="xl" :href="route('services')">View Services</x-button>
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('.portfolio-filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    const gridContainer = document.getElementById('portfolio-grid');
    const noProjectsMsg = document.getElementById('no-projects-msg');

    const slugAliasMap = {
        'all': 'all',
        'web-apps': 'web-apps',
        'web-app': 'web-apps',
        'web app': 'web-apps',
        'web application': 'web-apps',
        'mobile': 'mobile',
        'mobile app': 'mobile',
        'branding': 'branding',
        'brand': 'branding',
        'brand & web': 'branding',
        'brand-web': 'branding',
        'enterprise-cloud': 'enterprise-cloud',
        'enterprise cloud': 'enterprise-cloud'
    };

    function getSlugFromParam(param) {
        if (!param) return 'all';
        const decoded = decodeURIComponent(param).trim().toLowerCase();
        return slugAliasMap[decoded] || 'all';
    }

    // Core DOM visibility update logic
    function updateDomFilter(normalizedSlug) {
        let visibleCount = 0;

        projectCards.forEach(card => {
            const cardSlug = card.getAttribute('data-category-slug');
            const matches = (normalizedSlug === 'all' || cardSlug === normalizedSlug);

            if (matches) {
                visibleCount++;
                card.classList.remove('hidden');
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
            } else {
                card.classList.add('hidden');
            }
        });

        // Adjust grid container for 1 or 2 centered results vs 3+ column layout
        if (gridContainer) {
            if (visibleCount > 0 && visibleCount < 3) {
                gridContainer.className = 'reveal transition-all duration-300 flex flex-wrap justify-center gap-6 md:gap-8';
                projectCards.forEach(card => {
                    card.classList.add('flex-1', 'min-w-[300px]', 'max-w-[420px]');
                });
            } else {
                gridContainer.className = 'reveal transition-all duration-300 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8';
                projectCards.forEach(card => {
                    card.classList.remove('flex-1', 'min-w-[300px]', 'max-w-[420px]');
                });
            }
        }

        // Toggle empty state message
        if (noProjectsMsg) {
            if (visibleCount === 0) {
                noProjectsMsg.classList.remove('hidden');
            } else {
                noProjectsMsg.classList.add('hidden');
            }
        }
    }

    // Filter dispatcher supporting View Transitions API & Fallback
    function applyFilter(targetSlug, updateHistory = false) {
        const normalizedSlug = slugAliasMap[targetSlug] || 'all';
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Update active state and aria-current on filter buttons
        filterBtns.forEach(btn => {
            const btnSlug = btn.getAttribute('data-filter-slug');
            const isActive = (btnSlug === normalizedSlug);

            btn.setAttribute('aria-current', isActive ? 'true' : 'false');

            if (isActive) {
                btn.classList.add('bg-agency-accent', 'border-agency-accent', 'text-white');
                btn.classList.remove('border-agency-stroke', 'text-agency-muted', 'hover:border-white/20', 'hover:bg-white/5');
            } else {
                btn.classList.remove('bg-agency-accent', 'border-agency-accent', 'text-white');
                btn.classList.add('border-agency-stroke', 'text-agency-muted', 'hover:border-white/20', 'hover:bg-white/5');
            }
        });

        // 1. View Transitions API (Modern Browsers)
        if (!prefersReducedMotion && document.startViewTransition) {
            document.startViewTransition(() => {
                updateDomFilter(normalizedSlug);
            });
        }
        // 2. Smooth 150ms Fallback Transition
        else if (!prefersReducedMotion) {
            projectCards.forEach(card => {
                const cardSlug = card.getAttribute('data-category-slug');
                const matches = (normalizedSlug === 'all' || cardSlug === normalizedSlug);
                if (!matches && !card.classList.contains('hidden')) {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.97)';
                }
            });

            setTimeout(() => {
                updateDomFilter(normalizedSlug);
            }, 150);
        }
        // 3. Instant toggle for reduced motion
        else {
            updateDomFilter(normalizedSlug);
        }

        // Push new URL state into browser history without page reload
        if (updateHistory) {
            const newUrl = normalizedSlug === 'all' ? '/portfolio' : `/portfolio?category=${normalizedSlug}`;
            if (window.location.pathname + window.location.search !== newUrl) {
                window.history.pushState({ category: normalizedSlug }, '', newUrl);
            }
        }
    }

    // Intercept clicks on filter links
    filterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const slug = btn.getAttribute('data-filter-slug');
            applyFilter(slug, true);
        });
    });

    // Handle browser Back / Forward history navigation
    window.addEventListener('popstate', (e) => {
        const params = new URLSearchParams(window.location.search);
        const currentCategory = params.get('category');
        const slug = getSlugFromParam(currentCategory);
        applyFilter(slug, false);
    });

    // Sync state on page load if URL has category parameter
    const initialParams = new URLSearchParams(window.location.search);
    const initialCategory = initialParams.get('category');
    if (initialCategory) {
        applyFilter(getSlugFromParam(initialCategory), false);
    }
});
</script>
@endpush
@endsection
