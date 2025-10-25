<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use App\Models\Series;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        $series = Series::all();

        return view('products.create', compact('categories', 'authors', 'series'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->all());
        $product->authors()->sync($request->authors);
        $product->series()->sync($request->series);

        return redirect()->route('products.index')->with('success', 'Önüm üstünlikli goşuldy.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        $series = Series::all();

        return view('products.edit', compact('product', 'categories', 'authors', 'series'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        $product->authors()->sync($request->authors);
        $product->series()->sync($request->series);

        return redirect()->route('products.index')->with('success', 'Önüm üstünlikli üýtgedildi.');
    }
}
