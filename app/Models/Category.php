<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
        'status',
    ];

    //Category hasMany Products
    public function products() 
    {
        return $this->hasMany(Product::class,'category_id');
    }
    public function getImageUrlAttribute()
    {
        return $this->image
            ? url("/storage/app/public$this->image")
            : null;
    }

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChild');
    }
}


