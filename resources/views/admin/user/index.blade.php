@extends('layout.user.add')

@section('title')
    View User Listing
@endsection

@section('content')

        <a href="{{route('users.create')}}" class="btn btn-primary btn-sm mb-3 mt-3">Add User</a>
        <a href="{{route('users.index')}}" class="btn btn-success btn-sm mb-3 mt-3">Active</a>
        <a href="{{route('users.index', ['is_active' => "false"])}}" class="btn btn-danger btn-sm mb-3 mt-3">In Active</a>

        <table class="table table-bordered table-striped">
            <tr>
                <th>Index</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Country</th>
                <th>State</th>
                <th>Hobbies</th>
                <th>Status</th>
                <th>Profile_picture</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

                @foreach ($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td> 
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->country->name}}</td>
                        <td>{{$user->state->name}}</td>
                        <td>
                            @foreach($user->hobbies as $hobby)
                                {{ $hobby->name }}
                            @endforeach        
                        </td>
                        <td> 
                            @if($user->status == 1)
                            Active
                            @else
                            In Active
                            @endif
                        </td>
                        <td>
                            <img class="img-thumbnail" src="{{ asset('/storage/'. $user->profile_picture) }}" height="100px" width="100px">
                        </td>
                        <td><a href="{{route('users.show' , $user->id )}}" class="btn btn-primary btn-sm">View</a></td>
                        <td><a href="{{route('users.edit' , $user->id )}}" class="btn btn-secondary btn-sm">Edit</a></td>
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
        <div class="mt-5">
            {{$users->links('pagination::bootstrap-5')}}
        </div>
@endsection