<div class="flex flex-wrap items-center gap-2">
    <x-wire-button href="{{ route('admin.customers.edit', $customer) }}" blue xs>
        Edit
    </x-wire-button>

    <form
        action="{{ route('admin.customers.destroy', $customer) }}"
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
