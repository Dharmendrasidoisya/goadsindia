@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Product Category</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Product Category</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
		<a href="{{ route('add.category') }}" class="btn btn-primary">Add</a> 				 
						</div>
						 <button class="btn btn-danger" onclick="deleteSelected()" id="deleteButton" disabled style="display: none;">Delete</button>
						 <button class="btn btn-success" onclick="activateSelected()" id="activateButton" disabled>Active</button>
						 <button class="btn btn-warning" onclick="deactivateSelected()" id="deactivateButton" disabled>InActive</button>

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
				<th>Category Name </th>
				<th>Sequence</th>
				<th>Category Image </th>
				<th>Status</th>
				{{-- <th>Status</th> --}}
				<th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($categories as $key => $item)		
			<tr>
			    <td><input type="checkbox" name="selectedItems[]" value="{{ $item->id }}" onchange="updateDeleteButton()"></td>       
				<td> {{ $key+1 }} </td>
				<td>{{ $item->category_name }}</td>
			    <td>{{ $item->sequence }}</td>
				<td> <img src="{{ asset($item->category_image) }}" style="width: 70px; height:40px;" >  </td>
				<td>
					@if($item->status == 1)
						<span class="badge rounded-pill bg-success">Active</span>
					@else
						<span class="badge rounded-pill bg-danger">InActive</span>
					@endif
				</td>
				{{-- <td>
					<span class="badge badge-pill" style="background-color: {{ $item->status === 'active' ? 'green' : 'red' }}">
						{{ $item->status }}
					</span>
				</td> --}}
				<td>
 {{-- @if(Auth::user()->can('category.edit')) --}}
<a href="{{ route('edit.category',$item->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
{{-- @endif --}}
{{-- @if(Auth::user()->can('category.delete')) --}}
<a href="{{ route('delete.category',$item->id) }}" class="btn btn-danger" id="delete" style="display: none;"><i class="fas fa-trash"></i></a>
{{-- @endif --}}

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
			
					// Enable the delete button if at least one checkbox is checked
					deleteButton.disabled = selectedItems.length === 0;
				}
			
				function deleteSelected() {
					var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
					if (selectedItems.length === 0) {
						alert('Please select at least one item to delete.');
						return;
					}
			
					// Display a confirmation dialog before proceeding with deletion
					if (confirm('Are you sure you want to delete the selected items?')) {
						var ids = [];
						selectedItems.forEach(function(item) {
							ids.push(item.value);
						});
			
						// Set the selected IDs to the hidden input field in the form
						document.getElementById('selectedIds').value = ids.join(',');
			
						// Submit the form
						document.getElementById('deleteForm').submit();
					}
				}
			
				// Toggle select all checkboxes
				function toggleSelectAll(selectAllCheckbox) {
					var checkboxes = document.querySelectorAll('input[name="selectedItems[]"]');
					checkboxes.forEach(function(checkbox) {
						checkbox.checked = selectAllCheckbox.checked;
					});
					updateDeleteButton(); // Update the delete button state
				}
			</script>
			
			
	
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
	
	function activateSelected() {
		var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
		if (selectedItems.length === 0) {
			alert('Please select at least one item to activate.');
			return;
		}
	
		// Display a confirmation dialog before proceeding with activation
		if (confirm('Are you sure you want to activate the selected items?')) {
			var ids = [];
			selectedItems.forEach(function(item) {
				ids.push(item.value);
			});
	
			// Set the selected IDs to the hidden input field
			document.getElementById('selectedIds').value = ids.join(',');
	
			// Submit the form to the activate route
			document.getElementById('deleteForm').action = "{{ route('activate.selected.category') }}";
			document.getElementById('deleteForm').submit();
		}
	}
	
	function deactivateSelected() {
		var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
		if (selectedItems.length === 0) {
			alert('Please select at least one item to deactivate.');
			return;
		}
	
		// Display a confirmation dialog before proceeding with deactivation
		if (confirm('Are you sure you want to deactivate the selected items?')) {
			var ids = [];
			selectedItems.forEach(function(item) {
				ids.push(item.value);
			});
	
			// Set the selected IDs to the hidden input field
			document.getElementById('selectedIds').value = ids.join(',');
	
			// Submit the form to the deactivate route
			document.getElementById('deleteForm').action = "{{ route('deactivate.selected.category') }}";
			document.getElementById('deleteForm').submit();
		}
	}
	
			</script>
			


@endsection