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
use App\AttendanceSheet;
use Auth;
use Illuminate\Http\Request;

class ModuleController extends Controller
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
        $module_enroll_student=DB::table('enrolls')->join('modules','enrolls.course_id','=','modules.id')
        ->select('modules.*','enrolls.status as enroll_status','enrolls.student_id')->where('student_id',$student_id)->where('enrolls.status','1')->get();
        return view('admin.modules')->with('module_enroll_student',$module_enroll_student);
    }
    //->where('course_type','module')->where('attendance','present')->get()
    public function moduleAttendance(Request $request,$module_id,$std_id){
        $present=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$module_id)->where('course_type','module')->where('attendance','present')->get()->sum("lec_hours");
        $absent=DB::table("attendances")->where('student_id',$std_id)->where('course_id',$module_id)->where('course_type','module')->where('attendance','absent')->get()->sum("lec_hours");
        $module=DB::table('modules')->where('id',$module_id)->pluck('module_name')->first();
        $std_mod_atd=DB::table('attendances')->join('modules','attendances.course_id','=','modules.id')
        ->select('modules.*','attendances.created_at','attendances.attendance')
        ->where('student_id',$std_id)->where('course_id',$module_id)->where('attendances.course_type','module')->orderBy('attendances.id', 'DESC')->get();
        return view('admin.view_module_atd')->with('std_mod_atd',$std_mod_atd)->with('present',$present)->with('absent',$absent)->with('module',$module);
    }






    public function modulesSettings(){
        $role=Auth::user()->role;
        if($role==1){
        $modules=DB::table('modules')->get();
        return view('admin.moduels_settings')->with('modules',$modules);
    }else{
        $request->session()->flash('delete','Unauthorized');
        return redirect('home');
    }
}

    public function createModule(Request $request)
    {
        $role=Auth::user()->role;
        if($role==1){
            $module = new Module([ 
                'module_name' =>$request->get('module_name'),
                'module_code'=>$request->get('module_code'),
                'target_student_category'=>$request->get('student_category'),
                'conduct_lecturer'=>$request->get('conduct_lecturer'),
                'description'=>$request->get('module_description'),
                'status'=>'1'
             ]);
            $module->save();
            $request->session()->flash('success','Module Created successfully');
            return redirect('/modules_settings');
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }


    public function moduleAtdSheet()
    {   $lec_id=Auth::user()->id;
        $module=DB::table('modules')->get();
        $sheet_data=DB::table('attendance_sheets')->join('modules','attendance_sheets.course_id','=','modules.id')
        ->select('attendance_sheets.*','modules.module_name')->where('lecturer_id',$lec_id)->where('course_type','module')->orderBy('id', 'DESC')->get();
        return view('admin.module_atd_sheet')->with('module',$module)->with('sheet_data',$sheet_data);
    }


    public function managerModule(){
        $modules=DB::table('modules')->get();
        return view('admin.manager_module_sheet')->with('modules',$modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

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
