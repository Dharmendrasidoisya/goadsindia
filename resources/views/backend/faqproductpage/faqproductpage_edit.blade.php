@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit FAQ Product Page </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit FAQ Product Page </li>
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

		<form id="myForm" method="post" action="{{ route('update.faqproductpage') }}" enctype="multipart/form-data" >
			@csrf
		 
		 <input type="hidden" name="id" value="{{ $category->id }}">
		 <input type="hidden" name="old_image" value="{{ $category->category_image }}">


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Name <span style="color:red;">*</span></h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="faqproductpage_title" class="form-control faqproductpage_title" value="{{ $category->faqproductpage_title }}"   />
					<div id="faqproductpageTitleError" style="color: red; display: none;">Title is required.</div>
				</div>
			</div>
			  

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Description</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<textarea name="faqproductpage_longdescription" class="form-control" id="editor1">{{ $category->faqproductpage_longdescription }}</textarea>
					<div id="faqproductpageDescriptionError" style="color: red; display: none;">Description is required.</div>
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
		

		</form>



	</div>
							</div>
						</div>
					</div>
				</div>
			</div>

             <script>
				$(document).ready(function() {
					CKEDITOR.replace('category_description');
				});
			</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to validate the form
        function validateForm() {
            let isValid = true;

            // Title validation
            const title = $('.faqproductpage_title').val().trim();
            if (title === '') {
                $('#faqproductpageTitleError').show();
                $('.faqproductpage_title').addClass('is-invalid');
                isValid = false;
            } else {
                $('#faqproductpageTitleError').hide();
                $('.faqproductpage_title').removeClass('is-invalid');
            }

            // // Description validation
            // const description = $('.faqproductpage_description').val().trim();
            // if (description === '') {
            //     $('#faqproductpageDescriptionError').show();
            //     $('.faqproductpage_description').addClass('is-invalid');
            //     isValid = false;
            // } else {
            //     $('#faqproductpageDescriptionError').hide();
            //     $('.faqproductpage_description').removeClass('is-invalid');
            // }

            return isValid;
        }

        // Validate on form submission
        $('#myForm').on('submit', function (e) {
            if (!validateForm()) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Live validation for Title
        $('.faqproductpage_title').on('input', function () {
            if ($(this).val().trim() !== '') {
                $('#faqproductpageTitleError').hide();
                $(this).removeClass('is-invalid');
            }
        });

        // Live validation for Description
        // $('.faqproductpage_description').on('input', function () {
        //     if ($(this).val().trim() !== '') {
        //         $('#faqproductpageDescriptionError').hide();
        //         $(this).removeClass('is-invalid');
        //     }
        // });
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