@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Almacenes',
            'href' => route('admin.warehouses.index')
        ],
        [
            'name' => 'Editar',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Editar almacén">

    <x-wire-card>

        <form
            action="{{ route('admin.warehouses.update', $warehouse) }}"
            method="POST"
            class="space-y-4"
        >
            @csrf
            @method('put')

            <x-wire-input
                label="Nombre"
                name="name"
                value="{{ old('name', $warehouse->name) }}"
            />

            <x-wire-input
                label="Ubicación"
                name="location"
                value="{{ old('location', $warehouse->location) }}"
            />

            <div class="flex justify-end">
                <x-button>Actualizar</x-button>
            </div>
        </form>

    </x-wire-card>

</x-admin-layout>
