@extends('layouts.app')

@section('title', 'Services — Custom Web Development & AI Automation')
@section('meta_description', 'Explore Xynera services: custom web development, AI workflow automation, brand design, and technical SEO engineered for ambitious founders and enterprises.')

@section('content')
<!-- ─── Hero ─── -->
<section class="px-6 md:px-20 py-28 md:py-40 max-w-7xl mx-auto">
  <div class="max-w-4xl">
    <x-eyebrow label="Capabilities {{ date('Y') }}" :reveal="true" />
    
    <h1 class="text-[clamp(2.5rem,9vw,8rem)] font-black uppercase tracking-[-0.05em] leading-[0.88] mb-8 animate-fade-up [animation-delay:0.1s]">
      Premium<br>
      <span class="text-grad">Services</span>
    </h1>
    
    <p class="text-agency-muted text-[1.1rem] md:text-[1.25rem] leading-relaxed font-light max-w-2xl animate-fade-up [animation-delay:0.2s]">
      Bespoke digital solutions engineered with surgical precision. We merge expressive minimalism with high-performance architecture to build the future of your brand.
    </p>
  </div>
</section>

<!-- ─── Services Grid ─── -->
<section class="px-6 md:px-20 py-20 max-w-7xl mx-auto">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($services as $index => $service)
    <div class="group flex flex-col justify-between p-10 bg-white/[0.02] border border-agency-stroke rounded-[32px] hover:bg-white/[0.04] transition-all duration-500 reveal [transition-delay:{{ $index * 0.08 }}s]">
      <div class="flex justify-between items-start mb-12">
        <div class="w-14 h-14 rounded-2xl bg-agency-accent/10 flex items-center justify-center text-agency-accent group-hover:scale-110 transition-transform duration-500">
            <span class="material-symbols-outlined !text-3xl">{{ $service->icon }}</span>
        </div>
        <span class="text-xs font-bold text-agency-muted opacity-30 font-mono">{{ $service->number }}</span>
      </div>
      
      <div>
        <h3 class="text-2xl font-black mb-4 tracking-tight group-hover:text-agency-accent transition-colors">{{ $service->title }}</h3>
        <p class="text-agency-muted text-[0.95rem] leading-relaxed font-light mb-8">{{ $service->description }}</p>
        <div class="flex items-center gap-2 text-[0.7rem] font-bold uppercase tracking-widest text-agency-accent opacity-0 group-hover:opacity-100 transition-all transform translate-x-[-10px] group-hover:translate-x-0">
            Explore <span class="material-symbols-outlined !text-sm">arrow_forward</span>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>

<!-- ─── Stats Bar ─── -->
<div class="border-y border-agency-stroke bg-agency-surface/30 backdrop-blur-md py-16 mt-20">
  <div class="max-w-7xl mx-auto px-6 md:px-20">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 md:gap-20">
      @php
        $stats = [
            ['num' => '25', 'suffix' => '+', 'label' => 'Projects Delivered'],
            ['num' => '98', 'suffix' => '%', 'label' => 'Client Satisfaction'],
            ['num' => $services->count(), 'suffix' => '', 'label' => 'Core Services'],
            ['num' => '5', 'suffix' => 'yr', 'label' => 'In Operation'],
        ];
      @endphp
      @foreach($stats as $stat)
      <div class="text-center lg:text-left">
        <div class="text-4xl md:text-5xl font-black tracking-tight mb-2">
            <span class="text-grad">{{ $stat['num'] }}</span><span class="text-agency-accent ml-0.5">{{ $stat['suffix'] }}</span>
        </div>
        <div class="text-[0.7rem] font-bold uppercase tracking-[0.2em] text-agency-muted">{{ $stat['label'] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<!-- ─── FAQ Section ─── -->
@if(isset($faqs) && $faqs->count() > 0)
<section class="max-w-4xl mx-auto px-6 md:px-20 py-32">
    <x-eyebrow label="Answers" :reveal="true" class="justify-center mb-6" />
    <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tight leading-[1] mb-16 text-center">
        Frequently Asked<br><span class="text-grad">Questions</span>
    </h2>

    <div class="flex flex-col gap-4">
        @foreach($faqs as $index => $faq)
        <div class="faq-item group border border-agency-stroke bg-agency-surface/30 rounded-2xl overflow-hidden reveal [transition-delay:{{ $index * 0.05 }}s]">
            <button class="faq-toggle w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none hover:bg-white/[0.02] transition-colors">
                <span class="text-lg font-bold pr-8">{{ $faq->question }}</span>
                <span class="material-symbols-outlined faq-icon transition-transform duration-300 text-agency-accent">expand_more</span>
            </button>
            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-black/20">
                <div class="px-8 pb-6 pt-2 text-agency-muted leading-relaxed font-light text-[0.95rem]">
                    {{ $faq->answer }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const content = toggle.nextElementSibling;
            const icon = toggle.querySelector('.faq-icon');
            
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
});
</script>
@endif

<!-- ─── CTA ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-40 text-center">
  <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tight leading-[0.9] mb-12">
    Ready to elevate your<br><span class="italic font-light">digital presence?</span>
  </h2>
  <div class="flex flex-wrap justify-center gap-6">
    <x-button variant="primary" size="xl" :href="route('contact')" icon="rocket_launch">Launch Project</x-button>
    <x-button variant="outline" size="xl" :href="route('portfolio')">View Portfolio</x-button>
  </div>
</section>

@endsection
