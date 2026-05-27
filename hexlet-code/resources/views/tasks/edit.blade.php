<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Task
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $task->name) }}">
                @error('name')<div>{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ old('description', $task->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status_id">Status</label>
                <select name="status_id" id="status_id">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ old('status_id', $task->status_id) == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="assigned_to_id">Assigned To</label>
                <select name="assigned_to_id" id="assigned_to_id">
                    <option value="">None</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to_id', $task->assigned_to_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>
