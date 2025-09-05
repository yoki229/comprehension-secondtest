<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Season extends Model
{
    //リレーション
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_season', 'season_id', 'product_id');
    }

}
