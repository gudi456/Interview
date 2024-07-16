@extends('layouts.master')

@section('content')
    <h1>Role and Permission Management</h1>
    <form id="rolePermissionForm">
        @csrf
        <div id="rolesContainer">
            @foreach ($roles as $role)
                <div class="role" data-role-id="{{ $role->id }}">
                    <h2>{{ $role->name }}</h2>
                    <div class="permissions">
                        @foreach ($permissions as $permission)
                            <div>
                                <input type="checkbox" id="role{{ $role->id }}-permission{{ $permission->id }}" name="roles[{{ $role->id }}][]" value="{{ $permission->id }}" 
                                @if($role->permissions->contains($permission->id)) checked @endif>
                                <label for="role{{ $role->id }}-permission{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit">Save</button>
    </form>

    <div id="successMessage"></div>
    <div id="errorMessages"></div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#rolePermissionForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('role-permission.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#successMessage').text(response.message);
                        $('#errorMessages').empty();
                    },
                    error: function(response) {
                        $('#errorMessages').empty();
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#errorMessages').append('<p>' + value[0] + '</p>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
