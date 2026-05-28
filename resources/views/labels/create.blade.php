<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Label</h2>
    </x-slot>
    <div class="container mx-auto py-4">
        <form action="{{ route('labels.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')<div>{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
</x-app-layout>
