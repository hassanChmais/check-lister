<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Services\ChecklistService;

class ChecklistController extends Controller
{
    public function index(CheckList $checklist){
(new ChecklistService())->sync_checklist($checklist ,auth()->id());
return view('user.checklists.show',compact('checklist'));
    }
}

