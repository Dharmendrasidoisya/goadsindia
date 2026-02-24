@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit About Us</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit About Us</li>
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

		<form id="myForm" method="post" action="{{ route('update.about') }}" enctype="multipart/form-data" >
			@csrf
		 
		 <input type="hidden" name="id" value="{{ $category->id }}">
		 <input type="hidden" name="old_image" value="{{ $category->about_image }}">


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">About Us Title</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="about_name" class="form-control" value="{{ $category->about_name }}"   />
				</div>
			</div>
			  
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Description</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					
					<textarea name="about_description" class="form-control" id="editor1">{{ $category->about_description }}</textarea>
				</div>
			</div>
			{{-- <div class="row mb-3">
				<div class="col-sm-3">
			<h6 class="mb-0">Director's Desk</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					
					<textarea name="about_longdescription" class="form-control" id="editor2">{{ $category->about_longdescription }}</textarea>
				</div>
			</div> --}}

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Image</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="about_image" class="form-control"  id="image"   />
					<span class="text-danger">Image Size 580 X 546 px</span>
					<br/>
															<span style="color:red;">Please Select An Image Smaller Than 2 MB.
</span>
					     <br/>
						 <span id="imageError" style="color: red; display: none;">Please select a valid image (Max 2MB, 580x546px, JPG/JPEG/PNG)</span>
				</div>
			</div>



			{{-- <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0"> </h6>
				</div>
				<div class="col-sm-9 text-secondary">
  <img id="showImage" src="{{ asset($category->about_image)   }}" alt="Admin" style="width:100px; height: 100px;"  >
				</div>
			</div> --}}

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
											if (img.width !== 580 || img.height !== 546) {
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
					CKEDITOR.replace('about_description');
				});
			</script>
			<script>
				$(document).ready(function() {
					CKEDITOR.replace('about_longdescription');
				});
			</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                about_name: {
                    required : true,
                }, 
            },
            messages :{
                about_name: {
                    required : 'Please Enter About Name',
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