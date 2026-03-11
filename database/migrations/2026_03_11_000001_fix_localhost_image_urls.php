<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Replace http://localhost/storage/ with /storage/ in all image_url columns
        foreach (['products', 'blog_posts', 'gallery_images'] as $table) {
            DB::table($table)
                ->where('image_url', 'like', 'http://%/storage/%')
                ->get(['id', 'image_url'])
                ->each(function ($row) use ($table) {
                    $fixed = preg_replace('#^https?://[^/]+/storage/#', '/storage/', $row->image_url);
                    DB::table($table)->where('id', $row->id)->update(['image_url' => $fixed]);
                });
        }

        // Fix images JSON arrays in products table
        DB::table('products')
            ->whereNotNull('images')
            ->get(['id', 'images'])
            ->each(function ($row) {
                $images = json_decode($row->images, true);
                if (!is_array($images)) return;
                $fixed = array_map(fn($url) => preg_replace('#^https?://[^/]+/storage/#', '/storage/', $url), $images);
                DB::table('products')->where('id', $row->id)->update(['images' => json_encode($fixed)]);
            });
    }

    public function down(): void
    {
        // Not reversible — original localhost URLs are no longer valid
    }
};
