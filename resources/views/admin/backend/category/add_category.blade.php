@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>

        <div class="ps-3 pt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('all.category') }}" type="button" class="btn btn-primary btn-sm">
                <i class="bx bx-arrow-back pb-1" style="margin-right: -4px"></i>
                Back
            </a>
        </div>

    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Add a new category</h6>
    <hr/>
    <div class="card">

        <div class="card-body p-4">

            <form id="myForm" method="POST" action="{{ route('store.category') }}" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="input1" name="name" placeholder="Category Name">
                </div>

                <div class="form-group col-md-12">
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

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                image: {
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
                image: {
                    required : 'Image field is required',
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
