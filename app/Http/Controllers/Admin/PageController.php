<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
 

 public function welcome(){
$page = Page::findOrfail(1);
return view('page',compact('page'));
 }
}
