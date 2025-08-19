<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    // 商品一覧表示
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');

        $query = Product::query();

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products.index', compact('products'));
    }

    // 商品詳細表示
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 商品作成フォーム表示
    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        // 画像アップロード（必須なので null は許さない）
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = basename($imagePath);
        } else {
            // ここに来ることは基本ないが安全策として
            return redirect()->back()->withErrors(['image' => '商品画像を登録してください'])->withInput();
        }

        $validated['season'] = json_encode($request->input('season'));

        Product::create($validated);

        return redirect()->route('products.index')->with('success', '商品を登録しました。');
    }

    // 商品更新処理
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validated();

        // 画像アップロード（変更があれば）
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists('images/' . $product->image)) {
                Storage::disk('public')->delete('images/' . $product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = basename($imagePath);
        } else {
            // 画像未選択の場合は既存の画像を維持
            $validated['image'] = $product->image;
        }

        $validated['season'] = json_encode($request->input('season'));

        $product->update($validated);

        return redirect()->route('products.index')->with('success', '商品を更新しました。');
    }

    // 商品削除処理
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists('images/' . $product->image)) {
            Storage::disk('public')->delete('images/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }
}
