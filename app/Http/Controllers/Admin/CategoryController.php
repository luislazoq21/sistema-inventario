<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
        ]);

        $category = Category::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'La categoría se ha creado correctamente',
        ]);

        return redirect()->route('admin.categories.edit', $category);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'La categoría se ha actualizado correctamente',
        ]);

        return redirect()->route('admin.categories.edit', $category);
    }

    public function destroy(Category $category)
    {
        if($category->products()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'No se puede eliminar la categoría porque tiene productos asociados',
            ]);

            return redirect()->route('admin.categories.index');
        }

        $category->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'La categoría se ha eliminado correctamente',
        ]);

        return redirect()->route('admin.categories.index');
    }
}
