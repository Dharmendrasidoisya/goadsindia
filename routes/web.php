<?php
use Database\Seeders\AdminSedder;   
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\MemberController; 
// namespace App\Http\Controllers\Backend\JobVacancyController;


use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\MasterformController;
use App\Http\Controllers\Backend\InquiryController;


use App\Http\Controllers\Backend\ServicesseoController;
use App\Http\Controllers\Backend\ProductseoController;
use App\Http\Controllers\Backend\ApplicationseoController;

use App\Http\Controllers\Backend\ProjectController;


use App\Http\Controllers\Backend\ApplicationController;


use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Middleware\RedirectIfAuthenticated;
  
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\JobVacancyController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\OfferController;

use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\QualityController;

use App\Http\Controllers\Backend\FaqProductPageController;
use App\Http\Controllers\Backend\FaqCategoryController;
use App\Http\Controllers\Backend\FaqProductController;

use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SeoController;
use App\Http\Controllers\Backend\SeoblogController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\User\WishlistController; 
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\ReviewController;


use App\Http\Controllers\FrontendController;
 
/*
|--------------------------------------------------------------------------
| Web Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
 
// Route::get('/', function () {
//     return view('frontend.index');
// });
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('password/reset/{token}', [ForgotPasswordController::class,'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::post('password/reset', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', [IndexController::class, 'Index']);

Route::middleware(['auth'])->group(function() {
    
Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');

Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');


}); // Gorup Milldeware End


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/// Admin Dashboard

Route::middleware(['auth','role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashobard');

    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');

});


/// Vendor Dashboard
Route::middleware(['auth','role:vendor'])->group(function() {

   Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashobard');

   Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');

   Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');

    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');

    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');

    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');



// Vendor Add Product All Route 
Route::controller(VendorProductController::class)->group(function(){
    Route::get('/vendor/all/product' , 'VendorAllProduct')->name('vendor.all.product');
    Route::get('/vendor/add/product' , 'VendorAddProduct')->name('vendor.add.product');

    Route::post('/vendor/store/product' , 'VendorStoreProduct')->name('vendor.store.product');
    Route::get('/vendor/edit/product/{id}' , 'VendorEditProduct')->name('vendor.edit.product');

    Route::post('/vendor/update/product' , 'VendorUpdateProduct')->name('vendor.update.product');
    Route::post('/vendor/update/product/thambnail' , 'VendorUpdateProductThabnail')->name('vendor.update.product.thambnail');

    Route::post('/vendor/update/product/multiimage' , 'VendorUpdateProductmultiImage')->name('vendor.update.product.multiimage');
    
    Route::get('/vendor/product/multiimg/delete/{id}' , 'VendorMultiimgDelete')->name('vendor.product.multiimg.delete');

    Route::get('/vendor/product/inactive/{id}' , 'VendorProductInactive')->name('vendor.product.inactive');
    Route::get('/vendor/product/active/{id}' , 'VendorProductActive')->name('vendor.product.active');

    Route::get('/vendor/delete/product/{id}' , 'VendorProductDelete')->name('vendor.delete.product');

    Route::get('/vendor/subcategory/ajax/{category_id}' , 'VendorGetSubCategory');
     

});


 // Vendor Order All Route 
Route::controller(VendorOrderController::class)->group(function(){
    Route::get('/vendor/order' , 'VendorOrder')->name('vendor.order');

    Route::get('/vendor/return/order' , 'VendorReturnOrder')->name('vendor.return.order');

    Route::get('/vendor/complete/return/order' , 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
    Route::get('/vendor/order/details/{order_id}' , 'VendorOrderDetails')->name('vendor.order.details');
    
 
});



Route::controller(ReviewController::class)->group(function(){

 Route::get('/vendor/all/review' , 'VendorAllReview')->name('vendor.all.review');
 
});


}); // end Vendor Group middleware


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');



Route::middleware(['auth','role:admin'])->group(function() {


 // Brand All Route 
Route::controller(BrandController::class)->group(function(){
    Route::get('/all/brand' , 'AllBrand')->name('all.brand');
    Route::get('/add/brand' , 'AddBrand')->name('add.brand');
    Route::post('/store/brand' , 'StoreBrand')->name('store.brand');
    Route::get('/edit/brand/{id}' , 'EditBrand')->name('edit.brand');
    Route::post('/update/brand' , 'UpdateBrand')->name('update.brand');
    Route::get('/delete/brand/{id}' , 'DeleteBrand')->name('delete.brand');

});

    // Inquiry route...
    Route::controller(InquiryController::class)->group(function(){

        Route::get('inquirycreate' , 'create')->name('inquirycreate');
        Route::post('inquirystore' , 'store')->name('inquirystore');
        Route::get('inquiryindex' , 'index')->name('inquiryindex');
       
        Route::get('inquiryedit/{id}' , 'edit')->name('inquiryedit');
        
        // Route::post('inquiryupdate/{id}' , 'update')->name('inquiryupdate');
       
        Route::get('inquirydestroy/{id}' , 'destroy')->name('inquirydestroy');
         Route::get('inquiryview/{id}' , 'show')->name('inquiryshow');
        // Route::post('inquiry/update-status' , 'update_status')->name('inquirystatus');
       
       });


 // Category All Route 
Route::controller(CategoryController::class)->group(function(){
    Route::get('/all/category' , 'AllCategory')->name('all.category');
    Route::get('/add/category' , 'AddCategory')->name('add.category');
    Route::get('/inactive/category' , 'Inactivecategory')->name('inactive.category');
    Route::get('/active/category' , 'Activecategory')->name('active.category');
    Route::get('/active/category/details/{id}' , 'ActivecategoryDetails')->name('active.category.details');
    Route::post('/active/category/approve' , 'ActivecategoryApprove')->name('active.category.approve');
    Route::get('/inactive/category/details/{id}' , 'InActivecategoryDetails')->name('inactive.category.details');
    Route::post('/inactive/category/approve' , 'InActivecategoryApprove')->name('inactive.category.approve');
    Route::post('/store/category' , 'StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}' , 'EditCategory')->name('edit.category');
    Route::post('/update/category' , 'UpdateCategory')->name('update.category');
    Route::get('/delete/category/{id}' , 'DeleteCategory')->name('delete.category');
    Route::delete('/delete/selected/categories', 'DeleteSelectedcategories')->name('delete.selected.categories');

});
Route::controller(ServicesController::class)->group(function(){
    Route::get('/all/services' , 'Allservices')->name('all.services');
    Route::get('/add/services' , 'Addservices')->name('add.services');
    Route::get('/inactive/services' , 'Inactiveservices')->name('inactive.services');
    Route::get('/active/services' , 'Activeservices')->name('active.services');
    Route::get('/active/services/details/{id}' , 'ActiveservicesDetails')->name('active.services.details');
    Route::post('/active/services/approve' , 'ActiveservicesApprove')->name('active.services.approve');
    Route::get('/inactive/services/details/{id}' , 'InActiveservicesDetails')->name('inactive.services.details');
    Route::post('/inactive/services/approve' , 'InActiveservicesApprove')->name('inactive.services.approve');
    Route::post('/store/services' , 'Storeservices')->name('store.services');
    Route::get('/edit/services/{id}' , 'Editservices')->name('edit.services');
    Route::post('/update/services' , 'Updateservices')->name('update.services');
    Route::get('/delete/services/{id}' , 'Deleteservices')->name('delete.services');
    Route::delete('/delete/selected/categories', 'DeleteSelectedcategories')->name('delete.selected.categories');

});
Route::controller(AboutController::class)->group(function(){
    Route::get('/all/about' , 'Allabout')->name('all.about');
    Route::get('/add/about' , 'Addabout')->name('add.about');
    Route::get('/inactive/about' , 'Inactiveabout')->name('inactive.about');
    Route::get('/active/about' , 'Activeabout')->name('active.about');
    Route::get('/active/about/details/{id}' , 'ActiveaboutDetails')->name('active.about.details');
    Route::post('/active/about/approve' , 'ActiveaboutApprove')->name('active.about.approve');
    Route::get('/inactive/about/details/{id}' , 'InActiveaboutDetails')->name('inactive.about.details');
    Route::post('/inactive/about/approve' , 'InActiveaboutApprove')->name('inactive.about.approve');
    Route::post('/store/about' , 'Storeabout')->name('store.about');
    Route::get('/edit/about/{id}' , 'Editabout')->name('edit.about');
    Route::post('/update/about' , 'Updateabout')->name('update.about');
    Route::get('/delete/about/{id}' , 'Deleteabout')->name('delete.about');
    Route::delete('/delete/selected/categories', 'DeleteSelectedcategories')->name('delete.selected.categories');

});
 // Category All Route 
 Route::controller(ProjectController::class)->group(function(){
    Route::get('/all/project' , 'Allproject')->name('all.project');
    Route::get('/add/project' , 'Addproject')->name('add.project');
    Route::get('/inactive/project' , 'Inactiveproject')->name('inactive.project');
    Route::get('/active/project' , 'Activeproject')->name('active.project');
    Route::get('/active/project/details/{id}' , 'ActiveprojectDetails')->name('active.project.details');
    Route::post('/active/project/approve' , 'ActiveprojectApprove')->name('active.project.approve');
    Route::get('/inactive/project/details/{id}' , 'InActiveprojectDetails')->name('inactive.project.details');
    Route::post('/inactive/project/approve' , 'InActiveprojectApprove')->name('inactive.project.approve');
    Route::post('/store/project' , 'Storeproject')->name('store.project');
    Route::get('/edit/project/{id}' , 'Editproject')->name('edit.project');
    Route::post('/update/project' , 'Updateproject')->name('update.project');
    Route::get('/delete/project/{id}' , 'Deleteproject')->name('delete.project');
    Route::delete('/delete/selected/project', 'DeleteSelectedproject')->name('delete.selected.project');

});
Route::controller(ApplicationController::class)->group(function(){
    Route::get('/all/application' , 'Allapplication')->name('all.application');
    Route::get('/add/application' , 'Addapplication')->name('add.application');
    Route::get('/inactive/category' , 'Inactivecategory')->name('inactive.category');
    Route::get('/active/category' , 'Activecategory')->name('active.category');
    Route::get('/active/category/details/{id}' , 'ActivecategoryDetails')->name('active.category.details');
    Route::post('/active/category/approve' , 'ActivecategoryApprove')->name('active.category.approve');
    Route::get('/inactive/category/details/{id}' , 'InActivecategoryDetails')->name('inactive.category.details');
    Route::post('/inactive/category/approve' , 'InActivecategoryApprove')->name('inactive.category.approve');
    Route::post('/store/application' , 'Storeapplication')->name('store.application');
    Route::get('/edit/application/{id}' , 'Editapplication')->name('edit.application');
    Route::post('/update/application' , 'Updateapplication')->name('update.application');
    Route::get('/delete/application/{id}' , 'Deleteapplication')->name('delete.application');
    Route::delete('/delete/selected/application', 'DeleteSelectedapplication')->name('delete.selected.application');

});

 // Category All Route 
Route::controller(SubCategoryController::class)->group(function(){
    Route::get('/all/subcategory' , 'AllSubCategory')->name('all.subcategory');
    Route::get('/add/subcategory' , 'AddSubCategory')->name('add.subcategory');
    Route::get('/add/subcategory1' , 'AddSubCategory1')->name('add.subcategory1');
    Route::post('/store/subcategory1' , 'StoreSubCategory1')->name('store.subcategory1');
    Route::get('/inactive/subcategory' , 'Inactivesubcategory')->name('inactive.subcategory');
    Route::get('/active/subcategory' , 'Activesubcategory')->name('active.subcategory');
    Route::get('/active/subcategory/details/{id}' , 'ActivesubcategoryDetails')->name('active.subcategory.details');
    Route::post('/active/subcategory/approve' , 'ActivesubcategoryApprove')->name('active.subcategory.approve');
    Route::get('/inactive/subcategory/details/{id}' , 'InActivesubcategoryDetails')->name('inactive.subcategory.details');
    Route::post('/inactive/subcategory/approve' , 'InActivesubcategoryApprove')->name('inactive.subcategory.approve');
    Route::post('/store/subcategory' , 'StoreSubCategory')->name('store.subcategory');
    Route::get('/edit/subcategory/{id}' , 'EditSubCategory')->name('edit.subcategory');
    Route::post('/update/subcategory' , 'UpdateSubCategory')->name('update.subcategory');
    Route::get('/delete/subcategory/{id}' , 'DeleteSubCategory')->name('delete.subcategory');

    Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');
    Route::delete('/delete/selected/subcategories', 'DeleteSelectedSubcategories')->name('delete.selected.subcategories');

});


 // Vendor Active and Inactive All Route 
Route::controller(AdminController::class)->group(function(){
    Route::get('/inactive/vendor' , 'InactiveVendor')->name('inactive.vendor');
    Route::get('/active/vendor' , 'ActiveVendor')->name('active.vendor');
    Route::get('/inactive/vendor/details/{id}' , 'InactiveVendorDetails')->name('inactive.vendor.details');
    Route::post('/active/vendor/approve' , 'ActiveVendorApprove')->name('active.vendor.approve');
    Route::get('/active/vendor/details/{id}' , 'ActiveVendorDetails')->name('active.vendor.details');
      Route::post('/inactive/vendor/approve' , 'InActiveVendorApprove')->name('inactive.vendor.approve');
    

});

 // Admin Active and Inactive All Route 
 Route::controller(AdminController::class)->group(function(){
    Route::get('/inactive/admin' , 'InactiveAdmin')->name('inactive.admin');
    Route::get('/active/admin' , 'ActiveAdmin')->name('active.admin');
    Route::get('/inactive/admin/details/{id}' , 'InactiveAdminDetails')->name('inactive.admin.details');
    Route::post('/active/admin/approve' , 'ActiveAdminApprove')->name('active.admin.approve');
    Route::get('/active/admin/details/{id}' , 'ActiveAdminDetails')->name('active.admin.details');
      Route::post('/inactive/admin/approve' , 'InActiveAdminApprove')->name('inactive.admin.approve');
    

});

 // Member Active and Inactive All Route 
 Route::controller(MemberController::class)->group(function(){
    Route::get('/inactive/member' , 'InactiveUser')->name('inactive.user');
    Route::get('/active/member' , 'ActiveUser')->name('active.user');
    Route::get('/inactive/member/details/{id}' , 'InactiveUserDetails')->name('inactive.user.details');
    Route::post('/active/member/approve' , 'ActiveUserApprove')->name('active.user.approve');
    Route::get('/active/member/details/{id}' , 'ActiveUserDetails')->name('active.user.details');
      Route::post('/inactive/member/approve' , 'InActiveUserApprove')->name('inactive.user.approve');
    

});
	
	

 // Product All Route 
Route::controller(ProductController::class)->group(function(){
    Route::get('/all/product' , 'AllProduct')->name('all.product');
    Route::get('/add/product' , 'AddProduct')->name('add.product');
    Route::post('/store/product' , 'StoreProduct')->name('store.product');
    Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
    Route::post('/update/product' , 'UpdateProduct')->name('update.product');
    Route::post('/update/product/thambnail' , 'UpdateProductThambnail')->name('update.product.thambnail');
    Route::post('/update/product/multiimage' , 'UpdateProductMultiimage')->name('update.product.multiimage');
    Route::get('/product/multiimg/delete/{id}' , 'MulitImageDelelte')->name('product.multiimg.delete');

    Route::get('/product/inactive/{id}' , 'ProductInactive')->name('product.inactive');
    Route::get('/product/active/{id}' , 'ProductActive')->name('product.active');
    Route::get('/delete/product/{id}' , 'ProductDelete')->name('delete.product');

    // For Product Stock
     Route::get('/product/stock' , 'ProductStock')->name('product.stock');
    

});


 // FAQ Product Page All Route 

 Route::controller(FaqProductPageController::class)->group(function(){
    Route::get('/all/faqproductpage' , 'Allfaqproductpage')->name('all.faqproductpage');
    Route::get('/add/faqproductpage' , 'Addfaqproductpage')->name('add.faqproductpage');
    Route::get('/inactive/faqproductpage' , 'Inactivefaqproductpage')->name('inactive.faqproductpage');
    Route::get('/active/faqproductpage' , 'Activefaqproductpage')->name('active.faqproductpage');
    Route::get('/active/faqproductpage/details/{id}' , 'ActivefaqproductpageDetails')->name('active.faqproductpage.details');
    Route::post('/active/faqproductpage/approve' , 'ActivefaqproductpageApprove')->name('active.faqproductpage.approve');
    Route::get('/inactive/faqproductpage/details/{id}' , 'InActivefaqproductpageDetails')->name('inactive.faqproductpage.details');
    Route::post('/inactive/faqproductpage/approve' , 'InActivefaqproductpageApprove')->name('inactive.faqproductpage.approve');
    Route::post('/store/faqproductpage' , 'Storefaqproductpage')->name('store.faqproductpage');
    Route::get('/edit/faqproductpage/{id}' , 'Editfaqproductpage')->name('edit.faqproductpage');
    Route::post('/update/faqproductpage' , 'Updatefaqproductpage')->name('update.faqproductpage');
    Route::get('/delete/faqproductpage/{id}' , 'Deletefaqproductpage')->name('delete.faqproductpage');
    Route::delete('/delete/selected/faqproductpage', 'DeleteSelectedfaqproductpage')->name('delete.selected.faqproductpage');

});

// FAQ Category All Route 
Route::controller(FaqCategoryController::class)->group(function(){
    Route::get('/all/faqcategory' , 'Allfaqcategory')->name('all.faqcategory');
    Route::get('/add/faqcategory' , 'Addfaqcategory')->name('add.faqcategory');
    Route::get('/inactive/faqcategory' , 'Inactivefaqcategory')->name('inactive.faqcategory');
    Route::get('/active/faqcategory' , 'Activefaqcategory')->name('active.faqcategory');
    Route::get('/active/faqcategory/details/{id}' , 'ActivefaqcategoryDetails')->name('active.faqcategory.details');
    Route::post('/active/faqcategory/approve' , 'ActivefaqcategoryApprove')->name('active.faqcategory.approve');
    Route::get('/inactive/faqcategory/details/{id}' , 'InActivefaqcategoryDetails')->name('inactive.faqcategory.details');
    Route::post('/inactive/faqcategory/approve' , 'InActivefaqcategoryApprove')->name('inactive.faqcategory.approve');
    Route::post('/store/faqcategory' , 'Storefaqcategory')->name('store.faqcategory');
    Route::get('/edit/faqcategory/{id}' , 'Editfaqcategory')->name('edit.faqcategory');
    Route::post('/update/faqcategory' , 'Updatefaqcategory')->name('update.faqcategory');
    Route::get('/delete/faqcategory/{id}' , 'Deletefaqcategory')->name('delete.faqcategory');
    Route::delete('/delete/selected/faqcategory', 'DeleteSelectedfaqcategory')->name('delete.selected.faqcategory');

});
Route::post('/faqcategory/activate-selected', [FaqCategoryController::class, 'activateSelectedfaqcategory'])->name('activate.selected.faqcategory');
Route::post('/faqcategory/deactivate-selected', [FaqCategoryController::class, 'deactivateSelectedfaqcategory'])->name('deactivate.selected.faqcategory');

//FAQ Product All Route 
Route::controller(FaqProductController::class)->group(function(){
    Route::get('/all/faqproduct' , 'Allfaqproduct')->name('all.faqproduct');
    Route::get('/add/faqproduct' , 'Addfaqproduct')->name('add.faqproduct');
    Route::get('/inactive/faqproduct' , 'Inactivefaqproduct')->name('inactive.faqproduct');
    Route::get('/active/faqproduct' , 'Activefaqproduct')->name('active.faqproduct');
    Route::get('/active/faqproduct/details/{id}' , 'ActivefaqproductDetails')->name('active.faqproduct.details');
    Route::post('/active/faqproduct/approve' , 'ActivefaqproductApprove')->name('active.faqproduct.approve');
    Route::get('/inactive/faqproduct/details/{id}' , 'InActivefaqproductDetails')->name('inactive.faqproduct.details');
    Route::post('/inactive/faqproduct/approve' , 'InActivefaqproductApprove')->name('inactive.faqproduct.approve');
    Route::post('/store/faqproduct' , 'Storefaqproduct')->name('store.faqproduct');
    Route::get('/edit/faqproduct/{id}' , 'Editfaqproduct')->name('edit.faqproduct');
    Route::post('/update/faqproduct' , 'Updatefaqproduct')->name('update.faqproduct');
    Route::get('/delete/faqproduct/{id}' , 'Deletefaqproduct')->name('delete.faqproduct');
    Route::delete('/delete/selected/faqproduct', 'DeleteSelectedfaqproduct')->name('delete.selected.faqproduct');

});
Route::post('/faqproduct/activate-selected', [FaqProductController::class, 'activateSelectedfaqproduct'])->name('activate.selected.faqproduct');
Route::post('/faqproduct/deactivate-selected', [FaqProductController::class, 'deactivateSelectedfaqproduct'])->name('deactivate.selected.faqproduct');

Route::get('/get-products/{categoryId}', [FaqProductController::class, 'getProducts']);

//SEO Route
Route::controller(SeoController::class)->group(function(){
    Route::get('/all/seo' , 'Allseo')->name('all.seo');
    Route::get('/all/instruction-analytics' , 'Allinstruction')->name('all.instruction-analytics');
    Route::get('/add/seo' , 'Addseo')->name('add.seo');
    Route::get('/add/instruction-analytics' , 'Addinstruction')->name('add.instruction-analytics');
    Route::get('/inactive/seo' , 'Inactiveseo')->name('inactive.seo');
    Route::get('/active/seo' , 'Activeseo')->name('active.seo');
    Route::get('/active/seo/details/{id}' , 'ActiveseoDetails')->name('active.seo.details');
    Route::post('/active/seo/approve' , 'ActiveseoApprove')->name('active.seo.approve');
    Route::get('/inactive/seo/details/{id}' , 'InActiveseoDetails')->name('inactive.seo.details');
    Route::post('/inactive/seo/approve' , 'InActiveseoApprove')->name('inactive.seo.approve');
    Route::post('/store/seo' , 'Storeseo')->name('store.seo');
    Route::post('/store/instruction-analytics' , 'Storeinstruction')->name('store.instruction-analytics');
    Route::get('/edit/seo/{id}' , 'Editseo')->name('edit.seo');
    Route::post('/update/seo' , 'Updateseo')->name('update.seo');
    Route::get('/edit/instruction-analytics/{id}' , 'Editinstruction')->name('edit.instruction-analytics');
    Route::post('/update/instruction-analytics' , 'Updateinstruction')->name('update.instruction-analytics');
    Route::get('/delete/instruction-analytics/{id}' , 'Deleteinstruction')->name('delete.instruction-analytics');
    Route::get('/delete/seo/{id}' , 'Deleteseo')->name('delete.seo');
    Route::delete('/delete/selected/project', 'DeleteSelectedproject')->name('delete.selected.project');

});


//SEO Blog Route
Route::controller(SeoblogController::class)->group(function(){
    Route::get('/all/blogseo' , 'Allblogseo')->name('all.blogseo');
    Route::get('/add/blogseo' , 'Addblogseo')->name('add.blogseo');
    Route::get('/inactive/blogseo' , 'Inactiveblogseo')->name('inactive.blogseo');
    Route::get('/active/blogseo' , 'Activeblogseo')->name('active.blogseo');
    Route::get('/active/blogseo/details/{id}' , 'ActiveblogseoDetails')->name('active.blogseo.details');
    Route::post('/active/blogseo/approve' , 'ActiveblogseoApprove')->name('active.blogseo.approve');
    Route::get('/inactive/blogseo/details/{id}' , 'InActiveblogseoDetails')->name('inactive.blogseo.details');
    Route::post('/inactive/blogseo/approve' , 'InActiveblogseoApprove')->name('inactive.blogseo.approve');
    Route::post('/store/blogseo' , 'Storeblogseo')->name('store.blogseo');
    Route::get('/edit/blogseo/{id}' , 'Editblogseo')->name('edit.blogseo');
    Route::post('/update/blogseo' , 'Updateblogseo')->name('update.blogseo');
    Route::get('/delete/blogseo/{id}' , 'Deleteblogseo')->name('delete.blogseo');
    Route::delete('/delete/selected/blogseo', 'DeleteSelectedblogseo')->name('delete.selected.blogseo');

});

//SEO Category Route
Route::controller(ProductseoController::class)->group(function(){
    Route::get('/all/categoryseo' , 'Allservicesseo')->name('all.categoryseo');
    Route::get('/add/categoryseo' , 'Addservicesseo')->name('add.categoryseo');
    Route::get('/inactive/categoryseo' , 'Inactiveservicesseo')->name('inactive.categoryseo');
    Route::get('/active/categoryseo' , 'Activeservicesseo')->name('active.categoryseo');
    Route::get('/active/categoryseo/details/{id}' , 'ActiveservicesseoDetails')->name('active.categoryseo.details');
    Route::post('/active/categoryseo/approve' , 'ActiveservicesseoApprove')->name('active.categoryseo.approve');
    Route::get('/inactive/categoryseo/details/{id}' , 'InActiveservicesseoDetails')->name('inactive.categoryseo.details');
    Route::post('/inactive/categoryseo/approve' , 'InActiveservicesseoApprove')->name('inactive.categoryseo.approve');
    Route::post('/store/categoryseo' , 'Storeservicesseo')->name('store.categoryseo');
    Route::get('/edit/categoryseo/{id}' , 'Editservicesseo')->name('edit.categoryseo');
    Route::post('/update/categoryseo' , 'Updateservicesseo')->name('update.categoryseo');
    Route::get('/delete/categoryseo/{id}' , 'Deleteservicesseo')->name('delete.categoryseo');
    Route::delete('/delete/selected/categoryseo', 'DeleteSelectedservicesseo')->name('delete.selected.categoryseo');

});
Route::post('/categoryseo/activate-selected', [ProductseoController::class, 'activateSelectedcategoryseo'])->name('activate.selected.categoryseo');
Route::post('/categoryseo/deactivate-selected', [ProductseoController::class, 'deactivateSelectedcategoryseo'])->name('deactivate.selected.categoryseo');




//SEO Product Route
Route::controller(ServicesseoController::class)->group(function(){
    Route::get('/all/productsseo' , 'Allservicesseo')->name('all.productsseo');
    Route::get('/add/productsseo' , 'Addservicesseo')->name('add.productsseo');
    Route::get('/inactive/productsseo' , 'Inactiveservicesseo')->name('inactive.productsseo');
    Route::get('/active/productsseo' , 'Activeservicesseo')->name('active.productsseo');
    Route::get('/active/productsseo/details/{id}' , 'ActiveservicesseoDetails')->name('active.productsseo.details');
    Route::post('/active/productsseo/approve' , 'ActiveservicesseoApprove')->name('active.productsseo.approve');
    Route::get('/inactive/productsseo/details/{id}' , 'InActiveservicesseoDetails')->name('inactive.productsseo.details');
    Route::post('/inactive/productsseo/approve' , 'InActiveservicesseoApprove')->name('inactive.productsseo.approve');
    Route::post('/store/productsseo' , 'Storeservicesseo')->name('store.productsseo');
    Route::get('/edit/productsseo/{id}' , 'Editservicesseo')->name('edit.productsseo');
    Route::post('/update/productsseo' , 'Updateservicesseo')->name('update.productsseo');
    Route::get('/delete/productsseo/{id}' , 'Deleteservicesseo')->name('delete.productsseo');
    Route::delete('/delete/selected/productsseo', 'DeleteSelectedservicesseo')->name('delete.selected.productsseo');

});
Route::post('/productseo/activate-selected', [ServicesseoController::class, 'activateSelectedproductseo'])->name('activate.selected.productseo');
Route::post('/productseo/deactivate-selected', [ServicesseoController::class, 'deactivateSelectedproductseo'])->name('deactivate.selected.productseo');



//SEO Application Route
Route::controller(ApplicationseoController::class)->group(function(){
    Route::get('/all/applicationseo' , 'Allapplicationseo')->name('all.applicationseo');
    Route::get('/add/applicationseo' , 'Addapplicationseo')->name('add.applicationseo');
    Route::get('/inactive/applicationseo' , 'Inactiveapplicationseo')->name('inactive.applicationseo');
    Route::get('/active/applicationseo' , 'Activeapplicationseo')->name('active.applicationseo');
    Route::get('/active/applicationseo/details/{id}' , 'ActiveapplicationseoDetails')->name('active.applicationseo.details');
    Route::post('/active/applicationseo/approve' , 'ActiveapplicationseoApprove')->name('active.applicationseo.approve');
    Route::get('/inactive/applicationseo/details/{id}' , 'InActiveapplicationseoDetails')->name('inactive.applicationseo.details');
    Route::post('/inactive/applicationseo/approve' , 'InActiveapplicationseoApprove')->name('inactive.applicationseo.approve');
    Route::post('/store/applicationseo' , 'Storeapplicationseo')->name('store.applicationseo');
    Route::get('/edit/applicationseo/{id}' , 'Editapplicationseo')->name('edit.applicationseo');
    Route::post('/update/applicationseo' , 'Updateapplicationseo')->name('update.applicationseo');
    Route::get('/delete/applicationseo/{id}' , 'Deleteapplicationseo')->name('delete.applicationseo');
    Route::delete('/delete/selected/applicationseo', 'DeleteSelectedapplicationseo')->name('delete.selected.applicationseo');

});
Route::post('/applicationseo/activate-selected', [ApplicationseoController::class, 'activateSelectedapplicationseo'])->name('activate.selected.applicationseo');
Route::post('/applicationseo/deactivate-selected', [ApplicationseoController::class, 'deactivateSelectedapplicationseo'])->name('deactivate.selected.applicationseo');

 // Slider All Route 
Route::controller(SliderController::class)->group(function(){
    Route::get('/all/slider' , 'AllSlider')->name('all.slider');
    Route::get('/add/slider' , 'AddSlider')->name('add.slider');
    Route::post('/store/slider' , 'StoreSlider')->name('store.slider');
    Route::get('/edit/slider/{id}' , 'EditSlider')->name('edit.slider');
    Route::post('/update/slider' , 'UpdateSlider')->name('update.slider');
    Route::get('/delete/slider/{id}' , 'DeleteSlider')->name('delete.slider');
    Route::delete('/delete/selected/slider', 'DeleteSelectedslider')->name('delete.selected.slider');
});

 // Banner All Route 
Route::controller(BannerController::class)->group(function(){
    Route::get('/all/banner' , 'AllBanner')->name('all.banner');
    Route::get('/add/banner' , 'AddBanner')->name('add.banner');
    Route::post('/store/banner' , 'StoreBanner')->name('store.banner');
    Route::get('/edit/banner/{id}' , 'EditBanner')->name('edit.banner');
    Route::post('/update/banner' , 'UpdateBanner')->name('update.banner');
    Route::get('/delete/banner/{id}' , 'DeleteBanner')->name('delete.banner');
    Route::delete('/delete/selected/banner', 'DeleteSelectedbanner')->name('delete.selected.banner');

}); 
Route::controller(TestimonialController::class)->group(function(){
    Route::get('/all/testimonial' , 'Alltestimonial')->name('all.testimonial');
    Route::get('/add/testimonial' , 'Addtestimonial')->name('add.testimonial');
    Route::post('/store/testimonial' , 'Storetestimonial')->name('store.testimonial');
    Route::get('/edit/testimonial/{id}' , 'Edittestimonial')->name('edit.testimonial');
    Route::post('/update/testimonial' , 'Updatetestimonial')->name('update.testimonial');
    Route::get('/delete/testimonial/{id}' , 'Deletetestimonial')->name('delete.testimonial');

}); 

Route::controller(QualityController::class)->group(function(){
    Route::get('/all/quality' , 'Allquality')->name('all.quality');
    Route::get('/add/quality' , 'Addquality')->name('add.quality');
    Route::post('/store/quality' , 'Storequality')->name('store.quality');
    Route::get('/edit/quality/{id}' , 'Editquality')->name('edit.quality');
    Route::post('/update/quality' , 'Updatequality')->name('update.quality');
    Route::get('/delete/quality/{id}' , 'Deletequality')->name('delete.quality');

}); 
Route::controller(OfferController::class)->group(function(){
     Route::get('/all/offer' , 'Alloffer')->name('all.offer');
    Route::get('/add/offer' , 'Addoffer')->name('add.offer');
    Route::post('/store/offer' , 'Storeoffer')->name('store.offer');
    Route::get('/edit/offer/{id}' , 'Editoffer')->name('edit.offer');
    Route::post('/update/offer' , 'Updateoffer')->name('update.offer');
    Route::get('/delete/offer/{id}' , 'Deleteoffer')->name('delete.offer');
    Route::delete('/delete/selected/offer', 'DeleteSelectedoffer')->name('delete.selected.offer');

}); 

 // Coupon All Route 
Route::controller(CouponController::class)->group(function(){
    Route::get('/all/coupon' , 'AllCoupon')->name('all.coupon');
    Route::get('/add/coupon' , 'AddCoupon')->name('add.coupon');
    Route::post('/store/coupon' , 'StoreCoupon')->name('store.coupon');
    Route::get('/edit/coupon/{id}' , 'EditCoupon')->name('edit.coupon');
    Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
    Route::get('/delete/coupon/{id}' , 'DeleteCoupon')->name('delete.coupon');

}); 


 // Shipping Division All Route 
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/division' , 'AllDivision')->name('all.division');
    Route::get('/inactive/division' , 'Inactivedivision')->name('inactive.division');
    Route::get('/active/division' , 'Activedivision')->name('active.division');
    
    Route::get('/inactive/division/details/{id}' , 'InactivedivisionDetails')->name('inactive.division.details');
    Route::post('/inactive/division/approve' , 'InActivedivisionApprove')->name('inactive.division.approve');
    Route::get('/add/division' , 'AddDivision')->name('add.division');
    Route::post('/store/division' , 'StoreDivision')->name('store.division');
    Route::get('/edit/division/{id}' , 'EditDivision')->name('edit.division');
    Route::post('/update/division' , 'UpdateDivision')->name('update.division');
    Route::get('/delete/division/{id}' , 'DeleteDivision')->name('delete.division');
    Route::get('/active/division/details/{id}' , 'ActivedivisionDetails')->name('active.division.details');
    Route::post('/active/division/approve' , 'ActivedivisionApprove')->name('active.division.approve');

}); 


 // Shipping District All Route 
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/district' , 'AllDistrict')->name('all.district');
    Route::get('/add/district' , 'AddDistrict')->name('add.district');
    Route::post('/store/district' , 'StoreDistrict')->name('store.district');
    Route::get('/edit/district/{id}' , 'EditDistrict')->name('edit.district');
    Route::post('/update/district' , 'UpdateDistrict')->name('update.district');
    Route::get('/delete/district/{id}' , 'DeleteDistrict')->name('delete.district');

}); 


 // Shipping State All Route 
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/state' , 'AllState')->name('all.state');
    Route::get('/add/state' , 'AddState')->name('add.state');
    Route::post('/store/state' , 'StoreState')->name('store.state');
    Route::get('/edit/state/{id}' , 'EditState')->name('edit.state');
    Route::post('/update/state' , 'UpdateState')->name('update.state');
    Route::get('/delete/state/{id}' , 'DeleteState')->name('delete.state');

    Route::get('/district/ajax/{division_id}' , 'GetDistrict');

}); 


 // Admin Order All Route 
Route::controller(OrderController::class)->group(function(){
    Route::get('/pending/order' , 'PendingOrder')->name('pending.order');
    Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails')->name('admin.order.details');

    Route::get('/admin/confirmed/order' , 'AdminConfirmedOrder')->name('admin.confirmed.order');

    Route::get('/admin/processing/order' , 'AdminProcessingOrder')->name('admin.processing.order');
 
 Route::get('/admin/delivered/order' , 'AdminDeliveredOrder')->name('admin.delivered.order');

 Route::get('/pending/confirm/{order_id}' , 'PendingToConfirm')->name('pending-confirm');
 Route::get('/confirm/processing/{order_id}' , 'ConfirmToProcess')->name('confirm-processing');

  Route::get('/processing/delivered/{order_id}' , 'ProcessToDelivered')->name('processing-delivered');

  Route::get('/admin/invoice/download/{order_id}' , 'AdminInvoiceDownload')->name('admin.invoice.download');

}); 


 // Return Order All Route 
Route::controller(ReturnController::class)->group(function(){
    Route::get('/return/request' , 'ReturnRequest')->name('return.request');

    Route::get('/return/request/approved/{order_id}' , 'ReturnRequestApproved')->name('return.request.approved');

    Route::get('/complete/return/request' , 'CompleteReturnRequest')->name('complete.return.request');
   

});


 // Report All Route 
Route::controller(ReportController::class)->group(function(){

    Route::get('/report/view' , 'ReportView')->name('report.view');
    Route::post('/search/by/date' , 'SearchByDate')->name('search-by-date');
    Route::post('/search/by/month' , 'SearchByMonth')->name('search-by-month');
    Route::post('/search/by/year' , 'SearchByYear')->name('search-by-year');

    Route::get('/order/by/user' , 'OrderByUser')->name('order.by.user');
    Route::post('/search/by/user' , 'SearchByUser')->name('search-by-user');
 
});


 // Active user and vendor All Route 
Route::controller(ActiveUserController::class)->group(function(){

    Route::get('/all/user' , 'AllUser')->name('all-user');
	Route::get('/all/member' , 'AllMember')->name('all-member');
    Route::get('/all/vendor' , 'AllVendor')->name('all-vendor');
    
 
});


 // Blog Category All Route 
Route::controller(BlogController::class)->group(function(){

 Route::get('/admin/blog/category' , 'AllBlogCateogry')->name('admin.blog.category'); 

  Route::get('/admin/add/blog/category' , 'AddBlogCateogry')->name('add.blog.categroy');

  Route::post('/admin/store/blog/category' , 'StoreBlogCateogry')->name('store.blog.category');
  Route::get('/admin/edit/blog/category/{id}' , 'EditBlogCateogry')->name('edit.blog.category');

  Route::post('/admin/update/blog/category' , 'UpdateBlogCateogry')->name('update.blog.category');

  Route::get('/admin/delete/blog/category/{id}' , 'DeleteBlogCateogry')->name('delete.blog.category');
    
 
});



 // Blog Post All Route 
Route::controller(BlogController::class)->group(function(){

 Route::get('/admin/blog/post' , 'AllBlogPost')->name('admin.blog.post'); 

  Route::get('/admin/add/blog/post' , 'AddBlogPost')->name('add.blog.post');

  Route::post('/admin/store/blog/post' , 'StoreBlogPost')->name('store.blog.post');
  Route::get('/admin/edit/blog/post/{id}' , 'EditBlogPost')->name('edit.blog.post');

  Route::post('/admin/update/blog/post' , 'UpdateBlogPost')->name('update.blog.post');

  Route::get('/admin/delete/blog/post/{id}' , 'DeleteBlogPost')->name('delete.blog.post');
    
 
});


// Admin Reviw All Route 
Route::controller(ReviewController::class)->group(function(){

 Route::get('/pending/review' , 'PendingReview')->name('pending.review');
 Route::get('/review/approve/{id}' , 'ReviewApprove')->name('review.approve');
 Route::get('/publish/review' , 'PublishReview')->name('publish.review'); 
 Route::get('/review/delete/{id}' , 'ReviewDelete')->name('review.delete');
});


// Site Setting All Route 
Route::controller(SiteSettingController::class)->group(function(){

 Route::get('/site/setting' , 'SiteSetting')->name('site.setting');
 Route::post('/site/setting/update' , 'SiteSettingUpdate')->name('site.setting.update');

 Route::get('/seo/setting' , 'SeoSetting')->name('seo.setting');
  Route::post('/seo/setting/update' , 'SeoSettingUpdate')->name('seo.setting.update');
});


// Permission All Route 
Route::controller(RoleController::class)->group(function(){

 Route::get('/all/permission' , 'AllPermission')->name('all.permission');
 Route::get('/add/permission' , 'AddPermission')->name('add.permission');
 Route::post('/store/permission' , 'StorePermission')->name('store.permission');
 Route::get('/edit/permission/{id}' , 'EditPermission')->name('edit.permission');

 Route::post('/update/permission' , 'UpdatePermission')->name('update.permission');

  Route::get('/delete/permission/{id}' , 'DeletePermission')->name('delete.permission');
 
});
   // JobVacancy route...
Route::controller(JobVacancyController::class)->group(function(){

    Route::get('jobcreate' , 'create')->name('jobcreate');
    Route::post('jobstore' , 'store')->name('jobstore');
    Route::get('jobindex' , 'index')->name('jobindex');
   
    Route::get('jobedit/{id}' , 'edit')->name('jobedit');
	
	Route::post('jobupdate/{id}' , 'update')->name('jobupdate');
   
    Route::get('jobdestroy/{id}' , 'destroy')->name('jobdestroy');
     Route::get('jobview/{id}' , 'show')->name('jobshow');
	Route::post('job/update-status' , 'update_status')->name('jobstatus');
   
   });

 


// Roles All Route 
Route::controller(RoleController::class)->group(function(){

 Route::get('/all/roles' , 'AllRoles')->name('all.roles');
 Route::get('/add/roles' , 'AddRoles')->name('add.roles');
 Route::post('/store/roles' , 'StoreRoles')->name('store.roles');
 Route::get('/edit/roles/{id}' , 'EditRoles')->name('edit.roles');

 Route::post('/update/roles' , 'UpdateRoles')->name('update.roles');

 Route::get('/delete/roles/{id}' , 'DeleteRoles')->name('delete.roles');

 // add role permission 

 Route::get('/add/roles/permission' , 'AddRolesPermission')->name('add.roles.permission');

 Route::post('/role/permission/store' , 'RolePermissionStore')->name('role.permission.store');
 
  Route::get('/all/roles/permission' , 'AllRolesPermission')->name('all.roles.permission');

  Route::get('/admin/edit/roles/{id}' , 'AdminRolesEdit')->name('admin.edit.roles');

  Route::post('/admin/roles/update/{id}' , 'AdminRolesUpdate')->name('admin.roles.update');

 Route::get('/admin/delete/roles/{id}' , 'AdminRolesDelete')->name('admin.delete.roles');

});



// Admin User All Route 
Route::controller(AdminController::class)->group(function(){

 Route::get('/all/admin' , 'AllAdmin')->name('all.admin');
 Route::get('/add/admin' , 'AddAdmin')->name('add.admin');
 Route::post('/admin/user/store' , 'AdminUserStore')->name('admin.user.store');

 Route::get('/edit/admin/role/{id}' , 'EditAdminRole')->name('edit.admin.role');

 Route::post('/admin/user/update/{id}' , 'AdminUserUpdate')->name('admin.user.update');
  Route::get('/delete/admin/role/{id}' , 'DeleteAdminRole')->name('delete.admin.role');

});

// Member All Route 
Route::controller(MemberController::class)->group(function(){

    Route::get('/all/member/' , 'AllMember')->name('all.member');
    Route::get('/add/member' , 'AddMember')->name('add.member');
    Route::post('/admin/member/stored' , 'AdminMemberStored')->name('admin.member.stored');
   
    Route::get('/edit/member/role/{id}' , 'EditMemberRole')->name('edit.member.role');
	
	Route::get('/view/member/role/{id}' , 'ViewMemberRole')->name('view.member.role');
   
    Route::post('/member/update/{id}' , 'AdminMemberUpdate')->name('member.update');
     Route::get('/delete/member/role/{id}' , 'DeleteMemberRole')->name('delete.member.role');
   
     Route::get('/member/ajax/{division_id}' , 'GetDivision');
   });


  
}); // Admin End Middleware 


/// Frontend Product Details All Route 

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);

Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Product View Modal With Ajax

Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
/// Add to cart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

/// Add to cart store data For Product Details Page 
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);

/// Add to Wishlist 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

/// Add to Compare 
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

/// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout Page Route 
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');





 // Cart All Route 
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart' , 'MyCart')->name('mycart');
    Route::get('/get-cart-product' , 'GetCartProduct');
    Route::get('/cart-remove/{rowId}' , 'CartRemove');

    Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
    Route::get('/cart-increment/{rowId}' , 'CartIncrement');
    

}); 

// Frontend Blog Post All Route 
// Route::controller(BlogController::class)->group(function(){

//  Route::get('/blog' , 'AllBlog')->name('home.blog');  
//  Route::get('/post/details/{id}/{slug}' , 'BlogDetails'); 
//   Route::get('/post/category/{id}/{slug}' , 'BlogPostCategory');  
 
// });


// Frontend Blog Post All Route 
Route::controller(ReviewController::class)->group(function(){

 Route::post('/store/review' , 'StoreReview')->name('store.review'); 
 
});


// Search All Route 
Route::controller(IndexController::class)->group(function(){

 Route::post('/search' , 'ProductSearch')->name('product.search');
 Route::post('/search-product' , 'SearchProduct'); 
 
});

// Shop Page All Route 
Route::controller(ShopController::class)->group(function(){

 Route::get('/shop' , 'ShopPage')->name('shop.page');
 Route::post('/shop/filter' , 'ShopFilter')->name('shop.filter');
 
});





Route::post('ckeditor/upload', [BlogController::class, 'ckupload'])->name('ckeditor.upload');

 

/// User All Route
Route::middleware(['auth','role:user'])->group(function() {

 // Wishlist All Route 
Route::controller(WishlistController::class)->group(function(){
    Route::get('/wishlist' , 'AllWishlist')->name('wishlist');
    Route::get('/get-wishlist-product' , 'GetWishlistProduct');
    Route::get('/wishlist-remove/{id}' , 'WishlistRemove'); 

}); 


 // Compare All Route 
Route::controller(CompareController::class)->group(function(){
    Route::get('/compare' , 'AllCompare')->name('compare');
    Route::get('/get-compare-product' , 'GetCompareProduct');
   Route::get('/compare-remove/{id}' , 'CompareRemove'); 

}); 



 // Checkout All Route 
Route::controller(CheckoutController::class)->group(function(){
    Route::get('/district-get/ajax/{division_id}' , 'DistrictGetAjax');
    Route::get('/state-get/ajax/{district_id}' , 'StateGetAjax');

    Route::post('/checkout/store' , 'CheckoutStore')->name('checkout.store');
  

}); 


 // Stripe All Route 
Route::controller(StripeController::class)->group(function(){
    Route::post('/stripe/order' , 'StripeOrder')->name('stripe.order');
    Route::post('/cash/order' , 'CashOrder')->name('cash.order');
  

}); 


 // User Dashboard All Route 
Route::controller(AllUserController::class)->group(function(){
 Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');
 Route::get('/user/change/password' , 'UserChangePassword')->name('user.change.password');

 Route::get('/user/order/page' , 'UserOrderPage')->name('user.order.page');

 Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');
 Route::get('/user/invoice_download/{order_id}' , 'UserOrderInvoice');  

 Route::post('/return/order/{order_id}' , 'ReturnOrder')->name('return.order');

 Route::get('/return/order/page' , 'ReturnOrderPage')->name('return.order.page');

  // Order Tracking 
  Route::get('/user/track/order' , 'UserTrackOrder')->name('user.track.order');
  Route::post('/order/tracking' , 'OrderTracking')->name('order.tracking');


}); 





}); // end group User middleware

// frontend route...

Route::controller(FrontendController::class)->group(function(){

    Route::get('/joinus' , 'AddMembers')->name('joinus');
    Route::get('/certifications' , 'Certifications')->name('certifications');
    Route::get('/udyamcertifications' , 'UdyamCertifications')->name('udyamcertifications');
    Route::get('/gstcertifications' , 'GstCertifications')->name('gstcertifications');
    Route::get('/udyamragistercertifications' , 'UdyamragisterCertifications')->name('udyamragistercertifications');



    
    Route::post('/admin/member/store' , 'AdminMemberStore')->name('admin.member.store');
   
   
   });

   


Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('/about-us',[FrontendController::class,'about'])->name('about-us');
Route::get('/certification',[FrontendController::class,'certification'])->name('certification');
Route::get('/leadership',[FrontendController::class,'leadership'])->name('leadership');
Route::get('/service',[FrontendController::class,'service'])->name('service');
// Route::get('/product',[FrontendController::class,'product'])->name('product');

Route::post('inquirystore',[FrontendController::class,'store'])->name('inquirystored');

// Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
// Route::get('/product/{subcategory_name}/{id}',[FrontendController::class,'productdeatils'])->name('productdeatils');

// Multi Active/InActive Route
Route::delete('/banner/activate-selected', [BannerController::class, 'activateSelected'])->name('activate.selected.banner');
Route::delete('/banner/deactivate-selected', [BannerController::class, 'deactivateSelected'])->name('deactivate.selected.banner');

Route::delete('/slider/activate-selected', [SliderController::class, 'activateSelected'])->name('activate.selected.slider');
Route::delete('/slider/deactivate-selected', [SliderController::class, 'deactivateSelected'])->name('deactivate.selected.slider');

Route::delete('/project/activate-selected', [ProjectController::class, 'activateSelected'])->name('activate.selected.project');
Route::delete('/project/deactivate-selected', [ProjectController::class, 'deactivateSelected'])->name('deactivate.selected.project');

Route::delete('/category/activate-selected', [CategoryController::class, 'activateSelected'])->name('activate.selected.category');
Route::delete('/category/deactivate-selected', [CategoryController::class, 'deactivateSelected'])->name('deactivate.selected.category');

Route::delete('/application/activate-selected', [ApplicationController::class, 'activateSelected'])->name('activate.selected.application');
Route::delete('/application/deactivate-selected', [ApplicationController::class, 'deactivateSelected'])->name('deactivate.selected.application');

Route::delete('/about/activate-selected', [AboutController::class, 'activateSelected'])->name('activate.selected.about');
Route::delete('/about/deactivate-selected', [AboutController::class, 'deactivateSelected'])->name('deactivate.selected.about');

Route::post('/testimonial/activate-selected', [TestimonialController::class, 'activateSelectedTestimonials'])->name('activate.selected.testimonials');
Route::post('/testimonial/deactivate-selected', [TestimonialController::class, 'deactivateSelectedTestimonials'])->name('deactivate.selected.testimonials');

Route::post('/quality/activate-selected', [QualityController::class, 'activateSelectedquality'])->name('activate.selected.quality');
Route::post('/quality/deactivate-selected', [QualityController::class, 'deactivateSelectedquality'])->name('deactivate.selected.quality');

Route::post('/seo/activate-selected', [SeoController::class, 'activateSelected'])->name('activate.selected.seo');
Route::post('/seo/deactivate-selected', [SeoController::class, 'deactivateSelected'])->name('deactivate.selected.seo');

Route::delete('/blog/category/activate-selected', [BlogController::class, 'activatecSelected'])->name('activate.selected.blogcategory');
Route::delete('/blog/category/deactivate-selected', [BlogController::class, 'deactivatecSelected'])->name('deactivate.selected.blogcategory');

Route::delete('/blog/post/activate-selected', [BlogController::class, 'activatepSelected'])->name('activate.selected.blogpost');
Route::delete('/blog/post/deactivate-selected', [BlogController::class, 'deactivatepSelected'])->name('deactivate.selected.blogpost');

Route::delete('/blogseo/activate-selected', [SeoblogController::class, 'activateSelected'])->name('activate.selected.blogseo');
Route::delete('/blogseo/deactivate-selected', [SeoblogController::class, 'deactivateSelected'])->name('deactivate.selected.blogseo');

Route::delete('/offer/activate-selected', [OfferController::class, 'activateSelected'])->name('activate.selected.offer');
Route::delete('/offer/deactivate-selected', [OfferController::class, 'deactivateSelected'])->name('deactivate.selected.offer');

Route::delete('/service/activate-selected', [ServicesController::class, 'activateSelected'])->name('activate.selected.service');
Route::delete('/service/deactivate-selected', [ServicesController::class, 'deactivateSelected'])->name('deactivate.selected.service');

Route::delete('/faqproductpage/activate-selected', [FaqProductPageController::class, 'activateSelected'])->name('activate.selected.faqproductpage');
Route::delete('/faqproductpage/deactivate-selected', [FaqProductPageController::class, 'deactivateSelected'])->name('deactivate.selected.faqproductpage');

Route::get('/member',[FrontendController::class,'member'])->name('member');
// Route::get('/products',[FrontendController::class,'projects'])->name('products');
Route::get('/products',[FrontendController::class,'category'])->name('products');
Route::get('/custom-bearings',[FrontendController::class,'custombearings'])->name('custombearings');
Route::get('/{project_name}/{id}',[FrontendController::class,'projects'])->name('productsdeatils');
Route::get('/products/{project_name}/{id}',[FrontendController::class,'projectsdeatils'])->name('productsdeatils');

// Route::get('/blogs',[FrontendController::class,'blog'])->name('blog');
// Route::get('/blogs/{post_title}/{id}',[FrontendController::class,'blogdetails'])->name('blogdetails');
Route::get('/catalogs',[FrontendController::class,'catalogs'])->name('catalogs');
Route::get('/partners',[FrontendController::class,'partners'])->name('partners');
Route::get('/news',[FrontendController::class,'news'])->name('news');
Route::get('/news/{post_title}/{id}',[FrontendController::class,'newsdetails'])->name('newsdetails');
// Route::get('/blog/{post_title}/{id}',[FrontendController::class,'blogdeatils'])->name('blogdeatils');

// Route::get('/{member}/{division_name}/{id}', [FrontendController::class, 'member'])->name('members');
Route::get('/vendor',[FrontendController::class,'vendor'])->name('vendor');
// Route::get('/{vendor}/{division_name}/{id}', [FrontendController::class, 'vendor'])->name('vendors');
// Route::get('/{name}/{id}',[FrontendController::class,'member'])->name('member');
Route::get('/contact-us',[FrontendController::class,'contact'])->name('contact-us');
Route::get('/gallery',[FrontendController::class,'gallery'])->name('gallery');

Route::post('inquirystore',[FrontendController::class,'store'])->name('inquirystored');

Route::get('/comingsoon',[FrontendController::class,'comingsoon'])->name('comingsoon');

Route::get('/services',[FrontendController::class,'services'])->name('services');
Route::get('/infrastructure',[FrontendController::class,'infrastructure'])->name('infrastructure');
// Route::get('/{category_name}/{id}',[FrontendController::class,'category'])->name('category');

Route::get('clients',[FrontendController::class,'clients'])->name('clients');
Route::get('/product',[FrontendController::class,'product'])->name('product');
//Route::get('/application',[FrontendController::class,'application'])->name('application');
// Route::get('application/{application_name}/{id}',[FrontendController::class,'application'])->name('application');
//Route::get('/application/{application_name}/{id}',[FrontendController::class,'applicationdeatils'])->name('applicationdeatils');

Route::get('/videogallery',[FrontendController::class,'videogallery'])->name('videogallery');

Route::get('/certificate',[FrontendController::class,'certificate'])->name('certificate');
Route::get('/quality-assurance',[FrontendController::class,'quality'])->name('quality');
Route::get('/infrastructure',[FrontendController::class,'infrastructure'])->name('infrastructure');

// Route::get('/category/{category_id}/{category_name}', [FrontendController::class, 'category'])->name('category');

Route::get('/search', [FrontendController::class, 'search'])->name('search');
Route::get('/suggest', [FrontendController::class, 'suggest'])->name('suggest');
Route::get('/joboffers',[FrontendController::class,'joboffers'])->name('joboffers');

// Route::get('/{servicedetails}/{id}',[FrontendController::class,'servicedetails'])->name('servicedetails');

Route::get('/thankyou',[FrontendController::class,'thanks'])->name('thanks');

// Route::get('/{division_name}/{id}',[FrontendController::class,'agency'])->name('agency');


Route::post('landtfromstore','MasterformController@store')->name('landtfromstore');

// Contact route..
Route::get('contactshow','MasterformController@show')->name('contactshow');
Route::get('contactview/{id}','MasterformController@view')->name('contactview');



Route::delete('/delete/image/{id}', [ProjectController::class, 'deleteImage'])->name('delete.image');


// Route::get('services/{category_name}/{id}',[FrontendController::class,'category'])->name('category');

// Route::get('/{category_name}/{subcategory_name}/{id}',[FrontendController::class,'servicedetails'])->name('subcategory');

Route::get('/home', function () {
    return redirect('/');
});


Route::fallback(function () {
    return redirect('/');
});

