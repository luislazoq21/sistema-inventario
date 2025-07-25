@php
    $links = [
        [
            'header' => 'Principal',
        ],
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],

        [
            'name' => 'Inventario',
            'icon' => 'fa-solid fa-boxes-stacked',
            'active' => request()->routeIs([
                'admin.categories.*',
                'admin.products.*',
                'admin.warehouses.*',
            ]),
            'submenu' => [
                [
                    'name' => 'Categorías',
                    'href' => route('admin.categories.index'),
                    'active' => request()->routeIs('admin.categories.*'),
                ],
                [
                    'name' => 'Productos',
                    'href' => route('admin.products.index'),
                    'active' => request()->routeIs('admin.products.*'),
                ],
                [
                    'name' => 'Almacenes',
                    'href' => route('admin.warehouses.index'),
                    'active' => request()->routeIs('admin.warehouses.*'),
                ],
            ]
        ],

        [
            'name' => 'Compras',
            'icon' => 'fa-solid fa-cart-shopping',
            'active' => request()->routeIs([
                'admin.suppliers.*',
            ]),
            'submenu' => [
                [
                    'name' => 'Proveedores',
                    'href' => route('admin.suppliers.index'),
                    'active' => request()->routeIs('admin.suppliers.*'),
                ],
                [
                    'name' => 'Órdenes de compra',
                    'href' => '',
                    'active' => false,
                ],
                [
                    'name' => 'Compras',
                    'href' => '',
                    'active' => false,
                ],
            ],
        ],

        [
            'name' => 'Ventas',
            'icon' => 'fa-solid fa-cash-register',
            'active' => request()->routeIs([
                'admin.customers.*',
            ]),
            'submenu' => [
                [
                    'name' => 'Clientes',
                    'href' => route('admin.customers.index'),
                    'active' => request()->routeIs('admin.customers.*'),
                ],
                [
                    'name' => 'Cotizaciones',
                    'href' => '',
                    'active' => false,
                ],
                [
                    'name' => 'Ventas',
                    'href' => '',
                    'active' => false,
                ],
            ],
        ],

        [
            'name' => 'Movimientos',
            'icon' => 'fa-solid fa-arrows-rotate',
            'active' => request()->routeIs([

            ]),
            'submenu' => [
                [
                    'name' => 'Entradas y salidas',
                    'href' => '',
                    'active' => false,
                ],
                [
                    'name' => 'Transferencias',
                    'href' => '',
                    'active' => false,
                ],
            ],
        ],

        [
            'name' => 'Reportes',
            'icon' => 'fa-solid fa-chart-line',
            'href' => '',
            'active' => false,
        ],


        [
            'header' => 'Configuración',
        ],

        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'href' => '',
            'active' => false,
        ],
        [
            'name' => 'Roles',
            'icon' => 'fa-solid fa-shield-halved',
            'href' => '',
            'active' => false,
        ],
        [
            'name' => 'Permisos',
            'icon' => 'fa-solid fa-lock',
            'href' => '',
            'active' => false,
        ],
        [
            'name' => 'Ajustes',
            'icon' => 'fa-solid fa-gear',
            'href' => '',
            'active' => false,
        ],

    ];
@endphp

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @isset($link['header'])
                        <div class="p-2 mt-4 text-xs uppercase font-semibold text-gray-500">
                            {{ $link['header'] }}
                        </div>
                    @else
                        @isset($link['submenu'])
                            <div x-data="{
                                open: {{ $link['active'] ? 'true' : 'false' }}
                            }">
                                <button
                                    @click="open = !open"
                                    type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                >
                                    <span class="w-6 h-6 flex justify-center items-center text-gray-500">
                                        <i class="{{ $link['icon'] }}"></i>
                                    </span>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $link['name'] }}</span>
                                    <i
                                        class="text-sm"
                                        :class="{
                                            'fa-solid fa-chevron-up': open,
                                            'fa-solid fa-chevron-down': !open,
                                        }"
                                    ></i>
                                </button>
                                <ul x-show="open" x-cloak class="py-2 space-y-2">
                                    @foreach ($link['submenu'] as $submenu)
                                        <li>
                                            <a
                                                href="{{ $submenu['href'] }}"
                                                @class([
                                                    'flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700',
                                                    'bg-gray-100' => $submenu['active'],
                                                ])
                                            >
                                                {{ $submenu['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <a
                                href="{{ $link['href'] }}"
                                @class([
                                    'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group',
                                    'bg-gray-100' => $link['active'],
                                ])
                            >
                                <span class="w-6 h-6 flex justify-center items-center text-gray-500">
                                    <i class="{{ $link['icon'] }}"></i>
                                </span>
                                <span class="ms-3">{{ $link['name'] }}</span>
                            </a>
                        @endisset
                    @endisset
                </li>
            @endforeach
        </ul>
    </div>
</aside>
