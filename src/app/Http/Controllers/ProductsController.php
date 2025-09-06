<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //商品一覧ページ
    public function index()
    {
        //$products = Product::all();
		//return view('products',compact('products',));
        return view('products');
	}

}
