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

class SeminarController extends Controller
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
         $seminar_enroll_student=DB::table('enrolls')->join('seminars','enrolls.course_id','=','seminars.id')
         ->select('seminars.*','enrolls.status as enroll_status','enrolls.student_id')->where('student_id',$student_id)->where('enrolls.status','1')->get();
         return view('admin.seminars')->with('seminar_enroll_student',$seminar_enroll_student);
     }



    public function seminarSettings(){
        $role=Auth::user()->role;
        if($role==1){
        $seminars=DB::table('seminars')->get();
        return view('admin.seminars_settings')->with('seminars',$seminars);
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }
    }

    public function createSeminar(Request $request){
        $role=Auth::user()->role;
        if($role==1){
            $seminar = new Seminar([ 
                'seminar_name' =>$request->get('seminar_name'),
                'conducted_date'=>$request->get('date'),
                'conducted_lecturer'=>$request->get('conduct_lecturer'),
                'description'=>$request->get('seminar_description'),
                'std_category'=>$request->get('student_category'),
                'status'=>'1'
             ]);
            $seminar->save();
            $request->session()->flash('success','Seminar Created successfully');
            return redirect('/seminars_settings');
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }

    public function seminarAttendance(Request $request,$seminar_id,$std_id){
        $present=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$seminar_id)->where('course_type','seminar')->where('attendance','present')->get()->sum("lec_hours");
        $absent=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$seminar_id)->where('course_type','seminar')->where('attendance','absent')->get()->sum("lec_hours");
        $seminar=DB::table('seminars')->where('id',$seminar_id)->pluck('seminar_name')->first();
        $std_sem_atd=DB::table('attendances')->join('seminars','attendances.course_id','=','seminars.id')
        ->select('seminars.*','attendances.created_at','attendances.attendance')
        ->where('student_id',$std_id)->where('course_id',$seminar_id)->where('attendances.course_type','seminar')->orderBy('attendances.id', 'DESC')->get();
        return view('admin.view_seminar_atd')->with('std_sem_atd',$std_sem_atd)->with('present',$present)->with('absent',$absent)->with('seminar',$seminar);
    }

    public function seminarAtdSheet(){
        $lec_id=Auth::user()->id;
        $seminar=DB::table('seminars')->get();
        $sheet_data=DB::table('attendance_sheets')->join('seminars','attendance_sheets.course_id','=','seminars.id')
        ->select('attendance_sheets.*','seminars.seminar_name')->where('lecturer_id',$lec_id)->where('course_type','seminar')->orderBy('id', 'DESC')->get();
        return view('admin.seminar_atd_sheet')->with('seminar',$seminar)->with('sheet_data',$sheet_data);
    }
    

    public function managerSeminar(){
        $seminars=DB::table('seminars')->get();
        return view('admin.manager_seminar_sheet')->with('seminars',$seminars);
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
