<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    // many to many realtion with Product model
    public function Products()
    {
        return $this->belongsToMany(Product::class)->withPivot('category_id','product_id');
    }
    // morph realtion on Photo model 
    public function photos()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
    // search function and queries
    public function scopeFilter($query, $data = '')
    {
        return
            $query->where('name', 'like', '%' . $data . '%')
            ->orWhere('description', 'like', '%' . $data . '%')
            ->orWhere('id', 'like', '%' . $data . '%')->load('products')->paginate(10);
    }
}
