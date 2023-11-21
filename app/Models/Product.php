<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = ['category_id', 'link', 'title','description','image','is_editor_choice','scheduled_at'];
    use HasFactory;
    public function histories(){
        return $this->hasMany(ProductClickHistory::class,"product_id","id");
    }
    public function categories(){
        return $this->hasOne(Category::class,"id","category_id");
    }
    
}
