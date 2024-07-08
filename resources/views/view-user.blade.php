@extends('layout')

@section('title')
    View User
@endsection

@section('content')
<table class="table table-bordered table-striped">
   <tr>
    <th width = "80px">First Name:</th>
    <td>{{$users->firstName}}</td>
   </tr>

   <tr>
    <th width = "80px">Last Name:</th>
    <td>{{$users->lastName}}</td>
   </tr>

   <tr>
    <th>Email:</th>
    <td>{{$users->email}}</td>
   </tr>

   <tr>
    <th>Password:</th>
    <td>{{$users->password}}</td>
   </tr>

   <tr>
    <th>Phone Number:</th>
    <td>{{$users->phoneNumber}}</td>
   </tr>

   <tr>
    <th>Country:</th>
    <td>{{$users->country}}</td>
   </tr>

   <tr>
    <th>State:</th>
    <td>{{$users->state}}</td>
   </tr>

   <tr>
    <th>Profile Picture:</th>
    <td>{{$users->profilePicture}}</td>
   </tr>

   <tr>
    <th>Hobby:</th>
    <td> 
        @foreach($users->hobbies as $hobby)
            {{ $hobby->{"hobby-name"} }}
        @endforeach 
    </td>
   </tr>

</table>

<a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
@endsection
