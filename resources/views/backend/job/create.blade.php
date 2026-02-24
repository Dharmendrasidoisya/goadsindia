@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Job </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Job </li>
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
                                <form id="myForm" method="post" action="{{route('jobstore')}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Position</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input name="position" type="text"class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{old('position')}}"/>
                                            <span class="text-danger">
                                                @error("position")
                                                {{$message}}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Qualification</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input name="qualification" type="text" class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{old('qualification')}}"/>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Preffered Qualification</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input name="prefferedqualification" type="text" class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{old('prefferedqualification')}}"/>

                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Experience </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="experience" type="text" class="form-control"  value="{{old('experience')}}"/>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Location </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="location" type="text" class="form-control" data-rule-required="true" data-rule-minlength="3" value="{{old('location')}}"/>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Status</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-control" aria-label="Default select example" value="{{old('status')}}" name="status">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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



@endsection
