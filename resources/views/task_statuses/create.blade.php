<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создание статуса
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <form action="{{ route('task_statuses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Создать</button>
        </form>
    </div>
</x-app-layout>
