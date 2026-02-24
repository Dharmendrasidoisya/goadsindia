@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit Product </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Product </li>
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

		<form id="myForm" method="post" action="{{ route('update.project') }}" enctype="multipart/form-data" >
			@csrf
		 
		 <input type="hidden" name="id" value="{{ $category->id }}">
		 <input type="hidden" name="old_image" value="{{ $category->project_image }}">
<div class="row mb-3">
   <div class="col-sm-3">
    <h6 class="mb-0">Product Category</h6>
</div>
<div class="form-group col-sm-9 text-secondary">
    <select name="category_id" class="form-select mb-3" aria-label="Default select example">
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ $cat->id == $category->category_id ? 'selected' : '' }}>
                {{ $cat->category_name }}
            </option>
        @endforeach
    </select>
</div>
</div>

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Name</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="project_name" class="form-control" value="{{ $category->project_name }}"   />
				</div>
			</div>
			  
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Description</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					
					<textarea name="project_description" class="form-control" id="editor1">{{ $category->project_description }}</textarea>
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Image </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="project_image" class="form-control"  id="image"   />
					<span class="text-danger">Image Size 856 X 450 px</span>
					<br/>
										<span style="color:red;">Please Select An Image Smaller Than 2 MB.
</span>
		<br/>
		<span id="imageError" style="color: red; display: none;">Please select a valid image (Max 2MB, 856x450px, JPG/JPEG/PNG)</span>
				</div>
			</div>



			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0"> </h6>
				</div>
				<div class="col-sm-9 text-secondary">
  <img id="showImage" src="{{ asset($category->project_image)   }}" alt="Admin" style="width:100px; height: 100px;"  >
				</div>
			</div>
	           <div class="row mb-3" style="display: none;">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Gallery</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="project_images[]" class="form-control" id="images" multiple />
					<!-- Display existing images for editing if available -->
							<div id="multipleImagesPreview">
					@if (!empty($category->project_images))
						@foreach(json_decode($category->project_images) as $image)
							<div class="image-container" style="position: relative; display: inline-block; margin-right: 5px;">
								<img src="{{ asset($image) }}" alt="SubCategory Image" class="img-fluid" style="width:100px; height: 100px; margin-top: 20px; margin-right: 15px;">
								{{-- <i class="fas fa-trash-alt delete-icon" data-image="{{ $image }}" style="position: absolute; top: 5px; right: 5px;"></i> --}}
								<i class="fa-solid fa-circle-xmark delete-icon"
								data-image="{{ $image }}"
								data-project-id="{{ $category->id }}"
								style="position: absolute; top: 10px; right: 0px; color: red; font-size: 20px; cursor: pointer;"></i>
							</div>
						@endforeach
					@endif
				</div>
			</div>
			   </div>

			{{-- <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product PDF </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="project_pdf" class="form-control" id="pdf" />
					@if(!empty($category->project_pdf))
					<div class="mt-2">
						<a href="{{ asset($category->project_pdf) }}" target="_blank">Current PDF: {{ basename($category->project_pdf) }}</a>
					</div>
					@else
					<div class="mt-2">
						No PDF is uploaded
					</div>
				@endif
					<span class="text-danger">The PDF should not be more than 2MB</span>
				</div>
			</div> --}}

			{{-- <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Video</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="project_video" class="form-control" value="{{ $category->project_video }}"   />
					<br/>
					<iframe  src="{{ $category->project_video }}" title="" frameborder="0" allow=""  allowfullscreen></iframe>  
				</div>
			</div> --}}

					<div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Sequence</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                       	<input type="text" name="sequence" class="form-control" value="{{ $category->sequence }}"   />
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
								if (img.width !== 856 || img.height !== 450) {
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

{{-- <script>
				$(document).ready(function() {
					CKEDITOR.replace('project_description');
				});
			</script> --}}

			<script>
				$(document).ready(function() {
					// Handle delete icon click event
					$('.delete-icon').on('click', function() {
						var imageUrl = $(this).data('image');      // Image URL to be deleted
						var projectId = $(this).data('project-id'); // Project ID
						var container = $(this).closest('.image-container'); // The image container
			
						if (confirm('Are you sure you want to delete this image?')) {
							$.ajax({
								url: '/delete/image/' + projectId,  // Correct URL for the route
								type: 'DELETE',  // DELETE request
								data: {
									_token: '{{ csrf_token() }}',  // Include CSRF token
									image_url: imageUrl            // Send image URL to delete
								},
								success: function(response) {
									alert(response.message);
									// Remove the image container on success
									container.remove();
								},
								error: function(xhr, status, error) {
									alert('An error occurred while deleting the image.');
								}
							});
						}
					});
				});
			</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                project_name: {
                    required : true,
                }, 
            },
            messages :{
                project_name: {
                    required : 'Please Enter Category Name',
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