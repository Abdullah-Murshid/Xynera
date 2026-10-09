@extends('layouts.app')

@section('title', $project->title . ' — Case Study | Xynera')
@section('meta_description', $project->description)

@section('content')
<!-- ─── Header & Breadcrumb ─── -->
<section class="px-6 md:px-20 pt-20 pb-12 max-w-7xl mx-auto">
  <!-- Back Link -->
  <div class="mb-8">
    <a href="{{ route('portfolio') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-agency-muted hover:text-agency-accent transition-colors group">
      <span class="material-symbols-outlined !text-sm group-hover:-translate-x-1 transition-transform">arrow_back</span> 
      Back to Portfolio
    </a>
  </div>

  <!-- Title & Category Header -->
  <div class="flex flex-wrap items-center gap-3 mb-6">
    <span class="px-4 py-1.5 text-xs font-bold uppercase tracking-widest bg-agency-accent/10 border border-agency-accent/30 text-agency-accent rounded-full">
      {{ $project->category }}
    </span>
    <span class="w-1.5 h-1.5 rounded-full bg-white/30"></span>
    <span class="text-xs font-bold uppercase tracking-widest text-agency-muted">{{ $project->year }}</span>
  </div>

  <h1 class="text-4xl md:text-6xl lg:text-7xl font-black uppercase tracking-tight leading-[1.02] mb-6 text-white max-w-4xl">
    {{ $project->title }}
  </h1>

  <p class="text-agency-muted text-lg md:text-xl font-light leading-relaxed max-w-3xl mb-12">
    {{ $project->description }}
  </p>

  <!-- Project Overview Metadata Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-8 bg-agency-surface/60 border border-agency-stroke rounded-2xl backdrop-blur-md">
    @if($project->client)
    <div>
      <span class="text-[0.65rem] font-bold uppercase tracking-widest text-agency-muted block mb-1">Client</span>
      <span class="text-sm md:text-base font-semibold text-white">{{ $project->client }}</span>
    </div>
    @endif

    <div>
      <span class="text-[0.65rem] font-bold uppercase tracking-widest text-agency-muted block mb-1">Category</span>
      <span class="text-sm md:text-base font-semibold text-white">{{ $project->category }}</span>
    </div>

    <div>
      <span class="text-[0.65rem] font-bold uppercase tracking-widest text-agency-muted block mb-1">Year</span>
      <span class="text-sm md:text-base font-semibold text-white">{{ $project->year }}</span>
    </div>

    @if($project->technologies)
    <div>
      <span class="text-[0.65rem] font-bold uppercase tracking-widest text-agency-muted block mb-2">Technologies</span>
      <div class="flex flex-wrap gap-1.5">
        @foreach(array_map('trim', explode(',', $project->technologies)) as $tech)
          <span class="px-2.5 py-1 text-[0.7rem] font-medium bg-white/[0.06] border border-agency-stroke rounded-md text-white/90">
            {{ $tech }}
          </span>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>

<!-- ─── Hero Cover Image ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-4">
  <div class="relative w-full rounded-[28px] overflow-hidden border border-agency-stroke bg-agency-surface min-h-[350px] md:min-h-[480px] flex items-center justify-center">
    @if($project->image_path)
      <img src="{{ asset('storage/' . $project->image_path) }}" 
           alt="{{ $project->title }} case study cover" 
           width="1200"
           height="600"
           class="w-full h-full object-cover object-center max-h-[550px]">
      <div class="absolute inset-0 bg-gradient-to-t from-agency-dark/40 via-transparent to-transparent pointer-events-none"></div>
    @else
      <div class="p-20 text-center">
        <span class="material-symbols-outlined text-5xl text-agency-accent mb-4">image</span>
        <h3 class="text-xl font-bold">{{ $project->title }} Cover Image</h3>
      </div>
    @endif
  </div>
</section>

