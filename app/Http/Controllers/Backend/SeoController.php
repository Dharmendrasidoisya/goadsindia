<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Seo;
use App\Models\Analytics;
use App\Models\Category;


use Image;
 
class SeoController extends Controller
{
     public function Allseo(){
        // dd('test');
        $otherseo = Seo::latest()->get();
        // dd($categories);
        return view('backend.seo.seo_all',compact('otherseo'));
    } // End Method 
 
    public function Allinstruction(){
        // dd('test');
        // $category = Analytics::latest()->get();
        // dd($categories);
        $category = Analytics::find(1);
        return view('backend.seo_master.edit_instruction-analytics',compact('category'));
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

    public function Addinstruction(){
        
        $categories = Analytics::latest()->get();
        return view('backend.seo_master.add_instruction-analytics',compact('categories'));
    }// End Method 

    public function Addseo(){
        
        $categories = Seo::latest()->get();
        return view('backend.seo.seo_add',compact('categories'));
    }// End Method 



 public function Storeseo(Request $request){   

        Seo::insert([
            'menu_home' => $request->menu_home,
            'meta_title' => $request->meta_title,
            'keyword' => $request->keyword,
            'description' => $request->description,
            'schema' => $request->schema,
            'canonical' => $request->canonical,
            'image' => $request->image,
            'status' => 1,
        ]);

       $notification = array(
            'message' => 'Seo Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.seo')->with($notification); 

    }// End Method 

    public function Storeinstruction(Request $request) {   
        // dd($request);
        $cat_id = $request->id;
        $old_img = $request->old_image;
    
        // Update analytics details
        $categories = Analytics::findOrFail($cat_id);
        $categories->head = $request->head;
        $categories->body = $request->body;
        $categories->footer = $request->footer;
        $categories->status = $request->status;
        $categories->save();
    
        // Prepare notification
        $notification = [
            'message' => 'Analytics Updated Successfully',
            'alert-type' => 'success'
        ];
    
        // Redirect back with notification
        return redirect()->back()->with($notification);
    }
    public function Editinstruction($id){
        $category = Analytics::findOrFail($id);
		 $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.seo_master.edit_instruction-analytics',compact('category','categories'));
    }// End Method 
    
   public function Updateinstruction(Request $request)
   {
       $cat_id = $request->id;
       $old_img = $request->old_image;
       // Handle single image upload
       // Handle multiple images upload
       // Update other project details
       Analytics::findOrFail($cat_id)->update([
        'head' => $request->head,
        'body' => $request->body,
        'footer' => $request->footer,
           'status' => $request->status,
           // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
       ]);
   
       // Notification
       $notification = [
           'message' => 'Seo Updated Successfully',
           'alert-type' => 'success'
       ];
   
       return redirect()->route('all.instruction-analytics')->with($notification); 
   }
   public function Deleteinstruction($id){

    $category = Analytics::findOrFail($id);
  

    Analytics::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Analytics Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification); 

}// End Method 

    public function Editseo($id){
        $category = Seo::findOrFail($id);
		 $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.seo.seo_edit',compact('category','categories'));
    }// End Method 


   public function Updateseo(Request $request)
    {
        $cat_id = $request->id;
        $old_img = $request->old_image;
    
        // Handle single image upload
     
    
        // Handle multiple images upload
       
    
        // Update other project details
        Seo::findOrFail($cat_id)->update([
            'menu_home' => $request->menu_home,
            'meta_title' => $request->meta_title,
            'keyword' => $request->keyword,
            'description' => $request->description,
            'schema' => $request->schema,
            'canonical' => $request->canonical,
            'image' => $request->image,
            'status' => $request->status,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);
    
        // Notification
        $notification = [
            'message' => 'Seo Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.seo')->with($notification); 
    }


    public function Deleteseo($id){

        $category = Seo::findOrFail($id);
      

        Seo::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SEO Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 
    public function deleteSelectedproject(Request $request)
    {
        $selectedIds = explode(',', $request->input('ids', ''));
    
        if (!empty($selectedIds)) {
            Seo::whereIn('id', $selectedIds)->delete();
        }
    
        return redirect()->back()->with('success', 'Selected SEO have been deleted successfully.');
    }
    
    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Seo::whereIn('id', $ids)->update(['status' => 1]);

          // Notification
          $notification = [
            'message' => ' Selected Seos Activated Successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Seo::whereIn('id', $ids)->update(['status' => 0]);

               // Notification
               $notification = [
                'message' => ' Selected Seos InActivated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    


} 
