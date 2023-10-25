<?php

namespace App\Models;

use App\Models\Sneaker;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = ['listing_title', 'listing_description', 'listing_price', 'listing_picture', 'seller_id', 'listing_sold', 'buyer_id', 'listing_originalprice', 'listing_active'];


    public function sneakers()
    {
        return $this->belongsTo(Sneaker::class);
    }
}
