@extends('layout')

@section('title')
    {{-- Add New User --}}
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Fill The Form</h1>
    </div>
<div class="card-body">
    <form action="{{route('users.store')}}" method="POST">
        @csrf

            <div class="mb-3">
            <label class="form-lable">First Name:</label>
            <input type="text" value="{{ old('firstName') }}" class="form-control mb-3 @error('firstName') is-invalid @enderror" name="firstName">
            <span class="text-danger">
                @error('firstName')
                    {{$message}} 
                @enderror
            </span>
            </div>

            <div class="mb-3">
                <label class="form-lable">Last Name:</label>
                <input type="text" value="{{ old('lastName') }}" class="form-control mb-3 @error('lastName') is-invalid @enderror" name="lastName">
                <span class="text-danger">
                @error('lastName')
                        {{$message}} 
                @enderror
            </span>
            </div>

            <div class="mb-3">
            <label class="form-lable">Email:</label>
            <input type="email" value="{{ old('email') }}" class="form-control mb-3 @error('email') is-invalid @enderror" name="email">
            <span class="text-danger">
                @error('email')
                    {{$message}} 
                @enderror
            </span>  
            </div>

            <div class="mb-3">
            <label class="form-lable">Password:</label>
            <input type="password" value="{{ old('password') }}" class="form-control mb-3 @error('password') is-invalid @enderror" name="password">
            <span class="text-danger">
                @error('password')
                    {{$message}} 
                @enderror
            </span>
            </div>

            <div class="mb-3">
            <label class="form-lable">Phone Number:</label>
            <input type="number" value="{{ old('phoneNumber') }}" class="form-control mb-3 @error('phoneNumber') is-invalid @enderror" name="phoneNumber">
            <span class="text-danger">
                @error('phoneNumber')
                    {{$message}} 
                @enderror
            </span>
            </div>

            <div class="form-group mb-3">
                <label for="gender">Select Gender</label>
                <div class="form-check">
                    <input class="form-check-input form_data" type="radio" id="male-gender" name="gender" value="Male" checked>
                    <label for="male-gender">Male</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input form_data" type="radio" id="female-gender" name="gender" value="Female">
                    <label for="female-gender">Female</label>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Select Hobbies</label>
                <div class="form-check">
                    <input class="form-check-input form_data" type="checkbox" id="writing-hobby" name="hobby-name[]" value="Writing">
                    <label for="writing-hobby">Writing</label><br>
                    <input class="form-check-input form_data" type="checkbox" id="reading-hobby" name="hobby-name[]" value="Reading">
                    <label for="reading-hobby">Reading</label><br>
                    <input class="form-check-input form_data" type="checkbox" id="coding-hobby" name="hobby-name[]" value="Coding">
                    <label for="coding-hobby">Coding</label>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="country">Select Country:</label>
                <select name="country" id="country" class="form-control form_data">
                    <option value="">Select Your Country</option>
                        <option value="India">India</option>
                        <option value="Pakistan">Pakistan</option>
                </select>
                <span class="text-danger">
                    @error('country')
                        {{$message}} 
                    @enderror
                </span>
            </div>

            <div class="form-group mb-3">
                <label for="state">Select State:</label>
                <select name="state" id="state" class="form-control form_data">
                    <option value="">Select Your State</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Maharastra">Maharastra</option>
                </select>
            <span class="text-danger">
                @error('state')
                    {{$message}} 
                @enderror
            </span>
            </div>

            <div class="form-group mb-3">
                <label for="profile_pic">Upload Profile Picture:</label>
                <input class="form-control mb-2 @error('profilePicture') is-invalid @enderror" accept="image/*" name="profilePicture" type="file" id="uploadImage" value="{{ old('profilePicture') }}">
                <span class="text-danger">
                    @error('profilePicture')
                        {{$message}} 
                    @enderror
                </span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>

    </form>

</div>
</div>
@endsection