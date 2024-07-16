@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Customer</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-2">Create New Customer</a>
    <table class="table table-bordered" id="customer-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>State</th>
                <th>City</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {

    var table = $('#customer-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('customers.data') }}',
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
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Delete Role with AJAX and SweetAlert confirmation
    $(document).on('click','.delete-customer', function() {
        var customerId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "{{url('api/customers/delete/')}}" + '/' + customerId,
                    success: function (data) {
                        table.ajax.reload();
                    }         
                });
            }
        });
    });

});
</script>
@endsection
