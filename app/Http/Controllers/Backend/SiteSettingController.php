<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Seo;
use Image;

class SiteSettingController extends Controller
{
    public function SiteSetting(){
        $setting = SiteSetting::find(1);
        return view('backend.setting.setting_update', compact('setting'));
    } // End Method 

    public function SiteSettingUpdate(Request $request){
        $setting_id = $request->id;

        //PDF upload
              if ($request->hasFile('brochure')) {
            $brochure = $request->file('brochure');
            $brochureName = time() . '_' . $brochure->getClientOriginalName();
            $brochure->move(public_path('upload/brochures'), $brochureName); // Move to public/upload/brochures
            $brochureUrl = asset('upload/brochures/' . $brochureName);

            // Update project with new brochure
            SiteSetting::findOrFail($setting_id)->update([
                'brochure' => $brochureUrl,
            ]);

            // Delete old brochure if it exists
            if (!empty($project->brochure)) {
                $oldBrochurePath = public_path($project->brochure);
                if (File::exists($oldBrochurePath)) {
                    File::delete($oldBrochurePath);
                }
            }
        }

        // Handle the logo upload
        
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('upload/logo/'.$name_gen);
            $save_url = 'upload/logo/'.$name_gen;

            SiteSetting::findOrFail($setting_id)->update([
                'logo' => $save_url,
            ]);
        }

        // Handle the footer logo upload
        if ($request->file('footerlogo')) {
            $image2 = $request->file('footerlogo');
            $name_gen2 = hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
            Image::make($image2)->save('upload/footerlogo/'.$name_gen2);
            $save_url1 = 'upload/footerlogo/'.$name_gen2;

            SiteSetting::findOrFail($setting_id)->update([
                'footerlogo' => $save_url1,
            ]);
        }

        // Update the other settings
        SiteSetting::findOrFail($setting_id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'whatsapp_no' => $request->whatsapp_no,
            'email' => $request->email,
            'email2' => $request->email2,
            'email3' => $request->email3,
            'company_address' => $request->company_address,
            'about_title' => $request->about_title,
            'header_about_address' => $request->header_about_address,
            'about_me' => $request->about_me,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'copyright' => $request->copyright, 
        ]);

        $notification = array(
            'message' => 'Site Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 

    //////////// Seo Setting /////////////

    public function SeoSetting(){
        $seo = Seo::find(1);
        return view('backend.seo.seo_update', compact('seo'));
    } // End Method 

    public function SeoSettingUpdate(Request $request){
        $seo_id = $request->id;

        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description, 
        ]);

        $notification = array(
            'message' => 'Seo Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
}
