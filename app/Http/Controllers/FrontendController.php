<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Category;
use App\Models\Project;

use App\Models\FaqProductPage;
use App\Models\FaqCategory;
use App\Models\FaqSubCategory;
use App\Models\FaqProduct;

use App\Models\Application;

use App\Models\Seo;
use App\Models\SubCategory;
use App\Models\Role;
use App\Models\Banner;
use App\Models\Offer;
use App\Models\ShipDivision;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\JobVacancy;
use App\Models\BlogPost;
use App\Models\Services;
use App\Models\About;
use App\Models\Slider;
use App\Models\Quality;
use App\Models\Inquiry;
use App\Models\Seoblog;
use App\Models\Servicesseo;
use App\Models\Analytics;

use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\File;



use Image;
use Mail;

use Illuminate\Support\Facades\Http;


class FrontendController extends Controller
{
    public function index(request $id)
    {
        $settings = SiteSetting::latest()->get();
        $blogPost = BlogPost::where('category_id','1')->where('status', '1')->get()->take(3);
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $About = About::latest()->where('status', '1')->get();
        $categories = Services::latest()->get();
        $Projects = Project::latest()->where('status', '1')->get();
        $sliders = Slider::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
   
        $banner = Banner::latest()->where('status', '1')->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		$producttik = Category::latest()
		->take(5)
		->get();

        // dd($producttik);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
        $searchTerm = $id->input('search', '');

        if (!empty($searchTerm)) {
            $products = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")->latest()->get();
        } else {
            $products = SubCategory::latest()->get();
        }
        $application = Application::latest()->take(3)->get();
        //    dd($agencys);
        $application_front = Application::where('id', $id)->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','0')->where('status','1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.index', compact('Analytics','otherseo','blogPost','sliders','alladminuser','About','divisions', 'categories','Projects','banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','category','producttik'));
    }

