<x-app-layout>
    <div>
        <h1 class="text-2xl my-4">Просмотр задачи</h1>
        <h2 class="text-4xl my-4">{{ $task->name }}</h2>
        <p><b>Описание:</b> {{ $task->description }}</p>
        <p><b>Статус:</b> {{ $task->status->name }}</p>
        <p><b>Создатель:</b> {{ $task->created_by->name }}</p>
        <p><b>Исполнитель:</b> {{ $task->assigned_to->name }}</p>
        <p><b>Задача создана:</b> {{ $task->created_at }}</p>
        <p><b>Задача обновлена:</b> {{ $task->updated_at }}</p>
        <p>
            <b>Метки:</b> 
            <ul class="flex">
            @foreach ($task->marks as $mark)
                <li class="uppercase bg-indigo-200 text-indigo-600 px-3 mr-2 rounded-2xl">{{ $mark->name }}</li>
            @endforeach
            </ul>
        </p>
    </div>
</x-app-layout>