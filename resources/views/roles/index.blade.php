@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Roles</h2>
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-2">Create New Role</a>
    <table class="table table-bordered" id="roles-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {

    var table = $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('roles.data') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
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
    $(document).on('click','.delete-role', function() {
        var roleId = $(this).data('id');

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
                // Send AJAX request
                // $.ajax({
                //     url: '/roles/delete/' + roleId,
                //     type: 'get',
                //     success: function(response) {
                //         Swal.fire(
                //             'Deleted!',
                //             response.message,
                //             'success'
                //         ).then(() => {
                //             // Optionally reload the page or update the table
                //             location.reload(); // Example: Reload page
                //         });
                //     },
                //     error: function(xhr) {
                //         Swal.fire(
                //             'Error!',
                //             'Failed to delete role.',
                //             'error'
                //         );
                //     }
                // });

                $.ajax({
                    type: "GET",
                    url: "{{url('api/roles/delete/')}}" + '/' + roleId,
                    success: function (data) {
                        table.ajax.reload();
                    }         
                });
            }
        });
    });

    // $(document).on('click', '#delete-user', function (e) {
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     swal({
    //         title: "Are you sure?",
    //         text: "You want to delete the record!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //     .then((willDelete) => {
    //         if (willDelete) {
    //             $.ajax({
    //                 type: "GET",
    //                 url: "{{url('delete/')}}" + '/' + id,
    //                 success: function (data) {
    //                     table.ajax.reload();
    //                 }         
    //             });
    //         } 
    //     });
    // });
});
</script>
@endsection
