<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('admin.warehouses.index');
    }

    public function create()
    {
        return view('admin.warehouses.create');
    }

    public function store(WarehouseRequest $request)
    {
        $data = $request->validated();
        $warehouse = Warehouse::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El almacén fue creado correctamente',
        ]);

        return redirect()->route('admin.warehouses.edit', $warehouse);
    }

    public function edit(Warehouse $warehouse)
    {
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $data = $request->validated();
        $warehouse->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El almacén fue actualizado correctamente',
        ]);

        return redirect()->route('admin.warehouses.edit', $warehouse);
    }

    public function destroy(Warehouse $warehouse)
    {
        if($warehouse->inventories()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'No se puede eliminar el almacén',
            ]);

            return redirect()->route('admin.warehouses.index');
        }

        $warehouse->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El almacén fue eliminado correctamente',
        ]);

        return redirect()->route('admin.warehouses.index');
    }
}
