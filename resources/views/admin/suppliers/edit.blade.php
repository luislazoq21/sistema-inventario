@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Proveedores',
            'href' => route('admin.suppliers.index')
        ],
        [
            'name' => 'Editar',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Editar proveedor">

    <x-wire-card>

        <form
            action="{{ route('admin.suppliers.update', $supplier) }}"
            method="POST"
            class="space-y-4"
        >
            @csrf
            @method('put')

            <x-wire-native-select
                label="Tipo de documento"
                name="identity_id"
            >
                <option></option>
                @foreach ($identities as $identity)
                    <option value="{{ $identity->id }}" @selected(old('identity_id', $supplier->identity_id) == $identity->id)>{{ $identity->name }}</option>
                @endforeach
            </x-wire-native-select>

            <x-wire-input
                label="Número de documento"
                name="document_number"
                value="{{ old('document_number', $supplier->document_number) }}"
            />

            <x-wire-input
                label="Nombre"
                name="name"
                value="{{ old('name', $supplier->name) }}"
            />

            <x-wire-input
                label="Email"
                name="email"
                value="{{ old('email', $supplier->email) }}"
            />

            <x-wire-input
                label="Dirección"
                name="address"
                value="{{ old('address', $supplier->address) }}"
            />

            <x-wire-input
                label="Teléfono"
                name="phone"
                value="{{ old('phone', $supplier->phone) }}"
            />

            <div class="flex justify-end">
                <x-button>Actualizar</x-button>
            </div>
        </form>

    </x-wire-card>

</x-admin-layout>
