@extends('layouts.app')

@section('title', 'Majesty – Premium Pond Products')

@section('content')

{{-- ── HERO ──────────────────────────────────────────────────────────────────── --}}
<section id="home" class="relative h-screen flex items-center overflow-x-hidden bg-koi-deep">
    <div class="absolute inset-0 bg-gradient-to-br from-koi-deep via-background to-[hsl(175,40%,30%,0.2)]"></div>

    <div class="relative z-10 w-full mx-auto px-6 md:px-12 pt-20 pb-6 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-0 items-center max-w-screen-xl">
        {{-- Left: Typography --}}
        <div class="flex flex-col gap-4 lg:pr-8">
            <p class="text-xs uppercase tracking-[0.35em] text-primary font-display" data-hero data-delay="0">
                Premium Pond Products
            </p>

            <h1 class="font-display text-5xl md:text-7xl lg:text-[5.5rem] xl:text-[6.5rem] font-bold leading-[1.1] tracking-tight pb-1" data-hero data-delay="0.15">
                <span class="text-foreground">The Art</span><br>
                <span class="text-foreground">of&nbsp;</span><span class="text-gradient-gold italic font-light">Serenity</span>
            </h1>

            <p class="text-muted-foreground max-w-md text-base md:text-lg font-body leading-relaxed" data-hero data-delay="0.3">
                Making premium pond care affordable and effortless.
                Experience the beauty of natural balance.
            </p>

            <div class="flex gap-4 items-center flex-wrap" data-hero data-delay="0.45">
                <a href="#products" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
                    Explore Products
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#about" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-lg border border-border text-foreground font-display font-semibold text-sm tracking-wide hover:bg-secondary transition-all">
                    Our Story
                </a>
            </div>

            <div class="flex items-center gap-6 text-xs text-muted-foreground font-display tracking-widest uppercase" data-hero data-delay="0.6">
                <span>Pumps</span>
                <span class="w-8 h-px bg-border"></span>
                <span>Filters</span>
                <span class="w-8 h-px bg-border"></span>
                <span>Aerators</span>
            </div>
        </div>

        {{-- Right: Video Box --}}
        <div class="flex justify-center lg:justify-end items-center h-full">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl glow-gold w-full max-w-sm lg:w-auto"
                 style="aspect-ratio: 3/4; max-height: 55vw; max-height: clamp(260px, 55vw, 86vh);"
                 data-hero="scale" data-delay="0.3">
                <video src="{{ asset('videos/hero-koi-video.mp4') }}" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                <div class="absolute bottom-6 right-6 flex items-center gap-2 bg-background/60 backdrop-blur-md rounded-full px-4 py-2 cursor-pointer hover:bg-background/80 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-primary fill-primary" viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg>
                    <span class="text-xs font-display tracking-wider text-foreground uppercase">Watch Video</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── ABOUT ─────────────────────────────────────────────────────────────────── --}}
