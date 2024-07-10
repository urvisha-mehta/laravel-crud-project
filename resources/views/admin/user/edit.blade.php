@extends('layout.layout')

@section('title')
    Update User
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Update The Form</h1>
    </div>
        <div class="card-body">
            <form id="updateUser" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{--used for only update not working on read , add , delete --}}

                <div class="mb-3">
                <label class="form-lable">First Name:</label>
                <input type="text" value="{{$users->firstName}}" class="form-control mb-3 @error('firstName') is-invalid @enderror" name="firstName" id="firstName">
                    <span class="text-danger text-bold error"></span>
                </div>

                <div class="mb-3">
                <label class="form-lable">Last Name:</label>
                <input type="text" value="{{$users->lastName}}" class="form-control mb-3 @error('lastName') is-invalid @enderror" name="lastName" id="lastName" >
                    <span class="text-danger text-bold error"></span>                        
                </div>
              
                <div class="mb-3">
                <label class="form-lable">Email:</label>
                <input type="email" value="{{$users->email}}" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" id="email">  
                    <span class="text-danger text-bold error"></span>                   
                </div>
              
                <div class="mb-3">
                <label class="form-lable">Password:</label>
                <input type="password" value="" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" id="password">
                    <span class="text-danger text-bold error"></span>                    
                </div>

                <div class="mb-3">
                <label class="form-lable">Phone Number:</label>
                <input type="number" value="{{$users->phoneNumber}}" class="form-control mb-3 @error('phoneNumber') is-invalid @enderror" name="phoneNumber" id="phoneNumber">
                    <span class="text-danger text-bold error"></span>   
                </div>
              
                <div class="form-group mb-3">
                    <label for="gender">Select Gender</label>
                    <div class="form-check">
                        <input class="form-check-input form_data" type="radio" id="male-gender" name="gender" {{ $users->gender == 'Male' ? 'checked' : '' }} value="Male">
                        <label for="male-gender">Male</label>
                    </div>
    
                    <div class="form-check">
                        <input class="form-check-input form_data" type="radio" id="female-gender" name="gender" {{ $users->gender == 'Female' ? 'checked' : '' }} value="Female">
                        <label for="female-gender">Female</label>
                    </div>
                </div>
            
                <div class="form-group mb-3">
                    <label>Select Hobbies</label>
                    <div class="form-check">
                        <input class="form-check-input form_data" type="checkbox" id="writing-hobby" name="hobbies[1]" value="1" {{ in_array(1, $hobbies) ? 'checked' : '' }}>
                        <label for="writing-hobby">Writing</label><br>
                        <input class="form-check-input form_data" type="checkbox" id="reading-hobby" name="hobbies[3]" value="3" {{ in_array(3, $hobbies) ? 'checked' : '' }}>
                        <label for="reading-hobby">Reading</label><br>
                        <input class="form-check-input form_data" type="checkbox" id="coding-hobby" name="hobbies[2]" value="2" {{ in_array(2, $hobbies) ? 'checked' : '' }}>
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
                        <span class="text-danger text-bold error"></span>                  
                </div>
    
                <div class="form-group mb-3">
                    <label for="state">Select State:</label>
                    <select name="state" id="state" class="form-control form_data">
                        <option value="">Select Your State</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Maharastra">Maharastra</option>
                    </select>
                        <span class="text-danger text-bold error"></span>               
                </div>
    
                {{-- <div class="form-group mb-3">
                    <label for="profile_pic">Upload Profile Picture:</label>
                    <input class="form-control mb-2 @error('profilePicture') is-invalid @enderror" accept="image/*" name="profilePicture" type="file" id="uploadImage" value="profilePicture">
                    <span class="text-danger">
                        @error('profilePicture')
                            {{$message}} 
                        @enderror
                    </span>
                </div> --}}
              
                <button type="submit" class="btn btn-primary submit" id="submit" value="submit">Update</button>
                <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
<div id="response"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            
    <script>
        $(document).ready(function() {
        $("#updateUser").submit(function(e){
        e.preventDefault();
        let form = $('#updateUser')[0];
        let data = new FormData(form);
        
        $.ajax({
            url: "{{ route('users.update', $users->id) }}",
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