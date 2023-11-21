<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = ['parent_id', 'name','slug','icon'];

   /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
      return $this->hasMany('App\Models\Category','parent_id','id') ;
  }
    use HasFactory;
}
