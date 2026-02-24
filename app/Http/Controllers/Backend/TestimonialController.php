<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Image;

class TestimonialController extends Controller
{
     public function Alltestimonial(){
        $banner = Testimonial::latest()->get();
        return view('backend.testimonial.testimonial_all',compact('banner'));
    } // End Method 

 public function Addtestimonial(){
            return view('backend.testimonial.testimonial_add');
    }// End Method 

public function Storetestimonial(Request $request)
{
    $save_url = null;

    if ($request->hasFile('testimonial_image')) {
        $image = $request->file('testimonial_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/testimonial/'.$name_gen);
        $save_url = 'upload/testimonial/'.$name_gen;
    }

    Testimonial::insert([
        'testimonial_name'        => $request->testimonial_name,
        'testimonial_description' => $request->testimonial_description,
        'testimonial_image'       => $save_url, // null if no image
        'status'                  => '1',
    ]);

    $notification = [
        'message'    => 'Testimonial Inserted Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.testimonial')->with($notification);
}



     public function Edittestimonial($id){
        $category = Testimonial::findOrFail($id);
        return view('backend.testimonial.testimonial_edit',compact('category'));
    }// End Method 


    public function Updatetestimonial(Request $request){

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

        Testimonial::findOrFail($cat_id)->update([
            'testimonial_name' => $request->testimonial_name,
            'testimonial_description' => $request->testimonial_description,
            'testimonial_image' => $save_url, 
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Testimonial Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonial')->with($notification); 

        } else {

            Testimonial::findOrFail($cat_id)->update([
            'testimonial_name' => $request->testimonial_name,
            'testimonial_description' => $request->testimonial_description,
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Testimonial Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonial')->with($notification); 

        } // end else

    }// End Method 




    public function Deletetestimonial($id){

        $banner = Testimonial::findOrFail($id);
        $img = $banner->testimonial_image;
        unlink($img ); 

        Testimonial::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Testimonial Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function deleteSelectedtestimonial(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Testimonial::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Testimonial have been deleted successfully.');
    }

    public function activateSelectedTestimonials(Request $request)
    {
        $ids = explode(',', $request->ids);
        Testimonial::whereIn('id', $ids)->update(['status' => 1]);

            // Notification
            $notification = [
                'message' => ' Selected Testimonial Activated Successfully',
                'alert-type' => 'success'
            ];
    
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelectedTestimonials(Request $request)
    {
        $ids = explode(',', $request->ids);
        Testimonial::whereIn('id', $ids)->update(['status' => 0]);

           // Notification
           $notification = [
            'message' => ' Selected Testimonial InActivated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->back()->with($notification);
    }
    

}
 