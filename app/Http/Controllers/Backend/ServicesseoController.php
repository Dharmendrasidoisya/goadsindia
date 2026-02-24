<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Seo;
use App\Models\Servicesseo;
use App\Models\Services;


use App\Models\Category;


use Image;
 
class ServicesseoController extends Controller
{
     public function Allservicesseo(){
        // dd('test');
        $productseos = Servicesseo::latest()->get();
        // dd($categories);
        return view('backend.productsseo.productsseo_all',compact('productseos'));
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
         
        $categories = Servicesseo::latest()->get();
        $Services = Project::latest()->get();
        return view('backend.productsseo.productsseo_add',compact('categories','Services'));
    }// End Method 



 public function Storeservicesseo(Request $request){   
         
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

        Servicesseo::insert([
            'services_id' => $request->services_id,
            'meta_title' => $request->meta_title,
            'keyword' => $request->keyword,
            'description' => $request->description,
            'schema' => $request->schema,
            'canonical' => $request->canonical,
            'image' => $request->image,
            'status' => 1,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            // 'project_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Productseo Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.productsseo')->with($notification); 

    }// End Method 



    public function Editservicesseo($id){
        $category = Servicesseo::findOrFail($id);
		 $categories = Category::orderBy('category_name', 'ASC')->get();
         $Services = Project::latest()->get();
        return view('backend.productsseo.productsseo_edit',compact('category','categories','Services'));
    }// End Method 


   public function Updateservicesseo(Request $request)
    {
        $cat_id = $request->id;
        $old_img = $request->old_image;
    
        // Handle single image upload
     
    
        // Handle multiple images upload
       
    
        // Update other project details
        Servicesseo::findOrFail($cat_id)->update([
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
            'message' => 'Productseo  Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.productsseo')->with($notification); 
    }


    public function Deleteservicesseo($id){

        $category = Servicesseo::findOrFail($id);
      

        Servicesseo::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Productseo Deleted Successfully',
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
            Servicesseo::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Productseo have been deleted successfully.');
    }


    public function activateSelectedproductseo(Request $request)
    {
        $ids = explode(',', $request->ids);
        Servicesseo::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected Productseos Activated Successfully',
                'alert-type' => 'success'
            ];
    
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelectedproductseo(Request $request)
    {
        $ids = explode(',', $request->ids);
        Servicesseo::whereIn('id', $ids)->update(['status' => 0]);

              // Notification
              $notification = [
                'message' => ' Selected Productseos InActivated Successfully',
                'alert-type' => 'success'
            ];

        return redirect()->back()->with($notification);
    }
    

    

} 
