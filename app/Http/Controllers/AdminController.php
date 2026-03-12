<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BlogPost;
use App\Models\GalleryImage;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $products      = Product::latest()->get();
        $posts         = BlogPost::latest()->get();
        $galleryImages = GalleryImage::orderBy('sort_order')->orderBy('id')->get();
        $contacts      = ContactSubmission::latest()->get();

        return view('admin.index', compact('products', 'posts', 'galleryImages', 'contacts'));
    }

    // ────────── Products ──────────

    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'category'       => 'required|in:pond_pumps,pond_aerators,pond_filters,accessories',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'image_url'      => 'nullable|string',
            'featured'       => 'boolean',
            'status'         => 'required|in:active,inactive',
            'specifications' => 'nullable|string',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $specs = null;
        if (!empty($data['specifications'])) {
            $specs = json_decode($data['specifications'], true) ?? null;
        }
        $data['specifications'] = $specs;
        $data['featured'] = $request->boolean('featured');

        // Multiple images
        $images = [];
        if ($request->hasFile('extra_images')) {
            foreach ($request->file('extra_images') as $file) {
                $path = $file->store('products', 'public');
                $images[] = '/storage/' . $path;
            }
        }
        $data['images'] = $images;

        Product::create($data);

        return redirect()->route('admin.index')->with('success', 'Product created.');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'category'       => 'required|in:pond_pumps,pond_aerators,pond_filters,accessories',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'image_url'      => 'nullable|string',
            'featured'       => 'boolean',
            'status'         => 'required|in:active,inactive',
            'specifications' => 'nullable|string',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $specs = null;
        if (!empty($data['specifications'])) {
            $specs = json_decode($data['specifications'], true) ?? null;
        }
        $data['specifications'] = $specs;
        $data['featured'] = $request->boolean('featured');

        $images = $product->images ?? [];
        if ($request->hasFile('extra_images')) {
            foreach ($request->file('extra_images') as $file) {
                $path = $file->store('products', 'public');
                $images[] = '/storage/' . $path;
            }
        }
        $data['images'] = $images;

        $product->update($data);

        return redirect()->route('admin.index')->with('success', 'Product updated.');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.index')->with('success', 'Product deleted.');
    }

    // ────────── Blog ──────────

    public function storePost(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'excerpt'          => 'nullable|string',
            'content'          => 'nullable|string',
            'image_url'        => 'nullable|string',
            'published'        => 'boolean',
            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $data['slug']      = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);
        $data['author_id'] = auth()->id();
        $data['published'] = $request->boolean('published');

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('blog', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        BlogPost::create($data);

        return redirect()->route('admin.index', ['tab' => 'blog'])->with('success', 'Post created.');
    }

    public function updatePost(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'excerpt'          => 'nullable|string',
            'content'          => 'nullable|string',
            'image_url'        => 'nullable|string',
            'published'        => 'boolean',
            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $data['slug']      = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);
        $data['published'] = $request->boolean('published');

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('blog', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $post->update($data);

        return redirect()->route('admin.index', ['tab' => 'blog'])->with('success', 'Post updated.');
    }

    public function destroyPost(BlogPost $post)
    {
        $post->delete();

        return redirect()->route('admin.index', ['tab' => 'blog'])->with('success', 'Post deleted.');
    }

    // ────────── Gallery ──────────

    public function storeGalleryImage(Request $request)
    {
        $data = $request->validate([
            'image_url'  => 'nullable|string',
            'title'      => 'nullable|string|max:255',
            'subtitle'   => 'nullable|string|max:255',
            'tag'        => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'active'     => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('gallery', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $data['image_url']  = $data['image_url']  ?? '';
        $data['title']      = $data['title']      ?? '';
        $data['subtitle']   = $data['subtitle']   ?? '';
        $data['tag']        = $data['tag']        ?? '';
        $data['active']     = $request->boolean('active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        GalleryImage::create($data);

        return redirect()->route('admin.index', ['tab' => 'gallery'])->with('success', 'Gallery image added.');
    }

    public function updateGalleryImage(Request $request, GalleryImage $galleryImage)
    {
        $data = $request->validate([
            'image_url'  => 'nullable|string',
            'title'      => 'nullable|string|max:255',
            'subtitle'   => 'nullable|string|max:255',
            'tag'        => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'active'     => 'boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('gallery', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $data['image_url']  = $data['image_url']  ?? $galleryImage->image_url  ?? '';
        $data['title']      = $data['title']      ?? $galleryImage->title      ?? '';
        $data['subtitle']   = $data['subtitle']   ?? $galleryImage->subtitle   ?? '';
        $data['tag']        = $data['tag']        ?? $galleryImage->tag        ?? '';
        $data['active']     = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $galleryImage->update($data);

        return redirect()->route('admin.index', ['tab' => 'gallery'])->with('success', 'Gallery image updated.');
    }

    public function destroyGalleryImage(GalleryImage $galleryImage)
    {
        $galleryImage->delete();

        return redirect()->route('admin.index', ['tab' => 'gallery'])->with('success', 'Gallery image deleted.');
    }

    // ────────── Contact Submissions ──────────

    public function markContactRead(ContactSubmission $submission)
    {
        $submission->update(['is_read' => true]);

        return redirect()->route('admin.index', ['tab' => 'contacts'])->with('success', 'Message marked as read.');
    }

    public function destroyContact(ContactSubmission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.index', ['tab' => 'contacts'])->with('success', 'Message deleted.');
    }
}