@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add FAQ Product </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add FAQ Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto"></div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" method="post" action="{{ route('store.faqproduct') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Choose Category <span style="color:red;">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select" id="category_id">
                                                <option value="" selected>--Select Menu--</option>
                                                @foreach ($cat as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Choose Menu <span style="color:red;">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="services_id" class="form-select mb-3" id="product_id">
                                                <option value="" selected>Open this select menu</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <script>
                                                        document.getElementById('category_id').addEventListener('change', function () {
                                        const categoryId = this.value;
                                        const productSelect = document.getElementById('product_id');

                                        // Reset product dropdown
                                        productSelect.innerHTML = '<option value="" selected>Loading...</option>';

                                        if (categoryId) {
                                            fetch(`/get-products/${categoryId}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    productSelect.innerHTML = '<option value="">--Select Menu--</option>';
                                                    data.forEach(product => {
                                                        const option = document.createElement('option');
                                                        option.value = product.id;
                                                        option.textContent = product.project_name;
                                                        productSelect.appendChild(option);
                                                    });
                                                })
                                                .catch(error => console.error('Error fetching products:', error));
                                        }
                                    });

                                    </script>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Title <span style="color:red;">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="faqproduct_title" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Description</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea type="text" name="faqproduct_longdescriptions" id="editor1" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Status</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select class="form-select mb-3" name="status">
                                                <option value="" selected>--Select Menu--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    faqproduct_title: {
                        required : true,
                    },
                    services_id: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                },
                messages :{
                    faqproduct_title: {
                        required : 'Please Enter Title',
                    },
                    services_id: {
                        required : 'Please Choose Menu',
                    },
                    category_id: {
                        required : 'Please Choose Category',
                    },
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
