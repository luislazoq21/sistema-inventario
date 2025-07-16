<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Identity;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customers.index');
    }

    public function create()
    {
        $identities = Identity::all();
        return view('admin.customers.create', compact('identities'));
    }

    public function store(CustomerRequest $request)
    {
        $data = $request->validated();
        $customer = Customer::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El cliente se creó correctamente',
        ]);

        return redirect()->route('admin.customers.edit', $customer);
    }


    public function edit(Customer $customer)
    {
        $identities = Identity::all();
        return view('admin.customers.edit', compact('customer', 'identities'));
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();
        $customer->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El cliente se actualizó correctamente',
        ]);

        return redirect()->route('admin.customers.edit', $customer);
    }

    public function destroy(Customer $customer)
    {
        if($customer->quotes()->exists() || $customer->sales()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'No se puede eliminar el cliente',
            ]);

            return redirect()->route('admin.customers.index');
        }

        $customer->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'El cliente se eliminó correctamente',
        ]);

        return redirect()->route('admin.customers.index');
    }
}
