@extends('layouts.app')

@section('title', '商品登録')

@section('content')
<div class="product-create-container">
    <h1>商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">商品名 <span class="required">必須</span></label>
            <input type="text" name="name" id="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <p style="color:red; font-size:14px; margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">値段 <span class="required">必須</span></label>
            <input type="text" name="price" id="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <p style="color:red; font-size:14px; margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" id="image">
            @error('image')
                <p style="color:red; font-size:14px; margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>季節 <span class="required">必須</span> <span class="optional">複数選択可</span></label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="season[]" value="春" {{ is_array(old('season')) && in_array('春', old('season')) ? 'checked' : '' }}> 春</label>
                <label><input type="checkbox" name="season[]" value="夏" {{ is_array(old('season')) && in_array('夏', old('season')) ? 'checked' : '' }}> 夏</label>
                <label><input type="checkbox" name="season[]" value="秋" {{ is_array(old('season')) && in_array('秋', old('season')) ? 'checked' : '' }}> 秋</label>
                <label><input type="checkbox" name="season[]" value="冬" {{ is_array(old('season')) && in_array('冬', old('season')) ? 'checked' : '' }}> 冬</label>
            </div>
            @error('season')
                <p style="color:red; font-size:14px; margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">商品説明 <span class="required">必須</span></label>
            <textarea name="description" id="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <p style="color:red; font-size:14px; margin-top:5px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-group">
            <button type="button" onclick="history.back()" class="back-button">戻る</button>
            <button type="submit" class="submit-button">登録</button>
        </div>
    </form>
</div>
@endsection
