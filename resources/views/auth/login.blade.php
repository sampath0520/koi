<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – Koi Majesty</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-background text-foreground flex items-center justify-center p-4">

    {{-- Background decoration --}}
    <div class="fixed inset-0 bg-gradient-to-br from-koi-deep via-background to-[hsl(175,40%,20%,0.4)] pointer-events-none"></div>
    <div class="fixed top-0 right-0 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>
    <div class="fixed bottom-0 left-0 w-96 h-96 rounded-full bg-[hsl(175,50%,30%,0.08)] blur-3xl pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-md">

        {{-- Logo --}}
        <div class="flex flex-col items-center mb-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3 mb-2">
                <svg viewBox="0 0 200 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-12 w-auto">
                    <ellipse cx="26" cy="24" rx="15" ry="9" fill="#F5A623" transform="rotate(-8 26 24)"/>
                    <ellipse cx="30" cy="22" rx="6.5" ry="4" fill="#D9402A" opacity="0.75" transform="rotate(-8 30 22)"/>
                    <path d="M11 24 L4 14 L6 24 L4 34 Z" fill="#F5A623" opacity="0.9"/>
                    <path d="M21 30 Q16 37 21 39 Q26 34 24 30Z" fill="#E8891A" opacity="0.7"/>
                    <path d="M22 13 Q27 6 33 13" stroke="#F5A623" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                    <circle cx="39" cy="21" r="2.8" fill="white"/>
                    <circle cx="39.7" cy="21" r="1.4" fill="#1a2c2c"/>
                    <text x="54" y="31" font-family="Outfit, sans-serif" font-weight="700" font-size="22" fill="#F5A623" letter-spacing="0.5">Koi Majesty</text>
                </svg>
            </a>
            <p class="text-sm text-muted-foreground font-display tracking-wide">Admin Panel</p>
        </div>

        {{-- Card --}}
        <div class="bg-card border border-border rounded-2xl p-8 shadow-2xl">
            <h1 class="font-display text-2xl font-bold text-foreground mb-1">Welcome back</h1>
            <p class="text-sm text-muted-foreground mb-8">Sign in to manage your site</p>

            @if ($errors->any())
            <div class="mb-5 p-3 rounded-lg bg-destructive/10 border border-destructive/30 text-destructive text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="block text-sm font-medium font-display text-foreground">Email Address</label>
                    <input
                        id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="email"
                        placeholder="admin@koimajesty.com"
                        class="w-full px-4 py-3 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-sm @error('email') border-destructive @enderror"
                    >
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="block text-sm font-medium font-display text-foreground">Password</label>
                    <input
                        id="password" type="password" name="password"
                        required autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-sm @error('password') border-destructive @enderror"
                    >
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border border-border bg-background accent-primary">
                        <span class="text-sm text-muted-foreground">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ url('/forgot-password') }}" class="text-sm text-primary hover:underline">
                        Forgot password?
                    </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-3 px-6 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 active:scale-[0.98] transition-all glow-gold">
                    Sign In
                </button>
            </form>
        </div>

        {{-- Credentials hint (remove in production) --}}
        <div class="mt-4 p-3 rounded-lg bg-card/50 border border-border/50 text-center">
            <p class="text-xs text-muted-foreground font-display">
                Default: <span class="text-primary">admin@koimajesty.com</span>
                &nbsp;/&nbsp;
                <span class="text-primary">Admin@1234</span>
            </p>
        </div>

        <p class="mt-4 text-center text-xs text-muted-foreground">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors">← Back to website</a>
        </p>
    </div>

</body>
</html>
