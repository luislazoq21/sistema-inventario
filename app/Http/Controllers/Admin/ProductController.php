<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El producto se ha creado correctamente.',
        ]);

        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El producto se ha actualizado correctamente',
        ]);

        return redirect()->route('admin.products.edit', $product);
    }

    public function destroy(Product $product)
    {
        if($product->inventories()->exists() || $product->purchaseOrders()->exists() || $product->quotes()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'No se puede eliminar el producto porque tiene elementos asociados',
            ]);
        }

        $product->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El producto se ha eliminado correctamente',
        ]);

        return redirect()->route('admin.products.index');
    }

    public function dropzone(Request $request, Product $product)
    {
        // $path = Storage::put('/images', $request->file('file'));
        // $size = $request->file('file')->getSize();

        // $image = $product->images()->create(compact('path', 'size'));

        // return response()->json(compact('path'));

        $image = $product->images()->create([
            'path' => Storage::put('/images', $request->file('file')),
            'size' => $request->file('file')->getSize(),
        ]);

        return response()->json([
            'id' => $image->id,
            'path' => $image->path,
        ]);
    }
}
