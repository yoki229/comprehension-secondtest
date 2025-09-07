<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    //商品一覧ページ
    public function index()
    {
        $products = Product::Paginate(6);
		return view('products',compact('products',));
	}

    //検索・並び替え
    public function search(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $sort = $request->sort ?? '';         // 並び替え (highest / lowest)
        $query = Product::query();

        if(!empty($keyword))
        {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if($sort === 'highest')
        {
            $query->orderBy('price', 'desc');
        }
        elseif($sort === 'lowest')
        {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);;

		return view('products',compact('products', 'sort', 'keyword'));
	}

    //商品詳細ページ
    public function detail($productId)
    {
        $product = Product::find($productId);
		return view('update',compact('product',));
	}

    //商品登録ページ
    public function register()
    {
		return view('register');
	}


}
