<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckListGroup extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name'];

    public function checklists(){
        return $this->hasMany(CheckList::class,'checklist_group_id');
    }
}
