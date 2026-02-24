@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Clients Logo </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Clients Logo </li>
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

                                <form id="myForm" method="post" action="{{ route('update.offer') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $banner->id }}">
                                    <input type="hidden" name="old_img" value="{{ $banner->offer_image }}">

                                    <div class="row mb-3" style="display: none;">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Logo Title</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="offer_title" class="form-control"
                                                value="{{ $banner->offer_title }}" />
                                        </div>
                                    </div>

                                    {{-- <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Banner Url</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="banner_url" class="form-control" value="{{ $banner->banner_url }}"   />
				</div>
			</div> --}}


                                    {{-- <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Logo Image <span style="color:red;">*</span></h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="offer_image" class="form-control"  id="image"   />
					<span class="text-danger">Image Size 200 X 200 px</span>
						<br/>
					<span id="imageError" style="color: red; display: none;">Please select an image smaller than 2 MB.</span>
				</div>
			</div>



			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0"> </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					 <img id="showImage" src="{{ asset($banner->offer_image) }}" alt="Admin" style="width:100px; height: 100px;"  >
				</div>
			</div> --}}

                                    {{-- <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Logo Multiple Images</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="offer_images[]" class="form-control" id="image"
                                                multiple />
											        <span class="text-danger">Image Size 200 X 200 px</span>
					<br/>
					<span id="imageError" style="color: red; display: none;">Please select an image smaller than 2 MB.</span>
                                            <!-- Display existing images for editing if available -->
                                            <div id="multipleImagesPreview">
                                                @if (!empty($banner->offer_images))
                                                    @foreach (json_decode($banner->offer_images) as $image)
                                                        <div class="image-container existing-image-containe"
                                                            style="position: relative; display: inline-block; margin-right: 5px;">
                                                            <img src="{{ asset($image) }}" alt="Image" class="img-fluid"
                                                                style="width:100px; height: 100px; margin-top: 20px; margin-right: 15px;">
                                                            <i class="fa-solid fa-circle-xmark delete-icon"
                                                                data-image="{{ $image }}"
                                                                data-project-id="{{ $banner->id }}"
                                                                style="position: absolute; top: 10px; right: 0px; color: red; font-size: 20px; cursor: pointer;"></i>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}

									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">Logo Multiple Images</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="file" name="offer_images[]" class="form-control" id="image" multiple />
											        <span class="text-danger">Image Size 200 X 200 px</span>
																<br/>
															<span style="color:red;">Please Select An Image Smaller Than 2 MB.
</span>
					<br/>
                    <span id="imageError" style="color: red; display: none;">Please select a valid image (Max 2MB, 200x200px, JPG/JPEG/PNG)</span>
											<div id="multipleImagesPreview">
												@if (!empty($banner->offer_images))
												@foreach (json_decode($banner->offer_images) as $image)
														<div class="image-container existing-image-container"
															style="position: relative; display: inline-block; margin-right: 5px;">
															<img src="{{ asset($image) }}" alt="Project Image"
																class="img-fluid"
																style="width:100px; height: 100px; margin-top: 20px; margin-right: 15px;">
																<i class="fa-solid fa-circle-xmark delete-icon"
																data-image="{{ $image }}"
																data-project-id="{{ $banner->id }}"
																style="position: absolute; top: 10px; right: 0px; color: red; font-size: 20px; cursor: pointer;"></i>
															
														</div>
													@endforeach
												@endif
											</div>
										</div>
									</div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Status <span style="color:red;">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select class="form-select mb-3" aria-label="Default select example"
                                                name="status">
                                                <option value="" selected="">--Select Menu--</option>

                                                <option value="0" {{ $banner->status == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                                <option value="1" {{ $banner->status == '1' ? 'selected' : '' }}>
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
							if (img.width !== 200 || img.height !== 200) {
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
		$(document).ready(function () {
			$('.delete-icon').on('click', function () {
				var imageUrl = $(this).data('image');
				var projectId = $(this).data('project-id');
				var container = $(this).closest('.image-container');
	
				if (confirm('Are you sure you want to delete this image?')) {
					$.ajax({
						url: '/delete-image/' + projectId,
						type: 'DELETE',
						data: {
							_token: '{{ csrf_token() }}', // Laravel CSRF token
							image_url: imageUrl
						},
						success: function (response) {
							alert(response.message);
							// Remove image container on success
							container.remove();
						},
						error: function (xhr, status, error) {
							alert('An error occurred while deleting the image.');
						}
					});
				}
			});
		});
	</script>
	

    {{-- <script>
        $(document).ready(function() {
            // Handle delete icon click event
            $('.delete-icon').on('click', function() {
                var imageUrl = $(this).data('image');
                var projectId = $(this).data('project-id');
                var container = $(this).closest('.image-container');

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: '/delete-image/' + projectId, // Include project ID in the URL
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', // Laravel CSRF token
                            image_url: imageUrl
                        },
                        success: function(response) {
                            alert(response.message);
                            // Remove image container on success
                            container.remove();
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred while deleting the image.');
                        }
                    });
                }
            });
        });
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    offer_title: {
                        required: true,
                    },

                },
                messages: {
                    offer_title: {
                        required: 'Please Enter Banner Title',
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
