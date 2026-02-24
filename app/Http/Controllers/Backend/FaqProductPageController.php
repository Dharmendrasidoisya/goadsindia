<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqProductPage;
use Image;
 
class FaqProductPageController extends Controller
{
     public function Allfaqproductpage(){
        $categories = FaqProductPage::latest()->get();
        return view('backend.faqproductpage.faqproductpage_all',compact('categories'));
    } // End Method 
 
    public function Activefaqproductpage(){
        $inActiveUser = FaqProductPage::where('status','active')->get();
        return view('backend.faqproductpage.active_faqproductpage',compact('inActiveUser'));

    }
    public function ActivefaqproductpageDetails($id){
        $inactiveAdminDetails = FaqProductPage::findOrFail($id);
        return view('backend.faqproductpage.active_faqproductpage_details',compact('inactiveAdminDetails'));
    }
    public function ActivefaqproductpageApprove(Request $request){

        $user_id = $request->id;
        $user = FaqProductPage::findOrFail($user_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Category InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.faqproductpage')->with($notification);

    }
    public function Inactivefaqproductpage(){
        $inActiveUser = FaqProductPage::where('status','inactive')->get();
        return view('backend.faqproductpage.inactive_faqproductpage',compact('inActiveUser'));

    }
    public function InActivefaqproductpageDetails($id){
        $inactiveAdminDetails = FaqProductPage::findOrFail($id);
        return view('backend.faqproductpage.inactive_faqproductpage_details',compact('inactiveAdminDetails'));
    }
    public function InActivefaqproductpageApprove(Request $request){

        $user_id = $request->id;
        $user = FaqProductPage::findOrFail($user_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Category Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.faqproductpage')->with($notification);

    }
    public function Addfaqproductpage(){
        return view('backend.faqproductpage.faqproductpage_add');
    }// End Method 



    public function Storefaqproductpage(Request $request)
    {

        // Handle the image upload
        $save_url = null;
        if ($request->hasFile('faqproductpage_image')) {
            $image = $request->file('faqproductpage_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('upload/category/' . $name_gen);
            $save_url = 'upload/category/' . $name_gen;
        }
    
        // Insert category data into the database
        FaqProductPage::insert([
            'faqproductpage_title' => $request->faqproductpage_title,
            'faqproductpage_description' => $request->faqproductpage_description,
            'faqproductpage_longdescription' => $request->faqproductpage_longdescription,
            'faqproductpage_slug' => strtolower(str_replace(' ', '-', $request->faqproductpage_slug)),
            'faqproductpage_image' => $save_url, // Can be null or default image URL
            'status' => '1',
        ]);
    
        // Notification message
        $notification = array(
            'message' => 'FAQ Product Page Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.faqproductpage')->with($notification);
    }



    public function Editfaqproductpage($id){
        $category = FaqProductPage::findOrFail($id);
        return view('backend.faqproductpage.faqproductpage_edit',compact('category'));
    }// End Method 


  public function Updatefaqproductpage(Request $request){

        $cat_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('faqproductpage_image')) {

        $image = $request->file('faqproductpage_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        FaqProductPage::findOrFail($cat_id)->update([
            'faqproductpage_title' => $request->faqproductpage_title,
            'faqproductpage_description' => $request->faqproductpage_description,
            'faqproductpage_longdescription' => $request->faqproductpage_longdescription,	
            'faqproductpage_slug' => strtolower(str_replace(' ', '-',$request->faqproductpage_slug)),
            'faqproductpage_image' => $save_url, 
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'FAQ Product Page Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.faqproductpage')->with($notification); 

        } else {

            FaqProductPage::findOrFail($cat_id)->update([
            'faqproductpage_title' => $request->faqproductpage_title,
            'faqproductpage_description' => $request->faqproductpage_description,
            'faqproductpage_longdescription' => $request->faqproductpage_longdescription,	
            'faqproductpage_slug' => strtolower(str_replace(' ', '-',$request->faqproductpage_slug)), 
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'FAQ Product Page Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.faqproductpage')->with($notification); 

        } // end else

    }// End Method 


    public function Deletefaqproductpage($id){

        $category = FaqProductPage::findOrFail($id);
        $img = $category->category_image;
        unlink($img ); 

        FaqProductPage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'FAQ Product Page Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 
    public function DeleteSelectedfaqproductpage(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            FaqProductPage::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected FAQ Product Page have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        FaqProductPage::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected FAQProductPage Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        FaqProductPage::whereIn('id', $ids)->update(['status' => 0]);

           // Notification
           $notification = [
            'message' => ' Selected FAQProductPage InActivated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }


} 
