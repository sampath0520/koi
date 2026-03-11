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
        <div class="container mx-auto flex items-center justify-between h-16 px-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 select-none">
                <svg viewBox="0 0 160 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-auto" aria-label="Koi Majesty">
                    <ellipse cx="22" cy="20" rx="13" ry="8" fill="#F5A623" transform="rotate(-8 22 20)"/>
                    <ellipse cx="25" cy="18" rx="5.5" ry="3.5" fill="#D9402A" opacity="0.75" transform="rotate(-8 25 18)"/>
                    <path d="M9 20 L3 12 L5 20 L3 28 Z" fill="#F5A623" opacity="0.9"/>
                    <path d="M18 24 Q14 30 18 32 Q22 28 20 24Z" fill="#E8891A" opacity="0.7"/>
                    <path d="M19 12 Q23 6 28 12" stroke="#F5A623" stroke-width="2" stroke-linecap="round" fill="none"/>
                    <circle cx="33" cy="18" r="2.2" fill="white"/>
                    <circle cx="33.6" cy="18" r="1.1" fill="#1a2c2c"/>
                    <text x="48" y="26" font-family="Outfit, sans-serif" font-weight="700" font-size="18" fill="#F5A623" letter-spacing="0.5">Koi Majesty</text>
                </svg>
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
                <svg viewBox="0 0 160 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-auto" aria-label="Koi Majesty">
                    <ellipse cx="22" cy="20" rx="13" ry="8" fill="#F5A623" transform="rotate(-8 22 20)"/>
                    <ellipse cx="25" cy="18" rx="5.5" ry="3.5" fill="#D9402A" opacity="0.75" transform="rotate(-8 25 18)"/>
                    <path d="M9 20 L3 12 L5 20 L3 28 Z" fill="#F5A623" opacity="0.9"/>
                    <path d="M18 24 Q14 30 18 32 Q22 28 20 24Z" fill="#E8891A" opacity="0.7"/>
                    <path d="M19 12 Q23 6 28 12" stroke="#F5A623" stroke-width="2" stroke-linecap="round" fill="none"/>
                    <circle cx="33" cy="18" r="2.2" fill="white"/>
                    <circle cx="33.6" cy="18" r="1.1" fill="#1a2c2c"/>
                    <text x="48" y="26" font-family="Outfit, sans-serif" font-weight="700" font-size="18" fill="#F5A623" letter-spacing="0.5">Koi Majesty</text>
                </svg>
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
