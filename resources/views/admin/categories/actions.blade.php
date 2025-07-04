<div class="flex flex-wrap items-center gap-2">
    <x-wire-button href="{{ route('admin.categories.edit', $category) }}" blue xs>
        Edit
    </x-wire-button>

    <form
        action="{{ route('admin.categories.destroy', $category) }}"
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
