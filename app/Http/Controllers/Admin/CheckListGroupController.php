<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckListGroup ; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreChecklistGroupRequest;
use Redirect;

class CheckListGroupController extends Controller
{

    public function create()
    {
        return view('admin.checklist_groups.create');
    }
    public function store(StoreChecklistGroupRequest $request)
    {
        CheckListGroup::create($request->validated());
        return Redirect::back()->with('success','Successfully Inserted!');
    }

    public function edit(CheckListGroup $checklistGroup)
    {
        return view('admin.checklist_groups.edit',compact('checklistGroup'));
    }


    public function update(StoreChecklistGroupRequest $request,CheckListGroup $checklistGroup)
    {
        $checklistGroup->update($request->validated());
                return Redirect::back()->with('success','Successfully Updated!');
 
    }

    public function destroy(CheckListGroup $checklistGroup)
    {
       $checklistGroup->delete();
       return Redirect::route('admin.checklist_groups.create')->with('success','Successfully Deleted!');
    }
}
