@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' – Majesty')
@section('meta_description', $post->meta_description ?: $post->excerpt)

@section('content')
<div class="min-h-screen bg-background">
    <article class="pt-24 pb-16 container mx-auto px-4 max-w-3xl">
        <a href="{{ url('/blog') }}" class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary mb-8 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Back to Blog
        </a>

        @if($post->image_url)
        <div class="rounded-2xl overflow-hidden mb-8 aspect-video">
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="flex items-center gap-2 text-sm text-muted-foreground mb-4">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span>{{ $post->created_at->format('F d, Y') }}</span>
        </div>

        <h1 class="font-display text-3xl md:text-4xl font-bold text-foreground mb-6">{{ $post->title }}</h1>

        @if($post->content)
        <div class="prose prose-invert max-w-none text-foreground/90 leading-relaxed">
            {!! $post->content !!}
        </div>
        @endif
    </article>
</div>
@endsection
