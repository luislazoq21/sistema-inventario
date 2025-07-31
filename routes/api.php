<?php

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/suppliers', function(Request $request) {
    return Supplier::select('id', 'name')
        ->when($request->search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('document_number', 'like', "%{$search}%");
        })
        ->when(
            $request->exists('selected'),
            fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn (Builder $query) => $query->limit(10)
        )
        ->orderBy('name')
        ->get();
})->name('api.suppliers.index');


Route::post('/products', function(Request $request) {
    return Product::select('id', 'name')
        ->when($request->search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%");
        })
        ->when(
            $request->exists('selected'),
            fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn (Builder $query) => $query->limit(10)
        )
        ->orderBy('name')
        ->get();
})->name('api.products.index');
