<?php

namespace App\Http\Controllers;
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

class StudyGroupController extends Controller
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

       
    public function index()
    {
        $student_id=Auth::user()->id;
        $study_enroll_student=DB::table('enrolls')->join('study_groups','enrolls.course_id','=','study_groups.id')
        ->select('study_groups.*','enrolls.status as enroll_status','enrolls.student_id')->where('student_id',$student_id)->where('enrolls.status','1')->get();
        return view('admin.study_groups')->with('study_enroll_student',$study_enroll_student);
    }


    public function studyGroupSettings(){
        $role=Auth::user()->role;
        if($role==1){
        $study_groups=DB::table('study_groups')->get();
        return view('admin.study_groups_settings')->with('study_groups',$study_groups);
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }
    }

    public function createGroup(Request $request)
    {
        $role=Auth::user()->role;
        if($role==1){
            $group = new StudyGroup([ 
                'group_name' =>$request->get('study_name'),
                'std_category'=>$request->get('student_category'),
                'conducted_lecturer'=>$request->get('conduct_lecturer'),
                'description'=>$request->get('study_description'),
                'status'=>'1'
             ]);
            $group->save();
            $request->session()->flash('success','Study Group Created successfully');
            return redirect('/study_groups_settings
            ');
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }


    
    public function studyAttendance(Request $request,$study_id,$std_id){
        $present=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$study_id)->where('course_type','study')->where('attendance','present')->get()->sum("lec_hours");
        $absent=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$study_id)->where('course_type','study')->where('attendance','absent')->get()->sum("lec_hours");
        $study=DB::table('study_groups')->where('id',$study_id)->pluck('group_name')->first();
        $std_sem_atd=DB::table('attendances')->join('study_groups','attendances.course_id','=','study_groups.id')
        ->select('study_groups.*','attendances.created_at','attendances.attendance')
        ->where('student_id',$std_id)->where('course_id',$study_id)->where('attendances.course_type','study')->orderBy('attendances.id', 'DESC')->get();
        return view('admin.view_study_atd')->with('std_sem_atd',$std_sem_atd)->with('present',$present)->with('absent',$absent)->with('study',$study);
    }

    public function studyAtdSheet(){

        $lec_id=Auth::user()->id;
        $study=DB::table('study_groups')->get();
        $sheet_data=DB::table('attendance_sheets')->join('study_groups','attendance_sheets.course_id','=','study_groups.id')
        ->select('attendance_sheets.*','study_groups.group_name')->where('lecturer_id',$lec_id)->where('course_type','study')->orderBy('id', 'DESC')->get();
        return view('admin.study_atd_sheet')->with('study',$study)->with('sheet_data',$sheet_data);
        
    }


    public function managerStudy(){
        $study=DB::table('study_groups')->get();
        return view('admin.manager_study_sheet')->with('study',$study);
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
