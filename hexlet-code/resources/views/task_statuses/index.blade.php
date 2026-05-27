<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task Statuses
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <a href="{{ route('task_statuses.create') }}" class="btn">Create</a>
        <table class="table w-full mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taskStatuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->name }}</td>
                    <td>{{ $status->created_at }}</td>
                    <td>
                        <a href="{{ route('task_statuses.edit', $status) }}">Edit</a>
                        <form action="{{ route('task_statuses.destroy', $status) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
