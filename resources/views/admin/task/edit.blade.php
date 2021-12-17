@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
            	                       <div class="col-md-12" style="padding-right:18%;padding-left: 18%">
        @if (count($errors) > 0)
        <div class="alert alert-danger" >
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(Session::has('success'))
        <p class="alert alert-success">{{Session('success')}}</p>
        @endif

    </div>
                <div class="col-md-12">
                    <div class="card">

                        <form
                            action="{{ route('admin.checklists.tasks.update', [$checklist,$task]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">{{ __('Edit Task') }}</div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checklist-name">{{ __('Name') }}</label>
                                            <input value="{{ $task->name }}" class="form-control" name="name" type="text" id="checklist-name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="task-textarea">{{ __('Description') }}</label>
                                            <textarea id="editor" class="form-control" name="description" rows="5" id="task-textarea">{{ $task->description }}</textarea>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary" type="submit"> {{ __('Update Task') }}</button>
                            </div>
                        </form>
                    </div>
                </div></div></div></div>
@endsection
@section('scripts')

@include('admin.ckeditor')
@endsection