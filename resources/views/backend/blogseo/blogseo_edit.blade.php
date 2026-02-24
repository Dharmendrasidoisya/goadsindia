@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Blogs/News SEO </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blogs/News SEO </li>
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

                                <form id="myForm" method="post" action="{{ route('update.blogseo') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $blogseo->id }}">
                                    <input type="hidden" name="old_image" value="{{ $blogseo->project_image }}">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select" id="categorySelect">
                                                <option value="">Select an option</option>
                                                @foreach($blogcategory as $cat)
                                                    <option value="{{ $cat->id }}" {{ $cat->id == $blogseo->category_id ? 'selected' : '' }}>
                                                        {{ $cat->blog_category_name }}
                                                    </option>
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
                                            <h6 class="mb-0">Category</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">

                                            <select name="category_id" class="form-control">
                                                <option value="Category" {{ $blogseo->category_id == 'Category' ? 'selected' : '' }}>
                                                    Category</option>
                                            </select>

                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Project Category</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                                                <option value="">Select a category</option> <!-- Optionally, you can add a default option -->
                                                @foreach ($projects as $category)
                                                    <option value="{{ $category->id }}" @if($category->id == $category->category_id) selected @endif>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Project Category</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select mb-3" aria-label="Project Category">
                                                @foreach ($projects as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $selectedCategoryId ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Meta Title</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="meta_title" class="form-control"
                                                value="{{ $blogseo->meta_title }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Keyword</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="keyword" class="form-control"
                                                value="{{ $blogseo->keyword }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Description</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea type="text" name="description" class="form-control">{{ $blogseo->description }}</textarea>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Canonical</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="canonical" class="form-control"
                                                value="{{ $blogseo->canonical }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Schema</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea type="text" name="schema" class="form-control">{{ $category->schema }}</textarea>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Image </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="image" class="form-control"
                                                value="{{ $blogseo->image }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Status</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select class="form-control" aria-label="Default select example" name="status">
                                                <option value="" selected="">--Select Menu--</option>

                                                <option value="0" {{ $blogseo->status == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                                <option value="1" {{ $blogseo->status == '1' ? 'selected' : '' }}>
                                                    Active</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Update" />
                                        </div>
                                    </div>
                            </div>

                            </form>



                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
    </script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function() {
                var blogpost = @json($blogpost);
                var blogpostn = @json($blogpostn);
                var selectedCategory = "{{ old('category_id', $selectedCategoryId) }}";
                var selectedPost = "{{ old('post_id', $selectedPostId) }}";
    
                $('#categorySelect').val(selectedCategory).change(function() {
                    var categoryId = $(this).val();
                    $('#postSelect').empty();
                    $('#postSelect').append('<option value="">Open this select menu</option>');
    
                    if (categoryId == '1') {
                        $.each(blogpost, function(key, value) {
                            $('#postSelect').append('<option value="'+ value.id +'" '+ (selectedPost == value.id ? 'selected' : '') +'> '+ value.post_title +'</option>');
                        });
                    } else if (categoryId == '2') {
                        $.each(blogpostn, function(key, value) {
                            $('#postSelect').append('<option value="'+ value.id +'" '+ (selectedPost == value.id ? 'selected' : '') +'> '+ value.post_title +'</option>');
                        });
                    }
                }).trigger('change'); // Trigger change to populate the posts based on the default category
    
                $('#postSelect').val(selectedPost); // Set the selected post based on the default or previously selected value
            });
        </script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                meta_title: {
                    required : true,
                },
            },
            messages :{
                meta_title: {
                    required : 'Please Enter Meta Title',
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
