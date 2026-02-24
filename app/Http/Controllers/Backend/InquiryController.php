<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;


class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Inquiry::all();
        return view('backend.inquiry.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $contacts =  Inquiry::get();
        // return view('backend.inquiry.create',compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name'=>'required',
        //     'email'=>'required',
        //     'location'=>'required',
        //     'phone'=>'required',
        //     'subject'=>'required',
        //     'message'=>'required',
        //     'captcha'=>'required|same:kcaptcha',
        //  ],[
        //     'name'=> 'Name is required.',
        //     'email'=> 'Email is required.',
        //     'location'=> 'Location is required.',
        //     'phone'=> 'Phone is required.',
        //     'subject'=> 'Socation is required.',
        //     'message'=> 'Message is required.',
        //     'captcha'=>'Validation code not match.',
        // ]
        // );
        
        $contacts=new Inquiry();
        $contacts->name=$request->input('name');
        $contacts->email=$request->input('email');
        $contacts->location=$request->input('location');
        $contacts->phone=$request->input('phone');
        $contacts->subject=$request->input('subject');
        $contacts->message=$request->input('message');
  
        

        $contacts->save();
        
        // $contacts=['name'=>$contacts->name = $request->input('name'),'email'=> $contacts->email = $request->input('email'),'location'=> $contacts->location = $request->input('location'),'phone'=> $contacts->phone = $request->input('phone'),'subject'=> $contacts->subject = $request->input('subject')];
        // $user['to']='info@medtechdevices.net';
        // Mail::send('mail',$contacts,function($messages) use ($user){
        //     $messages->to($user['to']);
        //     $messages->subject('Inquiry');
        // });

        return redirect('thankyou.html');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacts = Inquiry::findOrfail($id);
        return view('backend.inquiry.view',compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $contacts = Inquiry::findOrfail($id);
        // return view('backend.inquiry.edit',compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inquiry::destroy($id);
        return redirect('inquiryindex');
    }

    public function update_status(Request $request){
        // dd($request->all());

        if($request->ajax()){
            if(!empty($request->checkbox)){
                // dd($request->all());
                foreach($request->checkbox as $checkbox){

                    $about = Inquiry::find($checkbox);
                    $about->status = $request->status;
                    // dd($about);
                    $about->save();
                }

                return response()->json(['success'=>'inquiry status updated']);
            }else{
                #
            }
        }
    }
}
