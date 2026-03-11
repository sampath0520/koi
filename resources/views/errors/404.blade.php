@extends('layouts.app')

@section('title', '404 – Page Not Found – Koi Majesty')

@section('content')
<div class="min-h-screen bg-background flex items-center justify-center px-4">
    <div class="text-center space-y-6">
        <h1 class="font-display text-8xl font-bold text-gradient-gold">404</h1>
        <p class="font-display text-2xl font-semibold text-foreground">Page Not Found</p>
        <p class="text-muted-foreground max-w-sm mx-auto">The page you're looking for doesn't exist or has been moved.</p>
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
            Go Home
        </a>
    </div>
</div>
@endsection
