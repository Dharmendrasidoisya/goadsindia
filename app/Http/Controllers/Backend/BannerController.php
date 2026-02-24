<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{
     public function AllBanner(){
        $banner = Banner::latest()->get();
        return view('backend.banner.banner_all',compact('banner'));
    } // End Method 

 public function AddBanner(){
            return view('backend.banner.banner_add');
    }// End Method 

     public function StoreBanner(Request $request){

        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description,
            'banner_longdescription' => $request->banner_longdescription,
            'banner_image' => $save_url, 
            'status' => '1',
        ]);

       $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.banner')->with($notification); 

    }// End Method 


     public function EditBanner($id){
        $banner = Banner::findOrFail($id);
        return view('backend.banner.banner_edit',compact('banner'));
    }// End Method 


    public function UpdateBanner(Request $request){

        $banner_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('banner_image')) {

        $image = $request->file('banner_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description,
            'banner_longdescription' => $request->banner_longdescription,
            'banner_image' => $save_url, 
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Banner Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification); 

        } else {

            Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description, 
            'banner_longdescription' => $request->banner_longdescription,
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Banner Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification); 

        } // end else

    }// End Method 




    public function DeleteBanner($id){

        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img ); 

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function deleteSelectedbanner(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Banner::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Banner have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Banner::whereIn('id', $ids)->update(['status' => 1]);

           // Notification
           $notification = [
            'message' => ' Selected Banners Activated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Banner::whereIn('id', $ids)->update(['status' => 0]);

           // Notification
           $notification = [
            'message' => ' Selected Banners InActivated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }


}
 