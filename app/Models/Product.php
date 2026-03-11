<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'category',
        'title',
        'description',
        'price',
        'image_url',
        'images',
        'featured',
        'status',
        'specifications',
    ];

    protected $casts = [
        'images'         => 'array',
        'specifications' => 'array',
        'featured'       => 'boolean',
        'price'          => 'decimal:2',
    ];

    public static array $categories = [
        'pond_pumps'    => 'Pond Pumps',
        'pond_aerators' => 'Pond Aerators',
        'pond_filters'  => 'Pond Filters',
        'accessories'   => 'Accessories',
    ];

    public static array $categoryDescriptions = [
        'pond_pumps'    => 'High-performance pumps for crystal-clear water circulation and waterfalls.',
        'pond_aerators' => 'Keep your pond oxygenated for healthier, happier pond fish.',
        'pond_filters'  => 'Advanced filtration systems for pristine water quality year-round.',
        'accessories'   => 'Essential tools, test kits, and accessories for complete pond care.',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
