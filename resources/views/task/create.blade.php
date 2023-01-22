<x-app-layout>
    <div>
        <h1 class="text-4xl my-4">Создать задачу</h1>
        {{ Form::model($task, ['route' => 'tasks.store']) }}
            {{ Form::label('name', 'Название', ['class' => 'font-bold']) }}<br>
            {{ Form::text('name') }}<br><br>

            {{ Form::label('description', 'Краткое описание', ['class' => 'font-bold']) }}<br>
            {{ Form::textarea('description', '', ['class' => 'h-24']) }}<br><br>

            {{ Form::label('status_id', 'Статус', ['class' => 'font-bold']) }}<br>
            {{ Form::number('status_id', 1) }}<br><br>

            {{ Form::label('created_by_id', 'Создатель', ['class' => 'font-bold']) }}<br>
            {{ Form::number('created_by_id', 1) }}<br><br>

            {{ Form::label('assigned_to_id', 'Исполнитель', ['class' => 'font-bold']) }}<br>
            {{ Form::number('assigned_to_id', 1) }}<br><br>

            <p class="font-bold">Метки</p>
            @foreach ($marks as $mark)
                {{ Form::checkbox('marks[]', $mark->id, false) }}
                {{ Form::label('marks[]', $mark->name, ['class' => 'mr-4']) }}
            @endforeach
            <br>
            
            {{ Form::submit('Создать', ['class' => 'inline-block rounded-lg bg-indigo-600 mt-6 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700']) }}
        {{ Form::close() }}
    </div>
</x-app-layout>