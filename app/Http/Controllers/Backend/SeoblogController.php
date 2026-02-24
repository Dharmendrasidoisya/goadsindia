<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Seo;
use App\Models\Seoblog;

use DB;
use App\Models\Category;
use GuzzleHttp\Handler\Proxy;
use Image;
 
class SeoblogController extends Controller
{
     public function Allblogseo(){
        // dd('test');
        $blogseo = Seoblog::latest()->get();
        $blogpost = BlogPost::latest()->get();
        // dd($categories);
        return view('backend.blogseo.blogseo_all',compact('blogseo','blogpost'));
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
    public function Addblogseo(){
        
        $blogcategory = BlogCategory::latest()->get();
        $blogseo = Seoblog::latest()->get();
        $blogpost = BlogPost::where('category_id','1')->latest()->get();
        $blogpostn = BlogPost::where('category_id','2')->latest()->get();
        return view('backend.blogseo.blogseo_add',compact('blogpostn','blogcategory','blogseo','blogpost'));
    }// End Method 



 public function Storeblogseo(Request $request){   
         
        // $images = $request->file('project_images');
        // $imagePaths = [];
        //   foreach ($images as $image) {
        //     $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('upload/project'), $name_gen);
        //     $imagePaths[] = 'upload/project/' . $name_gen;
        // }
        // $image = $request->file('project_image');
        // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(500,500)->save('upload/project/'.$name_gen);
        // $save_url = 'upload/project/'.$name_gen;

        Seoblog::insert([
            'category_id' => $request->category_id,
             'post_id' => $request->post_id,
            'meta_title' => $request->meta_title,
            'keyword' => $request->keyword,
            'description' => $request->description,
            'schema' => $request->schema,
            'canonical' => $request->canonical,
            'image' => $request->image,
            'status' => 1,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            // 'project_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'blogseo Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blogseo')->with($notification); 

    }// End Method 



    public function Editblogseo($id){
        $blogcategory = BlogCategory::latest()->get();
        $category = Seoblog::findOrFail($id);
        $blogseo = Seoblog::findOrFail($id);
        $blogpost = BlogPost::where('category_id','1')->latest()->get();
        $blogpostn = BlogPost::where('category_id', '2')->latest()->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        
        $selectedCategoryId = $blogseo->category_id;
        $selectedPostId = $blogseo->post_id; // Assuming 'post_id' exists in Seoblog
        // dd($category);
 
        return view('backend.blogseo.blogseo_edit', compact('blogpostn', 'blogcategory', 'category', 'categories', 'selectedCategoryId', 'blogseo', 'blogpost', 'selectedPostId'));
    }


   public function Updateblogseo(Request $request)
    {

        $cat_id = $request->id;
        $old_img = $request->old_image;
    
        // Handle single image upload
     
    
        // Handle multiple images upload
       
    
        // Update other project details
        Seoblog::findOrFail($cat_id)->update([
            // 'category_id' => (int)$request->category_id, // Convert to integer
			
            'post_id' => $request->post_id,
            'meta_title' => $request->meta_title,
            'keyword' => $request->keyword,
            'description' => $request->description,
            'schema' => $request->schema,
            'canonical' => $request->canonical,
            'image' => $request->image,
            'status' => $request->status,
        ]);
    
        // Notification
        $notification = [
            'message' => 'blogseo Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.blogseo')->with($notification); 
    }


    public function Deleteblogseo($id){

        $category = Seoblog::findOrFail($id);
      

        Seoblog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'blogseo Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 
    public function deleteSelectedblogseo(Request $request)
    {
        // Get the IDs of selected subcategories from the request
        $selectedIds = explode(',', $request->input('ids', ''));
    
        // Delete the selected subcategories if the IDs are not empty
        if (!empty($selectedIds)) {
            Seoblog::whereIn('id', $selectedIds)->delete();
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected blog have been deleted successfully.');
    }

    public function activateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Seoblog::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected blogseos Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivateSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        Seoblog::whereIn('id', $ids)->update(['status' => 0]);

                // Notification
                $notification = [
                    'message' => ' Selected blogseos InActivated Successfully',
                    'alert-type' => 'success'
                ];
        
        return redirect()->back()->with($notification);
    }



} 
