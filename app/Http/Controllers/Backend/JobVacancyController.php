<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = JobVacancy::all();
        return view('backend.job.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs =  JobVacancy::get();
        return view('backend.job.create',compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'position'=>'required',
         ]);
        $jobs=new JobVacancy();
        $jobs->position=$request->input('position');
        $jobs->qualification=$request->input('qualification');
        $jobs->experience=$request->input('experience');
        $jobs->prefferedqualification=$request->input('prefferedqualification');
        $jobs->location=$request->input('location');
        $jobs->status=$request->input('status');
        if($request->hasfile('image')) 
        { 
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename =time().'.'.$extension;
        $file->move('uploads/jobs/', $filename);
        $jobs->image= $filename;
        }
        $jobs->save();
        return redirect('jobindex');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = JobVacancy::findOrfail($id);
        return view('backend.job.view',compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = JobVacancy::findOrfail($id);
        return view('backend.job.edit',compact('job'));
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
        $this->validate($request,[
            'position'=>'required',
         ]);
        $job=JobVacancy::find($id);
        $job->position=$request->input('position');
        $job->qualification=$request->input('qualification');
        $job->experience=$request->input('experience');
        $job->prefferedqualification=$request->input('prefferedqualification');
        $job->location=$request->input('location');
        $job->status=$request->input('status');
        if($request->hasfile('image')) 
        { 
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename =time().'.'.$extension;
        $file->move('uploads/jobs/', $filename);
        $job->image= $filename;
        }
        $job->save();
        return redirect('jobindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JobVacancy::destroy($id);
        return redirect('jobindex');
    }

    public function update_status(Request $request){
        // dd($request->all());

        if($request->ajax()){
            if(!empty($request->checkbox)){
                // dd($request->all());
                foreach($request->checkbox as $checkbox){

                    $about = JobVacancy::find($checkbox);
                    $about->status = $request->status;
                    // dd($about);
                    $about->save();
                }

                return response()->json(['success'=>'Job Vacancy status updated']);
            }else{
                #
            }
        }
    }
}
