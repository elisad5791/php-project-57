<x-app-layout>
    <div>
        <h1 class="text-4xl mt-4">Статусы</h1>
        <a href="{{ route('statuses.create') }}" class="inline-block rounded-lg bg-indigo-600 mt-4 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">
            Создать
        </a>
        <table class="mt-4 table-fixed w-full max-w-screen-md border-collapse border border-slate-400">
            <tr class="font-bold bg-slate-100">
                <td class="border border-slate-300 p-3 w-20">ID</td>
                <td class="border border-slate-300 p-3">Имя</td>
                <td class="border border-slate-300 p-3">Дата создания</td>
                <td class="border border-slate-300 p-3">Действия</td>
            </tr>
            @foreach ($statuses as $status)
            <tr>
                <td class="border border-slate-300 p-3">{{$status->id}}</td>
                <td class="border border-slate-300 p-3">{{$status->name}}</td>
                <td class="border border-slate-300 p-3">{{$status->created_at}}</td>
                <td class="border border-slate-300 p-3">
                    <a href="{{ route('statuses.edit', ['status' => $status->id]) }}" class="text-indigo-600 hover:underline">Изменить</a>
                    {{ Form::model($status, ['route' => ['statuses.destroy', $status], 'method' => 'DELETE', 'class' => 'inline-block ml-4']) }}
                        {{ Form::submit('Удалить', ['class' => 'text-indigo-600 hover:underline']) }}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>