@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            @livewire('check-list-show', ['list_type' => $list_type])
        </div>
    </div>
@endsection
