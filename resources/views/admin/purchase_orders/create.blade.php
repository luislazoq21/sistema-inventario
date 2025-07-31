@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Órdenes de compra',
            'href' => route('admin.purchase-orders.index')
        ],
        [
            'name' => 'Nuevo',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Nueva orden de compra">
    <livewire:admin.purchase-order-create />
</x-admin-layout>
