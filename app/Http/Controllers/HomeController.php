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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){   
          //Module      
        $mod_check_data=[];
        $enrolls=DB::table('enrolls')->get();
        foreach($enrolls as $row){
        $module_id=$row->course_id;
        $std_id=$row->student_id;
        $present=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$module_id)->where('course_type','module')
        ->where('attendance','present')->get()->sum("lec_hours");
        $absent=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$module_id)->where('course_type','module')
        ->where('attendance','absent')->get()->sum("lec_hours");
        
        $total=$present+$absent;
        if($present!=0){
        $pecentage=($present/$total)*100;
        if($pecentage<75){
            $mod_check_data=DB::table('users')->join('enrolls','users.id','=','enrolls.student_id')
            ->join('modules','enrolls.course_id','=','modules.id')
            ->select('users.name','users.id','modules.module_name')
            ->where('enrolls.course_id',$module_id)->where('enrolls.student_id',$std_id)->where('enrolls.enroll','2')->get();
           
        }}
    }
        $id=Auth::user()->id;
        $role=Auth::user()->role; 
        $module_attend=DB::table('attendance_sheets')->join('enrolls', 'attendance_sheets.course_id', '=', 'enrolls.course_id')
        ->join('modules','attendance_sheets.course_id','=','modules.id')
        ->select('attendance_sheets.id as sheetID','attendance_sheets.hours','attendance_sheets.date','enrolls.*','modules.module_name','modules.conduct_lecturer')
        ->where('enrolls.student_id',$id)->where('enrolls.course_type','module')->where('enrolls.status','1')->where('attendance_sheets.course_type','module')
        ->where('attendance_sheets.status','1')->get();


        //Seminar
        $sem_check_data=[];
        $enrolls=DB::table('enrolls')->where('course_type','seminar')->get();
        foreach($enrolls as $row){
        $seminar_id=$row->course_id;
        $std_id=$row->student_id;
        $present=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$seminar_id)->where('course_type','seminar')->where('attendance','present')->get()->sum("lec_hours");
        $absent=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$seminar_id)->where('course_type','seminar')->where('attendance','absent')->get()->sum("lec_hours");
    
        $total=$present+$absent;
        if($present!=0){
        $pecentage=($present/$total)*100;
        if($pecentage<75){
            $sem_check_data=DB::table('users')->join('enrolls','users.id','=','enrolls.student_id')
            ->join('seminars','enrolls.course_id','=','seminars.id')
            ->select('users.name','users.id','seminars.seminar_name')
            ->where('enrolls.course_id',$seminar_id)->where('enrolls.student_id',$std_id)->where('enrolls.enroll','2')->get();
        }}
    }
    //$sem_check_data=[];

        $seminar_attend=DB::table('attendance_sheets')->join('enrolls', 'attendance_sheets.course_id', '=', 'enrolls.course_id')
        ->join('seminars','attendance_sheets.course_id','=','seminars.id')
        ->select('attendance_sheets.id as sheetID','attendance_sheets.hours','attendance_sheets.date','enrolls.*','seminars.seminar_name','seminars.conducted_lecturer')
        ->where('enrolls.student_id',$id)->where('enrolls.status','1')->where('enrolls.course_type','seminar')
        ->where('attendance_sheets.course_type','seminar')
        ->where('attendance_sheets.status','1')->get();
        
    

        //Study Group


        $study_check_data=[];

        $enrolls=DB::table('enrolls')->where('course_type','study')->get();
        foreach($enrolls as $row){
        $study_id=$row->course_id;
        $std_id=$row->student_id;
        $present=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$study_id)->where('course_type','study')->where('attendance','present')->get()->sum("lec_hours");
        $absent=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$study_id)->where('course_type','study')->where('attendance','absent')->get()->sum("lec_hours");
    
        
        $total=$present+$absent;

      
        if($present!=0){
        $pecentage=($present/$total)*100;
        if($pecentage<75){
            $study_check_data[]=DB::table('users')->join('enrolls','users.id','=','enrolls.student_id')
            ->join('study_groups','enrolls.course_id','=','study_groups.id')
            ->select('users.name','users.id','study_groups.group_name')
            ->where('enrolls.course_id',$study_id)->where('enrolls.student_id',$std_id)->where('enrolls.enroll','2')->get();
        }}
     
        
    }
  

    $study_attend=DB::table('attendance_sheets')->join('enrolls', 'attendance_sheets.course_id', '=', 'enrolls.course_id')
    ->join('study_groups','attendance_sheets.course_id','=','study_groups.id')
    ->select('attendance_sheets.id as sheetID','attendance_sheets.hours','attendance_sheets.date','enrolls.*','study_groups.group_name','study_groups.conducted_lecturer')
    ->where('enrolls.student_id',$id)->where('enrolls.status','1')->where('enrolls.course_type','study')->where('attendance_sheets.course_type','study')
    ->where('attendance_sheets.status','1')->get();
    
 

 
        if(isset($mod_check_data) || isset($sem_check_data) || isset($study_check_data)){
        if(($role==1 || $role==2) && ((count($mod_check_data)>0) || (count($sem_check_data)>0) || (count($study_check_data)>0))){
            $request->session()->flash('delete','Low Attendance Students are Available');    
        }}

        return view('admin.dashboard')
        ->with('module_attend',$module_attend)->with('mod_check_data',$mod_check_data)
        ->with('seminar_attend',$seminar_attend)->with('sem_check_data',$sem_check_data)
        ->with('study_attend',$study_attend)->with('study_check_data',$study_check_data);
    }


    public static function checkModlueAtd($sheetID){
        $id=Auth::user()->id;
        $atd_data_module=DB::table('attendances')->where('student_id',$id)->where('course_type','module')->where('sheet_id',$sheetID)->get();
        //return $atd_data->toArray();
        return json_encode($atd_data_module);
    } 

    public static function checkSeminarAtd($sheetID){
        $id=Auth::user()->id;
        $atd_data_seminar=DB::table('attendances')->where('student_id',$id)->where('course_type','seminar')->where('sheet_id',$sheetID)->get();
        //return $atd_data->toArray();
        return json_encode($atd_data_seminar);
    }

    public static function checkStudyAtd($sheetID){
        $id=Auth::user()->id;
        $atd_data_study=DB::table('attendances')->where('student_id',$id)->where('course_type','study')->where('sheet_id',$sheetID)->get();
        //return $atd_data->toArray();
        return json_encode($atd_data_study);
    }
}

