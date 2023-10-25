<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    protected $fillable = ['sneaker_brand', 'sneaker_model', 'sneaker_color', 'sneaker_size', 'sneaker_releasedate', 'sneaker_stylecode', 'sneaker_paidprice', 'sneaker_picture'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listing()
    {
        return $this->hasMany(Listing::class);
    }
}
