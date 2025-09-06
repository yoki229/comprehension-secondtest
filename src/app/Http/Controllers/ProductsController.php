<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product;

class ProductsController extends Controller
{
    //商品一覧ページ
    public function index()
    {
        $products = Product::Paginate(6);
		return view('products',compact('products',));
	}

}