    public function store(Request $request)
    {
        // dd($request);

        // Allowed domain
        $allowedDomain = 'lkfbearings.com';
    
        // Extract domain from the request's root URL
        $currentDomain = str_replace('www.', '', parse_url($request->root(), PHP_URL_HOST));

        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required',
                'location' => 'required',
                'phone' => 'required',
                'mes' => 'required',
                'captcha' => 'required|same:kcaptcha',
            ],
            [
                'name' => 'Name is required.',
                'email' => 'Email is required.',
                'location' => 'Location is required.',
                'phone' => 'Phone is required.',
                'mes' => 'Message is required.',
                'captcha' => 'Validation code not match.',
            ]
        );

         // Check if the domain matches
         if ($currentDomain !== $allowedDomain) {
            return redirect()->back()->withInput()->with('popup_error', 'Invalid Domain. Inquiry Not Allowed.');
        }

        Inquiry::insert([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'mes' => $request->mes,
            // 'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),

        ]);

        $notification = array(
            'message' => 'testimonial Inserted Successfully',
            'alert-type' => 'success'
        );

        $contacts = ['name' => $request->input('name'), 'email' => $request->input('email'), 'location' =>  $request->input('location'), 'phone' =>  $request->input('phone'), 'subject' =>  $request->input('subject'), 'mes' =>  $request->input('mes')];
        $user['to'] = 'kabraktc@gmail.com';
        $user['bcc'] = 'rutvik@indiantradebird.com';
        Mail::send('mail', $contacts, function ($messages) use ($user) {
            $messages->to($user['to']);
            $messages->to($user['bcc']);
            $messages->subject('Get It From Kabra Trading Co.');
        });



        return redirect('thankyou.html');
    }

    public function videogallery(request $id)
    {
        // dd($id);
        $categoryy = Category::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
        $Services = Services::latest()->where('status', '1')->get();
        $cat = Category::where('id', $id)->get();
        $Projects = Project::latest()->where('status', '1')->get();
        // $Projects = Project::where('category_id', $id)->where('status', '1')->get();
        // dd($Projects);

        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
    
        $application = Application::latest()->get();
        //    dd($agencys);
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::where('status', 'active')
            ->select('division_name', 'division_logo', 'id')
            ->get();
        // $alladminuser = Member::where('status', 'active')->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','5')->where('status','1')->get();
        $categoryseo = DB::table('productseo')->select('productseo.*')->where('services_id',$id)->where('status','1')->get();
       	$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        //  dd($alladminuser);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $sliders = Slider::where('status','1')->latest()->get();
        return view('frontend.videogallery', compact('sliders','Analytics','category','categoryseo','cat','otherseo','alladminuser','Services', 'divisions', 'settings' ,'alladminuser', 'divisions', 'categories','Projects','banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','categoryy','producttik'));
    }

    public function search(Request $request)
    {
        $settings = SiteSetting::latest()->get();
        $categories = Services::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $searchTerm = $request->input('search');
        $products = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")->get();
        // dd($products);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.index', compact('Analytics','products','settings','categories','offer','testimonials','category'));

        // return response()->json($products);
    }
    public function suggest(Request $request)
    {
        $searchTerm = $request->input('search');
        $suggestions = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")
                                    ->select('id', 'subcategory_name', 'subcategory_image', 'subcategory_slug')
                                    ->limit(5)
                                    ->get();
        return response()->json($suggestions);
    }
    public function about()
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $offer = Offer::latest()->where('status','1')->get();
          $About = About::latest()->where('status', '1')->get();
          $otherseo = Seo::select('seo.*')->where('menu_home','1')->where('status','1')->get();
          $Analytics = Analytics::latest()->where('status', '1')->get();
          $Projects = Project::latest()->where('status', '1')->get();
        return view('frontend.about-us', compact('Projects','Analytics','otherseo','settings','categories','products','application','category','offer','About'));
    }

        public function clients()
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
       	$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $offer = Offer::latest()->where('status','1')->get();
          $About = About::latest()->where('status', '1')->get();
          $otherseo = Seo::select('seo.*')->where('menu_home','5')->where('status','1')->get();
          $Analytics = Analytics::latest()->where('status', '1')->get();
          $Projects = Project::latest()->where('status', '1')->get();
        return view('frontend.our-clients', compact('Projects','Analytics','otherseo','settings','categories','products','application','category','offer','About'));
    }

    public function news(request $id)
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $offer = Offer::latest()->where('status','1')->get();                              
        $blogPost = BlogPost::where('category_id','2')->latest()->where('status', '1')->get();
          $About = About::latest()->get();
          $otherseo = Seo::select('seo.*')->where('menu_home','10')->where('status','1')->get();
          $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.news', compact('Analytics','otherseo','settings','blogPost','categories','products','application','category','offer','About'));
    }

    public function certification()
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $sliders = Slider::latest()->where('status','1')->get();
        $offer = Offer::latest()->where('status','1')->get();
          $About = About::latest()->get();
          $otherseo = Seo::select('seo.*')->where('menu_home','4')->where('status','1')->get();
          $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.certification', compact('Analytics','otherseo','sliders','settings','categories','products','application','category','offer','About'));
    }

    public function leadership()
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $offer = Offer::latest()->where('status','1')->get();
          $About = About::latest()->get();
          $otherseo = Seo::select('seo.*')->where('menu_home','2')->where('status','1')->get();
          $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.leadership', compact('Analytics','otherseo','settings','categories','products','application','category','offer','About'));
    }

    public function partners(request $id)
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $offer = Offer::latest()->where('status','1')->get();                              
        $blogPost = BlogPost::where('category_id','1')->latest()->get();
          $About = About::latest()->get();
          $otherseo = Seo::select('seo.*')->where('menu_home','3')->where('status','1')->get();
          $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.partners', compact('Analytics','otherseo','settings','blogPost','categories','products','application','category','offer','About'));
    }

    public function newsdetails($post_title, $id)
    {
        // dd($id);
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $producted= SubCategory::where('id', $id)->get();
        $products= SubCategory::latest()->get();
        // dd($products);
        $application = Application::latest()->get();
        $blogPost = BlogPost::latest()->where('category_id','2')->get()->take(3);
        $blogPosted = BlogPost::where('id', $id)->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','5')->where('status','1')->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        // $blogseo = DB::table('seoblog')->select('seoblog.*')->where('category_id','2')->get();
        // $blogseo = Seoblog::where('category_id','2')->get();
        $blogseo= Seoblog::where('id', $id)->where('status','1')->get();
        // dd($blogseo);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.newsdetails', compact('Analytics','category','blogseo','otherseo','settings','categories','products','producted','application','blogPost','blogPosted'));
    }

    public function service()
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
       	$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $offer = Offer::latest()->where('status','1')->get();
          $About = About::latest()->get();
          $otherseo = Seo::select('seo.*')->where('menu_home','9')->where('status','1')->get();
          $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.service', compact('Analytics','otherseo','settings','categories','products','application','category','offer','About'));
    }

    public function contact()
    {
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
       	$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
       $otherseo = Seo::select('seo.*')->where('menu_home','4')->where('status','1')->get();
       $Analytics = Analytics::latest()->where('status', '1')->get();
       $Projects = Project::latest()->where('status', '1')->get();
        return view('frontend.contact-us', compact('Projects','Analytics','otherseo','settings','categories','products','application','category'));
    }
      public function gallery()
    {
        $categories = Services::latest()->get();
        $slider = Slider::latest()->get();
        $Services = Services::latest()->where('status', '1')->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
       	$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','6')->where('status','1')->get();
        return view('frontend.gallery', compact('Services','otherseo','Analytics','settings','slider','categories','products','application','category'));
    }

          public function certificate()
    {
        $categories = Services::latest()->get();
        $slider = Slider::latest()->get();
        $Services = Services::latest()->where('status', '1')->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','3')->where('status','1')->get();
        return view('frontend.certificate', compact('Services','otherseo','Analytics','settings','slider','categories','products','application','category'));
    }
    
              public function quality()
    {
        $categories = Services::latest()->get();
        $slider = Slider::latest()->get();
        $Services = Services::latest()->where('status', '1')->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $quality = Quality:: latest()->where('status', '1')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','7')->where('status','1')->get();
        return view('frontend.quality', compact('quality','Services','otherseo','Analytics','settings','slider','categories','products','application','category'));
    }

                  public function infrastructure()
    {
        $categories = Services::latest()->get();
        $slider = Slider::latest()->get();
        $Services = Services::latest()->where('status', '1')->get();
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $application = Application::latest()->get();
		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $testimonials = Testimonial::latest()->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','8')->where('status','1')->get();
        return view('frontend.infrastructure', compact('testimonials','Services','otherseo','Analytics','settings','slider','categories','products','application','category'));
    }
    
    

    // public function product(request $id)
    // {
    //     $settings = SiteSetting::latest()->get();
    //     $products = SubCategory::latest()->get();
    //     $categories = Services::latest()->get();
    //     $application = Application::latest()->get();
    //     $application_front = Application::where('id', $id)->get();
	// 	$category = Category::latest()->where('status', '1')->get();
    //     $Projects = Project::latest()->where('status', '1')->get();
    //     $otherseo = Seo::select('seo.*')->where('menu_home','6')->where('status','1')->get();
    //     $Analytics = Analytics::latest()->where('status', '1')->get();
    //     return view('frontend.product', compact('Analytics','otherseo','Projects','settings','products','categories','application','application_front','category'));
    // }

        public function catalogs(request $id)
    {
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $categories = Services::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $Projects = Project::latest()->where('status', '1')->get();
        $application = Application::latest()->where('status', '1')->get();
        $application_front = Application::where('id', $id)->get();
        $blogPost = BlogPost::where('category_id','1')->latest()->where('status', '1')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','3')->where('status','1')->get();
        // dd($blogPost);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.catalogs', compact('Projects','category','Analytics','otherseo','settings','products','categories','application','application_front','blogPost'));
    }
    
    public function blog(request $id)
    {
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $categories = Services::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $Projects = Project::latest()->where('status', '1')->get();
        $application = Application::latest()->get();
        $application_front = Application::where('id', $id)->get();
        $blogPost = BlogPost::where('category_id','1')->latest()->where('status', '1')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','3')->where('status','1')->get();
        // dd($blogPost);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.blog', compact('Projects','category','Analytics','otherseo','settings','products','categories','application','application_front','blogPost'));
    }

    
    public function blogdetails($post_title, $id)
    {
        // dd($id);
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $producted= SubCategory::where('id', $id)->get();
        $products= SubCategory::latest()->get();
        // dd($products);
        $application = Application::latest()->get();
        $blogPost = BlogPost::latest()->where('category_id','1')->get();
        $blogPosted = BlogPost::where('id', $id)->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','4')->where('status','1')->get();
        // $blogseo = DB::table('seoblog')->select('seoblog.*')->where('category_id',1)->where('status','1')->get();
        $blogseo= Seoblog::where('post_id', $id)->where('status','1')->get();
         // $blogseo = DB::table('seoblog')->select('seoblog.*')->where('category_id',1)->where('status','1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
 		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $Projects = Project::latest()->where('status', '1')->get();

        return view('frontend.blogdetails', compact('category','Projects','Analytics','blogseo','otherseo','settings','categories','products','producted','application','blogPost','blogPosted'));
    }
    public function application(request $id)
    {
        // dd($id);
        $settings = SiteSetting::latest()->get();
        $products = SubCategory::latest()->get();
        $categories = Services::latest()->get();
        $application = Application::latest()->get();
        $categori_front = Category::where('id', $id)->get();
        $application_front = Application::where('id', $id)->get();
        // dd($application_front);
  		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
         $Analytics = Analytics::latest()->where('status', '1')->get();
         $otherseo = Seo::select('seo.*')->where('menu_home','3')->where('status','1')->get();
        return view('frontend.application', compact('Analytics','otherseo','settings','products','categories','application','application_front','category'));
    }
    // public function productdeatils($subcategory_name, $id)
    // {
    //     // dd($id);
    //     $categories = Services::latest()->get();
    //     $settings = SiteSetting::latest()->get();
    //     $producted= SubCategory::where('id', $id)->get();
    //     $products= SubCategory::latest()->get();
    //     // dd($products);
    //     $application = Application::latest()->get();
    //     $category = Category::latest()->where('status', '1')->get();
    //     $Analytics = Analytics::latest()->where('status', '1')->get();
    //     return view('frontend.productdeatils', compact('Analytics','settings','categories','products','producted','application','category'));
    // }
    public function applicationdeatils($application_name, $id)
    {
        // dd($id);
        $application_front = Application::where('id', $id)->get();
        // $application = Application::where('id', $id)->latest()->get();
        // $application = Application::where('id','6')->latest()->get();
        $applicationes = Application::latest()->get();

        // dd($applicationes);
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $producted= SubCategory::where('id', $id)->get();
        $products= SubCategory::latest()->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $producttik = SubCategory::latest()->get();
        $productedss = SubCategory::whereJsonContains('application_id', $id)->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $applicationseo = DB::table('applicationseo')->select('applicationseo.*')->where('services_id',$id)->where('status','1')->get();
        return view('frontend.applicationdeatils', compact('applicationseo','Analytics','settings','categories','products','producted','application_front','applicationes','category','producttik','productedss'));
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

    public function member(request $id)
    {
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::where('status', 'active')
            ->select('division_name', 'division_logo', 'id')
            ->get();
        // $alladminuser = Member::where('status', 'active')->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->get();

        //  dd($alladminuser);
        return view('frontend.member', compact('alladminuser', 'divisions', 'settings'));
    }

    public function category(request $id)
    {
        // dd($id);
        $categoryy = Category::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
        $Services = Category::latest()->get();
        $cat = Category::where('id', $id)->get();
        $Projects = Project::latest()->where('status', '1')->get();
        // $Projects = Project::where('category_id', $id)->where('status', '1')->get();
        // dd($Projects);

        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
    
        $application = Application::latest()->get();
        //    dd($agencys);
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::where('status', 'active')
            ->select('division_name', 'division_logo', 'id')
            ->get();
        // $alladminuser = Member::where('status', 'active')->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','2')->where('status','1')->get();
        $categoryseo = DB::table('productseo')->select('productseo.*')->where('services_id',$id)->where('status','1')->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        //  dd($alladminuser);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $faqproductpage = FaqProductPage::where('status', '1') ->orderBy('id', 'asc')->get();
        return view('frontend.category', compact('faqproductpage','Analytics','category','categoryseo','cat','otherseo','alladminuser','Services', 'divisions', 'settings' ,'alladminuser', 'divisions', 'categories','Projects','banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','categoryy','producttik'));
    }

    public function projects($project_name, $id)
    {
        // dd($id);
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
        $Services = Category::latest()->get();
        $Projectsnew = Project::where('category_id', $id)->latest()->where('status', '1')->get();
        $Projects = Project::latest()->where('status', '1')->get();
        // dd($Projects);
    	$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
		$categoryed = Category::where('id', $id)->where('status', '1')->get();
        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
      
        $application = Application::latest()->get();
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::where('status', 'active')
            ->select('division_name', 'division_logo', 'id')
            ->get();
        // $alladminuser = Member::where('status', 'active')->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->get();
     
        //  dd($alladminuser);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $categoryy = Project::where('category_id', $id)->get();
        $categoryseo = DB::table('productseo')->select('productseo.*')->where('services_id',$id)->where('status','1')->get();
        $faqcategory = DB::table('faqcategory')->select('faqcategory.*')->where('services_id',$id)->where('status','1') ->orderBy('id', 'asc')->get();
        //    dd($categoryy);

        return view('frontend.product', compact('Projectsnew','faqcategory','categoryseo','categoryed','categoryy','Analytics','alladminuser','Services', 'divisions', 'settings' ,'alladminuser', 'divisions', 'categories','Projects','banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','category','producttik'));
    }

     public function custombearings(request $id)
    {
        // dd($id);
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
        $Services = Category::latest()->get();
        $Projectsnew = Project::where('category_id', $id)->latest()->where('status', '1')->get();
        $Projects = Project::latest()->where('status', '1')->get();
        // dd($Projects);
    	$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
		$categoryed = Category::where('id', $id)->where('status', '1')->get();
        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
      
        $application = Application::latest()->get();
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::where('status', 'active')
            ->select('division_name', 'division_logo', 'id')
            ->get();
        // $alladminuser = Member::where('status', 'active')->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->get();
     
        //  dd($alladminuser);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $categoryy = Project::where('category_id', $id)->get();
        $categoryseo = DB::table('productseo')->select('productseo.*')->where('services_id',$id)->where('status','1')->get();
        $faqcategory = DB::table('faqcategory')->select('faqcategory.*')->where('services_id',$id)->where('status','1') ->orderBy('id', 'asc')->get();
        //    dd($categoryy);
        $otherseo = Seo::select('seo.*')->where('menu_home','9')->where('status','1')->get();
        return view('frontend.custombearings', compact('otherseo','Projectsnew','faqcategory','categoryseo','categoryed','categoryy','Analytics','alladminuser','Services', 'divisions', 'settings' ,'alladminuser', 'divisions', 'categories','Projects','banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','category','producttik'));
    }

    public function projectsdeatils($project_name, $id)
    {
        // dd($id);
        $Project_front = Project::where('id', $id)->get();
        $Projects = Project::latest()->where('status', '1')->get();
        
        $currentProject = Project::where('status', '1')->findOrFail($id);

        $Projectsrelated = Project::where('status', '1')
            ->where('category_id', $currentProject->category_id)
            ->where('id', '!=', $currentProject->id)
            ->latest()
            ->get()
            ->take(5);
        
        $application_front = Application::where('id', $id)->get();
        $application = Application::latest()->get();
        $categories = Services::latest()->get();
        $settings = SiteSetting::latest()->get();
        $producted= SubCategory::where('id', $id)->get();
        $products= SubCategory::latest()->get();
		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $producttik = SubCategory::latest()->get();
        $productedss = SubCategory::whereJsonContains('application_id', $id)->get();
        $productseos = DB::table('servicesseo')->select('servicesseo.*')->where('services_id',$id)->where('status','1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        $faqproduct = DB::table('faqproduct')->select('faqproduct.*')->where('services_id',$id)->where('status','1') ->orderBy('id', 'asc')->get();
     
        return view('frontend.productdeatils', compact('Projectsrelated','faqproduct','Analytics','productseos','settings','categories','products','producted','Projects','Project_front','application','category','producttik','productedss'));
    }
    public function joboffers(){
        // dd('test');
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
        $Projects = Project::latest()->where('status', '1')->get();
        $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $jobs = JobVacancy::latest()->where('status','1')->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','8')->where('status','1')->get();
        // Check if there's a search query
 

        if (!empty($searchTerm)) {
            $products = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")->latest()->get();
        } else {
            $products = SubCategory::latest()->get();
        }
        $application = Application::latest()->get();
        //    dd($agencys);
        $Analytics = Analytics::latest()->where('status', '1')->get();
        

        
        return view('frontend.joboffers',compact('Analytics','otherseo','alladminuser', 'divisions', 'categories','Projects','banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','category','producttik','jobs'));
}
    public function vendor(request $id)
    {
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::where('status', 'active')
            ->select('division_name', 'division_logo', 'id')
            ->get();
        // $alladminuser = Member::where('status', 'active')->get();
        $alladminuser = Member::where('role', 'vendor')->where('status', 'active')->get();

        //  dd($alladminuser);
        return view('frontend.vendor', compact('alladminuser', 'divisions', 'settings'));
    }



    public function agency($division_name, $id)
    {
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::where('division_name', $division_name)->select('id', 'division_name')->get();
        // dd($reqloc);
        $divisionIds = $divisions->pluck('id')->toArray();
        $agencys = Member::where('division_id', $divisionIds)->where('role', 'vendor')->where('status', 'active')->get();
        // dd($agencys);
        // $agencys = Member::where('division_id', $reqloc)->where('role', 'vendor')->where('status', 'active')->get();
        // $divisions = ShipDivision::select('division_name','division_logo','id')->limit(4)->get();
        // dd($divisions);
        $members = Member::where('division_id', $divisionIds)->where('role', 'member')->where('status', 'active')->get();
        // dd($alladminuser);

        return view('frontend.agency', compact('agencys', 'divisions', 'members', 'settings'));
    }
    public function thanks()
    {
        $settings = SiteSetting::latest()->get();
        return view('frontend.thankyou', compact('settings'));
    }
    public function servicedetails(Request $id)
    {
        $settings = SiteSetting::latest()->get();
        $subCategoryId = $id->id;

        // Fetch SubCategory details
        $servicedetails = SubCategory::where('id', $subCategoryId)->get();

        // Fetch corresponding division names
        $divisionIds = $servicedetails->pluck('division_id')->toArray();

        // Ensure unique division IDs
        $uniqueDivisionId = array_unique($divisionIds);

        // Convert JSON-encoded string to array
        $uniqueDivisionIds = json_decode($uniqueDivisionId[0]);

        // Fetch division names
        $divisionNames = ShipDivision::whereIn('id', $uniqueDivisionIds)->pluck('division_name', 'id');
        $divisions = ShipDivision::where('id', $id->id)->get();

        // Fetch subcategory image
        $subcategoryImage = $divisions->first()->division_logo;


        return view('frontend.servicedetails', compact('servicedetails', 'divisionNames', 'divisions', 'subcategoryImage', 'settings'));
    }




    public function comingsoon()
    {
        $settings = SiteSetting::latest()->get();
		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $divisions = ShipDivision::where('status', 'active')->select('division_name', 'division_logo', 'id')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','7')->where('status','1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.comingsoon', compact('Analytics','otherseo','divisions','category', 'settings'));
    }

    public function services()
    {
        // dd('dd');
        $settings = SiteSetting::latest()->get();
 	    $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $categories = Services::where('status', 'active')->latest()->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','9')->where('status','1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.services', compact('Analytics','otherseo','categories','category', 'settings'));
    }


    public function AddMembers()
    {
        //    dd('dddd');
        // $roles = Role::all();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('frontend.add_member', compact('divisions', 'settings'));
    }
    public function Certifications(request $id)
    {
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
        $searchTerm = $id->input('search', '');

        if (!empty($searchTerm)) {
            $products = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")->latest()->get();
        } else {
            $products = SubCategory::latest()->get();
        }
        $application = Application::latest()->get();
        //    dd($agencys);
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $otherseo = Seo::select('seo.*')->where('menu_home','4')->where('status','1')->get();
        $Analytics = Analytics::latest()->where('status', '1')->get();
        return view('frontend.certifications', compact('Analytics','otherseo','divisions', 'settings','alladminuser', 'divisions', 'categories', 'banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','category','producttik'));
    
      
    }
    public function UdyamCertifications(request $id)
    {
        //    dd('dddd');
        // $roles = Role::all();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
        $searchTerm = $id->input('search', '');

        if (!empty($searchTerm)) {
            $products = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")->latest()->get();
        } else {
            $products = SubCategory::latest()->get();
        }
        $application = Application::latest()->get();
        //    dd($agencys);
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('frontend.udyamcertifications', compact('divisions', 'settings','alladminuser', 'divisions', 'categories', 'banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','category','producttik'));
    
    }
    public function GstCertifications(request $id)
    {
        //    dd('dddd');
        // $roles = Role::all();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
		$category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
        $searchTerm = $id->input('search', '');

        if (!empty($searchTerm)) {
            $products = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")->latest()->get();
        } else {
            $products = SubCategory::latest()->get();
        }
        $application = Application::latest()->get();
        //    dd($agencys);
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('frontend.GstCertifications', compact('divisions', 'settings','alladminuser', 'divisions', 'categories', 'banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','category','producttik'));
    
    }
    public function UdyamragisterCertifications(request $id)
    {
        //    dd('dddd');
        // $roles = Role::all();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::select('division_name', 'division_logo', 'id')->limit(4)->get();
        $alladminuser = Member::where('role', 'member')->where('status', 'active')->limit(1)->get();
        $categories = Services::latest()->get();
	    $category = Category::orderByRaw('CAST(sequence AS UNSIGNED) ASC')->latest()->where('status', '1')->get();
        $banner = Banner::latest()->get();
        $offer = Offer::latest()->where('status','1')->get();
        $testimonials = Testimonial::latest()->get();
        $products = SubCategory::latest()->get();
		 $producttik = SubCategory::where('onhome', '1')
        ->where('status', 'active')->get();
        // dd($products);
        $agencys = Member::where('role', 'vendor')->where('status', 'active')->limit(1)->get();
        // Check if there's a search query
        $searchTerm = $id->input('search', '');

        if (!empty($searchTerm)) {
            $products = SubCategory::where('subcategory_name', 'like', "%$searchTerm%")->latest()->get();
        } else {
            $products = SubCategory::latest()->get();
        }
        $application = Application::latest()->get();
        //    dd($agencys);
        $application_front = Application::where('id', $id)->get();
        $settings = SiteSetting::latest()->get();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('frontend.udyamragistercertifications', compact('divisions', 'settings','alladminuser', 'divisions', 'categories', 'banner', 'settings', 'agencys', 'offer', 'testimonials', 'products','application','application_front','category','producttik'));
    
    }
    
    
    public function AdminMemberStore(Request $request)
    {
        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(250, 250)->save('upload/memberphoto/' . $name_gen);
        $save_url = 'upload/memberphoto/' . $name_gen;


        $user = new Member();
        $user->division_id = $request->division_id;
        $user->name = $request->name;
        $user->fathername = $request->fathername;
        $user->photo = $save_url;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->acno = $request->acno;
        $user->aadharno = $request->aadharno;
        $user->workexp = $request->workexp;
        $user->role = $request->role;
        // $user->role = ($request->role == 'vendor') ? 'vendor' : 'member';
        // $user->role = ($request->role == 'agent') ? 'vendor' : 'member';
        $user->status = 'Inactive';
        // dd($user);

        $user->save();



        $notification = array(
            'message' => 'New Member Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('thanks')->with($notification);
    }
}

