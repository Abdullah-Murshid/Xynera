@extends('layouts.app')

@section('title', 'Contact Us — Start Your Next Project')
@section('meta_description', 'Contact Xynera to discuss your web development or AI automation project. Send us a message and get a response within 24 hours.')

@section('content')
<!-- ─── Hero ─── -->
<section class="px-6 md:px-20 py-28 md:py-40 max-w-7xl mx-auto">
  <div class="max-w-4xl">
    <x-eyebrow label="Let's connect" :reveal="true" />
    
    <h1 class="text-[clamp(2.5rem,9vw,8rem)] font-black uppercase tracking-[-0.05em] leading-[0.88] mb-8 animate-fade-up [animation-delay:0.1s]">
      Start your<br>
      <span class="text-grad">Project</span>
    </h1>
    
    <p class="text-agency-muted text-[1.1rem] md:text-[1.25rem] leading-relaxed font-light max-w-2xl animate-fade-up [animation-delay:0.2s]">
      Whether you're looking to build an enterprise SaaS platform or launch a new digital identity, our team is ready to engineer the future with you.
    </p>
  </div>
</section>

<!-- ─── Contact Section ─── -->
<section class="max-w-7xl mx-auto px-6 md:px-20 py-10 reveal [transition-delay:0.3s]">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
    
    <!-- Left Col: Info -->
    <div class="lg:col-span-5 flex flex-col gap-12">
      @php
        $info = [
            ['icon' => 'alternate_email', 'title' => 'General Inquiries', 'value' => 'info@xynera.solutions', 'link' => 'mailto:info@xynera.solutions'],
            ['icon' => 'work', 'title' => 'New Business', 'value' => 'abdulrehman@xynera.solutions', 'link' => 'mailto:abdulrehman@xynera.solutions'],
        ];
      @endphp

      @foreach($info as $item)
      <div class="flex gap-6">
        <div class="w-12 h-12 rounded-xl bg-agency-accent/10 flex items-center justify-center text-agency-accent shrink-0">
            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
        </div>
        <div>
          <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-2">{{ $item['title'] }}</h4>
          @if(isset($item['is_address']))
            <address class="not-italic text-agency-muted text-[0.95rem] leading-relaxed font-light">{!! nl2br(e($item['value'])) !!}</address>
          @else
            <p><a href="{{ $item['link'] }}" class="text-agency-muted text-[0.95rem] hover:text-white transition-colors font-light">{{ $item['value'] }}</a></p>
          @endif
        </div>
      </div>
      @endforeach
      
      <div class="flex gap-4 mt-4">
        @foreach(['hub', 'share', 'groups'] as $icon)
          <div class="w-12 h-12 rounded-full border border-agency-stroke flex items-center justify-center text-agency-muted hover:text-agency-accent hover:border-agency-accent/30 transition-all cursor-pointer">
              <span class="material-symbols-outlined !text-[1.2rem]">{{ $icon }}</span>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Right Col: Form -->
    <div class="lg:col-span-7 bg-white/[0.02] border border-agency-stroke rounded-[40px] p-8 md:p-12">
      <form class="flex flex-col gap-8" action="{{ route('contact.submit') }}" method="POST" id="contactForm">
        @csrf
        <div style="display:none;" aria-hidden="true">
          <input type="text" name="website_hp" value="" tabindex="-1" autocomplete="off">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <x-input label="First Name" name="first_name" placeholder="John" :value="old('first_name')" required />
          <x-input label="Last Name" name="last_name" placeholder="Doe" :value="old('last_name')" required />
        </div>

        <x-input label="Email Address" type="email" name="email" placeholder="john@company.com" :value="old('email')" required />

        <x-select label="Project Type" name="project_type" :options="[
            'Web Application' => 'Web Application',
            'Mobile App' => 'Mobile App',
            'Corporate Website' => 'Corporate Website',
            'Brand Identity' => 'Brand Identity',
            'Other' => 'Other'
        ]" :selected="old('project_type')" required />

        <x-textarea label="Project Details" name="details" placeholder="Tell us a little bit about what you are looking to build..." :value="old('details')" required />

        <x-button variant="primary" size="lg" type="submit" class="w-full mt-4" id="submitBtn">
          <span id="btnText">Send Message</span>
          <span id="btnIcon" class="material-symbols-outlined">send</span>
          <div id="btnLoader" class="hidden animate-spin rounded-full h-5 w-5 border-2 border-white/20 border-t-white"></div>
        </x-button>
      </form>
    </div>
  </div>
</section>

