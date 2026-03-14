<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V9CTQRMEK0"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-V9CTQRMEK0');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel – Majesty</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/koi_logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
    <style>
        /* Quill dark-theme overrides */
        .ql-toolbar.ql-snow { background: hsl(var(--secondary)); border-color: hsl(var(--border)); border-radius: 0.5rem 0.5rem 0 0; }
        .ql-container.ql-snow { background: hsl(var(--background)); border-color: hsl(var(--border)); border-radius: 0 0 0.5rem 0.5rem; }
        .ql-editor { color: hsl(var(--foreground)); font-size: 0.875rem; min-height: 200px; }
        .ql-editor.ql-blank::before { color: hsl(var(--muted-foreground)); font-style: normal; }
        .ql-snow .ql-stroke { stroke: hsl(var(--muted-foreground)); }
        .ql-snow .ql-fill { fill: hsl(var(--muted-foreground)); }
        .ql-snow .ql-picker { color: hsl(var(--muted-foreground)); }
        .ql-snow .ql-picker-options { background: hsl(var(--card)); border-color: hsl(var(--border)); color: hsl(var(--foreground)); }
        .ql-snow.ql-toolbar button:hover .ql-stroke, .ql-snow .ql-toolbar button:hover .ql-stroke,
        .ql-snow.ql-toolbar button.ql-active .ql-stroke, .ql-snow .ql-toolbar button.ql-active .ql-stroke { stroke: hsl(var(--primary)); }
        .ql-snow.ql-toolbar button:hover .ql-fill, .ql-snow .ql-toolbar button:hover .ql-fill,
        .ql-snow.ql-toolbar button.ql-active .ql-fill, .ql-snow .ql-toolbar button.ql-active .ql-fill { fill: hsl(var(--primary)); }
        .ql-snow.ql-toolbar button:hover, .ql-snow .ql-toolbar button:hover { background: hsl(var(--secondary)); border-radius: 0.25rem; }
        .ql-snow .ql-editor a { color: hsl(var(--primary)); }
        .ql-snow .ql-tooltip { background: hsl(var(--card)); border-color: hsl(var(--border)); color: hsl(var(--foreground)); box-shadow: none; }
        .ql-snow .ql-tooltip input[type=text] { background: hsl(var(--background)); border-color: hsl(var(--border)); color: hsl(var(--foreground)); }
    </style>
