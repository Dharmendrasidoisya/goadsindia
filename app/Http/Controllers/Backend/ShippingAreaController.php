<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;


use App\Models\ShipDistricts;
use App\Models\ShipState;
use Carbon\Carbon;
use Image;

class ShippingAreaController extends Controller
{
    public function AllDivision(){
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.division_all',compact('division'));
    } // End Method 

    public function AddDivision(){
        return view('backend.ship.division.division_add');
    }// End Method 


    public function StoreDivision(Request $request){ 

        $image = $request->file('division_logo');
        //dd($image);
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(260,260)->save('upload/divisionlogo/'.$name_gen);
        $save_url = 'upload/divisionlogo/'.$name_gen;

        ShipDivision::insert([ 
            'division_name' => $request->division_name, 
            'division_logo' => $save_url,
			'status' => 'active',
        ]);

       $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification); 

    }// End Method 


     public function EditDivision($id){

        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.division_edit',compact('division'));

    }// End Method 


     public function UpdateDivision(Request $request){

        $division_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('division_logo')) {

            $image = $request->file('division_logo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(260,260)->save('upload/divisionlogo/'.$name_gen);
            $save_url = 'upload/divisionlogo/'.$name_gen;
    
            if (file_exists($old_img)) {
               unlink($old_img);
            }

         ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
            'division_logo' => $save_url, 
        ]);

       $notification = array(
            'message' => 'ShipDivision Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification); 

    } else {

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
   ]);

        $notification = array(
        'message' => 'ShipDivision Updated Successfully',
        'alert-type' => 'success'
         );

return redirect()->route('all.division')->with($notification); 

   } // end else

    }// End Method 


    public function DeleteDivision($id){

        $division = ShipDivision::findOrFail($id);
        $img = $division->division_logo;
        unlink($img ); 

        ShipDivision::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipDivision Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 

    /////////////// District CRUD ///////////////


     public function AllDistrict(){
        $district = ShipDistricts::latest()->get();
        return view('backend.ship.district.district_all',compact('district'));
    } // End Method 

    public function AddDistrict(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.ship.district.district_add',compact('division'));
    }// End Method 


public function StoreDistrict(Request $request){ 

        ShipDistricts::insert([ 
            'division_id' => $request->division_id, 
            'district_name' => $request->district_name,
        ]);

       $notification = array(
            'message' => 'ShipDistricts Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification); 

    }// End Method 


      public function EditDistrict($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistricts::findOrFail($id);
        return view('backend.ship.district.district_edit',compact('district','division'));

    }// End Method 


    public function UpdateDistrict(Request $request){

        $district_id = $request->id;

         ShipDistricts::findOrFail($district_id)->update([
             'division_id' => $request->division_id, 
            'district_name' => $request->district_name,
        ]);

       $notification = array(
            'message' => 'ShipDistricts Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification); 


    }// End Method 


     public function DeleteDistrict($id){

        ShipDistricts::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipDistricts Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 

  /////////////// State CRUD ///////////////


     public function AllState(){
        $state = ShipState::latest()->get();
        return view('backend.ship.state.state_all',compact('state'));
    } // End Method 


    public function AddState(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistricts::orderBy('district_name','ASC')->get();
         return view('backend.ship.state.state_add',compact('division','district'));
    }// End Method 


    public function GetDistrict($division_id){
        $dist = ShipDistricts::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
            return json_encode($dist);

    }// End Method 


    public function StoreState(Request $request){ 

        ShipState::insert([ 
            'division_id' => $request->division_id, 
            'district_id' => $request->district_id, 
            'state_name' => $request->state_name,
        ]);

       $notification = array(
            'message' => 'ShipState Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification); 

    }// End Method 


        public function EditState($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistricts::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
         return view('backend.ship.state.state_edit',compact('division','district','state'));
    }// End Method 


     public function UpdateState(Request $request){

        $state_id = $request->id;

         ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id, 
            'district_id' => $request->district_id, 
            'state_name' => $request->state_name,
        ]);

       $notification = array(
            'message' => 'ShipState Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification); 


    }// End Method 

 public function DeleteState($id){

        ShipState::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipState Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 

    public function Inactivedivision(){
        $inActiveUser = ShipDivision::where('status','inactive')->get();
        return view('backend.user.inactive_division',compact('inActiveUser'));

    }// End Mehtod 
    public function InactivedivisionDetails($id){
        $inactiveAdminDetails = ShipDivision::findOrFail($id);
        return view('backend.adminnew.inactive_division_details',compact('inactiveAdminDetails'));
    }
    public function InActivedivisionApprove(Request $request){

        $user_id = $request->id;
        $user = ShipDivision::findOrFail($user_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'ShipDivision Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.division')->with($notification);

    }
    public function Activedivision(){
        $inActiveUser = ShipDivision::where('status','active')->get();
        return view('backend.user.active_division',compact('inActiveUser'));

    }
    public function ActivedivisionDetails($id){
        $inactiveAdminDetails = ShipDivision::findOrFail($id);
        return view('backend.adminnew.active_division_details',compact('inactiveAdminDetails'));
    }
    public function ActivedivisionApprove(Request $request){

        $user_id = $request->id;
        $user = ShipDivision::findOrFail($user_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'ShipDivision InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.division')->with($notification);

    }
}