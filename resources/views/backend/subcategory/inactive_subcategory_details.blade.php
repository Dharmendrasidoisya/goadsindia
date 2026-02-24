@extends('admin.admin_dashboard')
@section('admin')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content"> 
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">InActive SubCategory Details</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">InActive SubCategory Details</li>
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

        <form method="post" action="{{ route('inactive.subcategory.approve') }}" enctype="multipart/form-data" >
            @csrf
        
        <input type="hidden" name="id" value="{{ $inactiveAdminDetails->id }}">
        
        <div class="row mb-3">
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
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Location</h6>
            </div>
            <div class="form-group col-sm-9 text-secondary">
                <select name="division_id[]" class="form-select mb-3 selectpicker" aria-label="Default select example"
                    multiple data-live-search="true">
                    {{-- <option>Open this select location</option> --}}
                    @foreach($locations as $location)
                    <option value="{{ $location->id }}"
                        {{ in_array($location->id, json_decode($subcategory->division_id)) ? 'selected' : '' }}>
                        {{ $location->division_name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
          

       <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">SubCategory Name</h6>
            </div>
            <div class="form-group col-sm-9 text-secondary">
                <input type="text" name="subcategory_name" class="form-control" value="{{ $subcategory->subcategory_name }}"   />
            </div>
        </div>
          
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">Category Description</h6>
            </div>
            <div class="form-group col-sm-9 text-secondary">
                
                                    <textarea name="subcategory_description" class="form-control ckeditor">{{ $subcategory->subcategory_description }}</textarea>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">SubCategory Image </h6>
            </div>
            <div class="col-sm-9 text-secondary">
                
                <input type="file" name="subcategory_image" class="form-control"  id="image"   />
                <img src="{{ asset($subcategory->subcategory_image) }}" alt="SubCategory Image" class="img-fluid">

            </div>
        </div>


            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                    <input type="submit" class="btn btn-danger px-4" value="active SubCategory" />
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