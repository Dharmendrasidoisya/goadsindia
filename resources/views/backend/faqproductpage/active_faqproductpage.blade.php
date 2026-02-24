@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">All Active Category</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Active Category</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                         
                        </div>
                    </div>
                </div>
                <!--end breadcrumb-->
                 
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
            <tr>
                <th>Sl</th>
				<th>Category Name </th>
				<th>Category Image </th>
				<th>Status</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
        @foreach($inActiveUser as $key => $item)        
            <tr>
                <td> {{ $key+1 }} </td>
				<td>{{ $item->category_name }}</td>
				<td> <img src="{{ asset($item->category_image) }}" style="width: 70px; height:40px;" >  </td>
				<td>
                    <span class="badge badge-pill" style="background-color: {{ $item->status === 'active' ? 'green' : 'red' }}">
                        {{ $item->status }}
                    </span>
                </td>
                
                <td>
                <a href="{{ route('active.category.details',$item->id) }}" class="btn btn-info">Category Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>Sl</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status </th>  
                <th>Action</th> 
            </tr>
        </tfoot> -->
    </table>
                        </div>
                    </div>
                </div>
            </div>




@endsection