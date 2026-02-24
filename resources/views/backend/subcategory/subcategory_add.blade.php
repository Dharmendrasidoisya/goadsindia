@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

    <style>
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 100%;
        }
    </style>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Project </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add SubCategory </li>
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

                                <form id="myForm" method="post" action="{{ route('store.subcategory') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3" style=display:none;>
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option selected="">Open this select menu</option>

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
				<div class="col-sm-3" style=display:none;>
					<h6 class="mb-0">Application</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<select name="division_id[]" class="form-select mb-3 selectpicker" aria-label="Default select example" multiple data-live-search="true">
						<option >Open this select location</option>
						@foreach ($locations as $location)
							<option value="{{ $location->id }}">{{ $location->division_name }}</option>
						@endforeach
					</select>
				</div>
			</div> --}}
                                    <div class="row mb-3" style=display:none;>
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Application</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="application_id[]" class="form-select mb-3 selectpicker" aria-label="Default select example" multiple data-live-search="true">
                                                {{-- <option >Open this select Application</option> --}}
                                                @foreach($applications as $location)
                                                    <option value="{{ $location->id }}">{{ $location->application_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Product Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="subcategory_name" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Product Description</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea type="text" name="subcategory_description" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Product Image Thumb</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="subcategory_image" class="form-control"
                                                id="image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">On home page</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="onhome" id="onhome" value="1">
                                                <label class="form-check-label" for="active">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product maltipal Images</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="subcategory_images[]" class="form-control" id="images" multiple />
				</div>
			</div> 



                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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


    <script>
        $(document).ready(function() {
            CKEDITOR.replace('subcategory_description');
        });
    </script>
    <!-- Bootstrap and Bootstrap Select JS files -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    subcategory_name: {
                        required: true,
                    },
                },
                messages: {
                    subcategory_name: {
                        required: 'Please Enter SubCategory Name',
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
@endsection
