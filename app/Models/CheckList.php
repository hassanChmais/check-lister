<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckList extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','checklist_group_id','user_id','checklist_id'];

    public function checklist_group(){
        return $this->belongsTo(CheckListGroup::class , 'checklist_group_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class , 'checklist_id');
    }
        public function user_tasks()
    {
        return $this->hasMany(Task::class , 'checklist_id')->where('user_id',auth()->id())->whereNotNull('completed_at');
    }
}
