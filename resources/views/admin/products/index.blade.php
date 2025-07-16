@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Productos',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Productos">

    <x-slot name="action">
        <x-wire-button href="{{ route('admin.products.create') }}" blue>
            Nuevo
        </x-wire-button>
    </x-slot>

    @livewire('admin.datatables.product-table')

    @push('css')
        <style>
            table th span, table td {
                font-size: 0.75rem !important;
            }
        </style>
    @endpush

    @push('js')
        <script>
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Está seguro de eliminar?",
                        text: "No se podrá revertir esta acción",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush

</x-admin-layout>
