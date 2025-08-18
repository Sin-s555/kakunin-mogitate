@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="product-detail-container">
    <a href="{{ route('products.index') }}" class="back-link">商品一覧 ＞</a> {{ $product->name }}

    <div class="product-detail-content">
        <div class="product-image-section">
            @php
                $imagePath = $product->image
                    ? asset('storage/images/' . $product->image)
                    : asset('images/' . $product->dummy_image);
            @endphp
            <img src="{{ $imagePath }}" alt="{{ $product->name }}">
            <p class="filename">{{ $product->image ?? $product->dummy_image }}</p>
        </div>

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

        <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="delete-form" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" title="削除">&#128465;</button>
        </form>
    </div>
</div>
@endsection
