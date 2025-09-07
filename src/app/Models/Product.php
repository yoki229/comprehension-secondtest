<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;

class Product extends Model
{
    use HasFactory;

    //書き換え可能に
    protected $fillable = ['name', 'price', 'image', 'description'];

    //リレーション
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }

    //テキストボックスの検索
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {

            // スペースで分割に対応
            $words = preg_split('/\s+/', $keyword);

            // 部分一致検索
            foreach ($words as $word)
            {
                $query->where('name', 'like', '%' . $keyword . '%');
            }
        }
    }

}
