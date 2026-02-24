<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{



    public function deleteImage(Request $request, $id)
{
    try {
        // Find the banner record by ID
        $banner = Offer::findOrFail($id);

        // Decode the JSON array of images
        $images = json_decode($banner->offer_images, true);

        // Get the image URL to delete
        $imageToDelete = $request->input('image_url');

        // Remove the image from the array
        if (($key = array_search($imageToDelete, $images)) !== false) {
            unset($images[$key]);
        }

        // Update the banner record with the new image array
        $banner->offer_images = json_encode(array_values($images));
        $banner->save();

        // Optionally delete the image file from storage
        $path = str_replace(asset('/'), '', $imageToDelete);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        return response()->json(['message' => 'Image deleted successfully.'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred while deleting the image.'], 500);
    }
}
        public function Alloffer(){
        // dd('test');
        $banner = Offer::whereNotNull('offer_images')
        ->where('offer_images', '!=', '[]')
        ->latest()
        ->get();
      
        return view('backend.offer.offer_all',compact('banner'));
    } // End Method 

 public function Addoffer(){
    // dd('dd');
            return view('backend.offer.offer_add');
    }// End Method 

    public function Storeoffer(Request $request) {
        $imagePaths = [];
    
        // Process multiple offer images
        if ($request->hasFile('offer_images')) {
            $images = $request->file('offer_images');
    
            foreach ($images as $image) {
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/offer'), $name_gen);
                $imagePaths[] = 'upload/offer/' . $name_gen;
            }
        }
    
        // Insert data into the database
        Offer::insert([
            'offer_title' => $request->offer_title,
            'offer_images' => json_encode($imagePaths), // Save multi-images as JSON
            'status' => 1,
        ]);
    
        $notification = [
            'message' => 'Client Logos Inserted Successfully',
            'alert-type' => 'info'
        ];
    
        return redirect()->route('all.offer')->with($notification);
    }
    



     public function Editoffer($id){
        $banner = Offer::findOrFail($id);
        return view('backend.offer.offer_edit',compact('banner'));
        
    }// End Method 


    public function Updateoffer(Request $request)
{
    $banner_id = $request->id;
    $old_img = $request->old_image; // Retaining this variable for consistency

    // Handle multiple images upload
    if ($request->hasFile('offer_images')) {
        $imagePaths = [];

        foreach ($request->file('offer_images') as $image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/offer'), $name_gen);
            $imagePaths[] = 'upload/offer/' . $name_gen;
        }

        // Remove old images if they exist
        if ($old_img) {
            $oldImagesArray = json_decode($old_img, true);
            foreach ($oldImagesArray as $oldImage) {
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
        }

        // Update the offer with new multiple images
        Offer::findOrFail($banner_id)->update([
            'offer_images' => json_encode($imagePaths),
        ]);
    }

    // Update other offer details
    Offer::findOrFail($banner_id)->update([
        'offer_title' => $request->offer_title,
        'status' => $request->status,
    ]);

    // Notification
    $notification = [
        'message' => 'Clients Logo Updated Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.offer')->with($notification);
}

// public function deleteImage($id, Request $request) {
//     $product = Offer::findOrFail($id);
//     $imageUrl = $request->input('image_url');

//     // Logic to delete the image from the database and filesystem
//     $images = json_decode($product->offer_images);
//     $key = array_search($imageUrl, $images);
//     if ($key !== false) {
//         unset($images[$key]);
//         $product->offer_images = json_encode(array_values($images));
//         $product->save();
//         File::delete(public_path($imageUrl)); // Delete image from filesystem
//     }

//     return response()->json(['message' => 'Image deleted successfully']);
// }


    public function Deleteoffer($id){

        $banner = Offer::findOrFail($id);
     

        Offer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Client Logo  Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 

    public function deleteSelectedoffer(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Offer::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Logos have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Offer::whereIn('id', $ids)->update(['status' => 1]);

             // Notification
             $notification = [
                'message' => ' Selected Logos Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Offer::whereIn('id', $ids)->update(['status' => 0]);

             // Notification
             $notification = [
                'message' => ' Selected Logos InActivated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }

}
 