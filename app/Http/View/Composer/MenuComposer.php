<?php

namespace App\Http\View\Composer;

use App\Models\Checklist;
use App\Services\MenuService;
use Carbon\Carbon;
use Illuminate\View\View;

class MenuComposer{

public function compose(View $view){
	    $menu = (new MenuService())->getMenu();
        $view->with('checklistGroups', $menu['checklistGroups']);
        $view->with('user_menu', $menu['user_menu']);
        $view->with('user_tasks_menu',$menu['user_tasks_menu']);
}

}