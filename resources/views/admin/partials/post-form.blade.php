<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Title</label>
            <input name="title" value="{{ old('title', $post->title ?? '') }}" required
                class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
        </div>
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Slug</label>
            <input name="slug" value="{{ old('slug', $post->slug ?? '') }}"
                class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground focus:outline-none focus:border-primary text-sm">
        </div>
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Excerpt</label>
        <textarea name="excerpt" rows="2" placeholder="Short description for listings..."
            class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-none">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Content</label>
        <div id="new-post-quill-editor"></div>
        <textarea name="content" id="new-post-content" class="hidden">{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Featured Image URL</label>
        <input name="image_url" value="{{ old('image_url', $post->image_url ?? '') }}" placeholder="https://..."
            class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-foreground">Upload Image</label>
        <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-muted-foreground">
    </div>

    <div class="border-t border-border pt-4 space-y-3">
        <p class="text-sm font-medium text-foreground">SEO Settings</p>
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Meta Title <span class="text-muted-foreground text-xs">(max 60 chars)</span></label>
            <input name="meta_title" value="{{ old('meta_title', $post->meta_title ?? '') }}" maxlength="60" placeholder="SEO title"
                class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm">
        </div>
        <div class="space-y-1">
            <label class="text-sm font-medium text-foreground">Meta Description <span class="text-muted-foreground text-xs">(max 160 chars)</span></label>
            <textarea name="meta_description" rows="2" maxlength="160" placeholder="SEO description..."
                class="w-full px-3 py-2 rounded-lg bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:border-primary text-sm resize-none">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <input type="hidden" name="published" value="0">
        <input type="checkbox" id="post_published" name="published" value="1" {{ old('published', $post->published ?? false) ? 'checked' : '' }} class="rounded">
        <label for="post_published" class="text-sm font-medium text-foreground">Published</label>
    </div>

    <button type="submit" class="w-full px-8 py-3 rounded-lg bg-primary text-primary-foreground font-display font-semibold text-sm tracking-wide hover:brightness-110 transition-all glow-gold">
        {{ $post ? 'Update Post' : 'Create Post' }}
    </button>
</form>
