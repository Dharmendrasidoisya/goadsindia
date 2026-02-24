@extends('admin.admin_dashboard')
@section('admin')
<!--begin::Wrapper-->
<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

	<!--begin::Container-->
	<div class="container">
		<div class="row">
				<div class="col-lg-12">
					<!--begin::Card-->
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-header">
			<h3 class="card-title">Only View</h3>
		</div>
		<!--begin::Form-->
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<form method="post" action="{{route('jobupdate',$job->id)}}" enctype='multipart/form-data'>
							@csrf
							<div class="box-content">
								<div class="form-group-select">
									<label class="col-sm-3 col-lg-2 control-label" for="position">Position<span style="color: #a94442;">*</span></label>
									<div class="col-sm-6 col-lg-4 controls">
										<input name="position" type="text"class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{$job->position}}" readonly/>
										<span class="text-danger">
											@error("position")
											{{$message}}
											@enderror
										</span>
									</div>
								</div>
								<div class="form-group-select" style="display: none;">
									<label class="col-sm-3 col-lg-2 control-label" for="image">Image<span style="color: #a94442;">*</span></label>
									<div class="col-sm-6 col-lg-4 controls">
										<input name="image" oninput="pic.src=window.URL.createObjectURL(this.files[0])" type="file"class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{$job->image}}"/>
										<label><strong style="color:red">image size 800*400</strong></label>
										<img id="pic" src="{{asset('uploads/jobs/'.$job->image)}}" width="60px" height="60px">
										<span class="text-danger">
											@error("image")
											{{$message}}
											@enderror
										</span>
									</div>
								</div>
								<div class="form-group-select">
									<label class="col-sm-3 col-lg-2 control-label" for="qualification">Qualification</label>
									<div class="col-sm-6 col-lg-4 controls">
										<input name="qualification" type="text" class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{$job->qualification}}" readonly/>
						
									</div>
								</div>
                                <div class="form-group-select">
									<label class="col-sm-3 col-lg-2 control-label" for="prefferedqualification">Preffered Qualification</label>
									<div class="col-sm-6 col-lg-4 controls">
										<input name="prefferedqualification" type="text" class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{$job->prefferedqualification}}" readonly/>
						
									</div>
								</div>
                                <div class="form-group-select">
									<label class="col-sm-3 col-lg-2 control-label" for="experience">Experience</label>
									<div class="col-sm-6 col-lg-4 controls">
										<input name="experience" type="text" class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{$job->experience}}" readonly/>
						
									</div>
								</div>
                                <div class="form-group-select">
									<label class="col-sm-3 col-lg-2 control-label" for="location">Location</label>
									<div class="col-sm-6 col-lg-4 controls">
										<input name="location" type="text" class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{$job->location}}" readonly/>
						
									</div>
								</div>
								<div class="form-group-select">
									<label class="col-sm-3 col-lg-2 control-label">Status</label>
									<div class="col-sm-6 col-lg-4 controls">
									<select class="form-control" aria-label="Default select example"  name="status" readonly>
											<option value="1" {{$job->status == '1' ? 'selected': ''}}>Active</option>
											<option value="0" {{$job->status == '0' ? 'selected': ''}}>Inactive</option>
										</select>
									</div>
								</div>
								<hr>

								<div class="form-group-select" style="display: none;">
									<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
										<input type="submit"  value="Submit"  class="btn btn-primary" />
									</div>
								</div>

							</div>
						</form>
					</div>
				</div>

			</div>
		<!--end::Form-->
		</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
	<!--end::Container-->
</div>
<!--end::Wrapper-->
@endsection
