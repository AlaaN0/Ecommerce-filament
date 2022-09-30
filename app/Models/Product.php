<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cost_price',
        'price',
        'sale_price',
        'sku',
        'quantity',
        'featured_image',
        'images',
        'category_id',
        'brand_id',
        'status',
        
    ];
    //protected $casts = [
    //    'images' => 'array',
    //];

    //Product BelongsToOne Category
    public function category() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //Product BelongsToOne Brand
    public function brand() 
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
