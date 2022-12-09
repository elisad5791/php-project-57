<nav class="shadow">
    <div class="max-w-screen-xl md:flex items-center justify-between p-4 mx-auto">
        <div class="text-center">
            <a href="/" class="text-xl font-bold">Менеджер задач</a>
        </div>
        <ul class="flex justify-center mt-4 md:mt-0">
            <li><a href="{{ route('tasks.index') }}" class="text-base font-medium text-gray-700 hover:text-indigo-600 px-4">Задачи</a></li>
            <li><a href="{{ route('statuses.index') }}" class="text-base font-medium text-gray-700 hover:text-indigo-600 px-4">Статусы</a></li>
            <li><a href="{{ route('marks.index') }}" class="text-base font-medium text-gray-700 hover:text-indigo-600 px-4">Метки</a></li>
        </ul>
        @if (Route::has('login'))
            @auth
                <form method="POST" action="{{ route('logout') }}" class="flex justify-center mt-4 md:mt-0">
                    @csrf
                    <button type="submit" class="inline-block rounded-lg bg-indigo-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">
                        Выход
                    </button>
                </form>
            @else
                <div class="flex justify-center mt-4 md:mt-0">
                    <a href="{{ route('login') }}" class="inline-block rounded-lg bg-indigo-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">
                        Вход
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block rounded-lg bg-indigo-600 ml-2 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">
                            Регистрация
                        </a>
                    @endif
                </div>
            @endauth
        @endif
    </div>
</nav>