<!-- ══ SUCCESS OVERLAY ══ -->
<div id="successOverlay" class="fixed inset-0 z-[9999] bg-agency-dark/95 backdrop-blur-[20px] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-600 [&.active]:opacity-100 [&.active]:pointer-events-auto">
    <div class="text-center p-10 w-full max-w-[480px]">
        <!-- Processing Stage -->
        <div id="stage-transmitting" class="transition-all duration-700">
            <div class="relative w-32 h-32 mx-auto mb-10 flex items-center justify-center">
                <!-- Abstract Rings -->
                <div class="absolute inset-0 border border-agency-accent/30 animate-morph opacity-40"></div>
                <div class="absolute inset-4 border border-agency-accent animate-morph [animation-duration:12s] [animation-direction:reverse]"></div>
                <div class="absolute inset-0 border-2 border-agency-accent/20 rounded-full animate-pulse-ring"></div>
                <div class="absolute inset-0 border-2 border-agency-accent/10 rounded-full animate-pulse-ring [animation-delay:1.5s]"></div>
                
                <!-- Center Core -->
                <div class="w-4 h-4 bg-agency-accent rounded-full shadow-[0_0_20px_rgba(236,91,19,0.8)] animate-pulse"></div>
            </div>
            <h2 class="text-white uppercase tracking-[0.6em] text-sm font-black mb-3">Synchronizing</h2>
            <p class="text-agency-muted text-[0.65rem] uppercase tracking-[0.3em] font-bold">Securing Project Brief...</p>
        </div>

        <!-- Delivery Stage -->
        <div id="stage-delivered" class="hidden opacity-0 scale-90 transition-all duration-500 [&.active]:block [&.active]:opacity-100 [&.active]:scale-100">
            <div class="w-20 h-20 bg-agency-accent rounded-full mx-auto mb-8 flex items-center justify-center shadow-[0_0_50px_rgba(236,91,19,0.4)] animate-icon-pop">
                <span class="material-symbols-outlined !text-[48px] text-white">check</span>
            </div>
            <h2 class="text-[2.8rem] font-black text-white uppercase leading-[0.9] tracking-tight italic mb-6">Message<br><span class="text-agency-accent">Delivered.</span></h2>
            <div class="h-0.5 w-10 bg-white/10 mx-auto mb-6"></div>
            <p class="text-agency-muted text-[1.1rem] leading-relaxed font-light mb-10">
                Your project brief has been securely delivered to our team. 
                <span class="text-white font-semibold block mt-2">Response expected within 24 hours.</span>
            </p>
            <button onclick="closeSuccessOverlay()" class="bg-white/5 border border-white/10 text-white px-8 py-3.5 rounded-full text-[0.7rem] font-extrabold uppercase tracking-[0.2em] hover:bg-white/10 hover:border-white/20 hover:-translate-y-0.5 transition-all cursor-pointer">Dismiss Confirmation</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('contactForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = this;
        const btn = document.getElementById('submitBtn');
        const text = document.getElementById('btnText');
        const icon = document.getElementById('btnIcon');
        const loader = document.getElementById('btnLoader');
        const overlay = document.getElementById('successOverlay');
        const stageTransmitting = document.getElementById('stage-transmitting');
        const stageDelivered = document.getElementById('stage-delivered');

        // 1. Loading State
        btn.disabled = true;
        btn.classList.add('opacity-70');
        text.textContent = 'Encrypting...';
        icon.classList.add('hidden');
        loader.classList.remove('hidden');

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // 2. Show Overlay (Stage 1: Transmitting)
                overlay.classList.add('active');

                // 3. Transition to Stage 2 (Delivered)
                setTimeout(() => {
                    stageTransmitting.style.opacity = '0';
                    stageTransmitting.style.transform = 'translateY(-20px)';
                    
                    setTimeout(() => {
                        stageTransmitting.classList.add('hidden');
                        stageDelivered.classList.remove('hidden');
                        stageDelivered.classList.add('active');
                        
                        // Force reflow for animation
                        void stageDelivered.offsetWidth;
                    }, 500);
                }, 2000); 
            } else if (response.status === 422) {
                const errors = data.errors;
                let errorMsg = 'Please check the following:\n';
                for (const field in errors) {
                    errorMsg += `- ${errors[field][0]}\n`;
                }
                alert(errorMsg);
                resetButton();
            } else {
                alert('Something went wrong. Please try again.');
                resetButton();
            }
        } catch (error) {
            alert('Connection error or invalid response. Check console for details.');
            resetButton();
        }

        function resetButton() {
            btn.disabled = false;
            btn.classList.remove('opacity-70');
            text.textContent = 'Send Message';
            icon.classList.remove('hidden');
            loader.classList.add('hidden');
        }
    });

    function closeSuccessOverlay() {
        const overlay = document.getElementById('successOverlay');
        overlay.classList.remove('active');
        setTimeout(() => {
            window.location.reload(); 
        }, 700);
    }
</script>
@endpush
@endsection
