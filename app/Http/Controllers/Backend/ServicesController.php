<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Services;

use Image;
 
class ServicesController extends Controller
{
     public function Allservices(){
        $categories = Services::latest()->get();
        return view('backend.services.services_all',compact('categories'));
    } // End Method 
 
    public function Activeservices(){
        $inActiveUser = Services::where('status','active')->get();
        return view('backend.services.active_category',compact('inActiveUser'));

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
    public function Addservices(){
        return view('backend.services.services_add');
    }// End Method 



 public function Storeservices(Request $request){

        $image = $request->file('services_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/service/'.$name_gen);
        $save_url = 'upload/service/'.$name_gen;

        Services::insert([
            'services__name' => $request->services__name,
            'services_description' => $request->services_description,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'services_image' => $save_url, 
             'status' => '1',
        ]);

       $notification = array(
            'message' => 'Gallery Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.services')->with($notification); 

    }// End Method 



    public function Editservices($id){
        $category = Services::findOrFail($id);
        return view('backend.services.services_edit',compact('category'));
    }// End Method 


  public function Updateservices(Request $request){

        $cat_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('services_image')) {

        $image = $request->file('services_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/service/'.$name_gen);
        $save_url = 'upload/service/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Services::findOrFail($cat_id)->update([
            'services__name' => $request->services__name,
            'services_description' => $request->services_description,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'services_image' => $save_url, 
             'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Gallery Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.services')->with($notification); 

        } else {

            Services::findOrFail($cat_id)->update([
            'services__name' => $request->services__name,
            'services_description' => $request->services_description,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)), 
             'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Gallery Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.services')->with($notification); 

        } // end else

    }// End Method 


    public function Deleteservices($id){

        $category = Services::findOrFail($id);
        $img = $category->services_image;
        unlink($img ); 

        Services::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Gallery Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 
    public function deleteSelectedcategories(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Services::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Gallery have been deleted successfully.');
    }

public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Services::whereIn('id', $ids)->update(['status' => 1]);

           // Notification
           $notification = [
            'message' => ' Selected Gallery Activated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Services::whereIn('id', $ids)->update(['status' => 0]);

           // Notification
           $notification = [
            'message' => ' Selected Gallery InActivated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }


} 
