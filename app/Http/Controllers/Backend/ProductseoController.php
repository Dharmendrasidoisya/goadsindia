<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Seo;
use App\Models\Productseo;
use App\Models\Services;


use App\Models\Category;


use Image;
 
class ProductseoController extends Controller
{
    public function Allservicesseo(){
       // dd('test');
       $categoryseo = Productseo::latest()->get();
       // dd($categories);
       return view('backend.categoryseo.categoryseo_all',compact('categoryseo'));
   } // End Method 

   public function Activecategory(){
       $inActiveUser = Project::where('status','active')->get();
       return view('backend.category.active_category',compact('inActiveUser'));

   }
   public function ActivecategoryDetails($id){
       $inactiveAdminDetails = Category::findOrFail($id);
       return view('backend.category.active_category_details',compact('inactiveAdminDetails'));
   }
   public function ActivecategoryApprove(Request $request){

       $user_id = $request->id;
       $user = Category::findOrFail($user_id)->update([
           'status' => 'inactive',
       ]);

       $notification = array(
           'message' => 'Category InActive Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('inactive.category')->with($notification);

   }
   public function Inactivecategory(){
       $inActiveUser = Category::where('status','inactive')->get();
       return view('backend.category.inactive_category',compact('inActiveUser'));

   }
   public function InActivecategoryDetails($id){
       $inactiveAdminDetails = Category::findOrFail($id);
       return view('backend.category.inactive_category_details',compact('inactiveAdminDetails'));
   }
   public function InActivecategoryApprove(Request $request){

       $user_id = $request->id;
       $user = Category::findOrFail($user_id)->update([
           'status' => 'active',
       ]);

       $notification = array(
           'message' => 'Category Active Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('active.category')->with($notification);

   }
   public function Addservicesseo(){
        
       $categories = Productseo::latest()->get();
       $Services = Category::latest()->get();
       return view('backend.categoryseo.categoryseo_add',compact('categories','Services'));
   }// End Method 



public function Storeservicesseo(Request $request){   
        


            Productseo::insert([
           'services_id' => $request->services_id,
           'meta_title' => $request->meta_title,
           'keyword' => $request->keyword,
           'description' => $request->description,
           'schema' => $request->schema,
           'canonical' => $request->canonical,
           'image' => $request->image,
           'status' => 1,
       ]);

      $notification = array(
           'message' => 'Categoryseo Inserted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('all.categoryseo')->with($notification); 

   }// End Method 



   public function Editservicesseo($id){
       $category = Productseo::findOrFail($id);
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $Services = Category::latest()->get();
       return view('backend.categoryseo.categoryseo_edit',compact('category','categories','Services'));
   }// End Method 


  public function Updateservicesseo(Request $request)
   {
       $cat_id = $request->id;
       $old_img = $request->old_image;
   
       // Handle single image upload
    
   
       // Handle multiple images upload
      
   
       // Update other project details
       Productseo::findOrFail($cat_id)->update([
           // 'services_id' => $request->services_id,
           'meta_title' => $request->meta_title,
           'keyword' => $request->keyword,
           'description' => $request->description,
           'schema' => $request->schema,
           'canonical' => $request->canonical,
           'image' => $request->image,
           'status' => $request->status,
           // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
       ]);
   
       // Notification
       $notification = [
           'message' => 'Categoryseo  Updated Successfully',
           'alert-type' => 'success'
       ];
   
       return redirect()->route('all.categoryseo')->with($notification); 
   }


   public function Deleteservicesseo($id){

       $category = Productseo::findOrFail($id);
     

       Productseo::findOrFail($id)->delete();

       $notification = array(
           'message' => 'Categoryseo Deleted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification); 

   }// End Method 

   public function deleteSelectedservicesseo(Request $request)
   {
       // Get the IDs of selected subcategories from the request
       $selectedIds = explode(',', $request->input('ids', ''));
   
       // Delete the selected subcategories if the IDs are not empty
       if (!empty($selectedIds)) {
        Productseo::whereIn('id', $selectedIds)->delete();
       }
   
       // Redirect back with a success message
       return redirect()->back()->with('success', 'Selected Categoryseo have been deleted successfully.');
   }


   
   public function activateSelectedcategoryseo(Request $request)
   {
       $ids = explode(',', $request->ids);
       Productseo::whereIn('id', $ids)->update(['status' => 1]);

       // Notification
       $notification = [
        'message' => ' Selected Categoryseos Activated Successfully',
        'alert-type' => 'success'
    ];
   
       return redirect()->back()->with($notification);
   }
   
   public function deactivateSelectedcategoryseo(Request $request)
   {
       $ids = explode(',', $request->ids);
       Productseo::whereIn('id', $ids)->update(['status' => 0]);
   
              // Notification
              $notification = [
                'message' => ' Selected Categoryseos InActivated Successfully',
                'alert-type' => 'success'
            ];

       return redirect()->back()->with($notification);
   }
   
   

} 
