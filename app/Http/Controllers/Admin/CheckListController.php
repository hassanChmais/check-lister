<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChecklistRequest;
use App\Models\CheckListGroup ;
use App\Models\Checklist;
use App\Models\Task ;
use Illuminate\Contracts\View\View;
use Redirect;

class CheckListController extends Controller
{
    public function create(CheckListGroup $checklistGroup)
    {

        return view('admin.checklist.create',compact('checklistGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChecklistRequest $request,ChecklistGroup $checklistGroup)
    {
        
        $checklistGroup->checklists()->create($request->validated());
        return Redirect::back()->with('success','Successfully Inserted!');
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
    public function edit(CheckListGroup $checklistGroup,CheckList $checklist)
    {
        
        return view('admin.checklist.edit',compact('checklistGroup','checklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreChecklistRequest $request, CheckListGroup $checklistGroup,CheckList $checklist)
    {
        $checklist->update($request->validated());

return Redirect::back()->with('success','Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistGroup $checklistGroup, CheckList $checklist)
    {
       $checklist->delete();
       return Redirect::route('home')->with('success','Successfully Deleted!'); 
    }
}
