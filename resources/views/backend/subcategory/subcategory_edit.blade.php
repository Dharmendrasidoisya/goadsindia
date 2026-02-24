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
					<div class="breadcrumb-title pe-3">Edit SubCategory </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit SubCategory </li>
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

 <form id="myForm" method="post" action="{{ route('update.subcategory') }}" enctype="multipart/form-data" >
			@csrf

			<input type="hidden" name="id" value="{{ $subcategory->id }}">
	        <input type="hidden" name="old_image" value="{{ $subcategory->subcategory_image }}">
		 
			<div class="row mb-3" style="display:none;">
				<div class="col-sm-3">
					<h6 class="mb-0">Category Name</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
	 	<select name="category_id" class="form-select mb-3" aria-label="Default select example">
			 <option selected="">Open this select menu</option>

			 @foreach($categories as $category)
		 	<option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }} >{{ $category->category_name }}</option>
		 	@endforeach
		 
								</select>
				</div>
			</div>
			<div class="row mb-3" style="display:none;">
				<div class="col-sm-3">
					<h6 class="mb-0">Application</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<select name="application_id[]" class="form-select mb-3 selectpicker" aria-label="Default select example"
						multiple data-live-search="true">
						{{-- <option>Open this select Application</option> --}}
						@foreach($applications as $location)
						<option value="{{ $location->id }}"
							{{ $subcategory->application_id && in_array($location->id, json_decode($subcategory->application_id)) ? 'selected' : '' }}>
							{{ $location->application_name }}
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
					<input type="text" name="subcategory_name" class="form-control" value="{{ $subcategory->subcategory_name }}"   />
				</div>
			</div>
			  
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Description</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					
										<textarea name="subcategory_description" class="form-control ckeditor">{{ $subcategory->subcategory_description }}</textarea>

				</div>
			</div>

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Image Thumb</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					
					<input type="file" name="subcategory_image" class="form-control"  id="image"   />
					<img src="{{ asset($subcategory->subcategory_image) }}" alt="SubCategory Image" class="img-fluid" style="max-width:19% !important;">

				</div>
			</div>
			 <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Product Multiple Images</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="subcategory_images[]" class="form-control" id="images" multiple />
					<!-- Display existing images for editing if available -->
					@if (!empty($subcategory->subcategory_images))
						@foreach(json_decode($subcategory->subcategory_images) as $image)
							<div class="image-container" style="position: relative; display: inline-block; margin-right: 5px;">
								<img src="{{ asset($image) }}" alt="SubCategory Image" class="img-fluid" style="max-width:19% !important; margin-top: 5px;">
								<i class="fas fa-trash-alt delete-icon" data-image="{{ $image }}" style="position: absolute; top: 5px; right: 5px;"></i>
							</div>
						@endforeach
					@endif
				</div>
			</div> 
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">On home page</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="onhome" id="onhome" value="1" {{ $onhome == 1 ? 'checked' : '' }}>
						
					</div>
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


<script>
    $(document).ready(function() {
        $('.delete-icon').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var imageUrl = $(this).data('image');

            $.ajax({
                url: '{{ route("delete.image", ["id" => $subcategory->id]) }}',
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    image_url: imageUrl
                },
                success: function(response) {
                    // Remove the image from the table
                    $('img[src="' + imageUrl + '"]').closest('.swiper-slide').remove();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>



 


@endsection