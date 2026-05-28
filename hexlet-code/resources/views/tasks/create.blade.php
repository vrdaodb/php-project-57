<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Task
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <form action="{{ route('tasks.store') }}" method="POST">
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
            <div class="mb-3">
                <label for="status_id">Status</label>
                <select name="status_id" id="status_id">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
                @error('status_id')<div>{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="assigned_to_id">Assigned To</label>
                <select name="assigned_to_id" id="assigned_to_id">
                    <option value="">None</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
    <div class="mb-3">
    <label for="labels">Labels</label>
    <select name="labels[]" id="labels" multiple>
        @foreach($labels as $label)
            <option value="{{ $label->id }}" {{ in_array($label->id, old('labels', [])) ? 'selected' : '' }}>
                {{ $label->name }}
            </option>
        @endforeach
    </select>
</div>
</x-app-layout>
