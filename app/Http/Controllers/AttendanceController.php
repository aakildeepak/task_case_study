<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Module;
use App\Seminar;
use App\StudyGroup;
use App\GroupData;
use App\Enroll;
use App\Attendance;
use Auth;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        //check authentication  
        public function __construct()
        {
            $this->middleware('auth');
        } 
        
    public function moduleAttendance(Request $request){
        if(Auth::user()->role==3){
            $id=Auth::user()->id;
            $data = new Attendance([ 
                'attendance' =>$request->get('attendance'),
                'sheet_id'=>$request->get('sheetID'),
                'student_id'=>$id,
                'lec_hours'=>$request->get('lec_hours'),
                'status'=>'1',
                'course_id'=>$request->get('course_id'),
                'course_type'=>'module',
             ]);
        
             $data->save();
             $request->session()->flash('success','Attendance Submit Successfully');
             return redirect('home');
            
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }





    public function modulePresent(Request $request,$id){
        if(Auth::user()->role==1 || Auth::user()->role==2){
            $accept = Attendance::find($id);
            $accept->attendance = 'present';
            $accept->save();
            $request->session()->flash('success','Attendance Edit Successfully');
            //return redirect('/module_atd_sheet');
            return back();
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }

    }

    public function moduleAbsent(Request $request,$id){
        if(Auth::user()->role==1 || Auth::user()->role==2){
            $accept = Attendance::find($id);
            $accept->attendance = 'absent';
            $accept->save();
            $request->session()->flash('success','Attendance Edit Successfully');
            //return redirect('/module_atd_sheet');
            return back();
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }



//Seminar
public function seminarAttendance(Request $request){
    if(Auth::user()->role==3){
        $id=Auth::user()->id;
        $data = new Attendance([ 
            'attendance' =>$request->get('attendance'),
            'sheet_id'=>$request->get('sheetID'),
            'student_id'=>$id,
            'lec_hours'=>$request->get('lec_hours'),
            'status'=>'1',
            'course_id'=>$request->get('course_id'),
            'course_type'=>'seminar',
         ]);
    
         $data->save();
         $request->session()->flash('success','Attendance Submit Successfully');
         return redirect('home');
        
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }
}


public function seminarPresent(Request $request,$id){
    if(Auth::user()->role==1 || Auth::user()->role==2){
        $accept = Attendance::find($id);
        $accept->attendance = 'present';
        $accept->save();
        $request->session()->flash('success','Attendance Edit Successfully');
        return back();
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }

}

public function seminarAbsent(Request $request,$id){
    if(Auth::user()->role==1 || Auth::user()->role==2){
        $accept = Attendance::find($id);
        $accept->attendance = 'absent';
        $accept->save();
        $request->session()->flash('success','Attendance Edit Successfully');
        return back();
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }
}


public function studyPresent(Request $request,$id){
    if(Auth::user()->role==1 || Auth::user()->role==2){
        $accept = Attendance::find($id);
        $accept->attendance = 'present';
        $accept->save();
        $request->session()->flash('success','Attendance Edit Successfully');
        return back();
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }

}

public function studyAbsent(Request $request,$id){
    if(Auth::user()->role==1 || Auth::user()->role==2){
        $accept = Attendance::find($id);
        $accept->attendance = 'absent';
        $accept->save();
        $request->session()->flash('success','Attendance Edit Successfully');
        return back();
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }
}

    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
