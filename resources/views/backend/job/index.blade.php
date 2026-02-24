@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Job</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Job</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('jobcreate') }}" class="btn btn-primary">Add Job</a>
                </div>
                <!-- <button class="btn btn-danger" onclick="deleteSelected()" id="deleteButton" disabled>Delete</button> -->

            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <form id="deleteForm" action="{{ route('delete.selected.project') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="selectedIds">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th>Sl</th>
                                    <th>Position </th>
                                    <th>Qualification</th>
									<th>Preffered Qualification</th>
									<th>Experience</th>
									<th>Location</th>
									<th>Status</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ( $jobs as  $blog)
                                    <tr>
                                    <td style="display: none;"><input type="checkbox" class="check-item" value="{{$blog->id}}" name="checkbox[]"/></td>

                                    <td>{{$blog->id}}</td>
                                    <td>{{$blog->position}}</td>
                                    <td>{{$blog->qualification}}</td>
									<td>{{$blog->prefferedqualification}}</td>
														<td>{{$blog->experience}}</td>
														<td>{{$blog->location}}</td>
                                                        <td> @if($blog->status == 1)
                                                            <span class="badge rounded-pill bg-success">Active</span>
                                                            @else
                                                            <span class="badge rounded-pill bg-danger">InActive</span>
                                                            @endif
                                                           </td>
										 
                                        <td>
                                            {{-- @if (Auth::user()->can('category.edit')) --}}
                                            <a href="{{route('jobedit',$blog->id)}}" class="btn btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            {{-- @endif --}}
                                            {{-- @if (Auth::user()->can('category.delete')) --}}
                                            <a href="{{route('jobdestroy',$blog->id)}}" class="btn btn-danger"
                                                id="delete" style="display: none;"><i class="fas fa-trash"></i></a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>	
<script>
	
		$(document).on('click','#checkAll',function(){
			if(this.checked) {
				$('.check-item').each(function(){
					this.checked = true;
				})
			}else{
				$('.check-item').each(function(){
					this.checked = false;
				})
			}

			buttonisabled()

		})


		$(document).on('click','.check-item',function(){
		if($('.check-item').length === $('.check-item:checked').length){
			$('#checkAll').prop('checked',true);
		}else{
			$('#checkAll').prop('checked',false);
		}

		buttonisabled()
	})

	function buttonisabled(){
		if($('.check-item:checked').length>0){
			$('.dropdown-toggle').removeAttr('disabled')
		}else{
			$('.dropdown-toggle').attr('disabled',true)
		}
	}

	function submitFrom(url, status){
		// console.log(status)
		$.ajax({
			url:url,
			type:'post',
			data:$('#MyForm').serialize() + '&status='+ status,
			success:function (data) {
				if(data.success){
					toastr.success(data.success);
					let page = $('li.page-item.active.page-link').html();
					getData(page);
				}
			}
		})
	}

</script>
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
