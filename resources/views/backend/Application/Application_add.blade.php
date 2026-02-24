@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Catalogue </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Catalogue </li>
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
                            <form id="myForm" method="post" action="{{ route('store.application') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Catalogue Name</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="application_name" class="form-control" />
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Certificate Description</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
										<textarea type="text" name="application_description" class="form-control" id="editor1"></textarea>
									</div>
									
                                </div> --}}
                                {{-- <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Certificate Image </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="application_image" class="form-control" id="image" />
                                         <span class="text-danger">Image Size 415 X 557 px</span>
                                                <br/>
                                                                    <span style="color:red;">Please Select An Image Smaller Than 2 MB.
        </span>
                                    <br/>
                                    <span id="imageError" style="color: red; display: none;">Please select a valid image (Max 2MB, 415x557px, JPG/JPEG/PNG)</span>
                                    </div>
                                </div> --}}
                          
                                {{-- <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;">
                                    </div>
                                </div> --}}

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Catalogue PDF </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="application_pdf" class="form-control" id="pdf" />
                                        <span class="text-danger">The PDF should not be more than 2MB</span>
                                    </div>
                                </div>
                                

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <select class="form-select mb-3" aria-label="Default select example" name="status">
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

    <script type="text/javascript">
        $(document).ready(function () {
                $('#image').on('change', function () {
                    const file = this.files[0];
                    const maxSize = 2 * 1024 * 1024; // 2 MB
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    const errorElement = $('#imageError');
            
                    if (!file) return;
            
                    if (!allowedTypes.includes(file.type) || file.size > maxSize) {
                        errorElement.show();
                        $(this).val('');
                        return;
                    }
            
                    const img = new Image();
                    img.src = URL.createObjectURL(file);
                    img.onload = () => {
                        if (img.width !== 415 || img.height !== 557) {
                            errorElement.show();
                            $('#image').val('');
                        } else {
                            errorElement.hide();
                            mainThamUrl(document.getElementById('image')); // Preview function
                        }
                    };
                });
            });
    </script>

<script>
    $(document).ready(function() {
        CKEDITOR.replace('application_description');
    });
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                application_name: {
                    required : true,
                }, 
				application_image: {
                    required : true,
                }, 
            },
            messages :{
                application_name: {
                    required : 'Please Enter Catalogue Name',
                },
				application_image: {
                    required : 'Please Enter Certificate Image',
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
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