<!-- ─── Detailed Case Study Breakdown ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Problem & Challenge -->
    @if($project->problem)
    <div class="p-8 md:p-10 bg-white/[0.02] border border-agency-stroke rounded-3xl flex flex-col justify-between hover:border-agency-stroke/80 transition-colors">
      <div>
        <div class="w-12 h-12 rounded-xl bg-agency-accent/10 flex items-center justify-center text-agency-accent mb-6">
          <span class="material-symbols-outlined">warning</span>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-agency-accent mb-2 block">01. The Problem</span>
        <h3 class="text-xl md:text-2xl font-black mb-4 text-white">The Challenge</h3>
        <p class="text-agency-muted text-base leading-relaxed font-light">
          {{ $project->problem }}
        </p>
      </div>
    </div>
    @endif

    <!-- Solution & Approach -->
    @if($project->solution)
    <div class="p-8 md:p-10 bg-white/[0.02] border border-agency-stroke rounded-3xl flex flex-col justify-between hover:border-agency-stroke/80 transition-colors">
      <div>
        <div class="w-12 h-12 rounded-xl bg-agency-accent/10 flex items-center justify-center text-agency-accent mb-6">
          <span class="material-symbols-outlined">lightbulb</span>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-agency-accent mb-2 block">02. Our Approach</span>
        <h3 class="text-xl md:text-2xl font-black mb-4 text-white">The Solution</h3>
        <p class="text-agency-muted text-base leading-relaxed font-light">
          {{ $project->solution }}
        </p>
      </div>
    </div>
    @endif

    <!-- Result & Impact -->
    @if($project->result)
    <div class="p-8 md:p-10 bg-agency-accent/5 border border-agency-accent/20 rounded-3xl flex flex-col justify-between hover:border-agency-accent/40 transition-colors">
      <div>
        <div class="w-12 h-12 rounded-xl bg-agency-accent/20 flex items-center justify-center text-agency-accent mb-6">
          <span class="material-symbols-outlined">trending_up</span>
        </div>
        <span class="text-xs font-bold uppercase tracking-widest text-agency-accent mb-2 block">03. The Impact</span>
        <h3 class="text-xl md:text-2xl font-black mb-4 text-white">Measurable Outcome</h3>
        <p class="text-white/90 text-base leading-relaxed font-medium">
          {{ $project->result }}
        </p>
      </div>
    </div>
    @endif

  </div>
</section>

<!-- ─── Related Projects ─── -->
@if(isset($relatedProjects) && $relatedProjects->count() > 0)
<section class="max-w-7xl mx-auto px-6 md:px-20 py-16 border-t border-agency-stroke">
  <div class="flex items-center justify-between mb-12">
    <div>
      <x-eyebrow label="More Work" :reveal="false" />
      <h2 class="text-3xl font-black tracking-tight text-white">Explore Other Case Studies</h2>
    </div>
    <a href="{{ route('portfolio') }}" class="hidden md:flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-agency-accent hover:underline">
      View All <span class="material-symbols-outlined !text-sm">arrow_forward</span>
    </a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @foreach($relatedProjects as $rel)
    <a href="{{ route('portfolio.show', $rel->slug) }}" class="group relative overflow-hidden rounded-[24px] border border-agency-stroke bg-agency-surface min-h-[300px] flex flex-col justify-end p-8">
      @if($rel->image_path)
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
             style="background-image: url('{{ asset('storage/' . $rel->image_path) }}');"></div>
      @endif
      <div class="absolute inset-0 bg-gradient-to-t from-agency-dark via-agency-dark/40 to-transparent opacity-85 group-hover:opacity-90 transition-opacity"></div>
      
      <div class="relative z-10">
        <span class="text-[0.6rem] font-bold uppercase tracking-[0.2em] text-agency-accent mb-2 block">{{ $rel->category }}</span>
        <h3 class="text-2xl font-black text-white group-hover:text-agency-accent transition-colors mb-2">{{ $rel->title }}</h3>
        <p class="text-agency-muted text-xs line-clamp-2 font-light mb-4">{{ $rel->description }}</p>
        <span class="inline-flex items-center gap-2 text-[0.7rem] font-bold uppercase tracking-widest text-white">
          Read Case Study <span class="material-symbols-outlined !text-xs">arrow_forward</span>
        </span>
      </div>
    </a>
    @endforeach
  </div>
</section>
@endif

<!-- ─── CTA Banner ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-28 text-center border-t border-agency-stroke">
  <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight leading-[0.95] mb-8">
    Have a similar project<br><span class="text-grad">in mind?</span>
  </h2>
  <p class="text-agency-muted text-lg font-light mb-10 max-w-xl mx-auto">
    Let's talk about how Xynera can turn your vision into an impactful digital product.
  </p>
  <div class="flex flex-wrap justify-center gap-4">
    <x-button variant="primary" size="xl" :href="route('contact')" icon="rocket_launch">Start a Conversation</x-button>
    <x-button variant="outline" size="xl" :href="route('portfolio')">Back to Portfolio</x-button>
  </div>
</section>
@endsection
