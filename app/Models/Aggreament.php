<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aggreament extends Model
{
    protected $table = 'aggreaments';
     protected $fillable = ['title','body','is_applied','created_at','updated_at'];
     public function contracts(){
        return $this->hasMany(AggreamentContract::class,"aggreament_id","id");
     }
    
    use HasFactory;
}
