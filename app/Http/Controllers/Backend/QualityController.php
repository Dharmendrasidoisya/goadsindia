<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quality;
use Image;

class QualityController extends Controller
{
     public function Allquality(){
        $banner = Quality::latest()->get();
        return view('backend.quality.quality_all',compact('banner'));
    } // End Method 

 public function Addquality(){
            return view('backend.quality.quality_add');
    }// End Method 

public function Storequality(Request $request)
{
    $save_url = null;

    if ($request->hasFile('testimonial_image')) {
        $image = $request->file('testimonial_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/testimonial/'.$name_gen);
        $save_url = 'upload/testimonial/'.$name_gen;
    }

    Quality::insert([
        'testimonial_name'        => $request->testimonial_name,
        'testimonial_description' => $request->testimonial_description,
        'testimonial_image'       => $save_url, // null if no image
        'status'                  => '1',
    ]);

    $notification = [
        'message'    => 'Infrastructure Inserted Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.quality')->with($notification);
}



     public function Editquality($id){
        $category = Quality::findOrFail($id);
        return view('backend.quality.quality_edit',compact('category'));
    }// End Method 


    public function Updatequality(Request $request){

        $cat_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('testimonial_image')) {

        $image = $request->file('testimonial_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/testimonial/'.$name_gen);
        $save_url = 'upload/testimonial/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Quality::findOrFail($cat_id)->update([
            'testimonial_name' => $request->testimonial_name,
            'testimonial_description' => $request->testimonial_description,
            'testimonial_image' => $save_url, 
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Infrastructure Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.quality')->with($notification); 

        } else {

            Quality::findOrFail($cat_id)->update([
            'testimonial_name' => $request->testimonial_name,
            'testimonial_description' => $request->testimonial_description,
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Infrastructure Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.quality')->with($notification); 

        } // end else

    }// End Method 




    public function Deletequality($id){

        $banner = Quality::findOrFail($id);
        $img = $banner->testimonial_image;
        unlink($img ); 

        Quality::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Infrastructure Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function deleteSelectedquality(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Quality::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Infrastructure have been deleted successfully.');
    }

    public function activateSelectedquality(Request $request)
    {
        $ids = explode(',', $request->ids);
        Quality::whereIn('id', $ids)->update(['status' => 1]);

            // Notification
            $notification = [
                'message' => ' Selected Infrastructure Activated Successfully',
                'alert-type' => 'success'
            ];
    
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelectedquality(Request $request)
    {
        $ids = explode(',', $request->ids);
        Quality::whereIn('id', $ids)->update(['status' => 0]);

           // Notification
           $notification = [
            'message' => ' Selected Infrastructure InActivated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->back()->with($notification);
    }
    

}
 