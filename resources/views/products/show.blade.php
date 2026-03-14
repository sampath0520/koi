@extends('layouts.app')

@section('title', $categoryLabel . ' – Majesty')
@section('meta_description', $categoryDescription)

@section('content')
<div class="min-h-screen bg-background">
    {{-- Hero Banner --}}
    <section class="relative pt-16">
        @php
        $bannerImages = [
            'pond_pumps'    => 'product-pumps.jpg',
            'pond_aerators' => 'product-aerators.jpg',
            'pond_filters'  => 'product-filters.jpg',
            'accessories'   => 'product-accessories.jpg',
        ];
        $bannerImg = $bannerImages[$category] ?? 'product-pumps.jpg';
        @endphp
        <div class="h-64 md:h-80 relative overflow-hidden">
            <img src="{{ asset('images/' . $bannerImg) }}" alt="{{ $categoryLabel }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-koi-deep/70"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center">
                    <p class="text-sm uppercase tracking-[0.3em] text-primary mb-2 font-display">Our Products</p>
                    <h1 class="font-display text-4xl md:text-5xl font-bold text-gradient-gold">{{ $categoryLabel }}</h1>
                    <p class="text-muted-foreground mt-3 max-w-lg mx-auto">{{ $categoryDescription }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Products Grid --}}
    <section class="py-16 container mx-auto px-4">
        <a href="{{ url('/') }}#products" class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary mb-8 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Back to All Categories
        </a>

        @if($products->isEmpty())
        <div class="text-center py-16">
            <p class="text-muted-foreground text-lg">No products available yet in this category.</p>
            <p class="text-sm text-muted-foreground mt-2">Check back soon!</p>
        </div>
        @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
            <div class="group rounded-2xl bg-card border border-border overflow-hidden hover:border-primary/40 transition-all duration-300 hover:-translate-y-1">
                @if($product->image_url)
                <div class="aspect-square overflow-hidden bg-secondary">
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="aspect-square bg-secondary flex items-center justify-center">
                    <span class="text-muted-foreground">No Image</span>
                </div>
                @endif

                <div class="p-5">
                    <h3 class="font-display font-semibold text-lg text-foreground mb-2">{{ $product->title }}</h3>
                    @if($product->description)
                    <div class="text-sm text-muted-foreground mb-3 leading-relaxed line-clamp-2">{!! $product->description !!}</div>
                    @endif
                    @if($product->price)
                    <p class="font-display font-bold text-primary text-lg">Rs. {{ number_format($product->price) }}</p>
                    @endif
                    @if($product->specifications && count($product->specifications) > 0)
                    <div class="mt-3 pt-3 border-t border-border space-y-1">
                        @foreach(array_slice($product->specifications, 0, 3, true) as $key => $value)
                        <div class="flex justify-between text-xs">
                            <span class="text-muted-foreground">{{ $key }}</span>
                            <span class="text-foreground">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </section>
</div>
@endsection
