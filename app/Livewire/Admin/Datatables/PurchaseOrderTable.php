<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderTable extends DataTableComponent
{
    // protected $model = PurchaseOrder::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        // $this->setAdditionalSelects(['purchase_orders.id']);
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Fecha", "date")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),

            Column::make("Serie", "serie")
                ->sortable(),

            Column::make("Correlativo", "correlative")
                ->sortable(),

            Column::make('Proveedor', 'supplier.name')
                ->sortable(),

            Column::make("Voucher type", "voucher_type")
                ->sortable(),

            Column::make("Total", "total")
                ->sortable()
                ->format(fn($value) => 'S/.' . number_format($value, 2)),

            Column::make('Acciones')
                ->label(function ($purchase_order) {
                    return view('admin.purchase_orders.actions', compact('purchase_order'));
                }),
        ];
    }

    public function builder(): Builder
    {
        return PurchaseOrder::query()
            ->with(['supplier']);
    }
}
