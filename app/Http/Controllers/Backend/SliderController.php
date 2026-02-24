<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
 
class SliderController extends Controller
{
      public function AllSlider(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all',compact('sliders'));
    } // End Method 

    public function AddSlider(){
            return view('backend.slider.slider_add');
    }// End Method 


   public function StoreSlider(Request $request)
{
    $save_url = null; // default if no image uploaded

    if ($request->hasFile('slider_image')) {
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;
    }

    Slider::insert([
        'slider_title' => $request->slider_title,
        'short_title' => $request->short_title,
        'slider_image' => $save_url, // will be null if no image uploaded
        'status' => '1',
    ]);

    $notification = array(
        'message' => 'Industry Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.slider')->with($notification);
} // End Method



    public function EditSlider($id){
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit',compact('sliders'));
    }// End Method 


public function UpdateSlider(Request $request)
{
    $slider_id = $request->id;

    if ($request->hasFile('slider_image')) {
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;

        // delete old image only if it exists
        if ($request->old_image && file_exists($request->old_image)) {
            unlink($request->old_image);
        }

        Slider::findOrFail($slider_id)->update([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
            'status' => $request->status,
        ]);

        $notification = [
            'message' => 'Industry Updated with image Successfully',
            'alert-type' => 'success'
        ];
    } else {
        Slider::findOrFail($slider_id)->update([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'status' => $request->status,
        ]);

        $notification = [
            'message' => 'Industry Updated without image Successfully',
            'alert-type' => 'success'
        ];
    }

    return redirect()->route('all.slider')->with($notification);
} // End Method




    public function DeleteSlider($id){

        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img ); 

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Industry Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 

    public function deleteSelectedslider(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Slider::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Industry have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Slider::whereIn('id', $ids)->update(['status' => 1]);

             // Notification
             $notification = [
                'message' => ' Selected Industry Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Slider::whereIn('id', $ids)->update(['status' => 0]);

             // Notification
             $notification = [
                'message' => ' Selected Industry InActivated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }


} 
