@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Seo</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Seo</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.seo') }}" class="btn btn-primary">Add Seo</a>
                </div>
                <button class="btn btn-danger" onclick="deleteSelected()" id="deleteButton" disabled>Delete</button>

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
                                    <th></th>
                                    <th>Sl</th>
                                    <th style="display: none;">Page</th>
                                    <th>Meta Title</th>
                                    <th>Meta Description</th>
                                    <th>Meta Keywords</th>
                                    <th>Canonical</th>
                                    <th  style="display: none;">Meta Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($otherseo as $key => $item)
                                    <tr>
                                        <td><input type="checkbox" name="selectedItems[]" value="{{ $item->id }}"
                                                onchange="updateDeleteButton()"></td>
                                        <td> {{ $key + 1 }} </td>
                                        <td  style="display: none;">{{ $item->menu_home }}</td>
                                        <td>{{ $item->meta_title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->keyword }}</td>
                                        <td>{{ $item->canonical }}</td>
                                        <td  style="display: none;">{{ $item->image }}</td>
                                        <td> @if($item->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                            <span class="badge rounded-pill bg-danger">InActive</span>
                                            @endif
                                           </td>
                                    
                     
                                        <td>
                                            {{-- @if (Auth::user()->can('category.edit')) --}}
                                            <a href="{{ route('edit.seo', $item->id) }}" class="btn btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            {{-- @endif --}}
                                            {{-- @if (Auth::user()->can('category.delete')) --}}
                                            <a href="{{ route('delete.seo', $item->id) }}" class="btn btn-danger"
                                                id="delete"><i class="fas fa-trash"></i></a>
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
    </script>
@endsection
