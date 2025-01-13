@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>

        <div class="ps-3 pt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">All Category</li>
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

    <h6 class="mb-0 text-uppercase">All Category List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Image</th>
                            <th>Category Name</th>
                            <th>Category Status</th>
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($category as $key=> $item )
                            <tr>
                                <td>{{ $key+1 }}</td>

                                <td>
                                    <img src="{{ (!empty($item->image)) ? url('uploads/categories/'.$item->image) : 'https://dummyimage.com/450x450/f3f3f3/4f4f4f' }}" width="30" width="30" alt="">
                                </td>

                                <td>{{ $item->name }}</td>

                                <td>{{ $item->status }}</td>

                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm">
                                        <i class="bx bx-edit me-0"></i>
                                    </button>

                                    <button type="button" class="btn btn-outline-danger btn-sm">
                                        <i class="bx bx-trash me-0"></i>
                                    </button>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
