@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Category SEO</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Category SEO</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.categoryseo') }}" class="btn btn-primary">Add</a>
                </div>
                <button class="btn btn-danger" onclick="submitAction('delete')" id="deleteButton" disabled style="display: none;">Delete</button>
                <button class="btn btn-success" onclick="submitAction('activate')" id="activateButton" disabled>Active</button>
                <button class="btn btn-warning" onclick="submitAction('deactivate')" id="deactivateButton" disabled>InActive</button>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <form id="actionForm" method="POST">
                        @csrf
                        <input type="hidden" name="ids" id="selectedIds">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> All</th>
                                    <th>Sl</th>
                                    <th style="display: none;">Page</th>
                                    <th>Meta Title</th>
                                    {{-- <th>Meta Description</th>
                                    <th>Meta Keywords</th> --}}
                                    <th>Canonical</th>
                                    <th style="display: none;">Meta Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryseo as $key => $item)
                                    <tr>
                                        <td><input type="checkbox" name="selectedItems[]" value="{{ $item->id }}" onchange="updateDeleteButton()"></td>
                                        <td> {{ $key + 1 }} </td>
                                        <td style="display: none;">{{ $item->services_id }}</td>
                                        <td>{{ $item->meta_title }}</td>
                                        {{-- <td>{{ substr($item->meta_title, 0, 15) }}...</td> --}}
                                        {{-- <td>{!! $item->description !!}</td>
                                        <td>{{ $item->keyword }}</td> --}}
                                        {{-- <td>{{ $item->canonical }}</td> --}}
                                        <td>{{ substr($item->canonical, 0, 100) }}...</td>
                                        <td style="display: none;">{{ $item->image }}</td>
                                        <td>
                                            @if($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.categoryseo', $item->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
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
            var enableButtons = selectedItems.length > 0;

            document.getElementById('deleteButton').disabled = !enableButtons;
            document.getElementById('activateButton').disabled = !enableButtons;
            document.getElementById('deactivateButton').disabled = !enableButtons;
        }

        function submitAction(action) {
            var selectedItems = document.querySelectorAll('input[name="selectedItems[]"]:checked');
            if (selectedItems.length === 0) {
                alert('Please select at least one item.');
                return;
            }

            if (confirm('Are you sure you want to ' + action + ' the selected items?')) {
                var ids = [];
                selectedItems.forEach(function(item) {
                    ids.push(item.value);
                });

                document.getElementById('selectedIds').value = ids.join(',');

                var form = document.getElementById('actionForm');
                if (action === 'delete') {
                    form.action = "{{ route('delete.selected.categoryseo') }}";
                    form.method = 'POST';
                    form.submit();
                } else if (action === 'activate') {
                    form.action = "{{ route('activate.selected.categoryseo') }}";
                    form.method = 'POST';
                    form.submit();
                } else if (action === 'deactivate') {
                    form.action = "{{ route('deactivate.selected.categoryseo') }}";
                    form.method = 'POST';
                    form.submit();
                }
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
