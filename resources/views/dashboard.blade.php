@extends('layouts.master')
@section('content')
<div class="container">
    <h2>User List</h2>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>State</th>
                <th>City</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    
    var token = localStorage.getItem('token');
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('users.data') }}',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            type: 'GET',
            dataType: 'json'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'email', name: 'email' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'state', name: 'state' },
            { data: 'city', name: 'city' },
        ],
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ]
    });

});
</script>
@endsection