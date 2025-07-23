<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Identity;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return view('admin.suppliers.index');
    }

    public function create()
    {
        $identities = Identity::all();
        return view('admin.suppliers.create', compact('identities'));
    }

    public function store(SupplierRequest $request)
    {
        $data = $request->validated();
        $supplier = Supplier::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El proveedor fue creado correctamente',
        ]);

        return redirect()->route('admin.suppliers.edit', $supplier);
    }

    public function edit(Supplier $supplier)
    {
        $identities = Identity::all();
        return view('admin.suppliers.edit', compact('identities', 'supplier'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();
        $supplier->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El proveedor fue actualizado correctamente',
        ]);

        return redirect()->route('admin.suppliers.edit', $supplier);
    }

    public function destroy(Supplier $supplier)
    {
        if($supplier->purchaseOrders()->exists() || $supplier->purchases()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'No se puede eliminar el proveedor',
            ]);

            return redirect()->route('admin.suppliers.index');
        }

        $supplier->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El proveedor fue eliminado correctamente',
        ]);

        return redirect()->route('admin.suppliers.index');
    }
}
