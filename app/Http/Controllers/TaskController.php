<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Mark;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all()->sortBy('id');
        $statuses = Status::all()->sortBy('id')->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $creators = User::all()->sortBy('id')->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $executors = User::all()->sortBy('id')->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $user = Auth::user();
        $isLoggedIn = Auth::check();
        return view('task.index', compact('tasks', 'statuses', 'creators', 'executors', 'isLoggedIn', 'user'));
    }

    public function filter(Request $request)
    {
        $tasks = Task::all()->sortBy('id');
        $statuses = Status::all()->sortBy('id')->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $creators = User::all()->sortBy('id')->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $executors = User::all()->sortBy('id')->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $user = Auth::user();
        $isLoggedIn = Auth::check();
        $status = $request->input('status');
        $creator = $request->input('creator');
        $executor = $request->input('executor');
        return view('task.index', compact('tasks', 'statuses', 'creators', 'executors', 'isLoggedIn', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $this->authorize('create', $task);
        $marks = Mark::all();
        return view('task.create', compact('task', 'marks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:statuses',
            'description' => 'required',
            'status_id' => 'required',
            'created_by_id' => 'required',
            'assigned_to_id' => 'required',
        ]);
        $task= new Task();
        $task->fill($data);
        $this->authorize('store', $task);
        $task->save();
        $task->marks()->sync($request->input('marks'));
        flash('Задача создана');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('edit', $task);
        $marks = Mark::all();
        return view('task.edit', compact('task', 'marks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks,name,' . $task->id,
            'description' => 'required',
            'status_id' => 'required',
            'created_by_id' => 'required',
            'assigned_to_id' => 'required',
        ]);
        $task->fill($data);
        $this->authorize('update', $task);
        $task->save();
        $task->marks()->sync($request->input('marks'));
        flash('Задача обновлена');
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $this->authorize('destroy', $task);
        if ($task) {
            $task->marks()->detach();
            $task->delete();
            flash('Задача удалена');
        } else {
            flash('Задача не может быть удалена')->error();
        }
        return redirect()->route('tasks.index');
    }
}
