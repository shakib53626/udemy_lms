@extends('admin.admin_dashboard')
@section('admin')

<style>
    .large-checkbox{
        transform: scale(1.5);
    }
</style>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All User</div>

        <div class="ps-3 pt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">All Instructor</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('add.category') }}" type="button" class="btn btn-primary btn-sm">
                <i class="bx bx-plus pb-1" style="margin-right: -4px"></i>
                Add
            </a>
        </div>

    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">All Instructor List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allInstructor as $key=> $user )
                            <tr>
                                <td>{{ $key+1 }}</td>

                                <td>
                                    <img src="{{ (!empty($user->image)) ? url($user->image) : 'https://dummyimage.com/450x450/f3f3f3/4f4f4f' }}" width="30" width="30" alt="">
                                </td>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->username }}</td>

                                <td>{{ $user->email }}</td>

                                <td>{{ $user->address }}</td>

                                <td>
                                    <span style="padding: 0 10px;" class="btn btn-sm @if ($user->status == 1) btn-outline-success @else btn-outline-danger @endif">{{ $user->status == 1 ? "Active" : "Inactive" }}</span>
                                </td>

                                <td>

                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input status-toggle large-checkbox" type="checkbox" id="flexSwitchCheckChecked" data-user-id="{{ $user->id }}" {{ $user->status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                    </div>

                                    <button type="button" class="btn btn-outline-success btn-sm">
                                        <i class="bx bx-edit me-0"></i>
                                    </button>

                                    <a href="{{ route('destroy.category', $user->id) }}" id="delete" type="button" class="btn btn-outline-danger btn-sm">
                                        <i class="bx bx-trash me-0"></i>
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('.status-toggle').on('change', function(){
            var userId = $(this).data('user-id');
            var isChecked = $(this).is(':checked');

            // Send ajax request
            $.ajax({
                url: "{{ route('update.user.status') }}",
                method : "POST",
                data : {
                    user_id   : userId,
                    is_checked: isChecked ? 1: 0,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    toastr.success(response.message);

                    var statusCell = $(this).closest('tr').find('td').eq(6); // Adjust to target the correct 'status' column
                    if(isChecked) {
                        statusCell.html('<span style="padding: 0 10px;" class="btn btn-sm btn-outline-success">Active</span>');
                    } else {
                        statusCell.html('<span style="padding: 0 10px;" class="btn btn-sm btn-outline-danger">Inactive</span>');
                    }
                }.bind(this),
                error: function(){

                }
            })
        });
    });
</script>


@endsection
