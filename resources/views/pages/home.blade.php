@extends('layouts.app')

@section('title', 'AI Automation & Web Development Agency')
@section('meta_description', 'Xynera is an AI automation and web development agency building high-performance applications, intelligent workflows, and custom digital experiences.')

@section('content')
<!-- ══ HERO ══ -->
<section id="hero" class="relative z-10 px-6 md:px-20 py-28 md:py-40 max-w-7xl mx-auto">
  
  <h1 class="text-[clamp(2.5rem,9vw,8rem)] font-black uppercase tracking-[-0.05em] leading-[0.88] animate-fade-up [animation-delay:0.08s]">
    We Build<br>
    <span class="text-grad">Digital</span><br>
    Excellence
  </h1>
  
  <p class="max-w-[580px] text-[1.05rem] text-agency-muted leading-[1.72] font-light mt-8 animate-fade-up [animation-delay:0.18s]">
    Xynera crafts bespoke digital solutions — from next-gen web apps to mobile experiences — engineered with surgical precision and expressive minimalism.
  </p>
  
  <div class="flex flex-wrap gap-4 mt-10 animate-fade-up [animation-delay:0.28s]">
    <x-button variant="primary" size="lg" :href="route('contact')" icon="rocket_launch">
      Start a Project
    </x-button>
    <x-button variant="outline" size="lg" :href="route('services')" icon="arrow_forward">
      View Services
    </x-button>
  </div>
</section>

<!-- ══ TICKER ══ -->
<div class="relative z-10 border-y border-agency-stroke overflow-hidden bg-agency-surface/40 backdrop-blur-md py-4 mt-20">
  <div class="flex w-max animate-ticker">
    @php $ticker_items = ['Web Development', 'Custom Software', 'UI/UX Design', 'Mobile Applications', 'SEO Strategy', 'Technical Consultation', 'Edge Architecture', 'Brand Identity']; @endphp
    @foreach(array_merge($ticker_items, $ticker_items, $ticker_items) as $item)
    <div class="flex items-center gap-5 px-10 whitespace-nowrap text-[0.7rem] font-bold uppercase tracking-[0.18em] text-agency-muted">
      <span class="w-1.5 h-1.5 rounded-full bg-agency-accent shrink-0"></span>
      {{ $item }}
    </div>
    @endforeach
  </div>
</div>

<!-- ══ ABOUT ══ -->
<section id="about" class="relative z-10 py-36">
  <div class="max-w-7xl mx-auto px-6 md:px-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
      <div>
        <x-eyebrow label="Who We Are" :reveal="true" />
        <h2 class="text-[clamp(2.2rem,4vw,3.5rem)] font-black tracking-[-0.04em] leading-[1.05] mb-6 reveal [transition-delay:0.05s]">
          Precision-crafted<br>for the <span class="text-grad">bold.</span>
        </h2>
        <p class="text-[0.92rem] text-agency-muted leading-[1.78] font-light reveal [transition-delay:0.12s]">
          Xynera is a digital engineering studio obsessed with craft. We partner with founders, brands, and enterprises to turn ambitious visions into high-performance digital products.
        </p>
        <p class="text-[0.92rem] text-agency-muted leading-[1.78] font-light mt-4 reveal [transition-delay:0.19s]">
          Every pixel, every function, every interaction is intentional. We don't build templates — we architect experiences that set the standard.
        </p>
        <div class="flex flex-wrap gap-2.5 mt-8 reveal [transition-delay:0.26s]">
          @foreach(['React & Next.js', 'Swift & Kotlin', 'Node.js', 'Figma', 'Edge Deploy', 'AI Integration'] as $pill)
            <span class="text-[0.65rem] font-bold uppercase tracking-widest px-4 py-2 border border-agency-stroke rounded-full text-agency-muted">{{ $pill }}</span>
          @endforeach
        </div>
      </div>
      
      <div class="relative bg-gradient-to-br from-white/[0.04] to-white/[0.01] border border-agency-stroke rounded-[20px] p-10 overflow-hidden aspect-[4/3] flex flex-col justify-end reveal [transition-delay:0.12s]">
        <div class="absolute inset-0 noise-grid opacity-30"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_60%_30%,rgba(236,91,19,0.15)_0%,transparent_65%)] pointer-events-none"></div>
        
        <div class="relative z-10 inline-flex items-center gap-2 bg-agency-dark/80 border border-agency-stroke rounded-xl px-4 py-3 w-fit mb-4">
          <span class="material-symbols-outlined !text-[1.1rem] text-agency-accent">verified</span>
          <span class="text-[0.75rem] font-semibold">Trusted by 25+ Clients</span>
        </div>
        
        <div class="relative z-10 flex items-baseline gap-1">
          <span class="text-5xl font-black text-grad">25</span>
          <span class="text-4xl text-agency-accent font-bold">+</span>
        </div>
        <div class="relative z-10 text-agency-muted text-sm font-medium tracking-wide">Projects successfully delivered</div>
      </div>
    </div>
  </div>
