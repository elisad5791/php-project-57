<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all()->sortBy('id');
        $isLoggedIn = Auth::check();
        return view('status.index', compact('statuses', 'isLoggedIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = new Status();
        $this->authorize('create', $status);
        return view('status.create', compact('status'));
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
        ]);
        $status= new Status();
        $status->fill($data);
        $this->authorize('store', $status);
        $status->save();
        flash('Статус создан');
        return redirect()->route('statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = Status::findOrFail($id);
        $this->authorize('edit', $status);
        return view('status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:statuses,name,' . $status->id,
        ]);
        $status->fill($data);
        $this->authorize('update', $status);
        $status->save();
        flash('Статус обновлен');
        return redirect()->route('statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $status = Status::find($id);
        $this->authorize('destroy', $status);
        if ($status && $status->tasks->isEmpty()) {
          $status->delete();
          flash('Статус удален');
        } else {
            flash('Статус не может быть удален')->error();
        }
        return redirect()->route('statuses.index');
    }
}
