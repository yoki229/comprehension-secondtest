<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;

class ProductsController extends Controller
{
    //商品一覧ページ
    public function index()
    {
        $products = Product::Paginate(6);
		return view('/products',compact('products',));
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

		return view('/products',compact('products', 'sort', 'keyword'));
	}

    //商品詳細ページ
    public function detail($productId)
    {
        $product = Product::find($productId);
        $seasons = Season::all();

		return view('/update',compact('product','seasons'));
	}

    //商品情報更新
    public function update(UpdateRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        //画像の保存
        if ($request->hasFile('image'))
        {
            // 古い画像をストレージから削除
                if($product->name) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
                }
            // 新しい画像を保存
            $path = $request->file('image')->store('public/images');
            $product->image = str_replace('public/', 'storage/', $path);
        }

        //通常カラムの更新
        $product->update($request->only(['name', 'price', 'description']));

        //リレーションカラムの更新
        if ($request->has('seasons'))
        {
            $product->seasons()->sync($request->seasons);
        }

        return redirect('/products');
	}

    //商品登録ページ
    public function register()
    {
        $seasons = Season::all();
        return view('/register', compact('seasons'));
	}

    //商品登録
    public function store(RegisterRequest $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 画像の保存
        $path = $request->file('image')->store('public/images');
        $product->image = str_replace('public/', 'storage/', $path);

        $product->save();

		return redirect('/products');
	}

    //商品削除
    public function delete(Request $request){

        Product::find($request->id)->delete();

        return redirect('/products');
    }


}
