<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'profile_image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function scopeWithRole($query, $roleName)
    {
        return $query->whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        });
    }

    public function views()
    {
        return $this->hasMany(ProductClickHistory::class);
    }
    public function plans(){
        return $this->hasOne(Subscription::class);
    }
}
