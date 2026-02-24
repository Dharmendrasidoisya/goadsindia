@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Seo </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Seo </li>
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

                                <form id="myForm" method="post" action="{{ route('update.seo') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                    <input type="hidden" name="old_image" value="{{ $category->project_image }}">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">

                                            <select name="menu_home" class="form-select mb-3">
                                                <option value="0" {{ $category->menu_home == '0' ? 'selected' : '' }}>
                                                    Home</option>
                                                <option value="1" {{ $category->menu_home == '1' ? 'selected' : '' }}>
                                                    About Us</option>
                                                    <option value="3" {{ $category->menu_home == '3' ? 'selected' : '' }}>
                                                    Blogs</option>
                                                          {{-- <option value="7" {{ $category->menu_home == '7' ? 'selected' : '' }}>
                                                    Quality Assurance</option>
                                                         <option value="8" {{ $category->menu_home == '8' ? 'selected' : '' }}>
                                                    Infrastructure</option>
                                                    <option value="9" {{ $category->menu_home == '9' ? 'selected' : '' }}>
                                                    Custom Bearings</option> --}}
                                                <option value="2" {{ $category->menu_home == '2' ? 'selected' : '' }}>
                                                    Products</option>
                                                <option value="4" {{ $category->menu_home == '4' ? 'selected' : '' }}>
                                                    Contact Us</option>
                                                       {{-- <option value="5" {{ $category->menu_home == '5' ? 'selected' : '' }}>
                                                   Video Gallery</option> --}}
                                                     <option value="6" {{ $category->menu_home == '6' ? 'selected' : '' }}>
                                                     Gallery</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Meta Title</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="meta_title" class="form-control"
                                                value="{{ $category->meta_title }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Keyword</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="keyword" class="form-control"
                                                value="{{ $category->keyword }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Description</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea type="text" name="description" class="form-control">{{ $category->description }}</textarea>
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
                                            <h6 class="mb-0">Canonical</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="canonical" class="form-control"
                                                value="{{ $category->canonical }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Image </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="image" class="form-control"
                                                value="{{ $category->image }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Status</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select class="form-select mb-3" aria-label="Default select example" name="status">
                                                <option value="" selected="">--Select Menu--</option>

                                                <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                                <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    project_name: {
                        required: true,
                    },
                },
                messages: {
                    project_name: {
                        required: 'Please Enter Category Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
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
