<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BlogPost;
use App\Models\GalleryImage;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $galleryImages = GalleryImage::active()->orderBy('sort_order')->orderBy('id')->get();
        } catch (\Exception $e) {
            $galleryImages = collect();
        }
        return view('home', compact('galleryImages'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactSubmission::create($request->only('name', 'email', 'message'));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Thank you! Your message has been received.']);
        }

        return back()->with('success', 'Thank you! Your message has been received.');
    }
}
