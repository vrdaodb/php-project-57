<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Метки
        </h2>
    </x-slot>

    <div class="container mx-auto py-4">
        <a href="{{ route('labels.create') }}">Создать метку</a>

        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at }}</td>
                    @auth
                    <td>
                        <a href="{{ route('labels.edit', $label) }}">Изменить</a>

                        <form
                            action="{{ route('labels.destroy', $label) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Удалить
                            </button>
                        </form>
                    </td>
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
