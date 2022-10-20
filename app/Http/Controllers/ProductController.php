<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditAddProductRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $validated = $this->validate($request, [
            'pages' => 'sometimes|integer',
            'per_page' => 'sometimes|integer',
        ]);

        $products = Product::with('brand')->paginate($validated['per_page'] ?? 50);
        return view('products.index', compact(['products']));
    }

    public function create()
    {
        $brands = Brand::all();
        $product = new Product();
        return view('products.edit-add', compact(['brands', 'product']));
    }

    public function store(EditAddProductRequest $request)
    {
        $validated = $request->validated();
        Product::create([
            'name' => $validated['name'],
            'brand_id' => $validated['brand'],
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] === 'yes'
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    public function show(Product $product)
    {
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        return view('products.edit-add', compact(['brands', 'product']));
    }

    public function update(EditAddProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update([
            'name' => $validated['name'],
            'brand_id' => $validated['brand'],
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] === 'yes'
        ]);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
