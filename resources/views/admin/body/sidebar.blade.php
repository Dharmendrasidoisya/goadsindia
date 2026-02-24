<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            {{-- <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon"> --}}
            <img src="{{ asset('images/logo-white.png') }}" class="logo-icon" alt="logo icon" style="width:30%; height:auto;">

        </div>
        {{-- <div>
            <h4 class="logo-text">Admin</h4>
        </div> --}}
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashobard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>



        {{-- @if (Auth::user()->can('brand.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('brand.list')) --}}
                <li> <a href="{{ route('all.brand') }}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('brand.add')) --}}
                <li> <a href="{{ route('add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand </a>
                </li>
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
        <hr>
        {{-- @if (Auth::user()->can('cat.menu')) --}}
           <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-image"></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('ads.list')) --}}
                <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
                <li> <a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>List Banner</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('ads.add')) --}}
                
                {{-- @endif --}}
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-camera" aria-hidden="true"></i>

                </div>
                <div class="menu-title">Gallery</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('category.list')) --}}
                <li> <a href="{{ route('all.services') }}"><i class="bx bx-right-arrow-alt"></i>All Gallery</a>
                </li>

                {{-- @endif --}}
                {{-- @if (Auth::user()->can('category.add')) --}}
                <li> <a href="{{ route('add.services') }}"><i class="bx bx-right-arrow-alt"></i>Add Gallery</a>
                </li>
               

                {{-- @endif --}}

            </ul>
        </li>

                {{-- @if (Auth::user()->can('slider.menu')) --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-industry"></i>
                </div>
                <div class="menu-title">Industery Master</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('slider.list')) --}}
                <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>All Industery</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('slider.add')) --}}
                <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Industery</a>
                </li>
                {{-- @endif --}}

            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Auth::user()->can('ads.menu')) --}}
        
        <li>
            <a href="{{ route('all.about') }}">
                <div class="parent-icon"><i class="fa fa-wrench"></i>
                </div>
                <div class="menu-title">About Us</div>
            </a>
        </li>
     

        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-wrench" aria-hidden="true"></i>

                </div>
                <div class="menu-title">About</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('category.list')) --}}
                <li> <a href="{{ route('all.about') }}"><i class="bx bx-right-arrow-alt"></i>All About</a>
                </li>

                {{-- @endif --}}
                {{-- @if (Auth::user()->can('category.add')) --}}
                <li style="display: none;"> <a href="{{ route('add.about') }}"><i class="bx bx-right-arrow-alt"></i>Add About</a>
                </li>
               

                {{-- @endif --}}

            </ul>
        </li>
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product Category</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('category.list')) --}}
                

                {{-- @endif --}}
                {{-- @if (Auth::user()->can('category.add')) --}}
                


                {{-- @endif --}}

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-cubes-stacked"></i></i>
                </div>
                <div class="menu-title">Product Master</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('category.list')) --}}
                <li> <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
                <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>List Category</a>
                </li>
                  <li> <a href="{{ route('add.project') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                <li> <a href="{{ route('all.project') }}"><i class="bx bx-right-arrow-alt"></i>List Product</a>
                </li>

                {{-- @endif --}}
                {{-- @if (Auth::user()->can('category.add')) --}}
                {{-- <li> <a href="{{ route('active.project') }}"><i class="bx bx-right-arrow-alt"></i>Active Category</a>
                </li>
                <li> <a href="{{ route('inactive.project') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Category</a>
                </li> --}}

                {{-- @endif --}}

            </ul>
        </li>
		
		    <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-briefcase"></i>
                </div>
                <div class="menu-title">Job Master</div>
            </a>
            <ul>
                

               
                <li> <a href="{{route('jobindex')}}"><i class="bx bx-right-arrow-alt"></i>Job Vacancy</a>
                </li>
                {{-- <li> <a href="{{ route('active.project') }}"><i class="bx bx-right-arrow-alt"></i>Active Category</a>
                </li>
                <li> <a href="{{ route('inactive.project') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Category</a>
                </li> --}}

                {{-- @endif --}}

            </ul>
        </li>
		
        <li>
            
            <ul>
                {{-- @if (Auth::user()->can('category.list')) --}}
                {{-- <li> <a href="{{ route('all.project') }}"><i class="bx bx-right-arrow-alt"></i>All Project</a>
                </li> --}}

                {{-- @endif --}}
                {{-- @if (Auth::user()->can('category.add')) --}}
               
                {{-- <li> <a href="{{ route('active.project') }}"><i class="bx bx-right-arrow-alt"></i>Active Category</a>
                </li>
                <li> <a href="{{ route('inactive.project') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Category</a>
                </li> --}}

                {{-- @endif --}}

            </ul>
        </li>
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-book"></i>
                </div>
                <div class="menu-title">Catalogs Master</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('category.list')) --}}
                <li> <a href="{{ route('add.application') }}"><i class="bx bx-right-arrow-alt"></i>Add Catalogue</a>
                </li>
                <li> <a href="{{ route('all.application') }}"><i class="bx bx-right-arrow-alt"></i>List Catalogue</a>
                </li>

                {{-- @endif --}}
                {{-- @if (Auth::user()->can('category.add')) --}}
              
                {{-- <li> <a href="{{ route('active.category') }}"><i class="bx bx-right-arrow-alt"></i>Active Category</a>
                </li>
                <li> <a href="{{ route('inactive.category') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Category</a>
                </li> --}}

                {{-- @endif --}}

            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Auth::user()->can('subcategory.menu')) --}}
        <li  style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-codepen"></i>
                </div>
                <div class="menu-title">Product</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('subcategory.list')) --}}
                <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('subcategory.add')) --}}
                <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
				{{-- <li> <a href="{{ route('add.subcategory1') }}"><i class="bx bx-right-arrow-alt"></i>maltipal image</a>
                </li> --}}

                {{-- @endif --}}

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-quote-right" aria-hidden="true"></i></i>
                </div>
                <div class="menu-title">Testimonial Master</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('ads.list')) --}}
                <li> <a href="{{ route('add.testimonial') }}"><i class="bx bx-right-arrow-alt"></i>Add Testimonial</a>
                </li>
                <li> <a href="{{ route('all.testimonial') }}"><i class="bx bx-right-arrow-alt"></i>List Testimonial</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('ads.add')) --}}
            
                {{-- @endif --}}
            </ul>
        </li>

                <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-cube" aria-hidden="true"></i></i>
                </div>
                <div class="menu-title">Quality Master</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('ads.list')) --}}
                <li> <a href="{{ route('add.quality') }}"><i class="bx bx-right-arrow-alt"></i>Add Quality</a>
                </li>
                <li> <a href="{{ route('all.quality') }}"><i class="bx bx-right-arrow-alt"></i>List Quality</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('ads.add')) --}}
            
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
     
        {{-- @if (Auth::user()->can('product.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-fresh-juice"></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('product.list')) --}}
                <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('product.add')) --}}
                <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                {{-- @endif --}}

            </ul>
        </li>
        {{-- @endif --}}

       
        <li style="display:none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-image"></i>
                </div>
                <div class="menu-title">Clients Logo</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('ads.list')) --}}
                <li> <a href="{{ route('all.offer') }}"><i class="bx bx-right-arrow-alt"></i>All Client Logo</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('ads.add')) --}}
                {{-- <li> <a href="{{ route('add.offer') }}"><i class="bx bx-right-arrow-alt"></i>Add Client Logo</a>
                </li> --}}
                {{-- @endif --}}
            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Auth::user()->can('coupon.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-invention"></i>
                </div>
                <div class="menu-title">Coupon System</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('coupon.list')) --}}
                <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                </li>
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('coupon.add')) --}}
                <li> <a href="{{ route('add.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>
                {{-- @endif --}}

            </ul>
        </li>
        {{-- @endif --}}


        {{-- <li class="menu-label">UI Elements</li> --}}


        {{-- @if (Auth::user()->can('order.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Order Manage </div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
                </li>
                <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed
                        Order</a>
                </li>
                <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing
                        Order</a>
                </li>
                <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered
                        Order</a>
                </li>



            </ul>
        </li>
        {{-- @endif --}}

        {{-- @if (Auth::user()->can('return.order.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='lni lni-paperclip'></i>
                </div>
                <div class="menu-title">Return Order </div>
            </a>
            <ul>
                <li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
                </li>
                <li> <a href="{{ route('complete.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Complete
                        Request</a>
                </li>
            </ul>
        </li>
        {{-- @endif --}}
        {{-- @if (Auth::user()->can('report.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-stats-up"></i>
                </div>
                <div class="menu-title">Reports Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
                </li>

                <li> <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order By User</a>
                </li>

            </ul>
        </li>
        {{-- @endif --}}



        {{-- @if (Auth::user()->can('blog.menu')) --}}
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-pyramids"></i>
                </div>
                <div class="menu-title">Blogs/News Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                </li>

                    <li> <a href="{{ route('admin.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>All Blogs/News Post</a>
                </li>
                 
                 
            </ul>
        </li> --}}
        {{-- @endif --}}

        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-book'></i>
                </div>
                <div class="menu-title">FAQ Master</div>
            </a>
                    <ul>
                    <li> <a href="{{ route('add.faqproductpage') }}"><i class="bx bx-right-arrow-alt"></i>Add FAQ Product Page </a>
                    </li>
                    <li> <a href="{{ route('all.faqproductpage') }}"><i class="bx bx-right-arrow-alt"></i>FAQ Product Page List</a>
                    </li>
                </ul>
            <ul>
                <li> <a href="{{ route('add.faqcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add FAQ Category </a>
                </li>
                <li> <a href="{{ route('all.faqcategory') }}"><i class="bx bx-right-arrow-alt"></i>FAQ Category List</a>
                </li>
            </ul>

            {{-- <ul>
                <li> <a href="{{ route('add.faqproduct') }}"><i class="bx bx-right-arrow-alt"></i>Add FAQ Product </a>
                </li>
                <li> <a href="{{ route('all.faqproduct') }}"><i class="bx bx-right-arrow-alt"></i>FAQ Product List</a>
                </li>
            </ul> --}}
        </li>

        {{-- @if (Auth::user()->can('area.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-map"></i>
                </div>
                <div class="menu-title">Shipping Area </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.division') }}"><i class="bx bx-right-arrow-alt"></i>All Location</a>
                </li>
                <li> <a href="{{ route('inactive.division') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Loction</a>
                </li>
                <li> <a href="{{ route('active.division') }}"><i class="bx bx-right-arrow-alt"></i>Active Loction</a>
                </li>
                <li style="display: none;"> <a href="{{ route('all.district') }}"><i
                            class="bx bx-right-arrow-alt"></i>All District</a>
                </li>

                <li style="display: none;"> <a href="{{ route('all.state') }}"><i
                            class="bx bx-right-arrow-alt"></i>All State</a>
                </li>

            </ul>
        </li>
        {{-- @endif --}}

        {{-- @if (Auth::user()->can('review.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-indent-increase"></i>
                </div>
                <div class="menu-title">Review Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
                </li>

                <li> <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish Review</a>
                </li>


            </ul>
        </li>
        {{-- @endif --}}

        {{-- @if (Auth::user()->can('stock.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-cart-full"></i>
                </div>
                <div class="menu-title">Stock Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
                </li>




            </ul>
        </li>
        {{-- @endif		  --}}


        {{-- @if (Auth::user()->can('role.permission.menu'))	    --}}


       
        {{-- @if (Auth::user()->can('admin.user.menu'))	  --}}

        <li style="display: none;">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-user"></i>
                </div>
                <div class="menu-title">Admin Manage </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>All Admin</a>
                </li>
                {{-- <li> <a href="{{ route('add.admin') }}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
						</li> --}}
                <li> <a href="{{ route('inactive.admin') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Admin</a>
                </li>
                <li> <a href="{{ route('active.admin') }}"><i class="bx bx-right-arrow-alt"></i>Active Admin</a>
                </li>

            </ul>
        </li>
        {{-- @endif	 	  --}}

        {{-- @if (Auth::user()->can('vendor.menu')) --}}
        {{-- <li>
				<a href="javascript:;" class="has-arrow">
					<div class="parent-icon"><i class='lni lni-network'></i>
					</div>
					<div class="menu-title">Vendor Manage </div>
				</a>
				<ul>
					<li> <a href="{{ route('all-vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Vendor</a>
					</li>
					<li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
					</li>
					<li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
					</li>
					 
				</ul>
			</li> --}}
        {{-- @endif --}}

        {{-- @if (Auth::user()->can('user.management.menu')) --}}
        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-slideshare"></i>
                </div>
                <div class="menu-title">Member Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.member') }}"><i class="bx bx-right-arrow-alt"></i>All Member</a>
                </li>
                <li> <a href="{{ route('inactive.user') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Member</a>
                </li>
                <li> <a href="{{ route('active.user') }}"><i class="bx bx-right-arrow-alt"></i>Active Member</a>
                </li>

            </ul>
        </li>
        {{-- @endif --}}
      

        {{-- <li class="menu-label">Roles And Permission</li> --}}
        <li style="display: none;">
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">Role & Permission</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Permission</a>
                </li>
                <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>

                <li> <a href="{{ route('add.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Roles in
                        Permission</a>
                </li>

                <li> <a href="{{ route('all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Roles in
                        Permission</a>
                </li>

            </ul>
        </li>
        {{-- @endif				  --}}

        <hr>
        {{-- @if (Auth::user()->can('site.menu'))		  --}}
        {{-- <li>
	<a href="javascript:;" class="has-arrow">
		<div class="parent-icon"><i class="lni lni-cog"></i>
		</div>
		<div class="menu-title">Setting Manage</div>
	</a>
	<ul>
		<li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
		</li>

			<li> <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
		</li>
		 
		 
	</ul>
</li> --}}
        {{-- @if (Auth::user()->can('site.menu'))		  --}}



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fas fa-project-diagram"></i></i>
                </div>
                <div class="menu-title">SEO Master</div>
            </a>
            <ul>
                {{-- @if (Auth::user()->can('category.list')) --}}
                <li> <a href="{{ route('all.seo') }}"><i class="bx bx-right-arrow-alt"></i>Other SEO pages </a>
                </li>
                {{-- <li> <a href="{{ route('all.blogseo') }}"><i class="bx bx-right-arrow-alt"></i>Blogs/News seo page</a>
                </li> --}}
                {{-- @endif --}}
                {{-- @if (Auth::user()->can('category.add')) --}}
                {{-- <li> <a href="{{ route('all.projectseo') }}"><i class="bx bx-right-arrow-alt"></i>Project seo page</a>
                </li>
                <li> <a href="{{ route('all.servicesseo') }}"><i class="bx bx-right-arrow-alt"></i>Services seo page</a>
                </li> --}}
                <li style="display: none;"> <a href="{{ route('all.blogseo') }}"><i class="bx bx-right-arrow-alt"></i>Blogs/News seo page</a>
                </li>
                <li> <a href="{{ route('all.categoryseo') }}"><i class="bx bx-right-arrow-alt"></i>Category SEO page</a>
                </li>
                {{-- <li> <a href="{{ route('all.productsseo') }}"><i class="bx bx-right-arrow-alt"></i>Product SEO page</a>
                </li> --}}
                <li style="display: none;"> <a href="{{ route('all.applicationseo') }}"><i class="bx bx-right-arrow-alt"></i>Application SEO page</a>
                </li>
                <li> <a href="{{ route('all.instruction-analytics') }}"><i class="bx bx-right-arrow-alt"></i>Instruction Analytics</a>
                </li>
                {{-- <li> <a href="{{ route('active.project') }}"><i class="bx bx-right-arrow-alt"></i>Active Category</a>
                </li>
                <li> <a href="{{ route('inactive.project') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Category</a>
                </li> --}}

                {{-- @endif --}}

            </ul>
        </li>

        <li style="display: none;">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-clipboard"></i>
                </div>
                <div class="menu-title">Inquiry Master</div>
            </a>
            <ul>
                

               
                <li> <a href="{{route('inquiryindex')}}"><i class="bx bx-right-arrow-alt"></i>Inquiry</a>
                </li>
                {{-- <li> <a href="{{ route('active.project') }}"><i class="bx bx-right-arrow-alt"></i>Active Category</a>
                </li>
                <li> <a href="{{ route('inactive.project') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        Category</a>
                </li> --}}

                {{-- @endif --}}

            </ul>
        </li>
        
        <li>
            <a href="{{ route('site.setting') }}">
                <div class="parent-icon"><i class='lni lni-cog'></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
        </li>
        {{-- @endif --}}


        {{-- @endif --}}
        <li  style="display: none;">
            <a href=" " target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
