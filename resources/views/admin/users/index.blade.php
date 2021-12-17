@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                
<table class="table table-responsive-sm">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Register Time</th>
        </tr>
    </thead>
<tbody>
    @foreach($users as $user)
<tr>
<td>{{$user->name}}</td>

<td>{{$user->email}}</td>
<td>{{$user->created_at}}</td>



</tr>
@endforeach
</tbody>
     </table> 
     {{$users->links()}}          
            </div>
        </div>
    </div>
</div>

@endsection