<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    protected $fillable = [
        'body',
        "post_id",
        "user_id"
    ];

    public function user()
    {
        $this->belongsTo(User::class,"user_id");
    }

    public function anouncement()
    {
        $this->belongsTo(Announcement::class,"post_id");
    }
}




?>
