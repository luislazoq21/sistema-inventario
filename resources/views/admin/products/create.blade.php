@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Productos',
            'href' => route('admin.products.index')
        ],
        [
            'name' => 'Nuevo',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Nuevo producto">

    <x-wire-card>

        <form
            action="{{ route('admin.products.store') }}"
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

            {{-- <x-wire-input
                label="SKU"
                name="sku"
                value="{{ old('sku') }}"
            /> --}}

            {{-- <x-wire-input
                label="Código de barras"
                name="barcode"
                value="{{ old('barcode') }}"
            /> --}}

            <x-wire-input
                label="Precio"
                name="price"
                type="number"
                step="0.01"
                value="{{ old('price') }}"
            />

            {{-- <x-wire-select
                label="Categoría"
                name="category_id"
                :options="$categories"
                option-label="name"
                option-value="id"
            /> --}}

            <x-wire-native-select
                label="Categoría"
                name="category_id"
            >
                <option></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </x-wire-native-select>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </form>

    </x-wire-card>

</x-admin-layout>
