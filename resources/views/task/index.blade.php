<x-app-layout>
    <div>
        <h1 class="text-4xl my-4">Задачи</h1>
        @if ($isLoggedIn)
        <a href="{{ route('tasks.create') }}" class="inline-block rounded-lg bg-indigo-600 mb-4 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">
            Создать
        </a>
        @endif
        {{ Form::open(['route' => 'tasks.filter']) }}
            {{ Form::select('status', $statuses, null, ['placeholder' => 'Статус']) }}
            {{ Form::select('creator', $creators, null, ['placeholder' => 'Автор']) }}
            {{ Form::select('executor', $executors, null, ['placeholder' => 'Исполнитель']) }}
            {{ Form::submit('Применить', ['class' => 'inline-block rounded-lg bg-indigo-600 ml-3 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700']) }}
        {{ Form::close() }}
        <table class="mt-4 table-fixed w-full border-collapse border border-slate-400">
            <tr class="font-bold bg-slate-100">
                <td class="border border-slate-300 p-3 w-20">ID</td>
                <td class="border border-slate-300 p-3">Имя</td>
                <td class="border border-slate-300 p-3">Статус </td>
                <td class="border border-slate-300 p-3">Создатель</td>
                <td class="border border-slate-300 p-3">Исполнитель</td>
                <td class="border border-slate-300 p-3">Дата создания</td>
                @if ($isLoggedIn)
                <td class="border border-slate-300 p-3">Действия</td>
                @endif
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td class="border border-slate-300 p-3">{{$task->id}}</td>
                <td class="border border-slate-300 p-3"><a href="{{ route('tasks.show', ['task' => $task->id]) }}" class="text-indigo-600 hover:underline">{{$task->name}}</a></td>
                <td class="border border-slate-300 p-3">{{$task->status->name}}</td>
                <td class="border border-slate-300 p-3">{{$task->created_by->name}}</td>
                <td class="border border-slate-300 p-3">{{$task->assigned_to->name}}</td>
                <td class="border border-slate-300 p-3">{{$task->created_at}}</td>
                @if ($isLoggedIn)
                <td class="border border-slate-300 p-3">
                    <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="text-indigo-600 hover:underline">Изменить</a>
                    @if ($task->created_by->is($user))
                    {{ Form::model($task, ['route' => ['tasks.destroy', $task], 'method' => 'DELETE', 'class' => 'inline-block ml-4']) }}
                        {{ Form::submit('Удалить', ['class' => 'text-indigo-600 hover:underline']) }}
                    {{ Form::close() }}
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>