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
                <img src="{{ asset('images/koi_logo.png') }}" alt="Koi Majesty" class="h-20 w-auto">
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
