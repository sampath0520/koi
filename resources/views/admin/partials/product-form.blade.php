<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Product Name</label>
            <input name="title" value="{{ old('title', $product->title ?? '') }}" required
                class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
        </div>
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Category</label>
            <select name="category" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                @foreach(\App\Models\Product::$categories as $slug => $label)
                <option value="{{ $slug }}" {{ old('category', $product->category ?? '') === $slug ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Description (HTML)</label>
        <textarea name="description" rows="4" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-y">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Price (Rs.)</label>
            <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" step="0.01"
                class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
        </div>
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Status</label>
            <select name="status" class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
                <option value="active" {{ old('status', $product->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $product->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Main Image URL</label>
        <input name="image_url" value="{{ old('image_url', $product->image_url ?? '') }}" placeholder="https://..."
            class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Upload Main Image</label>
        <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-muted-foreground">
    </div>

    <div class="flex items-center gap-2">
        <input type="hidden" name="featured" value="0">
        <input type="checkbox" id="new_featured" name="featured" value="1" {{ old('featured', $product->featured ?? false) ? 'checked' : '' }} class="rounded">
        <label for="new_featured" class="text-sm font-medium text-foreground">Featured</label>
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Specifications (JSON)</label>
        <textarea name="specifications" rows="3" placeholder='{"Flow Rate":"5000 L/h","Power":"50W"}'
            class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-none font-mono">{{ old('specifications', isset($product) && $product->specifications ? json_encode($product->specifications, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>

    <button type="submit" class="w-full px-8 py-3 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
        {{ $product ? 'Update Product' : 'Create Product' }}
    </button>
</form>
