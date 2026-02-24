@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Member</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Member</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.member') }}" class="btn btn-primary">Add Member</a> 				 
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
				<th>Image </th>
				<th>Name </th>
				<th>Email </th>
				<th>Phone </th>
				<th>Role </th>
				<th>Status </th> 
				<th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($alladminuser as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td> 
				<td> <img src="{{ (!empty($item->photo)) ? asset($item->photo): asset('upload/no_image.jpg')  }}" style="width: 70px; height:40px;" ></td>

				<td>{{ $item->name }}</td>
				<td>{{ $item->email }}</td>
				<td>{{ $item->phone }}</td>
				<td>  <span class="badge badge-pill" style="background-color: {{ $item->role === 'member' ? '#6c757d' : '#0d6efd' }}; padding:5px;">
					{{ $item->role }} </span>
				</td>

				<td>
					@if($item->status === 'active')
       					<span class="badge badge-pill bg-success">{{ $item->status}}</span>
					@else
						<span class="badge badge-pill btn-danger">{{ $item->status}}</span>
					@endif
				</td> 
				
				<td>
<a href="{{ route('edit.member.role',$item->id) }}" class="btn btn-info">Edit</a>
<a href="{{ route('view.member.role',$item->id) }}" class="btn btn-success">View</a>
<a href="{{ route('delete.member.role',$item->id) }}" class="btn btn-danger" id="delete" >Delete</a>

				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		{{-- <tfoot>
			<tr>
				<th>Sl</th>
				<th>Image </th>
				<th>Name </th>
				<th>Email </th>
				<th>Phone </th>
				<th>Status </th> 
				<th>Action</th> 
			</tr>
		</tfoot> --}}
	</table>
						</div>
					</div>
				</div>
 

				 
			</div>




@endsection