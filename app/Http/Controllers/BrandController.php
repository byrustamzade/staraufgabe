<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact(['brands']));
    }

    public function create()
    {
        $brand = new Brand();
        return view('brands.edit-add', compact(['brand']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:250'
        ]);

        Brand::create(['name' => $validated['name']]);

        return redirect()->route('brands.index')->with('success', 'Brand added successfully');
    }

    public function show(Brand $brand)
    {
        return redirect()->route('brands.index');
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit-add', compact(['brand']));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|max:250'
        ]);
        $brand->update([
            'name' => $validated['name']
        ]);
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }
}
