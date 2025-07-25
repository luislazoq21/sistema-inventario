<div class="flex flex-wrap items-center gap-2">
    <x-wire-button href="{{ route('admin.warehouses.edit', $warehouse) }}" blue xs>
        Edit
    </x-wire-button>

    <form
        action="{{ route('admin.warehouses.destroy', $warehouse) }}"
        method="POST"
        class="delete-form"
    >
        @csrf
        @method('delete')


        <x-wire-button type="submit" red xs>
            Delete
        </x-wire-button>
    </form>
</div>
