<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Seo;
use App\Models\FaqCategory;
use App\Models\Services;


use App\Models\Category;


use Image;
 
class FaqCategoryController extends Controller
{
    public function Allfaqcategory(){
       // dd('test');
       $categoryseo = FaqCategory::with('category')->latest()->get();
       $Services = Category::latest()->get();
       // dd($categories);
       return view('backend.faqcategory.faqcategory_all',compact('Services','categoryseo'));
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
   public function Addfaqcategory(){
        
       $categories = FaqCategory::latest()->get();
       $Services = Category::latest()->where('status',1)->get();
       return view('backend.faqcategory.faqcategory_add',compact('categories','Services'));
   }// End Method 



public function Storefaqcategory(Request $request){   
        
        // dd($request);

           FaqCategory::insert([
           'services_id' => $request->services_id,
           'faqcategory_title' => $request->faqcategory_title,
           'faqcategory_longdescriptions' => $request->faqcategory_longdescriptions,
           'status' => 1,
       ]);

      $notification = array(
           'message' => 'FAQ Category Inserted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('all.faqcategory')->with($notification); 

   }// End Method 



   public function Editfaqcategory($id){
       $category = FaqCategory::findOrFail($id);
        $categories = Category::orderBy('category_name', 'ASC')->where('status',1)->get();
        $Services = Category::latest()->where('status',1)->get();
       return view('backend.faqcategory.faqcategory_edit',compact('category','categories','Services'));
   }// End Method 


  public function Updatefaqcategory(Request $request)
   {
       $cat_id = $request->id;
       $old_img = $request->old_image;
   
       // Handle single image upload
    
   
       // Handle multiple images upload
      
   
       // Update other project details
       FaqCategory::findOrFail($cat_id)->update([
           'services_id' => $request->services_id,
           'faqcategory_title' => $request->faqcategory_title,
           'faqcategory_longdescriptions' => $request->faqcategory_longdescriptions,
           'status' => $request->status,
       ]);
   
       // Notification
       $notification = [
           'message' => 'FAQ Category  Updated Successfully',
           'alert-type' => 'success'
       ];
   
       return redirect()->route('all.faqcategory')->with($notification); 
   }


   public function Deletefaqcategory($id){

       $category = FaqCategory::findOrFail($id);
     

       FaqCategory::findOrFail($id)->delete();

       $notification = array(
           'message' => 'FAQ Category Deleted Successfully',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification); 

   }// End Method 

   public function deleteSelectedfaqcategory(Request $request)
   {
       // Get the IDs of selected subcategories from the request
       $selectedIds = explode(',', $request->input('ids', ''));
   
       // Delete the selected subcategories if the IDs are not empty
       if (!empty($selectedIds)) {
        FaqCategory::whereIn('id', $selectedIds)->delete();
       }
   
       // Redirect back with a success message
       return redirect()->back()->with('success', 'Selected FAQ Category have been deleted successfully.');
   }


   
   public function activateSelectedfaqcategory(Request $request)
   {
       $ids = explode(',', $request->ids);
       FaqCategory::whereIn('id', $ids)->update(['status' => 1]);

       // Notification
       $notification = [
        'message' => ' Selected FAQ Category Activated Successfully',
        'alert-type' => 'success'
    ];
   
       return redirect()->back()->with($notification);
   }
   
   public function deactivateSelectedfaqcategory(Request $request)
   {
       $ids = explode(',', $request->ids);
       FaqCategory::whereIn('id', $ids)->update(['status' => 0]);
   
              // Notification
              $notification = [
                'message' => ' Selected FAQ Category InActivated Successfully',
                'alert-type' => 'success'
            ];

       return redirect()->back()->with($notification);
   }
   
   

} 