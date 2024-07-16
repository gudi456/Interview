@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Edit Permission</h2>
    <form id="editPermissionForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="permission_id" id="permission_id" data-permission-id="{{ $permission->id }}">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}">
        </div>
        <!-- Add more fields as needed -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
$('#editPermissionForm').validate({
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
        var permissionId = $('#permission_id').data('permission-id');
        $.ajax({
            url: '{{ route('permissions.update', ':id') }}'.replace(':id', permissionId),
            type: 'PUT',
            data: $(form).serialize(),
            success: function(response) {
                // Handle success response
                console.log(response);
                window.location.href = "{{ route('permissions.index') }}";
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
