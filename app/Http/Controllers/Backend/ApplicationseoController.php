<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Seo;
use App\Models\Applicationseo;
use App\Models\Services;


use App\Models\Category;


use Image;
 
class ApplicationseoController extends Controller
{
    public function Allapplicationseo(){
       // dd('test');
       $applicationseo = Applicationseo::latest()->get();
       // dd($categories);
       return view('backend.applicationseo.applicationseo_all',compact('applicationseo'));
   } // End Method 

   public function Activecategory(){
       $inActiveUser = Application::where('status','active')->get();
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
   public function Addapplicationseo(){
        
       $categories = Applicationseo::latest()->get();
       $Services = Application::latest()->get();
       return view('backend.applicationseo.applicationseo_add',compact('categories','Services'));
   }// End Method 



public function Storeapplicationseo(Request $request){   
        


    Applicationseo::insert([
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
           'message' => 'Applicationseo Inserted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('all.applicationseo')->with($notification); 

   }// End Method 



   public function Editapplicationseo($id){
       $category = Applicationseo::findOrFail($id);
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $Services = Application::latest()->get();
       return view('backend.applicationseo.applicationseo_edit',compact('category','categories','Services'));
   }// End Method 


  public function Updateapplicationseo(Request $request)
   {
       $cat_id = $request->id;
       $old_img = $request->old_image;
   
       // Handle single image upload
    
   
       // Handle multiple images upload
      
   
       // Update other project details
       Applicationseo::findOrFail($cat_id)->update([
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
           'message' => 'Applicationseo  Updated Successfully',
           'alert-type' => 'success'
       ];
   
       return redirect()->route('all.applicationseo')->with($notification); 
   }


   public function Deleteapplicationseo($id){

       $category = Applicationseo::findOrFail($id);
     

       Applicationseo::findOrFail($id)->delete();

       $notification = array(
           'message' => 'Applicationseo Deleted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification); 

   }// End Method 

   public function deleteSelectedapplicationseo(Request $request)
   {
       // Get the IDs of selected subcategories from the request
       $selectedIds = explode(',', $request->input('ids', ''));
   
       // Delete the selected subcategories if the IDs are not empty
       if (!empty($selectedIds)) {
        Applicationseo::whereIn('id', $selectedIds)->delete();
       }
   
       // Redirect back with a success message
       return redirect()->back()->with('success', 'Selected Applicationseo have been deleted successfully.');
   }

   public function activateSelectedapplicationseo(Request $request)
   {
       $ids = explode(',', $request->ids);
       Applicationseo::whereIn('id', $ids)->update(['status' => 1]);
   
       // Notification
       $notification = [
        'message' => ' Selected Applicationseos Activated Successfully',
        'alert-type' => 'success'
    ];

       return redirect()->back()->with($notification);
   }
   
   public function deactivateSelectedapplicationseo(Request $request)
   {
       $ids = explode(',', $request->ids);
       Applicationseo::whereIn('id', $ids)->update(['status' => 0]);

            // Notification
            $notification = [
                'message' => ' Selected Applicationseos InActivated Successfully',
                'alert-type' => 'success'
            ];
   
       return redirect()->back()->with($notification);
   }


} 
