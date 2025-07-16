<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;

class CustomerTable extends DataTableComponent
{
    // protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Tipo Doc", "identity.name")
                ->sortable(),
            Column::make("Num Doc", "document_number")
                ->sortable()
                ->searchable(),
            Column::make("Razón social", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Teléfono", "phone")
                ->sortable(),
            Column::make('Acciones')
                ->label(function($customer) {
                    return view('admin.customers.actions', compact('customer'));
                }),
        ];
    }

    public function builder(): Builder
    {
        return Customer::query()
            ->with(['identity']);
    }
}
