@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/update.css')}}">
@endsection

@section('content')

<div class="form-layouts">

    <!-- 商品一覧 > 商品名 の段 -->
    <div class="form__head">
        <a href="/products">商品一覧</a> > {{ $product->name }}
    </div>

    <form class="form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $product->id }}">
        <!-- ファイル選択の段 -->
        <div class="form-flex">
            <div class="form__file">
                <img src="{{ asset($product->image) }}" >
                <input type="file" name="image">
                <div class="form__error">
                    @if ($errors->has('image'))
                        <ul>
                            @foreach ($errors->get('image') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form__short-content">
                <div class="form-group">
                    <div class="form__title-name">
                        <span>商品名</span>
                    </div>
                    <div class="form__content">
                        <div class="form__content-text">
                            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name', $product->name) }}"/>
                        </div>
                        <div class="form__error">
                            @if ($errors->has('name'))
                                <ul>
                                    @foreach ($errors->get('name') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__title-price">
                        <span>値段</span>
                    </div>
                    <div class="form__content">
                        <div class="form__content-text">
                            <input type="text" name="price" placeholder="値段を入力" value="{{ old('price', $product->price) }}"/>
                        </div>
                        <div class="form__error">
                            @if ($errors->has('price'))
                                <ul>
                                    @foreach ($errors->get('price') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__title-seasons">
                        <span>季節</span>
                    </div>
                    <div class="form__content">
                        @foreach($seasons as $season)
                        <div class="form__content-checkbox">
                            <label>
                                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <span>{{ $season->name }}</span>
                            </label>
                        </div>
                        @endforeach
                        <div class="form__error">
                            @if ($errors->has('seasons'))
                                <ul>
                                    @foreach ($errors->get('seasons') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 商品説明の段 -->
        <div class="form__long-content">
            <div class="form-group">
                <div class="form__title-description">
                    <span>商品説明</span>
                </div>
                <div class="form__content">
                    <div class="form__content-description">
                        <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="form__error">
                        @if ($errors->has('description'))
                            <ul>
                                @foreach ($errors->get('description') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ボタンの段 -->
        <div class="form__button">
            <a href="/products" class="back">戻る</a>
            <button type=submit class="update-button">変更を保存</button>
        </div>
    </form>

    <!-- 削除用ボタン -->
    <form class="delete-form" action="/products/{{ $product->id }}/delete" method="post">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id" value="{{ $product->id }}">
    <button type="submit" class="delete-icon">
        <img src="{{ asset('images/trash.png') }}" alt="削除" class="trash-icon">
    </button>
    </form>
</div>

@endsection