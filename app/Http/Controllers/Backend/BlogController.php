<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Image;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function AllBlogCateogry(){

        $blogcategoryies = BlogCategory::latest()->get();
        return view('backend.blog.category.blogcategroy_all',compact('blogcategoryies'));

    } // End Method 

    public function AddBlogCateogry(){
        return view('backend.blog.category.blogcategroy_add');
    } // End Method 


    public function StoreBlogCateogry(Request $request){
 
        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
            'created_at' => Carbon::now(), 
            'status' => '1',
        ]);

       $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification); 

    }// End Method 


    public function EditBlogCateogry($id){

        $blogcategoryies = BlogCategory::findOrFail($id);
        return view('backend.blog.category.blogcategroy_edit',compact('blogcategoryies'));

    }// End Method 

     public function UpdateBlogCateogry(Request $request){
    
      $blog_id = $request->id;

        BlogCategory::findOrFail($blog_id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)), 
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification); 

    }// End Method 


    public function DeleteBlogCateogry($id){
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method 

    //////////////////// Blog Post Methods //////////////////


 public function AllBlogPost(){

        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.blogpost_all',compact('blogpost'));

    } // End Method 


    public function AddBlogPost(){
        $blogcategory = BlogCategory::latest()->where('status',1)->get();
        return view('backend.blog.post.blogpost_add',compact('blogcategory'));
    } // End Method 


    public function StoreBlogPost(Request $request){

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $save_url, 
            'created_at' => Carbon::now(),
            'status' => '1',
        ]);

       $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.post')->with($notification); 

    }// End Method 


    public function ckupload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
      
            $request->file('upload')->move(public_path('upload/ckmedia'), $fileName);
      
            $url = asset('upload/ckmedia/' . $fileName);
  
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    public function EditBlogPost($id){
         $blogcategory = BlogCategory::latest()->where('status',1)->get();
         $blogpost = BlogPost::findOrFail($id);
        return view('backend.blog.post.blogpost_edit',compact('blogcategory','blogpost'));
    }// End Method 


     public function UpdateBlogPost(Request $request){

        $post_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('post_image')) {

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        BlogPost::findOrFail($post_id)->update([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $save_url, 
            'updated_at' => Carbon::now(),
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Blog Post Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.post')->with($notification); 

        } else {

            BlogPost::findOrFail($post_id)->update([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description, 
            'updated_at' => Carbon::now(),
            'status' => $request->status,
        ]);

       $notification = array(
            'message' => 'Blog Post Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.post')->with($notification); 

        } // end else

    }// End Method 


     public function DeleteBlogPost($id){

        $blogpost = BlogPost::findOrFail($id);
        $img = $blogpost->post_image;
        unlink($img ); 

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 


    //////////////////// Frontend Blog All Method //////////////


    public function AllBlog(){
        $blogcategoryies = BlogCategory::latest()->get();
        $blogpost = BlogPost::latest()->get();
        return view('frontend.blog.home_blog',compact('blogcategoryies','blogpost'));
    }// End Method 

    public function BlogDetails($id,$slug){
        $blogcategoryies = BlogCategory::latest()->get();
        $blogdetails = BlogPost::findOrFail($id);
        $breadcat = BlogCategory::where('id',$id)->get();
        return view('frontend.blog.blog_details',compact('blogcategoryies','blogdetails','breadcat'));

    }// End Method 


    public function BlogPostCategory($id,$slug){

        $blogcategoryies = BlogCategory::latest()->get();
        $blogpost = BlogPost::where('category_id',$id)->get();
        $breadcat = BlogCategory::where('id',$id)->get();
        return view('frontend.blog.category_post',compact('blogcategoryies','blogpost','breadcat'));

    }// End Method 

public function activatecSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        BlogCategory::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected Blog Categorys Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivatecSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        BlogCategory::whereIn('id', $ids)->update(['status' => 0]);

                // Notification
                $notification = [
                    'message' => ' Selected Blog Categorys InActivated Successfully',
                    'alert-type' => 'success'
                ];
        
        return redirect()->back()->with($notification);
    }

    public function activatepSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        BlogPost::whereIn('id', $ids)->update(['status' => 1]);

               // Notification
               $notification = [
                'message' => ' Selected Blog Posts Activated Successfully',
                'alert-type' => 'success'
            ];
        
        return redirect()->back()->with($notification);
    }
    
    public function deactivatepSelected(Request $request)
    {
        $ids = explode(',', $request->ids);
        BlogPost::whereIn('id', $ids)->update(['status' => 0]);

                // Notification
                $notification = [
                    'message' => ' Selected Blog Posts InActivated Successfully',
                    'alert-type' => 'success'
                ];
        
        return redirect()->back()->with($notification);
    }

}
 