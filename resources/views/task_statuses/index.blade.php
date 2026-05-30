<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Статусы задач
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <a href="{{ route('task_statuses.create') }}">
            Создать
        </a>

        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taskStatuses as $status)
                    <tr>
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->created_at }}</td>
                        <td>
                            <a href="{{ route('task_statuses.edit', $status) }}">
                                Изменить
                            </a>

                            <form
                                action="{{ route('task_statuses.destroy', $status) }}"
                                method="POST"
                                style="display:inline"
                                onsubmit="return confirm('Вы уверены?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
