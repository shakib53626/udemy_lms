@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>

        <div class="ps-3 pt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Edit Sub Category</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('all.sub_category') }}" type="button" class="btn btn-primary btn-sm">
                <i class="bx bx-arrow-back pb-1" style="margin-right: -4px"></i>
                Back
            </a>
        </div>

    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Edit Sub category</h6>
    <hr/>
    <div class="card">

        <div class="card-body p-4">

            <form id="myForm" method="POST" action="{{ url('update/sub-category/'.$subCategory->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Sub Category Name</label>
                    <input type="text" class="form-control" id="input1" name="name" value="{{ $subCategory->name }}" placeholder="Sub Category Name">
                </div>

                <div class="form-group col-md-12">
                    <label for="input2" class="form-label">Sub Category Status</label>
                    <select id="input2" name="status" class="form-select">
                        <option value="" selected>Select One</option>
                        <option value="active" {{ old('status', $subCategory->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $subCategory->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="input2" class="form-label">Category</label>
                    <select id="input2" name="category_id" class="form-select">
                        <option value="">Select One</option>
                        @foreach ($categories as $catItem)
                            <option value="{{ $catItem->id }}" {{ (old('category_id', $subCategory->category_id ?? '') == $catItem->id) ? 'selected' : '' }}>{{ $catItem->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="input3" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="input3">
                    <img id="showImage" src="{{ (!empty($subCategory->image)) ? url($subCategory->image) : 'https://dummyimage.com/450x450/f3f3f3/4f4f4f' }}" class="p-1" width="80">
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
                category_id: {
                    required : true,
                },
                status: {
                    required : true,
                },

            },
            messages :{
                name: {
                    required : 'Name field is required',
                },
                status: {
                    required : 'Status field is required',
                },
                category_id: {
                    required : 'Category field is required',
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