<section id="about" class="relative py-24 bg-section-alt">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-animate>
            <p class="text-sm uppercase tracking-[0.3em] text-primary mb-3 font-display">About Us</p>
            <h2 class="font-display text-3xl md:text-5xl font-bold text-foreground">
                The Art of <span class="text-gradient-gold">Pond Keeping</span>
            </h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative rounded-2xl overflow-hidden glow-gold" data-animate="fade-left">
                <img src="{{ asset('images/about-pond.jpg') }}" alt="Beautiful pond garden" class="w-full h-80 lg:h-[480px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-background/60 to-transparent"></div>
            </div>

            <div class="space-y-6">
                @php
                $cards = [
                    ['icon' => 'eye', 'title' => 'Our Vision', 'text' => 'Turn your pond keeping dream into reality. We\'re here to make your dream pond affordable to maintain in premium quality with simple & easy solutions.'],
                    ['icon' => 'target', 'title' => 'Our Mission', 'text' => 'We deliver simple, effective and affordable solutions that make premium pond care effortless, empowering every pond keeper with the tools needed for a thriving, beautiful pond.'],
                    ['icon' => 'leaf', 'title' => 'Nature First', 'text' => 'We develop symbiotic relationships among all parts in the system, making pond care more nature-friendly and sustainable for the long term.'],
                ];
                @endphp
                @foreach($cards as $card)
                <div class="flex gap-4 p-5 rounded-xl bg-card border border-border hover:border-primary/30 transition-colors" data-animate>
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                        @if($card['icon'] === 'eye')
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        @elseif($card['icon'] === 'target')
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                        @else
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3s2 2 2 6-2 6-2 6m7-12s2 2 2 6-2 6-2 6m5-9c0 4.5-3 6-3 9H7c0-3-3-4.5-3-9a8 8 0 0116 0z"/></svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-display font-semibold text-lg text-foreground mb-1">{{ $card['title'] }}</h3>
                        <p class="text-sm text-muted-foreground leading-relaxed">{{ $card['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── GALLERY ───────────────────────────────────────────────────────────────── --}}
<section id="gallery" class="py-16 bg-koi-deep relative overflow-hidden">
    {{-- Ambient glow --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-primary/5 rounded-full blur-[150px] pointer-events-none"></div>

    <div class="container mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-16" data-animate>
            <p class="text-sm uppercase tracking-[0.3em] text-primary mb-3 font-display">Showcase</p>
            <h2 class="font-display text-3xl md:text-5xl font-bold text-foreground">
                Our <span class="text-gradient-gold">Gallery</span>
            </h2>
        </div>

        {{-- Outer wrapper: carousel + arrows share the same relative parent --}}
        <div class="relative mx-auto" style="height:460px;">

            {{-- 3D Card Carousel wrapper --}}
            <div class="relative w-full h-full" id="gallery-carousel-wrapper">
                <div class="relative w-full h-full flex items-center justify-center"
                     id="gallery-carousel"
                     style="perspective:1500px;">
                    <div id="gallery-cards" class="relative w-full h-full"></div>
                </div>
            </div>

            {{-- Left arrow — sibling of carousel wrapper, never inside 3D context --}}
            <button id="gallery-prev-btn"
                class="absolute w-12 h-12 rounded-full flex items-center justify-center select-none"
                style="z-index:1000; top:50%; left:1.5rem; transform:translateY(-50%); border:2px solid hsl(var(--primary)); background:rgba(0,0,0,0.55); color:hsl(var(--primary)); cursor:pointer;">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19l-7-7 7-7"/></svg>
            </button>
            {{-- Right arrow --}}
            <button id="gallery-next-btn"
                class="absolute w-12 h-12 rounded-full flex items-center justify-center select-none"
                style="z-index:1000; top:50%; right:1.5rem; transform:translateY(-50%); border:2px solid hsl(var(--primary)); background:rgba(0,0,0,0.55); color:hsl(var(--primary)); cursor:pointer;">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"/></svg>
            </button>

        </div>

        {{-- Dots --}}
        <div class="flex items-center justify-center gap-2 mt-8" id="gallery-dots"></div>

    </div>

    {{-- Lightbox --}}
    <div id="gallery-lightbox"
         class="fixed inset-0 z-[2000] items-center justify-center"
         style="display:none; background:rgba(0,0,0,0.95);"
         onclick="galleryLightboxClose(event)">

        {{-- Prev arrow — vertically centred via inline style --}}
        <button onclick="galleryLightboxNav(-1); event.stopPropagation();"
            class="absolute z-20 w-12 h-12 rounded-full flex items-center justify-center select-none"
            style="top:50%; left:1.5rem; transform:translateY(-50%); background:rgba(0,0,0,0.5); border:2px solid hsl(var(--primary)); color:hsl(var(--primary)); cursor:pointer; transition:background .2s;"
            onmouseover="this.style.background='rgba(0,0,0,0.8)'"
            onmouseout="this.style.background='rgba(0,0,0,0.5)'">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19l-7-7 7-7"/></svg>
        </button>

        {{-- Next arrow --}}
        <button onclick="galleryLightboxNav(1); event.stopPropagation();"
            class="absolute z-20 w-12 h-12 rounded-full flex items-center justify-center select-none"
            style="top:50%; right:1.5rem; transform:translateY(-50%); background:rgba(0,0,0,0.5); border:2px solid hsl(var(--primary)); color:hsl(var(--primary)); cursor:pointer; transition:background .2s;"
            onmouseover="this.style.background='rgba(0,0,0,0.8)'"
            onmouseout="this.style.background='rgba(0,0,0,0.5)'">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- Close button — top-right of lightbox, below navbar --}}
        <button onclick="galleryCloseLightbox(); event.stopPropagation();"
            class="absolute z-30 w-12 h-12 rounded-full flex items-center justify-center select-none"
            style="top:4.5rem; right:1.5rem; background:rgba(0,0,0,0.5); border:2px solid hsl(var(--primary)); color:hsl(var(--primary)); cursor:pointer; transition:background .2s, transform .15s;"
            onmouseover="this.style.background='rgba(0,0,0,0.8)'; this.style.transform='scale(1.1)'"
            onmouseout="this.style.background='rgba(0,0,0,0.5)'; this.style.transform='scale(1)'">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>

        {{-- Image wrapper — centered, no close button inside image --}}
        <div class="flex flex-col items-center justify-center w-full h-full"
             id="gallery-lightbox-inner" style="pointer-events:none; padding:4rem 5rem 2rem;">
            <div class="relative inline-block" style="pointer-events:auto;">
                <img id="gallery-lightbox-img" src="" alt=""
                     style="max-width:60vw; max-height:65vh; width:auto; height:auto; object-fit:contain; border-radius:12px; box-shadow:0 25px 80px rgba(0,0,0,0.8); display:block;"
                     draggable="false">
            </div>
            <div id="gallery-lightbox-caption" class="mt-4 text-center" style="pointer-events:auto;"></div>
        </div>
    </div>

    <style>
        @keyframes lb-in  { from { opacity:0; transform:scale(.95); } to { opacity:1; transform:scale(1); } }
        @keyframes lb-out { from { opacity:1; transform:scale(1);   } to { opacity:0; transform:scale(.95); } }
        #gallery-lightbox.lb-opening { animation: lb-in  .2s ease forwards; }
        #gallery-lightbox.lb-closing { animation: lb-out .15s ease forwards; }
    </style>
</section>

<script>
(function () {
    /* ── Data ── */
    const GALLERY_DATA = @json($galleryImages->values());
    const FALLBACK     = '{{ asset('images/about-pond.jpg') }}';

    const PLACEHOLDERS = [
        { image_url: '{{ asset('images/gallery-koi-1.jpg') }}', title: 'Golden Harmony', subtitle: 'Premium Koi Collection', tag: 'Featured'  },
        { image_url: '{{ asset('images/gallery-koi-2.jpg') }}', title: 'Lotus Dream',    subtitle: 'Paired Beauty Series',   tag: 'Popular'   },
        { image_url: '{{ asset('images/gallery-koi-3.jpg') }}', title: 'Autumn Drift',   subtitle: 'Seasonal Showcase',      tag: 'New'       },
        { image_url: '{{ asset('images/gallery-koi-4.jpg') }}', title: 'Crimson Grace',  subtitle: 'Champion Bloodline',     tag: 'Exclusive' },
        { image_url: '{{ asset('images/gallery-koi-5.jpg') }}', title: 'Ocean School',   subtitle: 'Community Collection',   tag: 'Classic'   },
    ];

    const cards     = GALLERY_DATA.length > 0 ? GALLERY_DATA : PLACEHOLDERS;
    let activeIndex   = 0;
    let autoTimer     = null;
    let cardEls       = []; // persistent DOM elements — never recreated
    let lightboxIndex = 0;

    /* ── Geometry ── */
    function getOffset(i) {
        var o    = i - activeIndex;
        var half = Math.floor(cards.length / 2);
        if (o >  half) o -= cards.length;
        if (o < -half) o += cards.length;
        return o;
    }

    function getCardStyle(offset) {
        var abs = Math.abs(offset);
        return {
            x:       offset * 185,
            y:       abs * 12,
            scale:   offset === 0 ? 1 : 0.75 - abs * 0.05,
            rotateY: offset * 15,
            zIndex:  10 - abs,
            opacity: abs > 2 ? 0 : 1 - abs * 0.15,
        };
    }

    /* ── Build cards ONCE ── */
    function buildCards() {
        var wrap = document.getElementById('gallery-cards');
        if (!wrap) return;
        wrap.innerHTML = '';
        cardEls = [];

        var isMd = window.innerWidth >= 768;
        var isSm = window.innerWidth >= 640;

        cards.forEach(function (card, index) {
            var imgUrl   = card.image_url || FALLBACK;
            var title    = (card.title    || '').toUpperCase();
            var subtitle = card.subtitle  || '';
            var tag      = card.tag       || '';

            var offset   = getOffset(index);
            var abs      = Math.abs(offset);
            var s        = getCardStyle(offset);
            var isCenter = offset === 0;
            var cardW    = isCenter
                ? (isMd ? 340 : isSm ? 300 : 260)
                : (isMd ? 240 : isSm ? 210 : 180);

            var el = document.createElement('div');
            el.className = 'absolute cursor-pointer';
            /* Set transform immediately — NO transition yet, so initial placement is instant */
            el.style.cssText = [
                'left:50%', 'top:50%',
                'will-change:transform,opacity',
                'transform:translate(-50%,-50%) translateX(' + s.x + 'px) translateY(' + s.y + 'px) scale(' + s.scale + ') rotateY(' + s.rotateY + 'deg)',
                'z-index:' + s.zIndex,
                'opacity:' + (abs > 2 ? 0 : s.opacity),
                'width:' + cardW + 'px',
                'pointer-events:' + (abs > 2 ? 'none' : 'auto'),
            ].join(';');

            el.innerHTML = '<div class="rounded-2xl overflow-hidden relative shadow-2xl shadow-black/50" style="aspect-ratio:3/4;">'
                + '<img src="' + imgUrl + '" alt="' + title + '" class="w-full h-full object-cover" loading="lazy" onerror="this.src=\'' + FALLBACK + '\'">'
                + '<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>'
                + (tag
                    ? '<div class="card-badge absolute top-4 right-4" style="opacity:' + (isCenter ? 1 : 0) + ';transition:opacity .4s;"><span class="px-3 py-1 rounded-full text-xs font-display font-semibold bg-primary/90 text-primary-foreground backdrop-blur-sm">#' + tag + '</span></div>'
                    : '')
                + '<div class="card-overlay absolute inset-0 flex flex-col items-center justify-end pb-10 px-6 text-center" style="opacity:' + (isCenter ? 1 : 0) + ';transition:opacity .4s;">'
                + '<h3 class="font-display text-2xl md:text-4xl font-bold text-foreground uppercase tracking-wider leading-tight">' + title + '</h3>'
                + '<div class="w-10 h-0.5 bg-primary my-3 rounded-full"></div>'
                + '<p class="text-muted-foreground text-sm">' + subtitle + '</p>'
                + '</div>'
                + '</div>';

            /* Bind click */
            el.onclick = (function (c, i, center) {
                return center
                    ? function () { galleryOpenLightboxAt(i); }
                    : function () { gallerySetActive(i); };
            }(card, index, isCenter));

            cardEls.push(el);
            wrap.appendChild(el);
        });

        /* Enable smooth transitions AFTER the initial paint — double rAF ensures
           the browser has rendered the starting transforms before we add transitions */
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                cardEls.forEach(function (el) {
                    el.style.transition = 'transform 0.6s cubic-bezier(0.4,0,0.2,1), opacity 0.6s ease, width 0.6s ease';
                });
            });
        });

        updateDots();
    }

    /* ── Dots only ── */
    function updateDots() {
        var dotsEl = document.getElementById('gallery-dots');
        if (!dotsEl) return;
        dotsEl.innerHTML = cards.map(function (_, i) {
            var active = i === activeIndex;
            return '<button onclick="gallerySetActive(' + i + ')" style="'
                + (active
                    ? 'width:2rem;background:hsl(var(--primary));box-shadow:0 0 8px 2px hsl(var(--primary)/.4);'
                    : 'width:0.5rem;background:transparent;border:1.5px solid rgba(255,255,255,0.3);')
                + 'height:0.5rem;border-radius:999px;transition:all .3s;"></button>';
        }).join('');
    }

    /* ── Update positions ONLY (no DOM rebuild) — CSS transitions fire on existing elements ── */
    function updatePositions() {
        var isMd = window.innerWidth >= 768;
        var isSm = window.innerWidth >= 640;

        cards.forEach(function (card, index) {
            var el = cardEls[index];
            if (!el) return;
            var offset   = getOffset(index);
            var abs      = Math.abs(offset);
            var s        = getCardStyle(offset);
            var isCenter = offset === 0;
            var cardW    = isCenter
                ? (isMd ? 340 : isSm ? 300 : 260)
                : (isMd ? 240 : isSm ? 210 : 180);

            el.style.transform     = 'translate(-50%,-50%) translateX(' + s.x + 'px) translateY(' + s.y + 'px) scale(' + s.scale + ') rotateY(' + s.rotateY + 'deg)';
            el.style.zIndex        = s.zIndex;
            el.style.opacity       = abs > 2 ? '0' : s.opacity;
            el.style.width         = cardW + 'px';
            el.style.pointerEvents = abs > 2 ? 'none' : 'auto';

            var badge   = el.querySelector('.card-badge');
            var overlay = el.querySelector('.card-overlay');
            if (badge)   badge.style.opacity   = isCenter ? '1' : '0';
            if (overlay) overlay.style.opacity = isCenter ? '1' : '0';

            el.onclick = (function (c, i, center) {
                return center
                    ? function () { galleryOpenLightboxAt(i); }
                    : function () { gallerySetActive(i); };
            }(card, index, isCenter));
        });

        updateDots();
    }

    /* ── Navigation ── */
    window.gallerySetActive = function (i) {
        activeIndex = ((i % cards.length) + cards.length) % cards.length;
        updatePositions(); /* only update transforms — cards persist */
        resetTimer();
    };
    window.galleryNav = function (dir) { gallerySetActive(activeIndex + dir); };

    function resetTimer() {
        if (autoTimer) clearInterval(autoTimer);
        autoTimer = setInterval(function () { galleryNav(1); }, 4000);
    }

    /* ── Keyboard ── */
    document.addEventListener('keydown', function (e) {
        var lb = document.getElementById('gallery-lightbox');
        var lbOpen = lb && lb.style.display === 'flex';
        if (e.key === 'ArrowLeft')  { lbOpen ? galleryLightboxNav(-1) : galleryNav(-1); }
        if (e.key === 'ArrowRight') { lbOpen ? galleryLightboxNav(1)  : galleryNav(1);  }
        if (e.key === 'Escape')     { if (lbOpen) galleryCloseLightbox(); }
    });

    /* ── Touch swipe ── */
    var touchX = 0, touchY = 0;
    var carouselEl = document.getElementById('gallery-carousel');
    if (carouselEl) {
        carouselEl.addEventListener('touchstart', function (e) {
            touchX = e.touches[0].clientX;
            touchY = e.touches[0].clientY;
        }, { passive: true });
        carouselEl.addEventListener('touchend', function (e) {
            var dx = e.changedTouches[0].clientX - touchX;
            var dy = e.changedTouches[0].clientY - touchY;
            if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 40) galleryNav(dx < 0 ? 1 : -1);
        }, { passive: true });
    }

    /* ── Lightbox ── */
    function setLightboxContent(card) {
        document.getElementById('gallery-lightbox-img').src = card.image_url || FALLBACK;
        document.getElementById('gallery-lightbox-img').alt = card.title || '';
        document.getElementById('gallery-lightbox-caption').innerHTML = card.title
            ? '<span class="font-display text-xl font-bold uppercase tracking-wider text-white">' + card.title + '</span>'
              + (card.subtitle ? '<br><span class="text-sm mt-1 inline-block" style="color:rgba(255,255,255,.55);">' + card.subtitle + '</span>' : '')
            : '';
    }

    window.galleryOpenLightboxAt = function (idx) {
        lightboxIndex = ((idx % cards.length) + cards.length) % cards.length;
        var lb = document.getElementById('gallery-lightbox');
        setLightboxContent(cards[lightboxIndex]);
        lb.classList.remove('lb-closing');
        lb.style.display = 'flex';
        requestAnimationFrame(function () { lb.classList.add('lb-opening'); });
        document.body.style.overflow = 'hidden';
        /* Hide carousel arrows so they don't show behind lightbox */
        var pb = document.getElementById('gallery-prev-btn');
        var nb = document.getElementById('gallery-next-btn');
        if (pb) pb.style.visibility = 'hidden';
        if (nb) nb.style.visibility = 'hidden';
    };

    window.galleryLightboxNav = function (dir) {
        lightboxIndex = ((lightboxIndex + dir) % cards.length + cards.length) % cards.length;
        setLightboxContent(cards[lightboxIndex]);
    };

    window.galleryOpenLightbox = function (card) {
        var idx = cards.indexOf(card);
        galleryOpenLightboxAt(idx >= 0 ? idx : 0);
    };
    window.galleryCloseLightbox = function () {
        var lb = document.getElementById('gallery-lightbox');
        lb.classList.remove('lb-opening');
        lb.classList.add('lb-closing');
        lb.addEventListener('animationend', function handler() {
            lb.style.display = 'none';
            lb.classList.remove('lb-closing');
            lb.removeEventListener('animationend', handler);
        });
        document.body.style.overflow = '';
        /* Restore carousel arrows */
        var pb = document.getElementById('gallery-prev-btn');
        var nb = document.getElementById('gallery-next-btn');
        if (pb) pb.style.visibility = 'visible';
        if (nb) nb.style.visibility = 'visible';
    };
    window.galleryLightboxClose = function (e) {
        /* close when clicking the dark backdrop but not the image/caption */
        var inner = document.getElementById('gallery-lightbox-inner');
        if (!inner.contains(e.target) || e.target === inner) galleryCloseLightbox();
    };

    /* ── Resize — rebuild DOM since widths change ── */
    var resizeT;
    window.addEventListener('resize', function () {
        clearTimeout(resizeT);
        resizeT = setTimeout(function () { buildCards(); }, 150);
    });

    /* ── Wire up carousel arrow buttons via JS (not inline onclick) ── */
    var prevBtn = document.getElementById('gallery-prev-btn');
    var nextBtn = document.getElementById('gallery-next-btn');
    if (prevBtn) {
        prevBtn.addEventListener('click', function () { galleryNav(-1); });
        prevBtn.addEventListener('mouseover', function () { this.style.background = 'rgba(0,0,0,0.75)'; this.style.transform = 'translateY(-50%) scale(1.1)'; });
        prevBtn.addEventListener('mouseout',  function () { this.style.background = 'rgba(0,0,0,0.55)'; this.style.transform = 'translateY(-50%) scale(1)'; });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', function () { galleryNav(1); });
        nextBtn.addEventListener('mouseover', function () { this.style.background = 'rgba(0,0,0,0.75)'; this.style.transform = 'translateY(-50%) scale(1.1)'; });
        nextBtn.addEventListener('mouseout',  function () { this.style.background = 'rgba(0,0,0,0.55)'; this.style.transform = 'translateY(-50%) scale(1)'; });
    }

    /* ── Init ── */
    buildCards();
    resetTimer();
})();
</script>

