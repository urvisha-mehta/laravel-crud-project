@extends('layout.user.add')

@section('title')
    View User
@endsection

@section('content')
<table class="table table-bordered table-striped">
   <tr>
    <th width = "80px">First Name:</th>
    <td>{{$user->first_name}}</td>
   </tr>

   <tr>
    <th width = "80px">Last Name:</th>
    <td>{{$user->last_name}}</td>
   </tr>

   <tr>
    <th width = "80px">Email:</th>
    <td>{{$user->email}}</td>
   </tr>

   {{-- <tr>
    <th width = "80px">Password:</th>
    <td>{{$user->password}}</td>
   </tr> --}}

   <tr>
    <th width = "80px">Phone Number:</th>
    <td>{{$user->phone_number}}</td>
   </tr>

   <tr>
    <th width = "80px">Country:</th>
    <td>{{ $user->country->name }}</td>
   </tr>

   <tr>
    <th width = "80px">State:</th>
    <td>{{$user->state->name}}</td>
   </tr>

   <tr>
    <th width = "80px">Profile Picture:</th>
    <td>
        <img class="img-thumbnail" src="{{ asset('/storage/'. $user->profile_picture) }}" height="100px" width="100px">
    </td>
   </tr>

   <tr>
    <th width = "80px">Hobby:</th>
    <td> 
        @foreach($user->hobbies as $hobby)
            {{ $hobby->name }}
        @endforeach 
    </td>
   </tr>

</table>

<a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
@endsection
