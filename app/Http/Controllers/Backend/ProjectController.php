<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Facades\File;

use Image;
 
class ProjectController extends Controller
{
     public function Allproject(){
        $categories = Project::latest()->get();
        // dd($categories);
        return view('backend.project.project_all',compact('categories'));
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
    public function Addproject(){
        // dd('test');
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.project.project_add',compact('categories'));
    }// End Method 



    public function Storeproject(Request $request)
    {
        // Validate the request
        $request->validate([
            'category_id' => 'required',
            'project_name' => 'required',
            'project_image' => 'required|image',
            'project_images.*' => 'image|nullable', // Ensure multiple images are optional
            'project_pdf' => 'nullable|file|mimes:pdf', // Validate PDF file
            'project_video' => 'nullable|string', // Validate project video (text)
        ]);
    
        // Handle multiple images upload
        $imagePaths = [];
        if ($request->hasFile('project_images')) {
            $images = $request->file('project_images');
            foreach ($images as $image) {
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/project'), $name_gen);
                $imagePaths[] = 'upload/project/' . $name_gen;
            }
        }
    
        // Handle single image upload
        $save_url = null; // Initialize save_url
        if ($request->hasFile('project_image')) {
            $image = $request->file('project_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('upload/project/' . $name_gen));
            $save_url = 'upload/project/' . $name_gen;
        } else {
            return back()->withErrors(['project_image' => 'Single project image is required.']);
        }
    
        // Handle PDF file upload
        $pdfPath = null; // Initialize pdfPath
        if ($request->hasFile('project_pdf')) {
            $pdf = $request->file('project_pdf');
            $pdfName = hexdec(uniqid()) . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('upload/project/pdf'), $pdfName);
            $pdfPath = 'upload/project/pdf/' . $pdfName;
        }
    
        // Insert the project with the uploaded images, PDF, and video
        Project::insert([
            'category_id' => $request->category_id,
            'project_images' => json_encode($imagePaths), // This will be empty if no images are uploaded
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'project_image' => $save_url,
            'project_pdf' => $pdfPath, // Save the PDF path
            'project_video' => $request->project_video, // Save the video text
            'sequence' => $request->sequence,
            'status' => '1',
        ]);
    
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.project')->with($notification);
    } // End Method
    
    



    public function Editproject($id){
        $category = Project::findOrFail($id);
		 $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.project.project_edit',compact('category','categories'));
    }// End Method 


    public function Updateproject(Request $request)
    {
        $cat_id = $request->id;
        $project = Project::findOrFail($cat_id);
    
        // Handle single image upload
        if ($request->hasFile('project_image')) {
            $image = $request->file('project_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/project'), $name_gen);
            $save_url = 'upload/project/' . $name_gen;
    
            // Remove old image if it exists
            if (File::exists($project->project_image)) {
                File::delete($project->project_image);
            }
    
            // Update project with new single image
            $project->update(['project_image' => $save_url]);
        }
    
        // Handle multiple images upload
        if ($request->hasFile('project_images')) {
            $imagePaths = [];
            foreach ($request->file('project_images') as $image) {
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/project'), $name_gen);
                $imagePaths[] = 'upload/project/' . $name_gen;
            }
    
            // Update project with new multiple images
            $project->update(['project_images' => json_encode($imagePaths)]);
        }
    
        // Handle PDF file upload
        if ($request->hasFile('project_pdf')) {
            $pdf = $request->file('project_pdf');
            $pdfName = hexdec(uniqid()) . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('upload/project/pdf'), $pdfName);
            $pdfPath = 'upload/project/pdf/' . $pdfName;
    
            // Remove old PDF if it exists
            if ($project->project_pdf && File::exists($project->project_pdf)) {
                File::delete($project->project_pdf);
            }
    
            // Update project with new PDF
            $project->update(['project_pdf' => $pdfPath]);
        }
    
        // Update project video (text)
        if ($request->filled('project_video')) {
            $project->update(['project_video' => $request->project_video]);
        }
    
        // Update other project details
        $project->update([
            'category_id' => $request->category_id,
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'sequence' => $request->sequence,
            'status' => $request->status,
        ]);
    
        // Notification
        $notification = [
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.project')->with($notification);
    }
    

public function deleteImage($id, Request $request) {
    // Fetch the project by ID
    $project = Project::findOrFail($id);
    // Get the image URL from the request
    $imageUrl = $request->input('image_url');

    // Decode the JSON images from the project
    $images = json_decode($project->project_images);

    // Search for the image URL in the images array
    $key = array_search($imageUrl, $images);

    // If the image is found, delete it
    if ($key !== false) {
        unset($images[$key]); // Remove image from array
        $project->project_images = json_encode(array_values($images)); // Re-encode and save images
        $project->save();

        // Delete the image file from the filesystem
        File::delete(public_path($imageUrl));

        // Return success response
        return response()->json(['message' => 'Image deleted successfully']);
    }

    // If image not found, return error response
    return response()->json(['message' => 'Image not found'], 404);
}

    public function Deleteproject($id){

        $category = Project::findOrFail($id);
        $img = $category->project_image;
        unlink($img ); 

        Project::findOrFail($id)->delete();

        $notification = array(
            'message' => 'product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 
    public function deleteSelectedproject(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Category::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected product have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Project::whereIn('id', $ids)->update(['status' => 1]);

           // Notification
           $notification = [
            'message' => ' Selected Products Activated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Project::whereIn('id', $ids)->update(['status' => 0]);

           // Notification
           $notification = [
            'message' => ' Selected Products InActivated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }
    


} 
