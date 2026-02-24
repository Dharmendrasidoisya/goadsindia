@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Blogs/News Post</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Blogs/News  Post</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.blog.post') }}" class="btn btn-primary">Add</a> 				 
						</div>
						<button class="btn btn-danger" onclick="deleteSelected()" id="deleteButton" disabled style="display: none;">Delete</button>
						<button class="btn btn-success" onclick="activateSelected()" id="activateButton" disabled>Active</button>
						<button class="btn btn-warning" onclick="deactivateSelected()" id="deactivateButton" disabled>InActive</button>
					</div>
					</div>
				</div>
				<!--end breadcrumb-->
				 
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<form id="deleteForm" action="{{ route('delete.selected.categories') }}" method="POST">
								@csrf
								@method('DELETE')
								<input type="hidden" name="ids" id="selectedIds">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
				<th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> All</th>
				<th>Sl</th>
				<th>Post Category </th>
				<th>Post Image </th>
				<th>Post Title </th> 
				<th>Status </th> 
				<th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($blogpost as $key => $item)		
			<tr>
				<td style="width: 0px!important;"><input type="checkbox" name="selectedItems[]" value="{{ $item->id }}" onchange="updateDeleteButton()"></td> 
				<td style="width: 0px!important;"> {{ $key+1 }} </td>
				<td>{{ $item['blogcategory']['blog_category_name'] }}</td>
				<td> <img src="{{ asset($item->post_image) }}" style="width: 70px; height:40px;" >  </td>
				<td>{{ $item->post_title }}</td>
				<td>
					@if($item->status == 1)
						<span class="badge rounded-pill bg-success">Active</span>
					@else
						<span class="badge rounded-pill bg-danger">InActive</span>
					@endif
				</td>
				<td>
<a href="{{ route('edit.blog.post',$item->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
<a href="{{ route('delete.blog.post',$item->id) }}" class="btn btn-danger" id="delete" style="display: none;">Delete</a>

				</td> 
			</tr>
			@endforeach
			 
		 
		</tbody>

	</table>
							</form>
						</div>
					</div>
				</div>
 

				 
			</div>


			<script>
				function updateDeleteButton() {
					var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
					var deleteButton = document.getElementById('deleteButton');
					var activateButton = document.getElementById('activateButton');
					var deactivateButton = document.getElementById('deactivateButton');
			
					// Enable the buttons if at least one checkbox is checked
					var enableButtons = selectedItems.length > 0;
					deleteButton.disabled = !enableButtons;
					activateButton.disabled = !enableButtons;
					deactivateButton.disabled = !enableButtons;
				}
			
				function deleteSelected() {
					var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
					if (selectedItems.length === 0) {
						alert('Please select at least one item to delete.');
						return;
					}
			
					if (confirm('Are you sure you want to delete the selected items?')) {
						var ids = [];
						selectedItems.forEach(function(item) {
							ids.push(item.value);
						});
			
						document.getElementById('selectedIds').value = ids.join(',');
						document.getElementById('deleteForm').submit();
					}
				}
			
				function activateSelected() {
					var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
					if (selectedItems.length === 0) {
						alert('Please select at least one item to activate.');
						return;
					}
			
					if (confirm('Are you sure you want to activate the selected items?')) {
						var ids = [];
						selectedItems.forEach(function(item) {
							ids.push(item.value);
						});
			
						document.getElementById('selectedIds').value = ids.join(',');
						document.getElementById('deleteForm').action = "{{ route('activate.selected.blogpost') }}";
						document.getElementById('deleteForm').submit();
					}
				}
			
				function deactivateSelected() {
					var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
					if (selectedItems.length === 0) {
						alert('Please select at least one item to deactivate.');
						return;
					}
			
					if (confirm('Are you sure you want to deactivate the selected items?')) {
						var ids = [];
						selectedItems.forEach(function(item) {
							ids.push(item.value);
						});
			
						document.getElementById('selectedIds').value = ids.join(',');
						document.getElementById('deleteForm').action = "{{ route('deactivate.selected.blogpost') }}";
						document.getElementById('deleteForm').submit();
					}
				}
			
				function toggleSelectAll(selectAllCheckbox) {
					var checkboxes = document.querySelectorAll('input[name="selectedItems[]"]');
					checkboxes.forEach(function(checkbox) {
						checkbox.checked = selectAllCheckbox.checked;
					});
					updateDeleteButton();
				}
			</script>

@endsection