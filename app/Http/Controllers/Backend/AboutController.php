<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\About;

use Image;
 
class AboutController extends Controller
{
     public function Allabout(){
        $categories = About::latest()->get();
        return view('backend.About.about_all',compact('categories'));
    } // End Method 
 
    public function Activeservices(){
        $inActiveUser = About::where('status','active')->get();
        return view('backend.services.active_category',compact('inActiveUser'));

    }
    public function ActivecategoryDetails($id){
        $inactiveAdminDetails = About::findOrFail($id);
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
    public function Addabout(){
        return view('backend.About.about_add');
    }// End Method 



    public function Storeabout(Request $request){

        $save_url = null; // Default to null in case no image is uploaded
    
        if ($request->hasFile('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('upload/category/' . $name_gen);
            $save_url = 'upload/category/' . $name_gen;
        }
    
        About::insert([
            'about_name' => $request->about_name,
            'about_description' => $request->about_description,
            'about_longdescription' => $request->about_longdescription,
            'about_image' => $save_url, // Save image URL or leave as null
            'status' => '1',
        ]);
    
        $notification = array(
            'message' => 'About Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.about')->with($notification);
    }
    



    public function Editabout($id){
        $category = About::findOrFail($id);
        return view('backend.About.about_edit',compact('category'));
    }// End Method 


  public function Updateabout(Request $request){

        $cat_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('about_image')) {

        $image = $request->file('about_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        About::findOrFail($cat_id)->update([
            'about_name' => $request->about_name,
            'about_description' => $request->about_description,
            'about_longdescription' => $request->about_longdescription,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'about_image' => $save_url, 
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'About Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.about')->with($notification); 

        } else {

            About::findOrFail($cat_id)->update([
            'about_name' => $request->about_name,
            'about_description' => $request->about_description,
            'about_longdescription' => $request->about_longdescription,
            'status' => $request->status,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)), 
        ]);

       $notification = array(
            'message' => 'about Updated  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.about')->with($notification); 

        } // end else

    }// End Method 


    public function Deleteabout($id){

        $about = About::findOrFail($id);
    
        // Check if there is an image associated with the record and delete it
        if ($about->about_image) {
            if (file_exists($about->about_image)) {
                unlink($about->about_image); // Delete the image file
            }
        }
    
        // Delete the "About" record from the database
        $about->delete();
    
        $notification = array(
            'message' => 'About Deleted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }
    
 
    public function deleteSelectedcategories(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            About::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Category have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        About::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected About Us Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        About::whereIn('id', $ids)->update(['status' => 0]);

                // Notification
                $notification = [
                    'message' => ' Selected About Us InActivated Successfully',
                    'alert-type' => 'success'
                ];
        
        return redirect()->back()->with($notification);
    }


} 
