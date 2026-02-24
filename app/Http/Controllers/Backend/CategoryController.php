<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
 
class CategoryController extends Controller
{
     public function AllCategory(){
        $categories = Category::get();
        return view('backend.category.category_all',compact('categories'));
    } // End Method 
 
    public function Activecategory(){
        $inActiveUser = Category::where('status','active')->get();
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
    public function AddCategory(){
        return view('backend.category.category_add');
    }// End Method 



public function StoreCategory(Request $request)
{

    $save_url = null;
    if ($request->hasFile('category_image')) {
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path('upload/category/' . $name_gen));
        $save_url = 'upload/category/' . $name_gen;
    }

    $pdfPath = null;
    if ($request->hasFile('category_pdf')) {
        $pdf = $request->file('category_pdf');
        $pdfName = hexdec(uniqid()) . '.' . $pdf->getClientOriginalExtension();
        $pdf->move(public_path('upload/category/pdf'), $pdfName);
        $pdfPath = 'upload/category/pdf/' . $pdfName;
    }

    Category::create([
        'category_name' => $request->category_name,
        'category_description' => $request->category_description,
        'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        'category_image' => $save_url,   
        'category_pdf' => $pdfPath,   
        'sequence' => $request->sequence,
        'status' => 1,
    ]);

    return redirect()->route('all.category')->with([
        'message' => 'Category Inserted Successfully',
        'alert-type' => 'success',
    ]);
}




    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));
    }// End Method 


  public function UpdateCategory(Request $request)
{
    $cat_id = $request->id;
    $old_img = $request->old_image;
    $old_pdf = $request->old_pdf;

    $save_url = null;
    $pdfPath = null;


    if ($request->hasFile('category_image')) {
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path('upload/category/' . $name_gen));
        $save_url = 'upload/category/' . $name_gen;

    
        if ($old_img && file_exists(public_path($old_img))) {
            unlink(public_path($old_img));
        }
    }


    if ($request->hasFile('category_pdf')) {
        $pdf = $request->file('category_pdf');
        $pdfName = hexdec(uniqid()) . '.' . $pdf->getClientOriginalExtension();
        $pdf->move(public_path('upload/category/pdf'), $pdfName);
        $pdfPath = 'upload/category/pdf/' . $pdfName;


        if ($old_pdf && file_exists(public_path($old_pdf))) {
            unlink(public_path($old_pdf));
        }
    }


    $category = Category::findOrFail($cat_id);
    $category->update([
        'category_name' => $request->category_name,
        'category_description' => $request->category_description,
        'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        'status' => $request->status,
        'category_image' => $save_url ?? $category->category_image,
        'category_pdf'   => $pdfPath ?? $category->category_pdf,
        'sequence' => $request->sequence,
    ]);

    return redirect()->route('all.category')->with([
        'message' => 'Category Updated Successfully',
        'alert-type' => 'success',
    ]);
}



    public function DeleteCategory($id){

        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img ); 

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 
    public function DeleteSelectedcategories(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Category::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Category have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Category::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected Categorys Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Category::whereIn('id', $ids)->update(['status' => 0]);

           // Notification
           $notification = [
            'message' => ' Selected Categorys InActivated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }


} 
