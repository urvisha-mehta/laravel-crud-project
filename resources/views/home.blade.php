@extends('layout')

@section('title')
    View User Listing
@endsection

@section('content')
        <a href="{{route('users.create')}}" class="btn btn-success btn-sm mb-3 mt-3">Add User</a>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Index</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Country</th>
                <th>State</th>
                <th>Profile Picture</th>
                <th>Hobbies</th>
                <th>View</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>

                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->firstName}}</td>
                        <td>{{$user->lastName}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>{{$user->phoneNumber}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->country}}</td>
                        <td>{{$user->state}}</td>
                        <td>{{$user->profilePicture}}</td>
                        <td>
                            @foreach($user->hobbies as $hobby)
                                {{ $hobby->{'hobby-name'} }}
                            @endforeach        
                        </td>
                        <td><a href="{{route('users.show' , $user->id )}}" class="btn btn-primary btn-sm">View</a></td>
                        <td><a href="{{route('users.edit' , $user->id )}}" class="btn btn-secondary btn-sm">Update</a></td>
                        <td>
                            <form action="{{route('users.destroy' , $user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>
@endsection