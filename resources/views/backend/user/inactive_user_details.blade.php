@extends('admin.admin_dashboard')
@section('admin')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Inactive Member Details</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Inactive Member Details</li>
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
			 
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">

		<form method="post" action="{{ route('active.user.approve') }}" enctype="multipart/form-data" >
			@csrf
		
		<input type="hidden" name="id" value="{{ $inactiveUserDetails->id }}">
		
			   <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">City Agency Name</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
	 	<select name="division_id" class="form-select mb-3" aria-label="Default select example">
			 <option selected="">Open this select menu</option>

			 @foreach($divisions as $division)
		 	<option value="{{ $division->id }}" {{ $division->id == $division->id ? 'selected' : '' }}>{{ $division->division_name }}</option>
		 	@endforeach
		 
								</select>
				</div>
			</div>
			
<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Member Name</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" readonly name="name" class="form-control" placeholder="Add Member Name" /  value="{{ old('name', $inactiveUserDetails->name) }}">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Father Name</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" readonly name="fathername" class="form-control" placeholder="Add Father Name" / value="{{ old('fathername', $inactiveUserDetails->fathername) }}">
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Photo</h6>
				</div>
				<div class="col-sm-9 text-secondary">
				
						<img src="{{ asset($inactiveUserDetails->photo) }}" width="70px" height="40px">
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">D.O.B.</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" readonly name="dob" class="form-control" placeholder="Add D.O.B." / value="{{ old('dob', $inactiveUserDetails->dob) }}">
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Phone </h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text"readonly  name="phone" class="form-control" placeholder="Add Phone Number" / value="{{ old('phone', $inactiveUserDetails->phone) }}">
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Address</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text" readonly name="address" class="form-control" placeholder="Add Address" / value="{{ old('address', $inactiveUserDetails->address) }}">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Email</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="email" readonly name="email" class="form-control" placeholder="Add Email" / value="{{ old('email', $inactiveUserDetails->email) }}">
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Account No</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="number" readonly name="acno" class="form-control" placeholder="Add Account No" / value="{{ old('acno', $inactiveUserDetails->acno) }}">
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Aadhar Card No</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="number" readonly name="aadharno" class="form-control" placeholder="Add Aadhar Card No" / value="{{ old('aadharno', $inactiveUserDetails->aadharno) }}">
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Work Experience</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<input type="text"readonly  name="workexp" class="form-control" placeholder="Add Work Experience" / value="{{ old('workexp', $inactiveUserDetails->workexp) }}">
				</div>
			</div>
            <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Asign Roles </h6>
				</div>
				<div class="col-sm-9 text-secondary">
		<select name="roles" class="form-select mb-3" aria-label="Default select example">
						<option selected="">Open this select menu</option>
						<option value="member" {{ old('role', $inactiveUserDetails->role) == 'member' ? 'selected' : '' }}>Member</option>
					</select>
				</div>
			</div>
 
  


			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="btn btn-danger px-4" value="Active Member" />
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



 


@endsection