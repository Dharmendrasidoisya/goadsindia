@extends('admin.admin_dashboard')
@section('admin')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Active disivion Details</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Active disivion Details</li>
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

        <form method="post" action="{{ route('active.division.approve') }}" enctype="multipart/form-data" >
            @csrf
        
        <input type="hidden" name="id" value="{{ $inactiveAdminDetails->id }}">
        
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">division Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" class="form-control" name="division_name" value="{{ $inactiveAdminDetails->division_name }}"   />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0"> Division photo</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                 <img src="{{ (!empty($inactiveAdminDetails->division_logo)) ? asset($inactiveAdminDetails->division_logo): asset('upload/no_image.jpg')  }}" style="width: 70px; height:40px;" >

                    <!-- <input type="text" name="name" class="form-control" value="{{ $inactiveAdminDetails->name }}" /> -->
                </div>
            </div>
            <!-- <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Admin Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="email" name="email" class="form-control" value="{{ $inactiveAdminDetails->email }}" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Admin Phone </h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="phone" class="form-control" value="{{ $inactiveAdminDetails->phone }}" />
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Admin Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="address" class="form-control" value="{{ $inactiveAdminDetails->address }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Admin Join</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="admin_join" class="form-control" value="{{ $inactiveAdminDetails->admin_join }}" />
                </div>
            </div>

             


            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Admin Info</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <textarea name="admin_short_info" class="form-control" id="inputAddress2" placeholder="Admin Info " rows="3">
                    {{ $inactiveAdminDetails->admin_short_info }}
                </textarea>
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Admin Photo</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                     <img id="showImage" src="{{ (!empty($inactiveAdminDetails->photo)) ? url('upload/admin_images/'.$inactiveAdminDetails->photo):url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;"  >
                </div>
            </div> -->
 
  


            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                    <input type="submit" class="btn btn-danger px-4" value="Inactive division" />
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