@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Category</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="" type="button" class="btn btn-primary">Settings</a>
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
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($category as $key=> $item )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="{{ $item->image }}" width="70" width="70" alt="">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>61</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
