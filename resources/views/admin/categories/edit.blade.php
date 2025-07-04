@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Categorias',
            'href' => route('admin.categories.index')
        ],
        [
            'name' => 'Editar',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Editar categoría">

    <x-wire-card>

        <form
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
            class="space-y-4"
        >
            @csrf
            @method('put')

            <x-wire-input
                label="Nombre"
                name="name"
                value="{{ old('name', $category->name) }}"
            />

            <x-wire-textarea label="Descripción" name="description">
                {{ old('description', $category->description) }}
            </x-wire-textarea>

            <div class="flex justify-end">
                <x-button>Actualizar</x-button>
            </div>
        </form>

    </x-wire-card>

</x-admin-layout>
