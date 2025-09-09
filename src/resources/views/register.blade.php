@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')

<div class="form-layouts">
    <h2 class="register-title">
        商品登録
    </h2>

    <form class="form" action="/products/register" method="post" enctype="multipart/form-data">
        @csrf
        <!-- 商品名入力 -->
        <div class="form-item__group">
            <div class="form__title">
                <span>商品名</span>
                <span class="form__title--red">必須</span>
            </div>
            <div class="form__content">
                <div class="form__content-text">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name')}}"/>
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

        <!-- 値段入力 -->
        <div class="form-item__group">
            <div class="form__title">
                <span>値段</span>
                <span class="form__title--red">必須</span>
            </div>
            <div class="form__content">
                <div class="form__content-text">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}"/>
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

        <!-- ファイル選択 -->
        <div class="form-item__group">
            <div class="form__title">
                <span>商品画像</span>
                <span class="form__title--red">必須</span>
            </div>
            <div class="form__file">
                <!-- プレビュー画像（初期は非表示 -->
                <img src="#" id="preview">
                <!-- ファイル選択 -->
                <input type="file" name="image" id="image" class="form__file-update" accept="image/*">
            </div>
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

        <!-- 季節入力 -->
        <div class="form-item__group">
            <div class="form__title">
                <span>季節</span>
                <span class="form__title--red">必須</span>
                <span class="form__title--Note">複数選択可</span>
            </div>
            <div class="form__content">
                @foreach($seasons as $season)
                <div class="form__content-checkbox">
                    <label>
                        <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons',[])) ? 'checked' : '' }}>
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

        <!-- 商品説明入力 -->
        <div class="form-item__group">
            <div class="form__title">
                <span>商品説明</span>
                <span class="form__title--red">必須</span>
            </div>
            <div class="form__content">
                <div class="form__content-description">
                    <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
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

        <!-- ボタン -->
        <div class="form__button">
            <a href="/products" class="back">戻る</a>
            <button type=submit class="register-button">変更を保存</button>
        </div>
    </form>
</div>

<!-- プレビュー表示用JavaScript -->
<!-- JavaScriptなしではプレビューはどうにもならなそうだったので入れてみます。 -->
<script>
document.getElementById('image').addEventListener('change', function(event){
    const file = event.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block'; // プレビューを表示
        }
        reader.readAsDataURL(file);
    }
});
</script>

@endsection