</head>
<body class="min-h-screen bg-background font-body antialiased">

    {{-- Admin Header --}}
    <header class="border-b border-border bg-card/50 backdrop-blur-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/koi_logo.png') }}" alt="Majesty" class="h-14 w-auto">
                <span class="font-display font-bold text-foreground">Admin Panel</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors">View Site</a>
                <form method="POST" action="{{ url('/logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm text-muted-foreground hover:bg-secondary hover:text-foreground transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">

        @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-primary/10 border border-primary/30 text-primary text-sm font-display">
            {{ session('success') }}
        </div>
        @endif

        {{-- Tabs --}}
        @php $activeTab = request('tab', 'products'); @endphp
        <div class="flex gap-2 mb-8 border-b border-border">
            <a href="?tab=products"
               class="px-4 py-2 font-display text-sm font-medium transition-colors {{ $activeTab === 'products' ? 'border-b-2 border-primary text-primary' : 'text-muted-foreground hover:text-foreground' }}">
                Products
            </a>
            <a href="?tab=blog"
               class="px-4 py-2 font-display text-sm font-medium transition-colors {{ $activeTab === 'blog' ? 'border-b-2 border-primary text-primary' : 'text-muted-foreground hover:text-foreground' }}">
                Blog Posts
            </a>
            <a href="?tab=gallery"
               class="px-4 py-2 font-display text-sm font-medium transition-colors {{ $activeTab === 'gallery' ? 'border-b-2 border-primary text-primary' : 'text-muted-foreground hover:text-foreground' }}">
                Gallery
            </a>
            <a href="?tab=contacts"
               class="relative px-4 py-2 font-display text-sm font-medium transition-colors {{ $activeTab === 'contacts' ? 'border-b-2 border-primary text-primary' : 'text-muted-foreground hover:text-foreground' }}">
                Contacts
                @php $unread = $contacts->where('is_read', false)->count(); @endphp
                @if($unread > 0)
                <span class="ml-1.5 inline-flex items-center justify-center w-5 h-5 rounded-full bg-primary text-primary-foreground text-[10px] font-bold">{{ $unread }}</span>
                @endif
            </a>
        </div>

        {{-- ── PRODUCTS TAB ────────────────────────────────────────────── --}}
        @if($activeTab === 'products')
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-display text-2xl font-bold text-foreground">Products</h2>
                <button onclick="document.getElementById('modal-product-new').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm hover:brightness-110 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Product
                </button>
            </div>

            {{-- Product list --}}
            @if($products->isEmpty())
            <p class="text-muted-foreground text-center py-12">No products yet.</p>
            @else
            <div class="space-y-3">
                @foreach($products as $product)
                <div class="flex items-center gap-4 p-4 bg-card rounded-xl border border-border">
                    @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    @else
                    <div class="w-16 h-16 rounded-lg bg-secondary flex items-center justify-center flex-shrink-0">
                        <span class="text-xs text-muted-foreground">No img</span>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="font-display font-semibold text-foreground truncate">{{ $product->title }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $product->status === 'active' ? 'bg-primary/20 text-primary' : 'bg-secondary text-muted-foreground' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-muted-foreground">
                            {{ App\Models\Product::$categories[$product->category] ?? $product->category }}
                            @if($product->price) &bull; Rs. {{ number_format($product->price) }} @endif
                        </p>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="openEditProduct('{{ $product->id }}')" title="Edit"
                            class="p-2 rounded-lg hover:bg-secondary transition-colors text-muted-foreground hover:text-foreground">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <form method="POST" action="{{ url('/admin/products/' . $product->id) }}" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg hover:bg-destructive/10 transition-colors text-muted-foreground hover:text-destructive">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- New Product Modal --}}
        <div id="modal-product-new" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-card border border-border rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display text-xl font-bold text-foreground">Add Product</h3>
                    <button onclick="document.getElementById('modal-product-new').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                @include('admin.partials.product-form', ['product' => null, 'action' => url('/admin/products'), 'method' => 'POST'])
            </div>
        </div>

        {{-- Edit Product Modal --}}
        <div id="modal-product-edit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-card border border-border rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display text-xl font-bold text-foreground">Edit Product</h3>
                    <button onclick="document.getElementById('modal-product-edit').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div id="edit-product-form-container"></div>
            </div>
        </div>

        {{-- ── BLOG TAB ─────────────────────────────────────────────────── --}}
        @elseif($activeTab === 'blog')
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-display text-2xl font-bold text-foreground">Blog Posts</h2>
                <button onclick="document.getElementById('modal-post-new').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm hover:brightness-110 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Post
                </button>
            </div>

            @if($posts->isEmpty())
            <p class="text-muted-foreground text-center py-12">No blog posts yet.</p>
            @else
            <div class="space-y-3">
                @foreach($posts as $post)
                <div class="flex items-center gap-4 p-4 bg-card rounded-xl border border-border">
                    @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    @else
                    <div class="w-16 h-16 rounded-lg bg-secondary flex items-center justify-center flex-shrink-0">
                        <span class="text-xs text-muted-foreground">No img</span>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="font-display font-semibold text-foreground truncate">{{ $post->title }}</h3>
                            @if($post->published)
                            <svg class="w-3.5 h-3.5 text-primary flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            @else
                            <svg class="w-3.5 h-3.5 text-muted-foreground flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            @endif
                        </div>
                        <p class="text-sm text-muted-foreground">{{ $post->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="openEditPost('{{ $post->id }}')" title="Edit"
                            class="p-2 rounded-lg hover:bg-secondary transition-colors text-muted-foreground hover:text-foreground">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <form method="POST" action="{{ url('/admin/posts/' . $post->id) }}" onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg hover:bg-destructive/10 transition-colors text-muted-foreground hover:text-destructive">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- New Post Modal --}}
        <div id="modal-post-new" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-card border border-border rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display text-xl font-bold text-foreground">New Blog Post</h3>
                    <button onclick="document.getElementById('modal-post-new').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                @include('admin.partials.post-form', ['post' => null, 'action' => url('/admin/posts'), 'method' => 'POST'])
            </div>
        </div>

        {{-- Edit Post Modal --}}
        <div id="modal-post-edit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-card border border-border rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display text-xl font-bold text-foreground">Edit Post</h3>
                    <button onclick="document.getElementById('modal-post-edit').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div id="edit-post-form-container"></div>
            </div>
        </div>

        @endif

        {{-- ── GALLERY TAB ───────────────────────────────────────── --}}
        @if($activeTab === 'gallery')
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-display text-2xl font-bold text-foreground">Gallery</h2>
                <button onclick="document.getElementById('modal-gallery-new').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm hover:brightness-110 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Image
                </button>
            </div>

            @if($galleryImages->isEmpty())
            <p class="text-muted-foreground text-center py-12">No gallery images yet. Add your first image!</p>
            @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($galleryImages as $img)
                <div class="relative group rounded-xl overflow-hidden bg-card border border-border">
                    <div class="aspect-[3/4] overflow-hidden bg-secondary">
                        @if($img->image_url)
                        <img src="{{ $img->image_url }}" alt="{{ $img->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-xs text-muted-foreground">No image</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-3">
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <h3 class="font-display font-semibold text-sm text-foreground truncate">{{ $img->title ?: '(untitled)' }}</h3>
                            @if($img->tag)
                            <span class="flex-shrink-0 px-2 py-0.5 rounded-full text-xs bg-primary/10 text-primary font-display">{{ $img->tag }}</span>
                            @endif
                        </div>
                        <p class="text-xs text-muted-foreground truncate">{{ $img->subtitle }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs {{ $img->active ? 'text-primary' : 'text-muted-foreground' }}">
                                {{ $img->active ? 'Visible' : 'Hidden' }}
                            </span>
                            <div class="flex gap-1">
                                <button onclick="openEditGallery('{{ $img->id }}')" title="Edit"
                                    class="p-1.5 rounded-lg hover:bg-secondary transition-colors text-muted-foreground hover:text-foreground">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form method="POST" action="{{ url('/admin/gallery/' . $img->id) }}" onsubmit="return confirm('Delete this image?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg hover:bg-destructive/10 transition-colors text-muted-foreground hover:text-destructive">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- New Gallery Image Modal --}}
        <div id="modal-gallery-new" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-card border border-border rounded-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display text-xl font-bold text-foreground">Add Gallery Image</h3>
                    <button onclick="document.getElementById('modal-gallery-new').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <form method="POST" action="{{ url('/admin/gallery') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-foreground">Image URL</label>
                        <input name="image_url" placeholder="https://..." class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-foreground">Or Upload Image</label>
                        <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-muted-foreground">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-foreground">Title</label>
                            <input name="title" placeholder="e.g. Golden Harmony" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-foreground">Tag / Badge</label>
                            <input name="tag" placeholder="e.g. Featured" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-foreground">Subtitle</label>
                        <input name="subtitle" placeholder="e.g. Premium Collection" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-foreground">Sort Order</label>
                            <input type="number" name="sort_order" value="0" min="0" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                        </div>
                        <div class="flex items-end pb-2 gap-2">
                            <input type="hidden" name="active" value="0">
                            <input type="checkbox" id="new_gallery_active" name="active" value="1" checked class="rounded">
                            <label for="new_gallery_active" class="text-sm font-medium text-foreground">Visible in gallery</label>
                        </div>
                    </div>
                    <button type="submit" class="w-full px-8 py-3 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
                        Add to Gallery
                    </button>
                </form>
            </div>
        </div>

        {{-- Edit Gallery Image Modal --}}
        <div id="modal-gallery-edit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-card border border-border rounded-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-display text-xl font-bold text-foreground">Edit Gallery Image</h3>
                    <button onclick="document.getElementById('modal-gallery-edit').classList.add('hidden')" class="text-muted-foreground hover:text-foreground">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div id="edit-gallery-form-container"></div>
            </div>
        </div>

        @elseif($activeTab === 'contacts')
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-display text-2xl font-bold text-foreground">
                    Contact Messages
                    @if($contacts->where('is_read', false)->count() > 0)
                    <span class="ml-2 text-base font-medium text-muted-foreground">({{ $contacts->where('is_read', false)->count() }} unread)</span>
                    @endif
                </h2>
            </div>

            @if($contacts->isEmpty())
            <p class="text-muted-foreground text-center py-12">No contact submissions yet.</p>
            @else
            <div class="space-y-3">
                @foreach($contacts as $submission)
                <div class="p-5 bg-card rounded-xl border {{ $submission->is_read ? 'border-border' : 'border-primary/40' }} transition-colors">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                <span class="font-display font-semibold text-foreground">{{ $submission->name }}</span>
                                @if(!$submission->is_read)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary/20 text-primary uppercase tracking-wide">New</span>
                                @endif
                                <span class="text-xs text-muted-foreground">{{ $submission->created_at->format('M d, Y · g:i A') }}</span>
                            </div>
                            <a href="mailto:{{ $submission->email }}" class="text-sm text-primary hover:underline">{{ $submission->email }}</a>
                            <p class="mt-3 text-sm text-foreground leading-relaxed whitespace-pre-wrap">{{ $submission->message }}</p>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            @if(!$submission->is_read)
                            <form method="POST" action="{{ url('/admin/contacts/' . $submission->id . '/read') }}">
                                @csrf @method('PATCH')
                                <button type="submit" title="Mark as read"
                                    class="p-2 rounded-lg hover:bg-secondary transition-colors text-muted-foreground hover:text-foreground">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ url('/admin/contacts/' . $submission->id) }}" onsubmit="return confirm('Delete this message?')">
                                @csrf @method('DELETE')
                                <button type="submit" title="Delete"
                                    class="p-2 rounded-lg hover:bg-destructive/10 transition-colors text-muted-foreground hover:text-destructive">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        @endif

    <script>
    // ── Data store (keyed by id, populated server-side) ───────────────────────
    const PRODUCTS = @json($products->keyBy('id'));
    const POSTS    = @json($posts->keyBy('id'));
    const GALLERY  = @json($galleryImages->keyBy('id'));

    // ── HTML-escape helper ────────────────────────────────────────────────────
    function esc(v) {
        return String(v ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
    }
    function escTa(v) { return String(v ?? '').replace(/<\/textarea/gi,'&lt;/textarea'); }

    // ── Edit Product ──────────────────────────────────────────────────────────
    function openEditProduct(id) {
        const product = PRODUCTS[id];
        if (!product) { alert('Product data not found.'); return; }
        const container = document.getElementById('edit-product-form-container');
        const action    = '{{ url("admin/products") }}/' + id;
        const specs     = product.specifications ? JSON.stringify(product.specifications, null, 2) : '';
        container.innerHTML = buildProductFormHTML(action, 'PUT', product, specs);
        document.getElementById('modal-product-edit').classList.remove('hidden');
    }

    function buildProductFormHTML(action, method, p, specs) {
        const cats = {pond_pumps:'Pond Pumps',pond_aerators:'Pond Aerators',pond_filters:'Pond Filters',accessories:'Accessories'};
        let catOptions = Object.entries(cats).map(([k,v]) =>
            `<option value="${k}" ${p.category===k?'selected':''}>${v}</option>`
        ).join('');
        return `
        <form method="POST" action="${action}" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="${method}">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Product Name</label>
                    <input name="title" value="${esc(p.title)}" required class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Category</label>
                    <select name="category" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">${catOptions}</select>
                </div>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Description (HTML)</label>
                <textarea name="description" rows="4" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-y">${escTa(p.description)}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Price (Rs.)</label>
                    <input type="number" name="price" value="${esc(p.price)}" step="0.01" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Status</label>
                    <select name="status" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                        <option value="active" ${p.status==='active'?'selected':''}>Active</option>
                        <option value="inactive" ${p.status==='inactive'?'selected':''}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Main Image URL</label>
                <input name="image_url" value="${esc(p.image_url)}" placeholder="https://..." class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Upload New Main Image</label>
                <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-muted-foreground">
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="featured" value="0">
                <input type="checkbox" id="edit_featured" name="featured" value="1" ${p.featured?'checked':''} class="rounded">
                <label for="edit_featured" class="text-sm font-medium text-foreground">Featured</label>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Specifications (JSON)</label>
                <textarea name="specifications" rows="3" placeholder='{"Flow Rate":"5000 L/h","Power":"50W"}' class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-none font-mono">${escTa(specs)}</textarea>
            </div>
            <button type="submit" class="w-full px-8 py-3 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
                Update Product
            </button>
        </form>`;
    }

    // ── Edit Post ─────────────────────────────────────────────────────────────
    function openEditPost(id) {
        const post = POSTS[id];
        if (!post) { alert('Post data not found.'); return; }
        const container = document.getElementById('edit-post-form-container');
        const action    = '{{ url("admin/posts") }}/' + id;
        container.innerHTML = buildPostFormHTML(action, 'PUT', post);
        document.getElementById('modal-post-edit').classList.remove('hidden');
        setTimeout(function() { initQuillEditor('edit-post-quill-editor', 'edit-post-content'); }, 30);
    }

    function buildPostFormHTML(action, method, p) {
        p = p || {};
        return `
        <form method="POST" action="${action}" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="${method}">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Title</label>
                    <input name="title" value="${esc(p.title)}" required class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Slug</label>
                    <input name="slug" value="${esc(p.slug)}" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                </div>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Excerpt</label>
                <textarea name="excerpt" rows="2" placeholder="Short description..." class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-none">${escTa(p.excerpt)}</textarea>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Content</label>
                <div id="edit-post-quill-editor"></div>
                <textarea name="content" id="edit-post-content" class="hidden">${escTa(p.content)}</textarea>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Featured Image URL</label>
                <input name="image_url" value="${esc(p.image_url)}" placeholder="https://..." class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Upload New Image</label>
                <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-muted-foreground">
            </div>
            <div class="border-t border-border pt-4 space-y-3">
                <p class="text-sm font-medium text-foreground">SEO Settings</p>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Meta Title</label>
                    <input name="meta_title" value="${esc(p.meta_title)}" maxlength="60" placeholder="SEO title" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Meta Description</label>
                    <textarea name="meta_description" rows="2" maxlength="160" placeholder="SEO description..." class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-none">${escTa(p.meta_description)}</textarea>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="published" value="0">
                <input type="checkbox" id="post_pub_edit" name="published" value="1" ${(p.published||p.published===1)?'checked':''} class="rounded">
                <label for="post_pub_edit" class="text-sm font-medium text-foreground">Published</label>
            </div>
            <button type="submit" class="w-full px-8 py-3 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
                ${method === 'PUT' ? 'Update Post' : 'Create Post'}
            </button>
        </form>`;
    }

    // ── Edit Gallery Image ───────────────────────────────────────────────
    function openEditGallery(id) {
        const img = GALLERY[id];
        if (!img) { alert('Image data not found.'); return; }
        const container = document.getElementById('edit-gallery-form-container');
        const action    = '{{ url("admin/gallery") }}/' + id;
        container.innerHTML = buildGalleryFormHTML(action, img);
        document.getElementById('modal-gallery-edit').classList.remove('hidden');
    }

    function buildGalleryFormHTML(action, g) {
        g = g || {};
        return `
        <form method="POST" action="${action}" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Image URL</label>
                <input name="image_url" value="${esc(g.image_url)}" placeholder="https://..." class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
            </div>
            ${g.image_url ? `<img src="${esc(g.image_url)}" class="h-24 rounded-xl object-cover" alt="Preview">` : ''}
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Or Upload New Image</label>
                <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-muted-foreground">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Title</label>
                    <input name="title" value="${esc(g.title)}" placeholder="e.g. Golden Harmony" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Tag / Badge</label>
                    <input name="tag" value="${esc(g.tag)}" placeholder="e.g. Featured" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
                </div>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-foreground">Subtitle</label>
                <input name="subtitle" value="${esc(g.subtitle)}" placeholder="e.g. Premium Collection" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-foreground">Sort Order</label>
                    <input type="number" name="sort_order" value="${esc(g.sort_order ?? 0)}" min="0" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                </div>
                <div class="flex items-end pb-2 gap-2">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" id="edit_gallery_active" name="active" value="1" ${g.active ? 'checked' : ''} class="rounded">
                    <label for="edit_gallery_active" class="text-sm font-medium text-foreground">Visible in gallery</label>
                </div>
            </div>
            <button type="submit" class="w-full px-8 py-3 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
                Update Image
            </button>
        </form>`;
    }

    // ── Quill Rich Text Editor ────────────────────────────────────────────────
    const QUILL_TOOLBAR = [
        [{ header: [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ align: [] }],
        ['link', 'image'],
        ['clean']
    ];

    function initQuillEditor(editorId, textareaId) {
        const editorEl  = document.getElementById(editorId);
        const textarea  = document.getElementById(textareaId);
        if (!editorEl || !textarea) return;
        if (editorEl._quill) return; // already initialised

        const q = new Quill('#' + editorId, {
            theme: 'snow',
            modules: { toolbar: QUILL_TOOLBAR },
            placeholder: 'Write your blog post content here…'
        });

        // Populate with existing content
        if (textarea.value.trim()) {
            q.root.innerHTML = textarea.value;
        }

        editorEl._quill = q;

        // Sync onto hidden textarea before form submits
        const form = editorEl.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                textarea.value = q.root.innerHTML;
            });
        }
    }

    // Initialise Quill for the static "New Post" modal when it opens
    document.addEventListener('DOMContentLoaded', function() {
        const openNewPostBtn = document.querySelector('[onclick*="modal-post-new"]');
        if (openNewPostBtn) {
            openNewPostBtn.addEventListener('click', function() {
                setTimeout(function() {
                    initQuillEditor('new-post-quill-editor', 'new-post-content');
                }, 30);
            });
        }
    });
    </script>

</body>
</html>
