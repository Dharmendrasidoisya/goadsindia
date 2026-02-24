@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>


<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Testimonial </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Testimonial </li>
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

		<form id="myForm" method="post" action="{{ route('store.testimonial') }}" enctype="multipart/form-data" >
			@csrf
		 
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Testimonial Name <span style="color:red;">*</span></h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="testimonial_name" class="form-control"   />
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Testimonial Description <span style="color:red;">*</span></h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<textarea type="text" name="testimonial_description" class="form-control"></textarea>
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
			
			<div class="row mb-3" style="display: none;">
				<div class="col-sm-3">
					<h6 class="mb-0">Testimonial Image </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="testimonial_image" class="form-control"  id="image"   />
					<span class="text-danger">Image Size 424 X 500 px</span>
					<br/>
															<span style="color:red;">Please Select An Image Smaller Than 2 MB.
</span>
					     <br/>
						 <span id="imageError" style="color: red; display: none;">Please select a valid image (Max 2MB, 424x500px, JPG/JPEG/PNG)</span>
				</div>
			</div>



			<div class="row mb-3" style="display: none;">
				<div class="col-sm-3">
					<h6 class="mb-0"> </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					 <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;"  >
				</div>
			</div>





			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="btn btn-primary px-4" value="Save" />
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
											if (img.width !== 424 || img.height !== 500) {
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
					CKEDITOR.replace('testimonial_description');
				});
			</script>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                testimonial_name: {
                    required : true,
                }, 
				testimonial_description: {
                    required : true,
                }, 
            },
            messages :{
                testimonial_name: {
                    required : 'Please Enter testimonial Name',
                },
				testimonial_description: {
                    required : 'Please Enter testimonial Description',
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