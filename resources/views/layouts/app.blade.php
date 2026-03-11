<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Koi Majesty – Premium Koi Pond Products')</title>
    <meta name="description" content="@yield('meta_description', 'Making premium koi pond care affordable and effortless. Experience the beauty of natural balance.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground font-body antialiased">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-background/80 backdrop-blur-lg border-b border-border">
        <div class="container mx-auto flex items-center justify-between h-24 px-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 select-none">
                <img src="{{ asset('images/koi_logo.png') }}" alt="Koi Majesty" class="h-20 w-auto">
            </a>

            {{-- Desktop nav --}}
            <ul class="hidden md:flex items-center gap-8">
                <li><a href="{{ url('/') }}" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors duration-300">Home</a></li>
                <li><a href="{{ url('/') }}#about" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors duration-300">About</a></li>
                <li><a href="{{ url('/') }}#gallery" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors duration-300">Gallery</a></li>
                <li><a href="{{ url('/') }}#products" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors duration-300">Products</a></li>
                <li><a href="{{ url('/blog') }}" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors duration-300">Blog</a></li>
                <li><a href="{{ url('/') }}#contact" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors duration-300">Contact</a></li>
            </ul>

            {{-- Mobile toggle --}}
            <button
                class="md:hidden text-foreground"
                aria-label="Toggle menu"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden bg-background/95 backdrop-blur-lg border-b border-border">
            <ul class="flex flex-col items-center gap-4 py-6">
                <li><a href="{{ url('/') }}" class="text-base font-medium text-muted-foreground hover:text-primary transition-colors">Home</a></li>
                <li><a href="{{ url('/') }}#about" class="text-base font-medium text-muted-foreground hover:text-primary transition-colors">About</a></li>
                <li><a href="{{ url('/') }}#gallery" class="text-base font-medium text-muted-foreground hover:text-primary transition-colors">Gallery</a></li>
                <li><a href="{{ url('/') }}#products" class="text-base font-medium text-muted-foreground hover:text-primary transition-colors">Products</a></li>
                <li><a href="{{ url('/blog') }}" class="text-base font-medium text-muted-foreground hover:text-primary transition-colors">Blog</a></li>
                <li><a href="{{ url('/') }}#contact" class="text-base font-medium text-muted-foreground hover:text-primary transition-colors">Contact</a></li>
            </ul>
        </div>
    </nav>

    {{-- Page content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="py-8 border-t border-border bg-background">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 select-none">
                <img src="{{ asset('images/koi_logo.png') }}" alt="Koi Majesty" class="h-14 w-auto">
            </a>
            <p class="text-sm text-muted-foreground">© {{ date('Y') }} Koi Majesty. All rights reserved.</p>
            <div class="flex gap-4 text-sm text-muted-foreground">
                <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Home</a>
                <a href="{{ url('/blog') }}" class="hover:text-primary transition-colors">Blog</a>
                <a href="{{ url('/') }}#products" class="hover:text-primary transition-colors">Products</a>
                <a href="{{ url('/') }}#contact" class="hover:text-primary transition-colors">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>
