<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

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

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
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

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
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
