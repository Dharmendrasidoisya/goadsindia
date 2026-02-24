<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Seo;
use App\Models\FaqProduct;
use App\Models\Services;


use App\Models\Category;
use App\Models\SubCategory;
use Image;
 
class FaqProductController extends Controller
{
     public function Allfaqproduct(){
        // dd('test');
        $productseos = FaqProduct::with('category','subcategory','project')->latest()->get();
        $cat = Category::latest()->get();
        $sub = SubCategory::latest()->get();
        $Services = Project::latest()->get();
        // dd($categories);
        return view('backend.faqproduct.faqproduct_all',compact('productseos','cat','sub','Services'));
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
    public function Addfaqproduct(){
         
        $categories = FaqProduct::latest()->get();
        $cat = Category::latest()->where('status',1)->get();
        $sub = SubCategory::latest()->where('status',1)->get();
        $Services = Project::latest()->where('status',1)->get();
        return view('backend.faqproduct.faqproduct_add',compact('cat','sub','categories','Services'));
    }// End Method 



// Fetch products based on subcategory ID
public function getProducts($categoryId)
{
    $products = Project::where('category_id', $categoryId)->get();
    return response()->json($products);
}



 public function Storefaqproduct(Request $request){   
         
        // $images = $request->file('project_images');
        // $imagePaths = [];
        //   foreach ($images as $image) {
        //     $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('upload/project'), $name_gen);
        //     $imagePaths[] = 'upload/project/' . $name_gen;
        // }
        // $image = $request->file('project_image');
        // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(500,500)->save('upload/project/'.$name_gen);
        // $save_url = 'upload/project/'.$name_gen;

        FaqProduct::insert([
            'services_id' => $request->services_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'faqproduct_title' => $request->faqproduct_title,
            'faqproduct_longdescriptions' => $request->faqproduct_longdescriptions,
            'status' => 1,
        ]);

       $notification = array(
            'message' => 'FAQ Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.faqproduct')->with($notification); 

    }// End Method 



       public function Editfaqproduct($id){
        $category = FaqProduct::findOrFail($id);
		 $categories = Category::orderBy('category_name', 'ASC')->where('status',1)->get();
         $Services = Project::latest()->where('status',1)->get();
         $sub = SubCategory::latest()->where('status',1)->get();
        return view('backend.faqproduct.faqproduct_edit',compact('sub','category','categories','Services'));
    }// End Method 


   public function Updatefaqproduct(Request $request)
    {
        $cat_id = $request->id;
        $old_img = $request->old_image;
    
        // Handle single image upload
     
    
        // Handle multiple images upload
       
    
        // Update other project details
        FaqProduct::findOrFail($cat_id)->update([
            'services_id' => $request->services_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'faqproduct_title' => $request->faqproduct_title,
            'faqproduct_longdescriptions' => $request->faqproduct_longdescriptions,
            'status' => $request->status,
        ]);
    
        // Notification
        $notification = [
            'message' => 'FAQ Product  Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.faqproduct')->with($notification); 
    }


    public function Deletefaqproduct($id){

        $category = FaqProduct::findOrFail($id);
      

        FaqProduct::findOrFail($id)->delete();

        $notification = array(
            'message' => 'FAQ Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 
    public function deleteSelectedfaqproduct(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            FaqProduct::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected FAQ Product have been deleted successfully.');
    }


    public function activateSelectedfaqproduct(Request $request)
    {
        $ids = explode(',', $request->ids);
        FaqProduct::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected FAQ Product Activated Successfully',
                'alert-type' => 'success'
            ];
    
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelectedfaqproduct(Request $request)
    {
        $ids = explode(',', $request->ids);
        FaqProduct::whereIn('id', $ids)->update(['status' => 0]);

              // Notification
              $notification = [
                'message' => ' Selected FAQ Product InActivated Successfully',
                'alert-type' => 'success'
            ];

        return redirect()->back()->with($notification);
    }
    

    

} 
