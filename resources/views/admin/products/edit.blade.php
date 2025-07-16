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
            'name' => 'Editar',
        ],
    ];
@endphp

<x-admin-layout :breadcrumbs="$breadcrumbs" title="Editar producto">

    <div class="mb-4">
        <form
            method="POST"
            action="{{ route('admin.products.dropzone', $product) }}"
            class="dropzone"
            id="myDropzone"
        >
            @csrf
        </form>
    </div>

    <x-wire-card>

        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            class="space-y-4"
        >
            @csrf
            @method('put')

            <x-wire-input
                label="Nombre"
                name="name"
                value="{{ old('name', $product->name) }}"
            />

            <x-wire-textarea label="Descripción" name="description">
                {{ old('description', $product->description) }}
            </x-wire-textarea>

            <x-wire-input
                label="Precio"
                name="price"
                type="number"
                step="0.01"
                value="{{ old('price', $product->price) }}"
            />

            <x-wire-native-select
                label="Categoría"
                name="category_id"
            >
                <option></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </x-wire-native-select>

            <div class="flex justify-end">
                <x-button>Actualizar</x-button>
            </div>
        </form>

    </x-wire-card>

    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush

    @push('js')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        <script>
        Dropzone.options.myDropzone = {
            addRemoveLinks: true,
            init: function () {
                let myDropzone = this;
                let images = @json($product->images);

                images.forEach(image => {
                    let mockFile = {
                        id: image.id,
                        name: image.path.split('/').pop(),
                        size: image.size,
                    };

                    // myDropzone.displayExistingFile(mockFile, `{{ Storage::url('${ image.path }') }}`);
                    myDropzone.displayExistingFile(mockFile, `{{ asset('storage/${ image.path }') }}`);
                    myDropzone.emit('complete', mockFile);
                    myDropzone.files.push(mockFile);
                });

                this.on('success', function(file, response) {
                    file.id = response.id;
                });

                this.on('removedfile', function(file) {
                    axios.delete(`/admin/images/${ file.id }`)
                        .then(response => {
                            console.log(response.data);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            },
        };
    </script>
    @endpush

</x-admin-layout>
