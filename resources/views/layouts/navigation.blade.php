<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center space-x-6">

                <a href="{{ route('dashboard') }}">
                    Главная
                </a>

                <a href="{{ route('task_statuses.index') }}">
                    Статусы задач
                </a>

                <a href="{{ route('tasks.index') }}">
                    Задачи
                </a>

                <a href="{{ route('labels.index') }}">
                    Метки
                </a>

            </div>

            <div class="flex items-center space-x-4">

                @auth

                    <span>
                        {{ Auth::user()->name }}
                    </span>

                    @if (Route::has('profile.edit'))
    <a href="{{ route('profile.edit') }}">
        Профиль
    </a>
@endif

                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
    @csrf
</form>

<a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Выход
</a>

                @else

                    <a href="{{ route('login') }}" dusk="login">
                        Войти
                    </a>

                @endauth

            </div>

        </div>
    </div>
</nav>
