<?php
namespace App\Http\Controllers\Backend;
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\ShipDivision;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 

use App\Notifications\AdminApproveNotification;
use App\Notifications\VendorApproveNotification;
use App\Notifications\UserApproveNotification;
use App\Notifications\MemberApproveNotification;
use Illuminate\Support\Facades\Notification;
use Image;
         
class MemberController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');

    } // End Mehtod 


    public function AdminLogin(){
        return view('admin.admin_login');
    } // End Mehtod 


public function AdminDestroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } // End Mehtod 


    public function AdminProfile(){

        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));

    } // End Mehtod 

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address; 


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod 


    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    } // End Mehtod 


    public function AdminUpdatePassword(Request $request){
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed', 
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password 
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");

    } // End Mehtod 


    public function InactiveAdmin(){
        $inActiveAdmin = User::where('status','inactive')->where('role','admin')->latest()->get();
        return view('backend.adminnew.inactive_admin',compact('inActiveAdmin'));

    }// End Mehtod 

    public function InactiveVendor(){
        $inActiveVendor = User::where('status','inactive')->where('role','vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('inActiveVendor'));

    }// End Mehtod 

    public function InactiveUser(){
        $inActiveUser = Member::where('status','inactive')->whereIn('role', ['member', 'vendor'])->latest()->get();
        return view('backend.user.inactive_user',compact('inActiveUser'));

    }// End Mehtod 

    public function ActiveAdmin(){
        $ActiveAdmin = User::where('status','active')->where('role','admin')->latest()->get();
        return view('backend.adminnew.active_admin',compact('ActiveAdmin'));

    }// End Mehtod 

    public function ActiveVendor(){
        $ActiveVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.vendor.active_vendor',compact('ActiveVendor'));

    }// End Mehtod 

    public function ActiveUser(){
        $ActiveUser = Member::where('status','active')->whereIn('role', ['member', 'vendor'])->latest()->get();
        return view('backend.user.active_user',compact('ActiveUser'));

    }// End Mehtod 

    public function InactiveAdminDetails($id){

        $inactiveAdminDetails = User::findOrFail($id);
        return view('backend.adminnew.inactive_admin_details',compact('inactiveAdminDetails'));

    }// End Mehtod 

    public function InactiveVendorDetails($id){

        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));

    }// End Mehtod 

    public function InactiveUserDetails($id){
		
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $inactiveUserDetails = Member::findOrFail($id);
        return view('backend.user.inactive_user_details',compact('inactiveUserDetails','divisions'));

    }// End Mehtod 

    public function ActiveAdminApprove(Request $request){

        $admin_id = $request->id;
        $user = User::findOrFail($admin_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Admin Active Successfully',
            'alert-type' => 'success'
        );

         $vuser = User::where('role','admin')->get();
        Notification::send($vuser, new AdminApproveNotification($request));
        return redirect()->route('active.admin')->with($notification);

    }// End Mehtod 

    public function ActiveVendorApprove(Request $request){

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        );

         $vuser = User::where('role','vendor')->get();
        Notification::send($vuser, new VendorApproveNotification($request));
        return redirect()->route('active.vendor')->with($notification);

    }// End Mehtod 

    public function ActiveUserApprove(Request $request){

        $user_id = $request->id;
        $user = Member::findOrFail($user_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Member Active Successfully',
            'alert-type' => 'success'
        );

         $vuser = Member::where('role','member')->get();
        Notification::send($vuser, new MemberApproveNotification($request));
        return redirect()->route('active.user')->with($notification);

    }// End Mehtod 


    public function ActiveAdminDetails($id){

        $activeAdminDetails = User::findOrFail($id);
        return view('backend.adminnew.active_admin_details',compact('activeAdminDetails'));

    }// End Mehtod 

    public function ActiveVendorDetails($id){

        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details',compact('activeVendorDetails'));

    }// End Mehtod 

    public function ActiveUserDetails($id){
		
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $activeUserDetails = Member::findOrFail($id);
        return view('backend.user.active_user_details',compact('activeUserDetails','divisions'));

    }// End Mehtod 


     public function InActiveAdminApprove(Request $request){

        $admin_id = $request->id;
        $user = User::findOrFail($admin_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Admin InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.admin')->with($notification);

    }// End Mehtod 

    public function InActiveVendorApprove(Request $request){

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($notification);

    }// End Mehtod 

    public function InActiveUserApprove(Request $request){

        $user_id = $request->id;
        $user = Member::findOrFail($user_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Member InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.user')->with($notification);

    }// End Mehtod 

 
     ///////////// Admin All Method //////////////


    public function AllMember(){
	    $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $alladminuser = Member::whereIn('role', ['member', 'vendor'])->latest()->get();
        return view('backend.user.all_member',compact('alladminuser','divisions'));
    }// End Mehtod 


    public function AddMember(){
        $roles = Role::all();
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.user.add_member',compact('divisions','roles'));
    }// End Mehtod 



    public function AdminMemberStored(Request $request){
// dd($request);
        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(250,250)->save('upload/memberphoto/'.$name_gen);
        $save_url = 'upload/memberphoto/'.$name_gen;

     
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
        $user->status = 'active';
        $user->save();

       

         $notification = array(
            'message' => 'New Member Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.member')->with($notification);
        

    }// End Mehtod 




    public function EditMemberRole($id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $user = Member::findOrFail($id);
        $roles = Role::all();
        return view('backend.user.edit_member',compact('user','roles','divisions'));
    }// End Mehtod 

	
	    public function ViewMemberRole($id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $user = Member::findOrFail($id);
        $roles = Role::all();
        return view('backend.user.view_member',compact('user','roles','divisions'));
    }// End Mehtod 

    public function AdminMemberUpdate(Request $request,$id){
       
        $id = $request->id;
		$old_img = $request->old_image;

        if ($request->file('photo')) {

        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(250,250)->save('upload/memberphoto/'.$name_gen);
        $save_url = 'upload/memberphoto/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }
	 		
       
        $user = Member::findOrFail($id);
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
        // $user->role = 'member';
        $user->role = $request->role;
        // $user->status = 'active';
        $user->save();
      

         $notification = array(
            'message' => 'New Member Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.member')->with($notification);

	
        }else{
			$user = Member::findOrFail($id);
			$user->division_id = $request->division_id;
			$user->name = $request->name;
			$user->fathername = $request->fathername;
			$user->dob = $request->dob;
			$user->phone = $request->phone;
			$user->address = $request->address;
			$user->email = $request->email;
			$user->acno = $request->acno;
			$user->aadharno = $request->aadharno;
			$user->workexp = $request->workexp;
			// $user->role = 'member';
        $user->role = $request->role;
			// $user->status = 'active';
			$user->save();


			 $notification = array(
				'message' => 'New Member Updated Successfully',
				'alert-type' => 'success'
			);

			return redirect()->route('all.member')->with($notification);
		}// end else

    }// End Mehtod 


    public function DeleteMemberRole($id){

        $user = Member::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }
 
         $notification = array(
            'message' => 'Member Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod 

    public function GetDivision($division_id){
        $div = Member::where('division_id',$division_id)->orderBy('name','ASC')->get();
            return json_encode($div);

    }// End Method 




}
 