<x-app-layout>
    <div>
        <h1 class="text-4xl my-4">Создать метку</h1>
        {{ Form::model($mark, ['route' => 'marks.store']) }}
            {{ Form::label('name', 'Название', ['class' => 'font-bold']) }}<br>
            {{ Form::text('name') }}<br>
            {{ Form::submit('Создать', ['class' => 'inline-block rounded-lg bg-indigo-600 mt-6 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700']) }}
        {{ Form::close() }}
    </div>
</x-app-layout>