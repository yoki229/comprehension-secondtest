@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/products.css')}}">
@endsection

@section('content')
<div class="main-content">
    <!-- ヘッダー -->
    <div class="main-header">
        <div class="main-header__content">
            <h1 class="main-header__item">商品一覧</h1>
            <form action="/products/register" class="main-header__item">
                <button class="register-button">+商品を追加</button>
            </form>
        </div>
    </div>

    <div class="main-inner">
        <!-- サイド -->
        <div class="sidebar">
            <!-- 検索 -->
            <form action="/products/search" class="search" method="get">
                <input class="search-textbox" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                <button class="search-button" type="submit">検索</button>
            </form>

            <!-- 並び替え機能 -->
            <p class="sort-p">価格順で表示</p>
            <div class="sort-dropdown">
                <div class="placeholder">
                    <div>価格で並べ替え</div>
                    <div class="sort-dropdown__mark">▼</div>
                </div>
                <ul>
                    <li><a href="/products/search?keyword={{ request('keyword') }}&sort=highest">高い順に表示</a></li>
                    <li><a href="/products/search?keyword={{ request('keyword') }}&sort=lowest">低い順に表示</a></li>
                </ul>
            </div>
            <!-- 選択中のソートを表示 -->
            <div class="sort-tag">
                @if(request('sort') == 'highest')
                <span class="active-sort">高い順に表示 <a href="/products/search?keyword={{ request('keyword') }}">×</a></span>
                @elseif(request('sort') == 'lowest')
                <span class="active-sort">低い順に表示 <a href="/products/search?keyword={{ request('keyword') }}">×</a></span>
                @endif
            </div>
        </div>

        <!-- メインのカード一覧 -->
        <div class="content">
            <div class="content-list">

                @foreach($products as $product)
                <a href="route('products.show', $product->id)" class="card">
                    <div class="card__img">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="card__content">
                        <div>{{ $product->name }}</div>
                        <div>￥{{ $product->price }}</div>
                    </div>
                </a>
                @endforeach

            </div>

            <div class="pagination-item">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</div>
@endsection