<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Title</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- CSS for Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (necessary for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JS for Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <!-- Additional scripts and styles -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="registerForm"> 
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contactNumber" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ old('contact_number') }}" autocomplete="lastname">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" autocomplete="lastname">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State</label>
                            <div class="col-md-6">
                            <select id="state" name="state" class="form-control">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                            <div class="col-md-6">
                            <select id="city" name="city" class="form-control" disabled>
                                <option value="">Select City</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="male" name="gender" value="Male" checked>
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="Female">
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>
                                <!-- Add more radio buttons for other genders -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Hobbies') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hobby1" name="hobbies[]" value="Reading">
                                    <label class="form-check-label" for="hobby1">
                                        Reading
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hobby2" name="hobbies[]" value="Sports">
                                    <label class="form-check-label" for="hobby2">
                                        Sports
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hobby3" name="hobbies[]" value="Sports">
                                    <label class="form-check-label" for="hobby3">
                                        Traveling
                                    </label>
                                </div>

                                <!-- Add more checkboxes as needed -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="files" class="col-md-4 col-form-label text-md-right">{{ __('Files') }}</label>

                            <div class="col-md-6">
                                <input id="files" type="file" class="form-control" name="files[]" multiple>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>

                            <div class="col-md-6">
                                <select id="roles" class="form-control" name="roles[]" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                    <!-- Options will be dynamically loaded or manually added -->
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('user.login') }}">Login</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#roles').select2({
            placeholder: 'Select roles',
            tags: true 
        });

        $('#state').change(function() {
            var state_id = $(this).val();
            if(state_id) {
                $.ajax({
                    url: '{{ route("cities.state", ":state_id") }}'.replace(':state_id', state_id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city').empty().append('<option value="">Select City</option>');
                        $.each(data, function(index, city) {
                            $('#city').append('<option value="'+city.id+'">'+city.name+'</option>');
                        });
                        $('#city').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cities:', error);
                    }
                });
            } else {
                $('#city').empty().prop('disabled', true);
            }
        });

        

        $('#registerForm').validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                contact_number: {
                    required: true,
                    digits: true 
                },
                postcode: {
                    required: true,
                    digits: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8 // Example validation rule
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password' // Ensure password confirmation matches password
                },
                'hobbies[]': {
                    required: true,
                    minlength: 1 // At least one hobby must be selected
                },
                'roles[]': {
                    required: true,
                    minlength: 1
                },
                'files[]': {
                    required: true,
                },
            },
            messages: {
                firstname: {
                    required: "Please enter your first name.",
                },
                lastname: {
                    required: "Please enter your last name.",
                },
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address."
                },
                contact_number: {
                    required: "Please enter your contact number.",
                    digits: "Please enter only digits."
                },
                postcode: {
                    required: "Please enter your postcode.",
                    digits: "Please enter only digits."
                },
                state: {
                    required: "Please select your state."
                },
                city: {
                    required: "Please select your city."
                },
                password: {
                    required: "Please provide a password.",
                    minlength: "Your password must be at least 8 characters long."
                },
                password_confirmation: {
                    required: "Please confirm your password.",
                    equalTo: "Passwords do not match."
                },
                'hobbies[]': {
                    required: "Please select at least one hobby."
                },
                'roles[]': {
                    required: "Please select at least one role."
                },
                'files[]': {
                    required: "Please upload at least one file.",
                },
                gender: {
                    required: "Please select your gender."
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
        
        });

        $('#registerForm').submit(function(e) {
            e.preventDefault();
            if ($(this).valid()) {
                var formData = new FormData($('#registerForm')[0]);
                $.ajax({
                        url: "{{ route('register.user') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log({response});
                            alert(response.message);
                            localStorage.setItem('token', response.token);
                            localStorage.setItem('user', response.user);
                            // $('#registerForm').reset();
                            window.location.href = "{{ route('dashboard.index') }}";
                            $(form).find('.is-valid').removeClass('is-valid');
                        },
                        error: function(response) {
                            console.log(response);
                            alert('Something went wrong. Please try again.');
                        }
                    });

                }
        });
    });
</script>

</script>
</body>
</html>

