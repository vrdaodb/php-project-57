<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Изменение метки
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <form action="{{ route('labels.update', $label) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name">Имя</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $label->name) }}"
                >
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description">Описание</label>
                <textarea
                    name="description"
                    id="description"
                >{{ old('description', $label->description) }}</textarea>
            </div>

            <button type="submit">Обновить</button>
        </form>
    </div>
</x-app-layout>
