@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Member</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Member</li>
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
							 
<div class="col-lg-8">
	<div class="card">
		<div class="card-body">

		<form method="post" action="{{ route('admin.member.stored') }}" enctype="multipart/form-data" id="myForm">
			@csrf
		
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">City Agency Name<span class="text-danger">*</span></h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
	 	<select name="division_id" class="form-select mb-3" aria-label="Default select example">
			 <option selected="">Open this select menu</option>

			 @foreach($divisions as $division)
		 	<option value="{{ $division->id }}">{{ $division->division_name }}</option>
		 	@endforeach
		 
								</select>
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Member Name<span class="text-danger">*</span></h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="name" class="form-control" placeholder="Add Member Name" />
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Father Name</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="fathername" class="form-control" placeholder="Add Father Name" />
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Photo<span class="text-danger">*</span></h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="file" name="photo" class="form-control"  id="image"   />
					<label style="color:red;">Photo size 250*250</label>
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">D.O.B.</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="date" name="dob" class="form-control" placeholder="Add D.O.B." />
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Phone </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="phone" class="form-control" placeholder="Add Phone Number" />
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Address</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="address" class="form-control" placeholder="Add Address" />
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Email<span class="text-danger">*</span></h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="email" name="email" class="form-control" placeholder="Add Email" />
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Account No</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="number" name="acno" class="form-control" placeholder="Add Account No" />
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Aadhar Card No</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="number" name="aadharno" class="form-control" placeholder="Add Aadhar Card No" />
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Work Experience</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" name="workexp" class="form-control" placeholder="Add Work Experience" />
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Asign Roles <span class="text-danger">*</span></h6>
				</div>
				<div class="col-sm-9 text-secondary">
		            <select name="role" class="form-select mb-3" aria-label="Default select example">
						<option selected="">Open this select menu</option>
						<option value="member">Member</option>
						<option value="vendor">Agent</option>

					</select>
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



			<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
			<script>
				$(document).ready(function () {
					$('#myForm').validate({
						rules: {
							division_id: {
								required: true
							},
							name: {
								required: true,
								minlength: 2,
								maxlength: 50
							},
							email: {
								required: true,
								email: true
							},
							// Add more rules for other fields as needed
						},
						messages: {
							division_id: {
								required: "Please select a City Agency Name"
							},
							name: {
								required: "Please enter Member Name",
								minlength: "Member Name must be at least 2 characters long",
								maxlength: "Member Name cannot exceed 50 characters"
							},
							email: {
								required: "Please enter Email",
								email: "Please enter a valid Email"
							},
							// Add more messages for other fields as needed
						},
						errorElement: 'span',
						errorPlacement: function (error, element) {
							error.addClass('invalid-feedback');
							element.closest('.form-group').append(error);
						},
						highlight: function (element, errorClass, validClass) {
							$(element).addClass('is-invalid').removeClass('is-valid');
						},
						unhighlight: function (element, errorClass, validClass) {
							$(element).removeClass('is-invalid').addClass('is-valid');
						}
					});
				});
			</script>



@endsection