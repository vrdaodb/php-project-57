<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tasks
        </h2>
    </x-slot>
    <div class="container mx-auto py-4">
        <a href="{{ route('tasks.create') }}">Создать</a>

        <form method="GET" action="{{ route('tasks.index') }}">
            <div>
                <label for="filter[status_id]">Статус</label>
                <select name="filter[status_id]" id="filter[status_id]">
                    <option value="">All</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('filter.status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="filter[assigned_to_id]">Assigned To</label>
                <select name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                    <option value="">All</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('filter.assigned_to_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="filter[labels][id]">Label</label>
                <select name="filter[labels][id]" id="filter[labels][id]">
                    <option value="">All</option>
                    @foreach($labels as $label)
                        <option value="{{ $label->id }}" {{ request('filter.labels.id') == $label->id ? 'selected' : '' }}>
                            {{ $label->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Filter</button>
            <a href="{{ route('tasks.index') }}">Reset</a>
        </form>

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
