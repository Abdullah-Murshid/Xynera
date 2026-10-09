@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<section class="relative min-h-[70vh] flex items-center justify-center px-6 md:px-20 py-24">
    <div class="max-w-2xl mx-auto text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-agency-accent/10 border border-agency-accent/20 text-agency-accent text-xs font-mono font-bold uppercase tracking-widest mb-8">
            <span class="w-2 h-2 rounded-full bg-agency-accent animate-pulse"></span>
            Error Code 404
        </div>

        <h1 class="text-6xl md:text-8xl font-black tracking-tight text-white mb-6">
            Page Not Found
        </h1>

        <p class="text-agency-muted text-lg md:text-xl font-light leading-relaxed mb-10 max-w-lg mx-auto">
            The resource you are looking for has been moved, renamed, or does not exist.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4">
            <x-button variant="primary" size="lg" :href="route('home')">
                Back to Home
            </x-button>
            <x-button variant="outline" size="lg" :href="route('contact')">
                Contact Support
            </x-button>
        </div>
    </div>
</section>
@endsection
