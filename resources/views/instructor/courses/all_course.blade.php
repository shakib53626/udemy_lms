@extends('instructor.instructor_dashboard')
@section('instructor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Course</div>

        <div class="ps-3 pt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">All Course</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('add.course') }}" type="button" class="btn btn-primary btn-sm">
                <i class="bx bx-plus pb-1" style="margin-right: -4px"></i>
                Add
            </a>
        </div>

    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">All Course List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Course Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($courses as $key=> $item )
                            <tr>
                                <td>{{ $key+1 }}</td>

                                <td>
                                    <img src="{{ (!empty($item->course_image)) ? url($item->course_image) : 'https://dummyimage.com/450x450/f3f3f3/4f4f4f' }}" width="30" width="30" alt="">
                                </td>

                                <td>{{ $item->course_name }}</td>
                                <td>{{ $item->category_id }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->discount_price }}</td>

                                {{-- <td>
                                    <span style="padding: 0 10px;" class="btn btn-sm @if ($item->status == 'active') btn-outline-success @else btn-outline-danger @endif">{{ $item->status }}</span>
                                </td> --}}

                                <td>

                                    <button type="button" class="btn btn-outline-success btn-sm btn-edit-category" data-item='@json($item)' data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal">
                                        <i class="bx bx-edit me-0"></i>
                                    </button>

                                    <a href="{{ route('destroy.category', $item->id) }}" id="delete" type="button" class="btn btn-outline-danger btn-sm">
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

    <div class="col">

        <div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ps-4 pe-4">
                    <form id="myForm" method="POST" action="" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-12 mb-3">
                                <label for="input1" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="input1" name="name" placeholder="Category Name">
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <label for="input2" class="form-label">Category Status</label>
                                <select id="input2" name="status" class="form-select">
                                    <option value="" selected>Choose Status...</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input3" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="input3">
                                <img id="showImage" src="" class="p-1" width="80">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $('.btn-edit-category').on('click', function() {
    var item = $(this).data('item');
    $('#input1').val(item.name);
    $('#input2').val(item.status);

    if (item.image) {
        $('#showImage').attr('src', "{{ url('/') }}/" + item.image);
    } else {
        $('#showImage').attr('src', 'https://dummyimage.com/80x80/f3f3f3/4f4f4f');
    }

    // Update the form action URL dynamically
    $('#myForm').attr('action', "/update/category/" + item.id);
});
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                status: {
                    required : true,
                },

            },
            messages :{
                name: {
                    required : 'Please Enter Category Name',
                },
                status: {
                    required : 'Please Select Category Status',
                },


            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#input3').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>


@endsection
