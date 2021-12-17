@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $page->title }}</div>

                <div class="card-body">
                    {!! $page->content !!}
<div class="m-icon"><i class="me-2 mdi mdi-help-circle-outline"></i><code
                                                class="me-2">f625</code><span>mdi-help-circle-outline</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection