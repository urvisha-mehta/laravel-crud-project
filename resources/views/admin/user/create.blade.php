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
    <div id="response"></div>

    <form id="createUser" name="createUser" enctype="multipart/form-data">
        @csrf

            <div class="mb-3">
            <label class="form-lable">First Name:</label>
            <input type="text" value="{{ old('firstName') }}" class="form-control mb-3 @error('firstName') is-invalid @enderror" name="firstName" id="first-name" >
            {{-- <span class="text-danger error">
                @error('firstName')
                    {{$message}} 
                @enderror
            </span> --}}
            <span class="text-danger text-bold error"></span>
            </div>

            <div class="mb-3">
            <label class="form-lable">Last Name:</label>
            <input type="text" value="{{ old('lastName') }}" class="form-control mb-3 @error('lastName') is-invalid @enderror" name="lastName" id="last-name" >
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
            <input type="number" value="{{ old('phoneNumber') }}" class="form-control mb-3 @error('phoneNumber') is-invalid @enderror" name="phoneNumber" id="phone-number" >
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
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
        // console.log(response);
    },
    error: function(xhr, status, error) {
        // console.log(xhr);
        var response =  xhr.responseJSON;
        if (response.errors) {
            var errorMsg = '';
            $.each(response.errors, function(field, errors) {
                $.each(errors, function(index, error) {
                    errorMsg += error + '<br>';
                });
            });
            document.getElementById("response").innerHTML = errorMsg;
            }
    }
    });

})
    });
</script>

{{-- <script type="text/javascript">
    $(document).ready(function () {
        if ($('#createUser').length > 0) {
            $('#createUser').validate({
                rules: {
                   firstName:"required",
                   lastName:"required",
                   email:{
                        required:true,
                        email:true
                   },
                   password:{
                        required:true,
                        minlength:6
                   },
                   phoneNumber:{
                        required:true,
                        minlength:10,
                        maxlength:10
                   }

                },
                messages: {
                    firstName:"Enter Your First Name",
                    lastName:"Enter Your Last Name",
                    email:{
                        required:"Enter Your Email",
                        email:"Enter Valid Email"
                    },
                    password:{
                        required:"Enter Your Password",
                        minlength:"Password Must Be 6 Character Long"
                    },
                    phoneNumber:{
                        required:"Enter Your Phone Number",
                        minlength:"Phone Number Must Be 10 Digit Long",
                        maxlength:"Phone Number Must Be 10 Digit Long"
                    }
                },

                submitHandler: function (form) {

                    form.submit();
                },
                errorPlacement: function (error, element) {
                    error.appendTo(element.parent());
                }
            });
        }
    });
</script> --}}
    
@endsection