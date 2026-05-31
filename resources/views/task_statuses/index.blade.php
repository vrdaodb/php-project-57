<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Статусы задач
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        @auth
    <a href="{{ route('task_statuses.create') }}">Создать статус</a>
@endauth

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
    @auth
        <a href="{{ route('task_statuses.edit', $status) }}" dusk="edit-task-status-{{ $status->id }}">Изменить</a>


        <form
    id="delete-status-{{ $status->id }}"
    action="{{ route('task_statuses.destroy', $status) }}"
    method="POST"
    style="display:none"
>
    @csrf
    @method('DELETE')
</form>

<a
    href="#"
    onclick="event.preventDefault();
             if (confirm('Вы уверены?')) {
                 document.getElementById('delete-status-{{ $status->id }}').submit();
             }"
>
    Удалить
</a>
    @endauth
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
