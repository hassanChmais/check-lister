@extends('layouts.app')

@section('content')
<div class="container">

@livewire('header-totals-count', ['checklist_group_id' => $checklist->checklist_group_id])
                    
@livewire('check-list-show',['checklist' => $checklist] )

</div>
@endsection