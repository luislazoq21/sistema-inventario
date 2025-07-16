<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class ProductTable extends DataTableComponent
{
    // protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            ImageColumn::make('Imagen')
                ->location(
                    fn($row) => $row->image
                )
                ->attributes(fn($row) => [
                    'class' => 'w-20 h-20 rounded-full object-cover object-center',
                    'alt' => $row->name . ' image',
                ]),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Categoría", "category.name")
                ->sortable()
                ->searchable(),
            Column::make("Precio", "price")
                    ->sortable(),
            Column::make('Acciones')
                ->label(function($product) {
                    return view('admin.products.actions', compact('product'));
                }),
        ];
    }

    public function builder(): Builder
    {
        return Product::query()
            ->with(['category', 'images']);
    }
}
