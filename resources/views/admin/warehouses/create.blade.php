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
            'name' => 'Nuevo',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Nuevo almacén">

    <x-wire-card>

        <form
            action="{{ route('admin.warehouses.store') }}"
            method="POST"
            class="space-y-4"
        >
            @csrf

            <x-wire-input
                label="Nombre"
                name="name"
                value="{{ old('name') }}"
            />

            <x-wire-input
                label="Ubicación"
                name="location"
                value="{{ old('location') }}"
            />

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>

    </x-wire-card>

</x-admin-layout>
