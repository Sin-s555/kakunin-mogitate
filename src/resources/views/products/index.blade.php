@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<header class="header">
    <div class="logo">mogitate</div>
    <a href="{{ route('products.create') }}" class="add-button">+ 商品を追加</a>
</header>

<main class="container">
    <aside class="sidebar">
        <h2>商品一覧</h2>
        <form action="{{ route('products.index') }}" method="GET">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit">検索</button>

            <label for="sort">価格順で表示</label>
            <select id="sort" name="sort">
                <option value="" disabled selected>価格で並べ替え</option>
                <option value="asc" @if(request('sort') === 'asc') selected @endif>安い順</option>
                <option value="desc" @if(request('sort') === 'desc') selected @endif>高い順</option>
            </select>
        </form>

        @if(request('sort'))
        <div class="active-tags">
            <span class="tag">
                価格: {{ request('sort') === 'asc' ? '安い順' : '高い順' }}
                <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" class="remove-tag">&times;</a>
            </span>
        </div>
        @endif
    </aside>

    <section class="products">
        @foreach ($products as $product)
            @php
                // 優先度：アップロード画像 → ダミー画像 → no-image
                if ($product->image && file_exists(storage_path('app/public/images/' . $product->image))) {
                    $imagePath = asset('storage/images/' . $product->image);
                } elseif ($product->dummy_image && file_exists(public_path('images/' . $product->dummy_image))) {
                    $imagePath = asset('images/' . $product->dummy_image);
                } else {
                    $imagePath = asset('images/no-image.png');
                }
            @endphp

            <a href="{{ route('products.show', $product->id) }}" class="product-card">
                <img src="{{ $imagePath }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">¥{{ number_format($product->price) }}</div>
                </div>
            </a>
        @endforeach
    </section>

    <footer class="pagination">
        {{ $products->links() }}
    </footer>
</main>
@endsection
