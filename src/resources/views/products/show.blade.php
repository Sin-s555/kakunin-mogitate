@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="product-detail-container">
    <a href="{{ route('products.index') }}" class="back-link">商品一覧 ＞</a>
    <h2>{{ $product->name }}</h2>

    <div class="product-detail-content">
        {{-- 商品画像表示 --}}
        <div class="product-image-section">
            @php
                // 実際にアップロードされた画像があれば storage から
                if ($product->image && file_exists(public_path('storage/images/' . $product->image))) {
                    $imagePath = asset('storage/images/' . $product->image);
                    $filename = $product->image;
                } 
                // そうでなければ public/images のダミー画像
                elseif ($product->dummy_image && file_exists(public_path('images/' . $product->dummy_image))) {
                    $imagePath = asset('images/' . $product->dummy_image);
                    $filename = $product->dummy_image;
                } 
                // それ以外は空画像
                else {
                    $imagePath = asset('images/no-image.png');
                    $filename = 'no-image.png';
                }
            @endphp

            <img src="{{ $imagePath }}" alt="{{ $product->name }}">
            <p class="filename">{{ $filename }}</p>
        </div>

        {{-- 商品編集フォーム --}}
        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="product-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>商品画像</label>
                <input type="file" name="image">
                @error('image')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
                @error('name')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">
                @error('price')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>季節</label>
                @php
                    $seasonsArray = old('season', json_decode($product->season, true) ?? []);
                @endphp
                @foreach (['春', '夏', '秋', '冬'] as $season)
                    <label>
                        <input type="checkbox" name="season[]" value="{{ $season }}"
                            {{ in_array($season, $seasonsArray) ? 'checked' : '' }}>
                        {{ $season }}
                    </label>
                @endforeach
                @error('season')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>商品説明</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn btn-gray">戻る</a>
                <button type="submit" class="btn btn-yellow">変更を保存</button>
            </div>
        </form>

        {{-- 商品削除フォーム --}}
        <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="delete-form" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" title="削除">&#128465;</button>
        </form>
    </div>
</div>
@endsection
