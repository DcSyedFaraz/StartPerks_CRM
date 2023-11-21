<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AggreamentContract extends Model
{
    protected $table = 'user_aggreament_contracts';
     protected $fillable = ['user_id','aggreament_id','sign_image','created_at','updated_at'];

     public function agreement(){
      return $this->belongsTo(Aggreament::class,"aggreament_id");
     }
     public function user(){
      return $this->belongsTo(User::class,"user_id");
     }
    use HasFactory;
}
