<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompletedTasksCounter extends Component
{
    public $task_count ;
    public $checklist_id;
    public $completed_task;
    protected $listeners = ['task_complete' => 'recalculate_tasks'];

    public function render()
    {
        return view('livewire.completed-tasks-counter');
    }

    public function recalculate_tasks($task_id, $checklist_id, $count_change = 1)
    {
        if ($checklist_id == $this->checklist_id) {
            $this->completed_task += $count_change;
        }
    }
}
