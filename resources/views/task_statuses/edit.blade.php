<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Изменение статуса
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <form action="{{ route('task_statuses.update', $taskStatus) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name', $taskStatus->name) }}">
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" dusk="update-task-status">Обновить</button>
        </form>
    </div>
</x-app-layout>
