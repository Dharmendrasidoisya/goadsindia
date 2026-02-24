@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Clients logo</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Clients logo</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.offer') }}" class="btn btn-primary">Add</a> 				 
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
				<th>Title </th>
				{{-- <th>Banner Url </th> --}}
				<th>Logo</th>
				<th>Status </th>
				<th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($banner as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td>{{ $item->offer_title }}</td>
				<td> <img src="{{ asset($item->offer_image) }}" style="width: 70px; height:40px;" >  </td>
				
				<td> @if($item->status == 1)
					<span class="badge rounded-pill bg-success">Active</span>
					@else
					<span class="badge rounded-pill bg-danger">InActive</span>
					@endif
				   </td>
				<td>
  {{-- @if(Auth::user()->can('brand.edit')) --}}
<a href="{{ route('edit.offer',$item->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
{{-- @endif --}}
 {{-- @if(Auth::user()->can('brand.edit')) --}}
<a href="{{ route('delete.offer',$item->id) }}" class="btn btn-danger" id="delete" style="display: none;"><i class="fas fa-trash"></i></a>
{{-- @endif --}}

				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>
		
	</table>
						</div>
					</div>
				</div>
 

				 
			</div>




@endsection