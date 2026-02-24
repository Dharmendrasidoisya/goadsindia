@extends('admin.admin_dashboard')
@section('admin')
    @php
        $date = date('d-m-y');
        $today = App\Models\Order::where('order_date', $date)->sum('amount');

        $month = date('F');
        $month = App\Models\Order::where('order_month', $month)->sum('amount');

        $year = date('Y');
        $year = App\Models\Order::where('order_year', $year)->sum('amount');

        $pending = App\Models\Order::where('status', 'pending')->get();

        $vendor = App\Models\Member::where('status', 'active')->where('role', 'vendor')->get();
        $banner = App\Models\Banner::where('status', '1')->get();


        $customer = App\Models\Member::where('status', 'active')->where('role', 'member')->get();

        $product = App\Models\Project::where('status', '1')->get();

        $category = App\Models\Category::where('status', '1')->get();

        $application = App\Models\Services::where('status', '1')->get();

        $testimonial = App\Models\BlogPost::where('status', '1')->get();

        $otherseo = App\Models\Seo::where('status', '1')->get();

        $categoryseo = App\Models\Productseo::where('status', '1')->get();

        $subcategory = App\Models\Project::where('status', '1')->get();

        $productseo = App\Models\Servicesseo::where('status', '1')->get();

        $applicationseo = App\Models\Applicationseo::where('status', '1')->get();

    @endphp
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h1 class="mb-0 text-white">{{ count($category) }}</h1>
                            <div class="ms-auto">
                             <i class="bx bx-category text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <h2 class="mb-0 text-white">Categorys </h2>
                            {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h1 class="mb-0 text-white">{{ count($product) }}</h1>
                            <div class="ms-auto">
                              <i class="bx bx-category text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <h2 class="mb-0 text-white">Products</h2>
                            {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h1 class="mb-0 text-white">{{ count($application) }}</h1>
                            <div class="ms-auto">
                              <i class="bx bx-category text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <h2 class="mb-0 text-white">Gallery</h2>
                            {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h1 class="mb-0 text-white">{{ count($testimonial) }}</h1>
                            <div class="ms-auto">
                              <i class="bx bx-category text-white"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <h2 class="mb-0 text-white">Blogs</h2>
                            {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        @php
            $subcategory = App\Models\Project::where('status', '1')->orderBy('id', 'DESC')->limit(10)->get();
        @endphp

<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0">New Products</h5>
            </div>
            <div class="font-22 ms-auto">
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Sl</th>
                        <th>Image </th>
                        <th>Name </th>
                        {{-- <th>Email </th>
                                    <th>Phone </th> --}}
                        {{-- <th>Role </th> --}}
                        <th>Status </th>
                    </tr>
                </thead>


                <tbody>

                    @foreach ($subcategory as $key => $item)
                        <tr>
                            <td> {{ $key + 1 }} </td>
                            <td> <img
                                    src="{{ !empty($item->project_image) ? asset($item->project_image) : asset('upload/no_image.jpg') }}"
                                    style="width: 70px; height:40px;"></td>

                            <td>{{ $item->project_name }}</td>
                            {{-- <td>{{ $item->email }}</td>
        <td>{{ $item->phone }}</td> --}}
                            {{-- <td>  <span class="badge badge-pill" style="background-color: {{ $item->role === 'member' ? '#6c757d' : '#0d6efd' }}; padding:5px;">
            {{ $item->role }} </span>
        </td> --}}

        <td> @if($item->status == 1)
            <span class="badge rounded-pill bg-success">Active</span>
            @else
            <span class="badge rounded-pill bg-danger">InActive</span>
            @endif
           </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>

    

</div>
@endsection
