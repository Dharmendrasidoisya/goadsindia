<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Image;
 
class ApplicationController extends Controller
{
     public function Allapplication(){
        $categories = Application::latest()->get();
        return view('backend.Application.Application_all',compact('categories'));
    } // End Method 
 
    public function Activecategory(){
        $inActiveUser = Category::where('status','active')->get();
        return view('backend.Application.active_category',compact('inActiveUser'));

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
    public function Addapplication(){
        // dd('testdddddddddd');
        return view('backend.Application.Application_add');
    }// End Method 



    public function Storeapplication(Request $request)
{

    $save_image_url = null;
    $save_pdf_url   = null;


    if ($request->hasFile('application_image')) {
        $image = $request->file('application_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->save('upload/application/' . $name_gen);

        $save_image_url = 'upload/application/' . $name_gen;
    }


    if ($request->hasFile('application_pdf')) {
        $pdf = $request->file('application_pdf');
        $pdf_name_gen = hexdec(uniqid()) . '.' . $pdf->getClientOriginalExtension();

        $pdf->move('upload/application/pdf/', $pdf_name_gen);

        $save_pdf_url = 'upload/application/pdf/' . $pdf_name_gen;
    }

  
    Application::insert([
        'application_name'        => $request->application_name,
        'application_description' => $request->application_description,
        'application_image'       => $save_image_url, // nullable
        'application_pdf'         => $save_pdf_url,   // nullable
        'status'                  => 1,
    ]);


    $notification = [
        'message' => 'Catalogue Inserted Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.application')->with($notification);
}

    



    public function Editapplication($id){
        $category = Application::findOrFail($id);
        return view('backend.Application.Application_edit',compact('category'));
    }// End Method 


public function Updateapplication(Request $request)
{
    $id = $request->id;

    $application = Application::findOrFail($id);


    $save_image_url = $application->application_image;
    $save_pdf_url   = $application->application_pdf;


    if ($request->hasFile('application_image')) {

        $image = $request->file('application_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('upload/application/' . $name_gen);
        $save_image_url = 'upload/application/' . $name_gen;

    
        if (!empty($application->application_image) && file_exists($application->application_image)) {
            unlink($application->application_image);
        }
    }

   
    if ($request->hasFile('application_pdf')) {

        $pdf = $request->file('application_pdf');
        $pdf_name_gen = hexdec(uniqid()) . '.' . $pdf->getClientOriginalExtension();
        $pdf->move('upload/application/pdf/', $pdf_name_gen);
        $save_pdf_url = 'upload/application/pdf/' . $pdf_name_gen;


        if (!empty($application->application_pdf) && file_exists($application->application_pdf)) {
            unlink($application->application_pdf);
        }
    }

  
    $application->update([
        'application_name'        => $request->application_name,
        'application_description' => $request->application_description,
        'application_image'       => $save_image_url, // unchanged if no new upload
        'application_pdf'         => $save_pdf_url,   // unchanged if no new upload
        'status'                  => $request->status,
    ]);

    $notification = [
        'message' => 'Catalogue Updated Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.application')->with($notification);
}

    public function Deleteapplication($id)
    {
        // Find the application by ID
        $application = Application::findOrFail($id);
    
        // Retrieve the image and PDF paths
        $img = $application->application_image;
        $pdf = $application->application_pdf;
    
        // Delete the image file if it exists
        if (file_exists($img)) {
            unlink($img);
        }
    
        // Delete the PDF file if it exists
        if ($pdf && file_exists($pdf)) {
            unlink($pdf);
        }
    
        // Delete the application record from the database
        Application::findOrFail($id)->delete();
    
        // Set the notification message
        $notification = array(
            'message' => 'Catalogue Deleted Successfully',
            'alert-type' => 'success'
        );
    
        // Redirect back with the notification
        return redirect()->back()->with($notification);
    } // End Method
    
 
  public function deleteSelectedapplication(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Application::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected Catalogue have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Application::whereIn('id', $ids)->update(['status' => 1]);

             // Notification
             $notification = [
                'message' => ' Selected Catalogue Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Application::whereIn('id', $ids)->update(['status' => 0]);

             // Notification
             $notification = [
                'message' => ' Selected Catalogue InActivated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }


} 