{{-- ── PRODUCTS ──────────────────────────────────────────────────────────────── --}}
<section id="products" class="py-24 bg-water-gradient">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-animate>
            <p class="text-sm uppercase tracking-[0.3em] text-primary mb-3 font-display">Our Products</p>
            <h2 class="font-display text-3xl md:text-5xl font-bold text-foreground">
                Everything for Your <span class="text-gradient-gold">Pond</span>
            </h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6" data-stagger="0.1">
            @php
            $categories = [
                ['slug' => 'pond_pumps',    'label' => 'Pond Pumps',    'desc' => 'High-performance pumps for crystal-clear water circulation and waterfalls.', 'img' => 'product-pumps.jpg'],
                ['slug' => 'pond_aerators', 'label' => 'Pond Aerators', 'desc' => 'Keep your pond oxygenated for healthier, happier pond fish.',                  'img' => 'product-aerators.jpg'],
                ['slug' => 'pond_filters',  'label' => 'Pond Filters',  'desc' => 'Advanced filtration systems for pristine water quality year-round.',            'img' => 'product-filters.jpg'],
                ['slug' => 'accessories',   'label' => 'Accessories',   'desc' => 'Essential tools, test kits, and accessories for complete pond care.',            'img' => 'product-accessories.jpg'],
            ];
            @endphp
            @foreach($categories as $cat)
            <a href="{{ url('/products/' . $cat['slug']) }}" class="group block relative rounded-2xl bg-card border border-border overflow-hidden hover:border-primary/40 transition-all duration-300 hover:-translate-y-1">
                <div class="aspect-square overflow-hidden bg-secondary">
                    <img src="{{ asset('images/' . $cat['img']) }}" alt="{{ $cat['label'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-5">
                    <h3 class="font-display font-semibold text-lg text-foreground mb-2">{{ $cat['label'] }}</h3>
                    <p class="text-sm text-muted-foreground mb-4 leading-relaxed">{{ $cat['desc'] }}</p>
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-primary group-hover:gap-3 transition-all">
                        View Details
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CONTACT ───────────────────────────────────────────────────────────────── --}}
<section id="contact" class="py-24 bg-section-alt">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-animate>
            <p class="text-sm uppercase tracking-[0.3em] text-primary mb-3 font-display">Get In Touch</p>
            <h2 class="font-display text-3xl md:text-5xl font-bold text-foreground">
                Contact <span class="text-gradient-gold">Us</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-12 max-w-4xl mx-auto">
            {{-- Info --}}
            <div class="space-y-6" data-animate="fade-left">
                <p class="text-muted-foreground leading-relaxed">
                    Ready to start your pond keeping journey? We’d love to hear from you. Reach out for product inquiries, pond consultation, or any questions.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <a href="tel:+94771734462" class="text-foreground hover:text-primary transition-colors">+94 77 173 4462</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <a href="mailto:team@koimajesty.com" class="text-foreground hover:text-primary transition-colors">team@koimajesty.com</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-foreground">Worldwide Shipping Available</span>
                    </div>
                </div>
            </div>

            {{-- Form + Thank You --}}
            <div id="contact-form-wrap" data-animate="fade-right">
                {{-- Thank you message (hidden until submit) --}}
                <div id="contact-success" class="hidden flex flex-col items-center justify-center gap-6 h-full text-center py-8">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <h3 class="font-display text-2xl font-bold text-foreground mb-2">Thank You!</h3>
                        <p class="text-muted-foreground">Your message has been received.<br>We'll get back to you soon.</p>
                    </div>
                    <button onclick="contactReset()" class="text-sm text-primary hover:underline font-display">Send another message</button>
                </div>

                {{-- Contact form --}}
                <form id="contact-form" class="space-y-4">
                    @csrf
                    <div>
                        <input type="text" name="name" id="cf-name" placeholder="Your Name" required
                            class="w-full px-4 py-3 rounded-lg bg-card border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary transition-colors">
                        <p id="err-name" class="hidden mt-1 text-xs text-destructive"></p>
                    </div>
                    <div>
                        <input type="email" name="email" id="cf-email" placeholder="Your Email" required
                            class="w-full px-4 py-3 rounded-lg bg-card border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary transition-colors">
                        <p id="err-email" class="hidden mt-1 text-xs text-destructive"></p>
                    </div>
                    <div>
                        <textarea name="message" id="cf-message" rows="4" placeholder="Your Message" required
                            class="w-full px-4 py-3 rounded-lg bg-card border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary transition-colors resize-none"></textarea>
                        <p id="err-message" class="hidden mt-1 text-xs text-destructive"></p>
                    </div>
                    <p id="err-general" class="hidden text-xs text-destructive"></p>
                    <button type="submit" id="cf-btn"
                        class="w-full px-8 py-3 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold flex items-center justify-center gap-2">
                        <span id="cf-btn-text">Send Message</span>
                        <svg id="cf-spinner" class="hidden animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    var form    = document.getElementById('contact-form');
    var success = document.getElementById('contact-success');
    var btn     = document.getElementById('cf-btn');
    var btnText = document.getElementById('cf-btn-text');
    var spinner = document.getElementById('cf-spinner');

    function setError(field, msg) {
        var el = document.getElementById('err-' + field);
        if (!el) return;
        if (msg) { el.textContent = msg; el.classList.remove('hidden'); }
        else     { el.textContent = ''; el.classList.add('hidden'); }
    }
    function clearErrors() {
        ['name','email','message','general'].forEach(function(f){ setError(f,''); });
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        clearErrors();
        btn.disabled = true;
        btnText.textContent = 'Sending…';
        spinner.classList.remove('hidden');

        var data = new FormData(form);

        fetch('{{ url("/contact") }}', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: data,
        })
        .then(function (res) { return res.json().then(function(j){ return {ok: res.ok, status: res.status, json: j}; }); })
        .then(function (r) {
            btn.disabled = false;
            btnText.textContent = 'Send Message';
            spinner.classList.add('hidden');

            if (r.ok) {
                form.classList.add('hidden');
                success.classList.remove('hidden');
            } else if (r.status === 422 && r.json.errors) {
                var errs = r.json.errors;
                Object.keys(errs).forEach(function(k){ setError(k, errs[k][0]); });
            } else {
                setError('general', r.json.message || 'Something went wrong. Please try again.');
            }
        })
        .catch(function () {
            btn.disabled = false;
            btnText.textContent = 'Send Message';
            spinner.classList.add('hidden');
            setError('general', 'Network error. Please try again.');
        });
    });

    window.contactReset = function () {
        form.reset();
        clearErrors();
        success.classList.add('hidden');
        form.classList.remove('hidden');
    };
})();
</script>

@endsection
