@extends('layouts.app')

@section('title', '500 - Server Error')

@section('content')
<section class="relative min-h-[70vh] flex items-center justify-center px-6 md:px-20 py-24">
    <div class="max-w-2xl mx-auto text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-agency-accent/10 border border-agency-accent/20 text-agency-accent text-xs font-mono font-bold uppercase tracking-widest mb-8">
            <span class="w-2 h-2 rounded-full bg-agency-accent animate-pulse"></span>
            Error Code 500
        </div>

        <h1 class="text-6xl md:text-8xl font-black tracking-tight text-white mb-6">
            System Error
        </h1>

        <p class="text-agency-muted text-lg md:text-xl font-light leading-relaxed mb-10 max-w-lg mx-auto">
            An internal server error occurred while processing your request. Our engineering team has been notified.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4">
            <x-button variant="primary" size="lg" :href="route('home')">
                Return Home
            </x-button>
            <x-button variant="outline" size="lg" :href="route('contact')">
                Report Issue
            </x-button>
        </div>
    </div>
</section>
@endsection
