<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Checklist;
use App\Models\Task;
use Redirect ;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request,CheckList $checklist)
    {
        $position = $checklist->tasks->whereNull('user_id')->max('position') + 1;
        $checklist->tasks()->create($request->validated() + ['position' => $position]);
        return Redirect::back()->with('success','Successfully inserted task !');
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
    public function edit(CheckList $checklist,Task $task)
    {
       return view('admin.task.edit',compact('checklist','task')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request,CheckList $checklist,Task $task)
    {
        $task->update($request->validated());
        return Redirect::back()->with('success','Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckList $checklist,Task $task)
    {
        $checklist->tasks()->whereNull('user_id')->where('position','>',$task->position)->update(['position' => \DB::raw('position - 1')]);
        $task->delete();
        return Redirect::back()->with('success','Task Deleted Successfully');

    }
}
