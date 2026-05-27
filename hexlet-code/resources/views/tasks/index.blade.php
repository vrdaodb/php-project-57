<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tasks
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <a href="{{ route('tasks.create') }}">Create</a>
        <table class="table w-full mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Creator</th>
                    <th>Assigned To</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                    <td>{{ $task->status->name }}</td>
                    <td>{{ $task->creator->name }}</td>
                    <td>{{ $task->assignedTo?->name }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                        @if($task->created_by_id === auth()->id())
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
