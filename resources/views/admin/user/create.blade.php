@extends('layout.layout')

@section('title')
    {{-- Add New User --}}
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Fill The Form</h1>
    </div>
<div class="card-body">

    <form id="createUser" name="createUser" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
            <label class="form-lable">First Name:</label>
            <input type="text" value="{{ old('firstName') }}" class="form-control mb-3 @error('firstName') is-invalid @enderror" name="firstName" id="firstName" >
            {{-- <span class="text-danger error">
                @error('firstName')
                    {{$message}} 
                @enderror
            </span> --}}
            <span class="text-danger text-bold error"></span>
            </div>

            <div class="mb-3">
            <label class="form-lable">Last Name:</label>
            <input type="text" value="{{ old('lastName') }}" class="form-control mb-3 @error('lastName') is-invalid @enderror" name="lastName" id="lastName" >
            {{-- <span class="text-danger error">
                @error('lastName')
                    {{$message}} 
                @enderror
            </span> --}}
            <span class="text-danger text-bold error"></span>
            </div>

            <div class="mb-3">
            <label class="form-lable">Email:</label>
            <input type="email" value="{{ old('email') }}" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" id="email" >
            {{-- <span class="text-danger error">
                @error('email')
                    {{$message}} 
                @enderror
            </span>   --}}
            <span class="text-danger text-bold error"></span>
            </div>

            <div class="mb-3">
            <label class="form-lable">Password:</label>
            <input type="password" value="{{ old('password') }}" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" id="password" >
            {{-- <span class="text-danger error">
                @error('password')
                    {{$message}} 
                @enderror
            </span> --}}
            <span class="text-danger text-bold error"></span>
            </div>

            <div class="mb-3">
            <label class="form-lable">Phone Number:</label>
            <input type="number" value="{{ old('phoneNumber') }}" class="form-control mb-3 @error('phoneNumber') is-invalid @enderror" name="phoneNumber" id="phoneNumber" >
            {{-- <span class="text-danger error">
                @error('phoneNumber')
                    {{$message}} 
                @enderror
            </span> --}}
            <span class="text-danger text-bold error"></span>
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
                    <input class="form-check-input form_data" type="checkbox" id="writing-hobby" name="hobbies[]" value="1">
                    <label for="writing-hobby">Writing</label><br>
                    <input class="form-check-input form_data" type="checkbox" id="reading-hobby" name="hobbies[]" value="3">
                    <label for="reading-hobby">Reading</label><br>
                    <input class="form-check-input form_data" type="checkbox" id="coding-hobby" name="hobbies[]" value="2">
                    <label for="coding-hobby">Coding</label>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="country">Select Country:</label>
                <select name="country" id="country" class="form-control form_data" >
                    <option value="">Select Your Country</option>
                        <option value="India">India</option>
                        <option value="Pakistan">Pakistan</option>
                </select>
                {{-- <span class="text-danger error">
                    @error('country')
                        {{$message}} 
                    @enderror
                </span> --}}
            <span class="text-danger text-bold error"></span>
            </div>

            <div class="form-group mb-3">
                <label for="state">Select State:</label>
                <select name="state" id="state" class="form-control form_data" >
                    <option value="">Select Your State</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Maharastra">Maharastra</option>
                </select>
            {{-- <span class="text-danger error">
                @error('state')
                    {{$message}} 
                @enderror
            </span> --}}
            <span class="text-danger text-bold error"></span>
            </div>

            {{-- <div class="form-group mb-3">
                <label for="profile_pic">Upload Profile Picture:</label>
                <input class="form-control mb-2 @error('profilePicture') is-invalid @enderror" name="profilePicture" accept="image/*" type="file" value="profilePicture" id="profile" >
                <span class="text-danger error">
                    @error('profilePicture')
                        {{$message}} 
                    @enderror
                </span>
            </div> --}}

            <button class="btn btn-primary submit" type="submit" name="submit" value="submit" id="submit" data-resource="faq">Submit</button>
            <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>

    </form>

</div>
</div>
<div id="response"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
    $("#createUser").submit(function(e){
    e.preventDefault();
    let form = $('#createUser')[0];
    let data = new FormData(form);
    
    $.ajax({
        url: "{{ route('users.store') }}",
        type: "POST",
        data : data,
        dataType:"JSON",
        processData : false,
        contentType:false,
        
    success: function(response) {
       if(response.redirect){ 
        window.location.href = response.redirect;
       }
    },
    error: function(xhr, status, error) {
        // console.log(xhr);
        var response =  xhr.responseJSON;
        $(document).find("span.error").text('');
        if (response.errors) {
            $.each(response.errors, function(key, errors) {
                var errorSpan = $("#" + key).next(".error");
                errors.forEach(function(message) {
                    errorSpan.append("<div>" + message + "</div>");
                });
            });
            }
    }
    });

})
    });
</script>
    
@endsection
