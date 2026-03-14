@extends('layouts.app')

@section('title', 'Pond Tips & Guides – Majesty')
@section('meta_description', 'Expert advice on keeping your pond healthy and your fish beautiful.')

@section('content')
<div class="min-h-screen bg-background">
    <section class="pt-24 pb-16 container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-sm uppercase tracking-[0.3em] text-primary mb-3 font-display">Our Blog</p>
            <h1 class="font-display text-3xl md:text-5xl font-bold text-gradient-gold">Pond Tips & Guides</h1>
            <p class="text-muted-foreground mt-3 max-w-lg mx-auto">Expert advice on keeping your pond healthy and your fish beautiful.</p>
        </div>

        @if($posts->isEmpty())
        <div class="text-center py-16">
            <p class="text-muted-foreground text-lg">No blog posts yet. Check back soon!</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <a href="{{ url('/blog/' . $post->slug) }}" class="group block rounded-2xl bg-card border border-border overflow-hidden hover:border-primary/40 transition-all duration-300 hover:-translate-y-1">
                @if($post->image_url)
                <div class="aspect-video overflow-hidden bg-secondary">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="aspect-video bg-secondary flex items-center justify-center">
                    <span class="text-muted-foreground">No Image</span>
                </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 text-xs text-muted-foreground mb-2">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="font-display font-semibold text-lg text-foreground mb-2 group-hover:text-primary transition-colors">{{ $post->title }}</h3>
                    @if($post->excerpt)
                    <p class="text-sm text-muted-foreground leading-relaxed line-clamp-3">{{ $post->excerpt }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </section>
</div>
@endsection
