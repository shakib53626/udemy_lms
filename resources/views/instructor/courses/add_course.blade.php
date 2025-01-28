@extends('instructor.instructor_dashboard')
@section('instructor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Course</div>

        <div class="ps-3 pt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('all.course') }}" type="button" class="btn btn-primary btn-sm">
                <i class="bx bx-arrow-back pb-1" style="margin-right: -4px"></i>
                Back
            </a>
        </div>

    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Add a new Course</h6>
    <hr/>
    <div class="card">

        <div class="card-body p-4">

            <form id="myForm" method="POST" action="{{ route('store.category') }}" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="form-group col-md-12">
                    <label for="course_name" class="form-label">Course Name</label>
                    <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name">
                </div>

                <div class="form-group col-md-12">
                    <label for="title" class="form-label">Course Title</label>
                    <input type="text" class="form-control" id="title" name="course_title" placeholder="Course Title">
                </div>

                <div class="form-group col-md-6">
                    <label for="category" class="form-label">Course Category</label>
                    <select id="category" name="category_id" class="form-select">
                        <option value="" selected>Select Category</option>

                        @foreach ($categories as $key=>$category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="category" class="form-label">Course Sub Category</label>
                    <select id="category" name="sub_category_id" class="form-select">
                        <option value="" selected>Select Sub Category</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="category" class="form-label">Certificate Available</label>
                    <select id="category" name="certificate" class="form-select">
                        <option value="" selected>Select Sub Category</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="input3" class="form-label">Image</label>
                    <input type="file" name="course_image" class="form-control" id="input3">
                    <img id="showImage" src="" class="p-1" width="80">
                </div>

                <div class="form-group col-md-4">
                    <label for="video" class="form-label">Course Intro Video</label>
                    <input type="file" class="form-control" id="video" name="video" accept="video/mp4, video/webm">
                </div>

                <div class="form-group col-md-4">
                    <label for="price" class="form-label">Selling Price</label>
                    <input type="text" class="form-control" id="price" name="selling_price" placeholder="Selling Price">
                </div>

                <div class="form-group col-md-4">
                    <label for="price" class="form-label">Discount Price</label>
                    <input type="text" class="form-control" id="price" name="discount_price" placeholder="Discount Price">
                </div>

                <div class="form-group col-md-4">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" class="form-control" id="duration" name="duration" placeholder="Course Duration">
                </div>

                <div class="form-group col-md-4">
                    <label for="resources" class="form-label">Resources</label>
                    <input type="text" class="form-control" id="resources" name="duration" placeholder="Course Resources">
                </div>

                <div class="form-group col-md-12">
                    <label for="prerequisites" class="form-label">Course Prerequisites</label>
                    <textarea name="prerequisites" class="form-control" id="prerequisites" cols="30" rows="3" placeholder="Course prerequisites"></textarea>
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
