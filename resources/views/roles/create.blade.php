@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Create New Role</h2>
    <form id="createRoleForm">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <!-- Add more fields as needed -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
$('#createRoleForm').validate({
    rules: {
        name: 'required',
        // Add other validation rules as needed
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
    submitHandler: function(form) {
        $.ajax({
            url: '{{ route('roles.store') }}',
            type: 'POST',
            data: $(form).serialize(),
            success: function(response) {
                // Handle success response
                console.log(response);
                window.location.href = "{{ route('roles.index') }}";
                // Optionally, redirect or update DataTable
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    }
});
</script>
@endsection
