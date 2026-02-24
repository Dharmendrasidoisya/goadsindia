<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ShipDivision;
use App\Models\Application;


use Illuminate\Support\Facades\File;

use Image;

class SubCategoryController extends Controller
{
    public function AllSubCategory()
    {
      
		$subcategories = SubCategory::where('status', 'active')->get();
        return view('backend.subcategory.subcategory_all', compact('subcategories'));
    } // End Method 

    public function Activesubcategory()
    {
        $inActiveUser = SubCategory::where('status', 'active')->get();
        return view('backend.subcategory.active_subcategory', compact('inActiveUser'));
    }
    public function ActivesubcategoryDetails($id)
    {
        $inactiveAdminDetails = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        $locations = ShipDivision::orderBy('division_name', 'ASC')->get();

        return view('backend.subcategory.active_subcategory_details', compact('inactiveAdminDetails', 'categories', 'subcategory', 'locations'));
    }
    public function ActivesubcategoryApprove(Request $request)
    {

        $user_id = $request->id;
        $user = SubCategory::findOrFail($user_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Subcategory InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.subcategory')->with($notification);
    }
    public function Inactivesubcategory()
    {
        $inActiveUser = SubCategory::where('status', 'inactive')->get();
        return view('backend.subcategory.inactive_subcategory', compact('inActiveUser'));
    }
    public function InActivesubcategoryDetails($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        $locations = ShipDivision::orderBy('division_name', 'ASC')->get();
        $inactiveAdminDetails = SubCategory::findOrFail($id);
        return view('backend.subcategory.inactive_subcategory_details', compact('inactiveAdminDetails', 'categories', 'subcategory', 'locations'));
    }
    public function InActivesubcategoryApprove(Request $request)
    {

        $user_id = $request->id;
        $user = SubCategory::findOrFail($user_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'SubCategory Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.subcategory')->with($notification);
    }
    public function AddSubCategory()
    {

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $applications = Application::orderBy('application_name', 'ASC')->get();

        return view('backend.subcategory.subcategory_add', compact('categories', 'applications'));
    }
    public function AddSubCategory1()
    {

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $locations = ShipDivision::orderBy('division_name', 'ASC')->get();

        return view('backend.subcategory.subcategory_add1', compact('categories', 'locations'));
    }
    // End Method 
    public function StoreSubCategory1(Request $request)
    {
        // dd($request);
        $image = $request->file('subcategory_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('upload/subcategory/' . $name_gen);
        $save_url = 'upload/subcategory/' . $name_gen;

        SubCategory::insert([
            
            'subcategory_name' => $request->subcategory_name,
            'subcategory_description' => $request->subcategory_description,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'subcategory_image' => $save_url,
            
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    } // End Method 

    public function StoreSubCategory(Request $request)
    {
        // dd($request);

        $images = $request->file('subcategory_images');
        $imagePaths = [];
        $onHomeValue = $request->has('onhome') ? 1 : 0;
        foreach ($images as $image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/subcategory'), $name_gen);
            $imagePaths[] = 'upload/subcategory/' . $name_gen;
        }
        $image = $request->file('subcategory_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('upload/subcategory/' . $name_gen);
        $save_url = 'upload/subcategory/' . $name_gen;

        SubCategory::insert([
            
            'subcategory_name' => $request->subcategory_name,
            'subcategory_description' => $request->subcategory_description,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'subcategory_image' => $save_url,
            'subcategory_images' => json_encode($imagePaths),
           
            'onhome' => $onHomeValue, // Set the value here
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);
    } // End Method 


    public function EditSubCategory($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
		 $onhome = $subcategory->onhome;
        //   dd($subcategory);
        $locations = ShipDivision::orderBy('division_name', 'ASC')->get();
        //   dd($locations);
        $applications = Application::orderBy('application_name', 'ASC')->get();
         
        return view('backend.subcategory.subcategory_edit', compact('categories', 'subcategory', 'locations','onhome','applications'));
    } // End Method 


    public function UpdateSubCategory(Request $request)
    {
        $subcat_id = $request->id;
        $old_img = $request->old_image;
        $onHomeValue = $request->has('onhome') ? 1 : 0;
    
        // Validate the form fields
        $request->validate([
            // Add your validation rules here
        ]);
    
        // Prepare data to update
        $dataToUpdate = [
            
            'subcategory_name' => $request->subcategory_name,
            'subcategory_description' => $request->subcategory_description,
            'onhome' => $onHomeValue, // Set the value here
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'status' => 'active',
            

        ];
    
        // Handle updating the single image
        if ($request->file('subcategory_image')) {
            // Validate and process the single image
            $image = $request->file('subcategory_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('upload/subcategory/' . $name_gen);
            $save_url = 'upload/subcategory/' . $name_gen;
    
            if (file_exists($old_img)) {
                unlink($old_img);
            }
    
            // Update $dataToUpdate with new image path
            $dataToUpdate['subcategory_image'] = $save_url;
        }
    
        // Handle updating the multiple images
        if ($request->hasFile('subcategory_images')) {
            $imagePaths = [];
            foreach ($request->file('subcategory_images') as $image) {
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/subcategory'), $name_gen);
                $imagePaths[] = 'upload/subcategory/' . $name_gen;
            }
            // Update $dataToUpdate with new image paths
            $dataToUpdate['subcategory_images'] = json_encode($imagePaths);
        }
    
        // Update the subcategory
        SubCategory::findOrFail($subcat_id)->update($dataToUpdate);
      // Update division_id separately
   
        // Additional update logic
    
        // Redirect back with notification
        $notification = [
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.subcategory')->with($notification);
    }

    public function deleteImage($id, Request $request) {
        $product = SubCategory::findOrFail($id);
        $imageUrl = $request->input('image_url');
    
        // Logic to delete the image from the database and filesystem
        $images = json_decode($product->subcategory_images);
        $key = array_search($imageUrl, $images);
        if ($key !== false) {
            unset($images[$key]);
            $product->subcategory_images = json_encode(array_values($images));
            $product->save();
            File::delete(public_path($imageUrl)); // Delete image from filesystem
        }
    
        return response()->json(['message' => 'Image deleted successfully']);
    }
    
    public function DeleteSubCategory($id)
    {

        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 


    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    } // End Method 

    public function deleteSelectedSubcategories(Request $request)
{
    // Get the IDs of selected subcategories from the request
    $selectedIds = explode(',', $request->input('ids', ''));

    // Delete the selected subcategories if the IDs are not empty
    if (!empty($selectedIds)) {
        Subcategory::whereIn('id', $selectedIds)->delete();
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Selected subcategories have been deleted successfully.');
}

}