</section>

<!-- ══ SERVICES ══ -->
<section id="services" class="relative z-10 py-10">
  <div class="max-w-7xl mx-auto px-6 md:px-20">
    <x-section-header 
      eyebrow="What We Do" 
      title="Our Core<br><span class='text-grad'>Capabilities</span>" 
      linkText="All Services" 
      :linkHref="route('services')" 
    />
    
    <div class="flex flex-col">
      @foreach($services as $index => $service)
      <div class="group flex flex-wrap items-center justify-between py-8 border-b border-agency-stroke reveal [transition-delay:{{ $index * 0.07 }}s] hover:bg-white/[0.02] transition-colors cursor-pointer px-2">
        <div class="flex items-center gap-8 md:gap-16">
          <span class="text-xs font-bold text-agency-muted opacity-40 font-mono">{{ $service->number }}</span>
          <span class="material-symbols-outlined text-agency-accent group-hover:scale-110 transition-transform">{{ $service->icon }}</span>
          <span class="text-xl md:text-3xl font-black tracking-tight group-hover:translate-x-2 transition-transform">{{ $service->title }}</span>
        </div>
        <div class="flex items-center gap-4 mt-4 md:mt-0">
          <span class="text-[0.6rem] font-bold uppercase tracking-widest px-3 py-1 border border-agency-stroke rounded-full text-agency-muted">{{ $service->tags }}</span>
          <span class="material-symbols-outlined text-agency-muted group-hover:text-agency-accent transition-colors">arrow_forward</span>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ══ WORK ══ -->
<section id="work" class="relative z-10 py-36">
  <div class="max-w-7xl mx-auto px-6 md:px-20">
    <x-section-header 
      eyebrow="Selected Work" 
      title="Recent <span class='text-grad'>Projects</span>" 
      linkText="Full Portfolio" 
      :linkHref="route('portfolio')" 
    />
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      @if($projects->count() > 0)
        @php $featured = $projects->first(); @endphp
        <a href="{{ route('portfolio.show', $featured->slug) }}" class="relative group h-[500px] lg:h-[700px] rounded-3xl overflow-hidden border border-agency-stroke reveal block"
             style="background-image: url('{{ $featured->image_path ? asset('storage/' . $featured->image_path) : '' }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-t from-agency-dark via-agency-dark/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
            <div class="absolute inset-0 noise-grid opacity-20 pointer-events-none"></div>
            
            <div class="absolute bottom-10 left-10 right-10">
                <span class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-agency-accent mb-3 block">{{ $featured->category }}</span>
                <h3 class="text-3xl font-black mb-3 group-hover:text-agency-accent transition-colors">{{ $featured->title }}</h3>
                <p class="text-agency-muted text-sm line-clamp-2 font-light max-w-sm mb-4">{{ $featured->description }}</p>
                <span class="inline-flex items-center gap-2 text-[0.7rem] font-bold uppercase tracking-widest text-white opacity-80 group-hover:opacity-100 transition-all">
                  View Case Study <span class="material-symbols-outlined !text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <div class="grid grid-cols-1 gap-8">
            @foreach($projects->skip(1) as $index => $project)
            <a href="{{ route('portfolio.show', $project->slug) }}" class="relative group h-[235px] md:h-[335px] rounded-3xl overflow-hidden border border-agency-stroke reveal [transition-delay:{{ ($index + 1) * 0.1 }}s] block"
                 style="background-image: url('{{ $project->image_path ? asset('storage/' . $project->image_path) : '' }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-t from-agency-dark via-agency-dark/10 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                
                <div class="absolute bottom-8 left-8 right-8">
                    <span class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-agency-accent mb-1 block">{{ $project->category }}</span>
                    <h3 class="text-xl font-black mb-1 group-hover:text-agency-accent transition-colors">{{ $project->title }}</h3>
                    <p class="text-agency-muted text-xs line-clamp-1 font-light max-w-xs mb-3">{{ $project->description }}</p>
                    <span class="inline-flex items-center gap-2 text-[0.65rem] font-bold uppercase tracking-widest text-white opacity-80 group-hover:opacity-100 transition-all">
                      View Case Study <span class="material-symbols-outlined !text-xs">arrow_forward</span>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
      @endif
    </div>
  </div>
</section>

