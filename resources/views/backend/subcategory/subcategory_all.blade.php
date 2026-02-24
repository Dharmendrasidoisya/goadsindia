@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.subcategory') }}" class="btn btn-primary">Add Product</a>
                </div>
                <button class="btn btn-danger" onclick="deleteSelected()" id="deleteButton" disabled>Delete</button>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
					<form id="deleteForm" action="{{ route('delete.selected.subcategories') }}" method="POST">
						@csrf
						@method('DELETE')
						<input type="hidden" name="ids" id="selectedIds">
                         <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
								<th></th>
                                <th>Sl</th>
                                <th style=display:none;>Category Name </th>
                                <th>Product Name </th>
                                <th>Product Image </th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $key => $item)
                                <tr>
									<td><input type="checkbox" name="selectedItems[]" value="{{ $item->id }}" onchange="updateDeleteButton()"></td>
                                    <td> {{ $key + 1 }} </td>
                                    <td style=display:none;> {{ $item->category_name }}</td>
                                    <td> {{ $item->subcategory_name }} </td>
                                    <td> <img src="{{ asset($item->subcategory_image) }}" style="width: 70px; height:40px;">
                                    </td>
                                    <td>
                                        <span class="badge badge-pill"
                                            style="background-color: {{ $item->status === 'active' ? 'green' : 'red' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('edit.subcategory', $item->id) }}" class="btn btn-info"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('delete.subcategory', $item->id) }}" class="btn btn-danger"
                                            id="delete"><i class="fas fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                        {{-- <tfoot>
			<tr>
				<th>Sl</th>
				<th style=display:none;>Category Name </th>
				<th>SubCategory Name </th>
				<th>Action</th> 
			</tr>
		</tfoot> --}}
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
	</script>
@endsection
