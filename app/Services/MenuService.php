<?php

namespace App\Services ; 

use App\Models\Checklist;
use App\Models\CheckListGroup;
use App\Models\Task;
use Carbon\Carbon;
class MenuService

{
	
public function getMenu():array{

	        $checklistGroups = CheckListGroup::with(['checklists' => function($query){
                $query->whereNull('user_id');}
                ,
                'checklists.tasks' =>function($query){
                    $query->whereNull('user_id');
                },
                'checklists.user_tasks'
            ])->get() ;
            $checklists=Checklist::whereNull('user_id')->get();
            $last_action_at = auth()->user()->last_action_at;
/*if(is_null($last_action_at)){
    $last_action_at = now()->subYears(10);
}*/
$user_checklists=Checklist::where('user_id',auth()->id())->get();

            $groups = [];
            foreach ($checklistGroups->toArray() as $group) {
                $group_updated_at = $user_checklists->where('checklist_group_id', $group['id'])->max('updated_at');

                $group['is_new'] = $group_updated_at && Carbon::create($group['created_at'])->setTimezone('Asia/Beirut')->greaterThan($group_updated_at);

                $group['is_updated'] = !($group['is_new'])
                    && $group_updated_at
                    && Carbon::create($group['updated_at'])->setTimezone('Asia/Beirut')->greaterThan($group_updated_at);


               foreach ($group['checklists'] as &$checklist) {
                    $checklist_updated_at = $user_checklists->where('checklist_id', $checklist['id'])->max('updated_at');
                    if(!$checklist_updated_at){
                     $checklist['is_new'] = True ;
                     $checklist['is_updated'] = False;
                    }
                    else{
                    $checklist['is_new'] = !($group['is_new'])
                        && $checklist_updated_at
                        && Carbon::create($checklist['created_at'])->setTimezone('Asia/Beirut')->greaterThan($checklist_updated_at);
                    $checklist['is_updated'] = !($group['is_new']) && !($group['is_updated'])
                        && !($checklist['is_new'])
                        && $checklist_updated_at
                        && Carbon::create($checklist['updated_at'])->setTimezone('Asia/Beirut')->greaterThan($checklist_updated_at);
                    }

                    $checklist['tasks_count'] = count($checklist['tasks']);
                    $checklist['completed_tasks_count'] = count($checklist['user_tasks']);
                }

               $groups[] = $group ;
            }
        $user_tasks_menu = [];
        if (!auth()->user()->is_admin) {
            $user_tasks = Task::where('user_id', auth()->id())->get();
            $user_tasks_menu = [
                'my_day' => [
                    'name' => __('My Day'),
                    'icon' => 'sun',
                    'tasks_count' => $user_tasks->whereNotNull('added_to_my_day_at')->count()
                ],
                'important' => [
                    'name' => __('Important'),
                    'icon' => 'star',
                    'tasks_count' => $user_tasks->where('is_important', 1)->count()
                ],
                'planned' => [
                    'name' => __('Planned'),
                    'icon' => 'calendar',
                    'tasks_count' => $user_tasks->whereNotNull('due_date')->count()
                ],
            ];
        }

            return [
         'checklistGroups' => $checklistGroups,
         'user_menu' => $groups,
         'user_tasks_menu' =>$user_tasks_menu,
            ];

}
}