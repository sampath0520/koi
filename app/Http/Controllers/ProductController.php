<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(string $category)
    {
        $validCategories = array_keys(Product::$categories);

        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        $products = Product::where('category', $category)
            ->active()
            ->latest()
            ->get();

        return view('products.show', [
            'category'            => $category,
            'categoryLabel'       => Product::$categories[$category],
            'categoryDescription' => Product::$categoryDescriptions[$category],
            'products'            => $products,
        ]);
    }
}
