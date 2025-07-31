<div
    x-data="{
        products: @entangle('products'),

        total: @entangle('total'),

        removeProduct(index) {
            this.products.splice(index, 1);
        },

        init() {
            this.$watch('products', (newProducts) => {
                let total = 0;

                newProducts.forEach(product => {
                    total += product.price * product.quantity;
                });

                this.total = total;
            });
        },
    }"
>
    <x-wire-card>
        <form
            wire:submit="save"
            class="space-y-4"
        >
            <div class="grid lg:grid-cols-4 gap-4">
                <x-wire-native-select
                    label="Tipo de comprobante"
                    wire:model="voucher_type"
                >
                    <option value="1">Factura</option>
                    <option value="2">Boleta</option>
                </x-wire-native-select>

                <x-wire-input
                    label="Serie"
                    wire:model="serie"
                    disabled
                />

                <x-wire-input
                    label="Correlativo"
                    wire:model="correlative"
                    disabled
                />

                <x-wire-input
                    label="Fecha"
                    wire:model="date"
                    type="date"
                />
            </div>

            <x-wire-select
                label="Proveedor"
                wire:model="supplier_id"
                :async-data="[
                    'api' => route('api.suppliers.index'),
                    'method' => 'POST',
                ]"
                option-label="name"
                option-value="id"
            />

            <div class="grid lg:grid-cols-4 gap-4">
                <x-wire-select
                    label="Producto"
                    wire:model="product_id"
                    :async-data="[
                        'api' => route('api.products.index'),
                        'method' => 'POST',
                    ]"
                    option-label="name"
                    option-value="id"
                    class="lg:col-span-3"
                />

                <x-wire-button wire:click="addProduct" class="lg:self-end" spinner="addProduct">Agregar producto</x-wire-button>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="text-gray-700 border-y bg-blue-50">
                            <th class="py-2 px-4">Producto</th>
                            <th class="py-2 px-4">Cantidad</th>
                            <th class="py-2 px-4">Precio</th>
                            <th class="py-2 px-4">Subtotal</th>
                            <th class="py-2 px-4"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <template x-for="(product, index) in products" :key="product.id">
                            <tr class="border-b">
                                <td class="px-4 py-2" x-text="product.name"></td>
                                <td class="px-4 py-2">
                                    <x-wire-input
                                        type="number"
                                        x-model="product.quantity"
                                        class="w-20"
                                        min="1"
                                    />
                                </td>
                                <td class="px-4 py-2">
                                    <x-wire-input
                                        type="number"
                                        x-model="product.price"
                                        class="w-20"
                                        min="0.00"
                                        step="0.01"
                                    />
                                </td>
                                <td class="px-4 py-2" x-text="(product.quantity * product.price).toFixed(2)"></td>
                                <td class="px-4 py-2">
                                    <x-wire-mini-button
                                        x-on:click="removeProduct(index)"
                                        rounded
                                        icon="trash"
                                        red
                                    />
                                </td>
                            </tr>

                        </template>

                        <template x-if="products.length === 0">
                            <tr class="border-b">
                                <td colspan="5" class="text-center py-4">No hay productos agregados</td>s
                            </tr>
                        </template>

                    </tbody>
                </table>
            </div>

            <div class="flex gap-4 flex-col lg:flex-row lg:items-end">
                <x-wire-input
                    wire:model="observation"
                    class="flex-1"
                    label="Observaciones"
                />

                <div>
                    Total: S/. <span x-text="total.toFixed(2)"></span>
                </div>
            </div>

            <div class="flex justify-end">
                <x-wire-button
                    type="submit"
                    icon="check"
                    spinner="save"
                >
                    Guardar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>
</div>
