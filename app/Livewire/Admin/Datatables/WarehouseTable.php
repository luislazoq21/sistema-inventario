<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Warehouse;

class WarehouseTable extends DataTableComponent
{
    protected $model = Warehouse::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Ubicación", "location")
                ->sortable()
                ->searchable(),
            Column::make('Acciones')
                ->label(function($warehouse) {
                    return view('admin.warehouses.actions', compact('warehouse'));
                })
        ];
    }
}
