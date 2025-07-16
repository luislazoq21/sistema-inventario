@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Categorías',
            'href' => route('admin.categories.index')
        ],
        [
            'name' => 'Nueva',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Nueva categoría">

    <x-wire-card>

        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
            class="space-y-4"
        >
            @csrf

            <x-wire-input
                label="Nombre"
                name="name"
                value="{{ old('name') }}"
            />

            <x-wire-textarea label="Descripción" name="description">
                {{ old('description') }}
            </x-wire-textarea>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>

    </x-wire-card>

</x-admin-layout>
