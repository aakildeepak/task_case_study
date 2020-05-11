<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Module;
use App\Seminar;
use App\StudyGroup;
use App\GroupData;
use App\Enroll;
use App\Attendance;
use App\AttendanceSheet;
use Auth;
use Illuminate\Http\Request;

class AttendanceSheetController extends Controller
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
   
    public function createModuleSheet(Request $request){
        $role=Auth::user()->role;
        $lec_id=Auth::user()->id;
        if($role==2){
            $mod_sheet = new AttendanceSheet([ 
                'lecturer_id'=>$lec_id,
                'course_type'=>'module',
                'course_id'=>$request->get('module'),
                'hours'=>$request->get('hours'),
                'date'=>$request->get('date'),
                'status'=>$request->get('status'),
            ]);
            $mod_sheet->save();
            $request->session()->flash('success','Module Attendance Sheet Created successfully');
            return redirect('/module_atd_sheet');

        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }

    public function activeModuleSheet(Request $request,$id){
        $accept = AttendanceSheet::find($id);
        $accept->status = '1';
        $accept->save();
        $request->session()->flash('success','Attendance Sheet Activated Successfully');
        return redirect('/module_atd_sheet');
    }

    public function deactiveModuleSheet(Request $request,$id){
        $accept = AttendanceSheet::find($id);
        $accept->status = '0';
        $accept->save();
        $request->session()->flash('success','Attendance Sheet Deactivated Successfully');
        return redirect('/module_atd_sheet');
    }

    public function viewModuleSheet(Request $request,$id){
        $result=DB::table('attendances')->select('course_id')->where('sheet_id',$id)->first();
        if(isset($result)){
        $courseID=$result->course_id;
        $all=DB::table('enrolls')->where('course_id',$courseID)->where('course_type','module')->count();
        $present=DB::table('attendances')->where('sheet_id',$id)->where('course_type','module')->where('attendance','present')->count();
        $absent=DB::table('attendances')->where('sheet_id',$id)->where('course_type','module')->where('attendance','absent')->count();
        $atd=DB::table('attendances')->join('users','attendances.student_id','=','users.id')->select('attendances.*','users.name')
        ->where('sheet_id',$id)->orderBy('attendances.id', 'DESC')->get();
        return view('admin.view_module_sheet')->with('atd',$atd)->with('all',$all)->with('present',$present)->with('absent',$absent);
    }else{
        $request->session()->flash('success','No Data');
        return back();
    }
    
    }

    public function searchModSheet(Request $request){
        $modules=DB::table('modules')->get();
        $module_id=$request->get('search');
        $sheet_data=DB::table('attendance_sheets')->where('course_id',$module_id)->where('course_type','module')->orderBy('id', 'DESC')->get();
        return view('admin.manager_module_sheet')->with('modules',$modules)->with('sheet_data',$sheet_data);

    }


    //Seminar
    public function createSeminarSheet(Request $request){
        $role=Auth::user()->role;
        $lec_id=Auth::user()->id;
        if($role==2){
            $sem_sheet = new AttendanceSheet([ 
                'lecturer_id'=>$lec_id,
                'course_type'=>'seminar',
                'course_id'=>$request->get('seminar'),
                'hours'=>$request->get('hours'),
                'date'=>$request->get('date'),
                'status'=>$request->get('status'),
            ]);
            $sem_sheet->save();
            $request->session()->flash('success','Seminar Attendance Sheet Created successfully');
            return redirect('/seminar_atd_sheet');

        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }

    public function activeSeminarSheet(Request $request,$id){
        $accept = AttendanceSheet::find($id);
        $accept->status = '1';
        $accept->save();
        $request->session()->flash('success','Attendance Sheet Activated Successfully');
        return redirect('/seminar_atd_sheet');
    }

    public function deactiveSeminarSheet(Request $request,$id){
        $accept = AttendanceSheet::find($id);
        $accept->status = '0';
        $accept->save();
        $request->session()->flash('success','Attendance Sheet Deactivated Successfully');
        return redirect('/seminar_atd_sheet');
    }


    public function viewSeminarSheet(Request $request,$id){
        $result=DB::table('attendances')->select('course_id')->where('sheet_id',$id)->where('course_type','seminar')->first();
        if(isset($result)){
        $courseID=$result->course_id;
        $all=DB::table('enrolls')->where('course_id',$courseID)->where('course_type','seminar')->count();
        $present=DB::table('attendances')->where('sheet_id',$id)->where('course_type','seminar')->where('attendance','present')->count();
        $absent=DB::table('attendances')->where('sheet_id',$id)->where('course_type','seminar')->where('attendance','absent')->count();
        $atd=DB::table('attendances')->join('users','attendances.student_id','=','users.id')->select('attendances.*','users.name')->where('sheet_id',$id)
        ->orderBy('attendances.id', 'DESC')->get();
        return view('admin.view_seminar_sheet')->with('atd',$atd)->with('all',$all)->with('present',$present)->with('absent',$absent);
        }else{
            $request->session()->flash('success','No Data');
            return back();
        }
    
    }

    public function searchSemSheet(Request $request){
        $seminars=DB::table('seminars')->get();
        $seminar_id=$request->get('search');
        $sheet_data=DB::table('attendance_sheets')->where('course_id',$seminar_id)->where('course_type','seminar')->orderBy('id', 'DESC')->get();
        return view('admin.manager_seminar_sheet')->with('seminars',$seminars)->with('sheet_data',$sheet_data);

    }

    //Study Group
    public function createStudySheet(Request $request){
        $role=Auth::user()->role;
        $lec_id=Auth::user()->id;
        if($role==2){
            $sem_sheet = new AttendanceSheet([ 
                'lecturer_id'=>$lec_id,
                'course_type'=>'study',
                'course_id'=>$request->get('study'),
                'hours'=>$request->get('hours'),
                'date'=>$request->get('date'),
                'status'=>$request->get('status'),
            ]);
            $sem_sheet->save();
            $request->session()->flash('success','Study Group Attendance Sheet Created successfully');
            return redirect('/study_group_atd_sheet');

        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }

    
    public function activeStudySheet(Request $request,$id){
        $accept = AttendanceSheet::find($id);
        $accept->status = '1';
        $accept->save();
        $request->session()->flash('success','Attendance Sheet Activated Successfully');
        return redirect('/study_group_atd_sheet');
    }

    public function deactiveStudySheet(Request $request,$id){
        $accept = AttendanceSheet::find($id);
        $accept->status = '0';
        $accept->save();
        $request->session()->flash('success','Attendance Sheet Deactivated Successfully');
        return redirect('/study_group_atd_sheet');
    }

    public function viewStudySheet(Request $request,$id){
        
        $result=DB::table('attendances')->select('course_id')->where('sheet_id',$id)->where('course_type','study')->first();
  
        
        if(isset($result)){
            $courseID=$result->course_id;
            $all=DB::table('enrolls')->where('course_id',$courseID)->where('course_type','study')->count();
            $present=DB::table('attendances')->where('sheet_id',$id)->where('course_type','study')->where('attendance','present')->count();
            $absent=DB::table('attendances')->where('sheet_id',$id)->where('course_type','study')->where('attendance','absent')->count();
            $atd=DB::table('attendances')->join('users','attendances.student_id','=','users.id')->select('attendances.*','users.name')->where('sheet_id',$id)
            ->orderBy('attendances.id', 'DESC')->get();
            return view('admin.view_study_sheet')->with('atd',$atd)->with('all',$all)->with('present',$present)->with('absent',$absent);
        }else{
            $request->session()->flash('success','No Data');
            return back();
        }
    }


    public function searchStudySheet(Request $request){
        $study=DB::table('study_groups')->get();
        $study_id=$request->get('search');
        $sheet_data=DB::table('attendance_sheets')->where('course_id',$study_id)->where('course_type','study')->orderBy('id', 'DESC')->get();
        return view('admin.manager_study_sheet')->with('study',$study)->with('sheet_data',$sheet_data);

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
