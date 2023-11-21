<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    protected $fillable = ['description',"image","user_id","created_at","updated_at"];
    
    public function created_by()
    {
        $this->belongsTo(User::class,"user_id");
    }
    public function user() {
        return $this->hasOne('App\Models\Comment','post_id','id') ;
    }
    
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function comments() {
        return $this->hasMany(Comment::class,'post_id','id') ;
    }
    use HasFactory;
}
