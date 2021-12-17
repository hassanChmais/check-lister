<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class TasksTable extends Component
{
    public $checklist ;
    public function render()
    {
        $tasks = $this->checklist->tasks()->whereNull('user_id')->orderBy('position')->get();
        return view('livewire.tasks-table',compact('tasks'));
    }
        public function task_up($task_id)
    {
        $task = Task::find($task_id);
        if ($task) {
            Task::where('position', $task->position - 1)->update([
                'position' => $task->position
            ]);
            $task->update(['position' => $task->position - 1]);
        }
    }

    public function task_down($task_id)
    {
        $task = Task::find($task_id);
        if ($task) {
            Task::where('position', $task->position + 1)->update([
                'position' => $task->position
            ]);
            $task->update(['position' => $task->position + 1]);
        }
    }
}
