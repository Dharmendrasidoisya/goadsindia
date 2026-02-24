@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Blogs/News SEO </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Blogs/News SEO </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" method="post" action="{{ route('store.blogseo') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select" id="categorySelect">
                                                <option value="">Select an option</option>
                                                @foreach($blogcategory as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->blog_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="post_id" class="form-select" id="postSelect">
                                                <option value="">Open this select menu</option>
                                            </select>
                                        </div>
                                    </div>

                                    

                                    
                                    {{-- <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Project Name </h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option selected="">Open this select menu</option>

                                                @foreach($projects as $category)
												@if($category->status == '1')
												<option data-value="{{$category->category_id}}" value="{{$category->id}}" >{{ $category->project_name}}</option>
												@endif
											@endforeach

                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Meta Title</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="meta_title" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Keyword</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="keyword" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Description</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea type="text" name="description" class="form-control"></textarea>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Canonical</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="canonical" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Schema</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea type="text" name="schema" class="form-control"></textarea>
                                        </div>

                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Meta Image </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="image" class="form-control"
                                                 />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Status</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select class="form-control" aria-label="Default select example" name="status">
                                                <option value="" selected="">--Select Menu--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#categorySelect').change(function() {
                var categoryId = $(this).val();
                var blogpost = @json($blogpost);
                var blogpostn = @json($blogpostn);
    
                $('#postSelect').empty();
                $('#postSelect').append('<option value="">Open this select menu</option>');
    
                if (categoryId == '1') {
                    $.each(blogpost, function(key, value) {
                        $('#postSelect').append('<option value="'+ value.id +'">'+ value.post_title +'</option>');
                    });
                } else if (categoryId == '2') {
                    $.each(blogpostn, function(key, value) {
                        $('#postSelect').append('<option value="'+ value.id +'">'+ value.post_title +'</option>');
                    });
                }
            });
        });
    </script>
    

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    meta_title: {
                        required : true,
                    },
                    post_id: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                },
                messages :{
                    meta_title: {
                        required : 'Please Enter Meta Title',
                    },
                    post_id: {
                        required : 'Please Choose Name',
                    },
                    category_id: {
                        required : 'Please Choose Category',
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
    {{-- <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    
@endsection