<!-- ══ PROCESS ══ -->
<section id="process" class="relative z-10 py-10">
  <div class="max-w-7xl mx-auto px-6 md:px-20">
    <x-section-header eyebrow="How We Work" title="Our <span class='text-grad'>Process</span>" />
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      @php 
        $steps = [
            ['num' => '01', 'icon' => 'search', 'title' => 'Discover', 'desc' => 'We deep-dive into your goals, users, and market landscape to define a sharp strategic foundation.'],
            ['num' => '02', 'icon' => 'draw', 'title' => 'Design', 'desc' => 'High-fidelity wireframes and prototypes tested for clarity, delight, and performance.'],
            ['num' => '03', 'icon' => 'code', 'title' => 'Build', 'desc' => 'Engineering excellence with clean architecture, scalable APIs, and obsessive attention to detail.'],
            ['num' => '04', 'icon' => 'rocket_launch', 'title' => 'Deploy', 'desc' => 'Phased deployment with performance monitoring, optimization, and ongoing support built in.'],
        ];
      @endphp
      @foreach($steps as $index => $step)
      <div class="p-8 bg-white/[0.02] border border-agency-stroke rounded-2xl reveal [transition-delay:{{ $index * 0.1 }}s] hover:bg-white/[0.04] transition-all group">
        <span class="text-[0.6rem] font-bold text-agency-accent uppercase tracking-widest block mb-6 opacity-60">Step {{ $step['num'] }}</span>
        <div class="w-12 h-12 rounded-xl bg-agency-accent/10 flex items-center justify-center text-agency-accent mb-6 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined">{{ $step['icon'] }}</span>
        </div>
        <h3 class="text-lg font-black mb-3">{{ $step['title'] }}</h3>
        <p class="text-agency-muted text-[0.85rem] leading-relaxed font-light">{{ $step['desc'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ══ TESTIMONIALS ══ -->
<section id="testimonials" class="relative z-10 py-36">
  <div class="max-w-7xl mx-auto px-6 md:px-20">
    <x-section-header eyebrow="Client Voices" title="What They <span class='text-grad'>Say</span>" />
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($testimonials as $index => $testimonial)
      <div class="p-10 bg-agency-surface/30 border border-agency-stroke rounded-[32px] backdrop-blur-sm reveal [transition-delay:{{ $index * 0.07 }}s] flex flex-col justify-between">
        <div>
            <div class="flex gap-1 mb-6 text-[#fbbf24]">
              @for($i=0; $i<$testimonial->stars; $i++)
              <span class="material-symbols-outlined !text-[1.1rem]">star</span>
              @endfor
            </div>
            <p class="text-lg font-medium leading-relaxed italic opacity-90 mb-10">"{{ $testimonial->quote }}"</p>
        </div>
        
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-full flex items-center justify-center text-xs font-bold uppercase transition-transform group-hover:scale-110 {{ $testimonial->avatar_class }}">
            {{ $testimonial->author_initials }}
          </div>
          <div>
            <div class="text-sm font-bold">{{ $testimonial->author_name }}</div>
            <div class="text-[0.7rem] text-agency-muted font-bold uppercase tracking-widest">{{ $testimonial->author_role }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ══ CTA BANNER ══ -->
<section id="cta" class="relative z-10 px-6 py-32 text-center overflow-hidden border-t border-agency-stroke">
  <div class="absolute inset-0 noise-grid opacity-10 pointer-events-none"></div>
  <div class="max-w-3xl mx-auto relative z-10">
    <div class="text-xs font-black uppercase tracking-[0.3em] text-agency-muted mb-8">Let's create something great</div>
    <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tight leading-[0.9] mb-10">Ready to<br><span class="text-grad">Elevate</span><br>Your Vision?</h2>
    <p class="text-agency-muted text-lg font-light mb-12">Join the businesses that trusted Xynera to build their most important digital products.</p>
    <div class="flex flex-wrap justify-center gap-6">
      <x-button variant="primary" size="xl" :href="route('contact')" icon="rocket_launch">Launch Project</x-button>
      <x-button variant="outline" size="xl" :href="route('portfolio')">View Portfolio</x-button>
    </div>
  </div>
</section>

{{-- ── Structured Data (JSON-LD) ── --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "Organization",
      "@@id": "https://xynera.solutions/#organization",
      "name": "Xynera",
      "url": "https://xynera.solutions/",
      "logo": "https://xynera.solutions/assets/images/logo.png",
      "sameAs": [
        "https://twitter.com/xynerasolutions",
        "https://linkedin.com/company/xynera"
      ],
      "contactPoint": {
        "@@type": "ContactPoint",
        "email": "info@xynera.solutions",
        "contactType": "customer service"
      }
    },
    {
      "@@type": "WebSite",
      "@@id": "https://xynera.solutions/#website",
      "url": "https://xynera.solutions/",
      "name": "Xynera",
      "description": "AI Automation & Web Development Agency",
      "publisher": {
        "@@id": "https://xynera.solutions/#organization"
      }
    },
    {
      "@@type": "ProfessionalService",
      "@@id": "https://xynera.solutions/#service",
      "name": "Xynera — AI Automation & Web Development Agency",
      "url": "https://xynera.solutions/",
      "image": "https://xynera.solutions/assets/images/og-image.jpg",
      "priceRange": "$$$",
      "address": {
        "@@type": "PostalAddress",
        "addressLocality": "Palo Alto",
        "addressRegion": "CA",
        "postalCode": "94301",
        "addressCountry": "US"
      }
    }
  ]
}
</script>
@endsection
