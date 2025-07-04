@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Dashboard">
    <x-wire-button>Prueba</x-wire-button>
</x-admin-layout>
