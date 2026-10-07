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
  <div class="flex flex-wrap items-center justify-center gap-4">
    @php
        $categories = [
            null => 'All Projects',
            'Web App' => 'Web Apps',
            'Mobile' => 'Mobile',
            'Branding' => 'Branding',
        ];
    @endphp
    @foreach($categories as $cat => $label)
        <a href="{{ route('portfolio', $cat ? ['category' => $cat] : []) }}" 
           class="px-6 py-2.5 rounded-full text-[0.75rem] font-bold uppercase tracking-widest border transition-all duration-300 {{ (!request('category') && !$cat) || (request('category') == $cat) ? 'bg-agency-accent border-agency-accent text-white' : 'border-agency-stroke text-agency-muted hover:border-white/20 hover:bg-white/5' }}">
            {{ $label }}
        </a>
    @endforeach
  </div>
</section>

<!-- ─── Portfolio Grid ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-10">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 md:gap-8 reveal">
    @foreach($projects as $index => $project)
    @php
        $gridClasses = 'lg:col-span-2';
        if($project->is_tall) $gridClasses = 'lg:col-span-2 lg:row-span-2';
        if($project->is_wide) $gridClasses = 'lg:col-span-4';
    @endphp
    <a href="#" class="group relative overflow-hidden rounded-[32px] border border-agency-stroke bg-agency-surface min-h-[350px] {{ $gridClasses }} reveal [transition-delay:{{ $index * 0.05 }}s]">
      <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
           @if($project->image_path) style="background-image: url('{{ asset('storage/' . $project->image_path) }}');" @endif></div>
      <div class="absolute inset-0 bg-gradient-to-t from-agency-dark via-agency-dark/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
      
      <div class="absolute inset-0 p-8 flex flex-col justify-end">
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

@endsection
