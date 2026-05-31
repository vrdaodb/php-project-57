<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Задачи') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">

        @if (session('success'))
            <div class="mb-4">
                {{ session('success') }}
            </div>
        @endif

        @auth
            <div class="mb-4">
                <a href="{{ route('tasks.create') }}">
                    Создать задачу
                </a>
            </div>
        @endauth

        <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">

            <div>
                <label for="filter[status_id]">Статус</label>
                <select name="filter[status_id]" id="filter[status_id]">
                    <option value="">Все</option>
                    @foreach ($statuses as $status)
                        <option
                            value="{{ $status->id }}"
                            @selected(request('filter.status_id') == $status->id)
                        >
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="filter[created_by_id]">Автор</label>
                <select name="filter[created_by_id]" id="filter[created_by_id]">
                    <option value="">Все</option>
                    @foreach ($users as $user)
                        <option
                            value="{{ $user->id }}"
                            @selected(request('filter.created_by_id') == $user->id)
                        >
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="filter[assigned_to_id]">Исполнитель</label>
                <select name="filter[assigned_to_id]" id="filter[assigned_to_id]">
                    <option value="">Все</option>
                    @foreach ($users as $user)
                        <option
                            value="{{ $user->id }}"
                            @selected(request('filter.assigned_to_id') == $user->id)
                        >
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">
                Применить
            </button>
        </form>

        <table class="table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Статус</th>
                    <th>Автор</th>
                    <th>Исполнитель</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>

                        <td>
                            <a href="{{ route('tasks.show', $task) }}">
                                {{ $task->name }}
                            </a>
                        </td>

                        <td>{{ $task->status->name }}</td>

                        <td>{{ $task->creator->name }}</td>

                        <td>{{ $task->assignedTo?->name }}</td>

                        <td>
                            {{ $task->created_at->format('d.m.Y') }}
                        </td>

                        <td>
                            @auth
                                <a href="{{ route('tasks.edit', $task) }}">
                                    Изменить
                                </a>
                            @endauth

                            @auth
                                @if ($task->created_by_id === auth()->id())
                                    <form
                                        method="POST"
                                        action="{{ route('tasks.destroy', $task) }}"
                                        style="display:inline"
                                        onsubmit="return confirm('Вы уверены?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit">
                                            Удалить
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
