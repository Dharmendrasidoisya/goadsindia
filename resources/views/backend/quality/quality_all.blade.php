@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Quality</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Quality</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            {{-- <div class="btn-group">
                <a href="{{ route('add.testimonial') }}" class="btn btn-primary">Add</a>
            </div> --}}
            <button class="btn btn-success" onclick="activateSelected()" id="activateButton" disabled>Active</button>
            <button class="btn btn-warning" onclick="deactivateSelected()" id="deactivateButton" disabled>InActive</button>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <form id="bulkActionForm" method="POST">
                    @csrf
                    <input type="hidden" name="ids" id="selectedIds">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> All</th>
                                <th>Sl</th>
                                {{-- <th>Testimonial Name</th> --}}
                                <th>Quality Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banner as $key => $item)
                            <tr>
                                <td><input type="checkbox" name="selectedItems[]" value="{{ $item->id }}" onchange="updateActionButtons()"></td>
                                <td>{{ $key+1 }}</td>
                                {{-- <td>{{ $item->testimonial_name }}</td> --}}
                                {{-- <td>{!! html_entity_decode($item->testimonial_description) !!}</td> --}}
                                <td>{!! substr($item->testimonial_description, 0, 100) !!}...</td>
                                <td>
                                    @if($item->status == 1)
                                    <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit.quality', $item->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('delete.quality', $item->id) }}" class="btn btn-danger" id="delete" style="display: none;"><i class="fas fa-trash"></i></a>
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
    function updateActionButtons() {
        var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
        document.getElementById('activateButton').disabled = selectedItems.length === 0;
        document.getElementById('deactivateButton').disabled = selectedItems.length === 0;
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
            document.getElementById('bulkActionForm').action = "{{ route('activate.selected.quality') }}";
            document.getElementById('bulkActionForm').submit();
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
            document.getElementById('bulkActionForm').action = "{{ route('deactivate.selected.quality') }}";
            document.getElementById('bulkActionForm').submit();
        }
    }

    function toggleSelectAll(source) {
        checkboxes = document.querySelectorAll('input[name="selectedItems[]"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
        updateActionButtons();
    }
</script>

@endsection
