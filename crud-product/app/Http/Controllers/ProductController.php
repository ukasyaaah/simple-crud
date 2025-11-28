<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.manipulasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'description' => 'required',
            'image' => 'required|image|file|max:5000',

        ]);

        $validated['image'] = $request->file('image')->store('images');

        Product::create($validated);
        return redirect()->route('index')->with('success', 'Data berhasil di tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, int $id)
    {
        $detailProduk = Product::findOrFail($id);
        return view('product.manipulasi', compact('detailProduk',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        $validated = $request->validate([
            'name' => 'string|required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,gif'
        ]);

        if ($request->file('image')) {
            Storage::delete($product->image);
            $validated['image'] = $request->file('image')->store('images');
        }

        $product->update($validated);
        return  redirect()->route('index')->with('success', 'Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();
        return redirect()->route('index');
    }
}
