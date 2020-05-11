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
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
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
    }
    /*
    public function allCourses1()
    {   $id=Auth::user()->id;
        $year=Auth::user()->degree_year;
        $modules=DB::table('modules')->leftJoin('enrolls', 'modules.id', '=', 'enrolls.course_id')
        ->select('modules.*','enrolls.enroll')->where('modules.target_student_category',$year)->where('modules.status','1')->get();
        return view('admin.all_courses')->with('modules',$modules);
    }
    */
    public function allCourses()
    {   $id=Auth::user()->id;
        $year=Auth::user()->degree_year;
        $modules=DB::table('modules')->where('target_student_category',$year)->where('status','1')->get();
        $seminars=DB::table('seminars')->where('std_category',$year)->where('status','1')->get();
        $study=DB::table('study_groups')->where('std_category',$year)->where('status','1')->get();
        return view('admin.all_courses')->with('modules',$modules)->with('seminars',$seminars)->with('study',$study);
    }


    public static function checkEnrollModule($moduleID){
        $id=Auth::user()->id;
        $checkMod=DB::table('enrolls')->where('student_id',$id)->where('course_type','module')->where('course_id',$moduleID)->get();
        return json_encode($checkMod);
    }

    public static function checkEnrollSeminar($seminarID){
        $id=Auth::user()->id;
        $checkSem=DB::table('enrolls')->where('student_id',$id)->where('course_type','seminar')->where('course_id',$seminarID)->get();
        return json_encode($checkSem);
    }

    public static function checkEnrollStudy($studyID){
        $id=Auth::user()->id;
        $checkStudy=DB::table('enrolls')->where('student_id',$id)->where('course_type','study')->where('course_id',$studyID)->get();
        return json_encode($checkStudy);
    }

    public function enrollModule(Request $request,$mod_id){
        $role=Auth::user()->role;
        if($role==3){
        $id=Auth::user()->id;
        $mod_enroll = new Enroll([ 
            'course_type' =>'module',
            'enroll'=>'2',
            'course_id'=>$mod_id,
            'student_id'=>$id,
            'status'=>'1'
         ]);
        $mod_enroll->save();
        $request->session()->flash('success','You are enrolled successfully');
        return redirect('/all_courses');
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }

    public function enrollSeminar(Request $request,$sem_id){
        $role=Auth::user()->role;
        if($role==3){
        $id=Auth::user()->id;
        $sem_enroll = new Enroll([ 
            'course_type' =>'seminar',
            'enroll'=>'2',
            'course_id'=>$sem_id,
            'student_id'=>$id,
            'status'=>'1'
         ]);
        $sem_enroll->save();
        $request->session()->flash('success','You are enrolled successfully');
        return redirect('/all_courses');
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }

    public function enrollStudy(Request $request,$std_id){
        $role=Auth::user()->role;
        if($role==3){
        $id=Auth::user()->id;
        $study_enroll = new Enroll([ 
            'course_type' =>'study',
            'enroll'=>'2',
            'course_id'=>$std_id,
            'student_id'=>$id,
            'status'=>'1'
         ]);
        $study_enroll->save();
        $request->session()->flash('success','You are enrolled successfully');
        return redirect('/all_courses');
        }else{
            $request->session()->flash('delete','Unauthorized');
            return redirect('home');
        }
    }



    public function userProfile(){
        $id=Auth::user()->id;
        $user_data=DB::table('users')->where('id',$id)->get();
        return view('admin.user_profile')->with('user_data',$user_data);
    }



    public function update(Request $request)
    {
        
        try{
            $validator = Validator::make($request->all(),[
                
                //'image' => 'required|image|mimes:pdf,jpeg,png,jpg,gif,svg|max:5048',
                "image" => "mimes:jpeg,png,jpg|max:10000",
            ]);
    
            
            if($validator->fails()){ 
                $request->session()->flash('delete','Your profile picture format is not Valid');
                return redirect('userProfile');
            }else{

            

        $id=Auth::user()->id;
        $role=Auth::user()->role;
        $user = User::find($id);
        $user->name = $request->get('name');
       // $user->admission_no = $request->get('admission_no');
       /*
        if($role==2 || $role==3){
        $user->department = $request->get('department');
        }
        */
        if($role==3){
            $user->degree_year = $request->get('year');
            }

        $user->description = $request->get('description');

       // $user->description = $request->get('description');
        
        if ($request->hasFile('image')) {  
            $fileName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('Images'), $fileName); 
            $imagePath=$user->profile_pic;
            if(isset($imagePath)){
            $image_path = "/Images/$imagePath";
            unlink(public_path() . $image_path);
            }
            $user->profile_pic = $fileName;
            }

        $user->save();
        $request->session()->flash('success','User Information Updated Successfully');
        return redirect('user_profile');
            }
        }catch(\Exception $error){
                $request->session()->flash('delete','Unable to save your Profile Data. Please try again.');
                return redirect('user_profile');
        }
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
