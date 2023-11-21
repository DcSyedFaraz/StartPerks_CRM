<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_cards extends Model
{
    use HasFactory;
    protected $table = "bank_cards";
    protected $guarded = [];

    /**
     * Get the user associated with the Bank_cards
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bank()
    {
        return $this->hasOne(Banks::class, 'id',"bank_id");
    }
    public function funding_detail()
    {
        return $this->hasOne(Funding_detail::class, 'card_id',"id")->where("user_id",\Auth::id());
    }
}
