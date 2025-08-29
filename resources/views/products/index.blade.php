@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<header class="header">
    <div class="logo">mogitate</div>
    <a href="#" class="add-button">+ 商品を追加</a>
</header>

<main class="container">
    <aside class="sidebar">
        <h2>商品一覧</h2>
        <form>
            <input type="text" placeholder="商品名で検索">
            <button type="submit">検索</button>

            <label for="sort">価格順で表示</label>
            <select id="sort" name="sort">
                <option value="">価格で並べ替え</option>
                <option value="asc">安い順</option>
                <option value="desc">高い順</option>
            </select>
        </form>
    </aside>

    <section class="products">
        @php
            $products = [
                ['id' => 1, 'name' => 'キウイ', 'price' => 800, 'image' => 'kiwi.jpg'],
                ['id' => 2, 'name' => 'ストロベリー', 'price' => 1200, 'image' => 'strawberry.jpg'],
                ['id' => 3, 'name' => 'オレンジ', 'price' => 850, 'image' => 'orange.jpg'],
                ['id' => 4, 'name' => 'スイカ', 'price' => 700, 'image' => 'watermelon.jpg'],
                ['id' => 5, 'name' => 'ピーチ', 'price' => 1000, 'image' => 'peach.jpg'],
                ['id' => 6, 'name' => 'シャインマスカット', 'price' => 1400, 'image' => 'shine_muscat.jpg'],
            ];
        @endphp

        @foreach ($products as $product)
            <a href="{{ route('products.show', $product['id']) }}" class="product-card">
                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}">
                <div class="product-info">
                    <div class="product-name">{{ $product['name'] }}</div>
                    <div class="product-price">¥{{ number_format($product['price']) }}</div>
                </div>
            </a>
        @endforeach
    </section>
</main>

<footer class="pagination">
    <a href="#">&lt;</a>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">&gt;</a>
</footer>
@endsection
