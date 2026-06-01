<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $task->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <p>Status: {{ $task->status->name }}</p>
        <p>Description: {{ $task->description }}</p>
        <p>Creator: {{ $task->creator->name }}</p>
        <p>Assigned To: {{ $task->assignedTo?->name }}</p>
        <p>Labels: {{ $task->labels->pluck('name')->join(', ') }}</p>
        <a href="{{ route('tasks.edit', $task) }}">Изменить</a>
    </div>
</x-app-layout>
