@extends('layout.user.add')

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
                    <input type="text" value="{{$user->first_name}}" class="form-control mb-3" name="first_name" id="first_name">
                    <span class="text-danger text-bold error"></span>
                </div>

                <div class="mb-3">
                    <label class="form-lable">Last Name:</label>
                    <input type="text" value="{{$user->last_name}}" class="form-control mb-3" name="last_name" id="last_name" >
                    <span class="text-danger text-bold error"></span>                        
                </div>
              
                <div class="mb-3">
                    <label class="form-lable">Email:</label>
                    <input type="email" value="{{$user->email}}" class="form-control mb-3" name="email" id="email">  
                    <span class="text-danger text-bold error"></span>                   
                </div>
              
                <div class="mb-3">
                    <label class="form-lable">Password:</label>
                    <input type="password" value="" class="form-control mb-3" name="password" id="password">
                    <span class="text-danger text-bold error"></span>                    
                </div>

                <div class="mb-3">
                    <label class="form-lable">Phone Number:</label>
                    <input type="number" value="{{$user->phone_number}}" class="form-control mb-3" name="phone_number" id="phone_number">
                    <span class="text-danger text-bold error"></span>   
                </div>
              
                <div class="form-group mb-3">
                    <label for="gender">Select Gender</label>
                        <div class="form-check">
                            <input class="form-check-input form_data" type="radio" id="male-gender" name="gender" {{ $user->gender == 'Male' ? 'checked' : '' }} value="Male">
                            <label for="male-gender">Male</label>
                        </div>
                    
                        <div class="form-check">
                            <input class="form-check-input form_data" type="radio" id="female-gender" name="gender" {{ $user->gender == 'Female' ? 'checked' : '' }} value="Female">
                            <label for="female-gender">Female</label>
                        </div>
                </div>
            
                <div class="form-group mb-3">
                    <label>Select Hobbies</label>
                    <div class="form-check">
                        @php
                        use App\Models\Hobby;
                        $hobbies = Hobby::get();
                        @endphp
                        @if (!empty($hobbies)) 
                            @foreach ($hobbies as $hobby) 
                                <input class="form-check-input" type="checkbox" name="hobbies[]"  {{ in_array($hobby->id, $userHobbies) ? 'checked' : null;}}  value="{{$hobby->id}}">{{$hobby->name}}<br>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="country">Select Country:</label>
                    <select name="country" id="country" class="form-control form_data">
                        <option value="">-- Select Country --</option>
                        @foreach ($countries as $country)
                        <option>
                            {{$country->name}}
                        </option>
                        @endforeach
                    </select>
                    <span class="text-danger text-bold error"></span>                  
                </div>
    
                <div class="form-group mb-3">
                    <label for="state">Select State:</label>
                    <select name="state" id="state" class="form-control form_data">
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
            url: "{{ route('users.update', $user->id) }}",
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
$('#country').on('change', function () {
                var idCountry = this.value;
                $("#state").html('');
                $.ajax({
                    url: "{{route('fetch-states')}}",
                    type: "GET",
                    data: {
                        country_id: idCountry,
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
    </script>
@endsection            