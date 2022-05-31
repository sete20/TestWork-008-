<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    // many to many realtion with Categroy model
    public function categories(){
        return $this->belongsToMany(Category::class)->withPivot('category_id','product_id');
    }
    // morph realtion on Photo model 
    public function photos(){
        return $this->morphOne(Photo::class, 'photoable');
    }
    // search function and queries
    public function scopeFilter($query,$data=''){
        return
        $query->where('name', 'like', '%' . $data . '%')
        ->orWhere('quantity', 'like', '%' . $data . '%')
        ->orWhere('price', 'like', '%' . $data . '%')
        ->orWhere('quantity', 'like', '%' . $data . '%')
        ->orWhere('details', 'like', '%' . $data . '%')
        ->orWhere('id', 'like', '%' . $data . '%')->load('categories')->paginate(10);
    }
}
