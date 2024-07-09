@extends('layout.layout')

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
    <th width = "80px">Email:</th>
    <td>{{$users->email}}</td>
   </tr>

   {{-- <tr>
    <th width = "80px">Password:</th>
    <td>{{$users->password}}</td>
   </tr> --}}

   <tr>
    <th width = "80px">Phone Number:</th>
    <td>{{$users->phoneNumber}}</td>
   </tr>

   <tr>
    <th width = "80px">Country:</th>
    <td>{{$users->country}}</td>
   </tr>

   <tr>
    <th width = "80px">State:</th>
    <td>{{$users->state}}</td>
   </tr>

   {{-- <tr>
    <th width = "80px">Profile Picture:</th>
    <td>{{$users->profilePicture}}</td>
   </tr> --}}

   <tr>
    <th width = "80px">Hobby:</th>
    <td> 
        @foreach($users->hobbies as $hobby)
            {{ $hobby->{"hobby-name"} }}
        @endforeach 
    </td>
   </tr>

</table>

<a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
@endsection
