@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard v3</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
      <!-- Alert Section -->
      @if(session('success'))
      <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                   {{session('success')}}
                </div>
      @endif

      @if(session('delete'))
      <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                 {{session('delete')}}
                </div>
      @endif

      @if(Auth::user()->role == 3 && Auth::user()->degree_year == "none")
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        <p>Please Update Your Profile. Make sure to update your degree year.</p>
      </div>
      @endif




<!-- Module -->
<div class="modal fade" id="Module" tabindex="-1" role="dialog" aria-labelledby="ModuleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModuleLabel">Low Attendance Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <th>#</th>
            <th>Student Name</th>
            <th>Module Name</th>
          </thead>
          <tbody>
            <?php $i=1;?>
            @foreach($mod_check_data as $mod_check)
            <tr>
            <td>{{$i}}</td>
            <td>{{$mod_check->name}}</td>
            <td>{{$mod_check->module_name}}</td>
            <tr>
              <?php $i++ ?>
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<!-- Seminar -->
<div class="modal fade" id="Seminar" tabindex="-1" role="dialog" aria-labelledby="SeminarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SeminarLabel">Low Attendance Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <th>#</th>
            <th>Student Name</th>
            <th>Module Name</th>
          </thead>
          <tbody>
            <?php $i=1;?>
            @foreach($sem_check_data as $sem_check)
            <tr>
            <td>{{$i}}</td>
            <td>{{$sem_check->name}}</td>
            <td>{{$sem_check->seminar_name}}</td>
            <tr>
              <?php $i++ ?>
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>





  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
     
       <!--Manager-->
       @if(Auth::check() && (Auth::user()->role == 1))
       <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo count($mod_check_data) ?></h3>
              <h4>Module</h4>
              <p>Low Attendance Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
        
            <a type="button" data-toggle="modal" data-target="#Module" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo count($sem_check_data) ?></h3>
              <h4>Seminar</h4>
              <p>Low Attendance Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
        
            <a type="button" data-toggle="modal" data-target="#Seminar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
   
   
      </div>

       @endif
       
       

<!--Lecturer-->
@if(Auth::check() && (Auth::user()->role == 2))
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?php echo count($mod_check_data) ?></h3>
        <h4>Module</h4>
        <p>Low Attendance Students</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
  
      <a type="button" data-toggle="modal" data-target="#Module" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
 <!-- ./col -->
 <div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3><?php echo count($sem_check_data) ?></h3>
      <h4>Seminar</h4>
      <p>Low Attendance Students</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>

    <a type="button" data-toggle="modal" data-target="#Seminar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>


</div>

@endif
 


        

      <!--Student-->
      @if(Auth::check() && (Auth::user()->role == 3))
     

      
<!--Module-->
<div class="content">
  <div class="container-fluid">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><h1>Module</h1></span>
      </div>
      <!-- /.info-box-content -->
    </div>


    <div class="row">
     
      @foreach($module_attend as $m_row)
    
      <div class="col-lg-3 col-6">
        
        <div class="position-relative p-3 bg-gray" style="height: 200px">
          <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-success text-lg">
              Attendance
            </div>
          </div>
         {{$m_row->module_name}}
          <br>
          <small>{{$m_row->conduct_lecturer}}</small>
        <br>
       <small>Date : {{$m_row->date}}</small><span style="margin-left: 15px"><small>Hours : {{$m_row->hours}}</small></span>
    
        @php
           $atd_data_module=App\Http\Controllers\HomeController::checkModlueAtd($m_row->sheetID); 
           $atd_data_module = json_decode($atd_data_module,true);
        @endphp
        @foreach($atd_data_module as $r)
        @endforeach

         
        @if(!empty($atd_data_module))
        @if($r['attendance']=="present")
        <span class="badge bg-success">You are marked as present</span>
        @endif
        @if($r['attendance']=="absent")
          <span class="badge bg-danger">You are marked as absent</span>
        @endif
          
        @endif
        

        @if(empty($atd_data_module))
          <form method="POST" action="{{ url('/submit_modules_attendance') }}" id="attendance" role="form" enctype="multipart/form-data" >
            @csrf
          <input hidden value="{{$m_row->hours}}" name="lec_hours">
          <input hidden name="sheetID" value="{{$m_row->sheetID}}">
          <input hidden name="course_id" value="{{$m_row->course_id}}">
          <div class="form-group">
            <label for="customSwitch">Mark Your Attendance</label>
            <select class="selectpicker" name="attendance">
              <option value="present">Present</option>
              <option value="absent">Absent</option>
            </select>  
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-sm">Submit</button>
          @endif
        </div>
        </form>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!--/Module-->     
     
<br>
<!--Seminar-->
<div class="content">
  <div class="container-fluid">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><h1>Seminar</h1></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <div class="row">
    
      @foreach($seminar_attend as $s_row)
    
      <div class="col-lg-3 col-6">
        
        <div class="position-relative p-3 bg-gray" style="height: 200px">
          <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-success text-lg">
              Attendance
            </div>
          </div>
         {{$s_row->seminar_name}}
          <br>
          <small>{{$s_row->conducted_lecturer}}</small>
        <br>
       <small>Date : {{$s_row->date}}</small><span style="margin-left: 15px"><small>Hours : {{$s_row->hours}}</small></span>
    
        @php
           $atd_data_seminar=App\Http\Controllers\HomeController::checkSeminarAtd($s_row->sheetID); 
           $atd_data_seminar = json_decode($atd_data_seminar,true);
        @endphp
        @foreach($atd_data_seminar as $s)
        @endforeach

         
        @if(!empty($atd_data_seminar))
        @if($s['attendance']=="present")
        <span class="badge bg-success">You are marked as present</span>
        @endif
        @if($s['attendance']=="absent")
          <span class="badge bg-danger">You are marked as absent</span>
        @endif
          
        @endif
        

        @if(empty($atd_data_seminar))
          <form method="POST" action="{{ url('/submit_seminars_attendance') }}" id="attendance" role="form" enctype="multipart/form-data" >
            @csrf
          <input hidden value="{{$s_row->hours}}" name="lec_hours">
          <input hidden name="sheetID" value="{{$s_row->sheetID}}">
          <input hidden name="course_id" value="{{$s_row->course_id}}">
          <div class="form-group">
            <label for="customSwitch">Mark Your Attendance</label>
            <select class="selectpicker" name="attendance">
              <option value="present">Present</option>
              <option value="absent">Absent</option>
            </select>  
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-sm">Submit</button>
          @endif
        </div>
        </form>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!--/Seminar-->


<br>
<!--Seminar-->
<div class="content">
  <div class="container-fluid">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><h1>Study Group</h1></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <div class="row">
    
      @foreach($study_attend as $s_row)
    
      <div class="col-lg-3 col-6">
        
        <div class="position-relative p-3 bg-gray" style="height: 200px">
          <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-success text-lg">
              Attendance
            </div>
          </div>
         {{$s_row->group_name}}
          <br>
          <small>{{$s_row->conducted_lecturer}}</small>
        <br>
       <small>Date : {{$s_row->date}}</small><span style="margin-left: 15px"><small>Hours : {{$s_row->hours}}</small></span>
    
        @php
           $atd_data_study=App\Http\Controllers\HomeController::checkStudyAtd($s_row->sheetID); 
           $atd_data_study = json_decode($atd_data_study,true);
        @endphp
        @foreach($atd_data_study as $s)
        @endforeach

         
        @if(!empty($atd_data_study))
        @if($s['attendance']=="present")
        <span class="badge bg-success">You are marked as present</span>
        @endif
        @if($s['attendance']=="absent")
          <span class="badge bg-danger">You are marked as absent</span>
        @endif
          
        @endif
        

        @if(empty($atd_data_study))
          <form method="POST" action="{{ url('/submit_seminars_attendance') }}" id="attendance" role="form" enctype="multipart/form-data" >
            @csrf
          <input hidden value="{{$s_row->hours}}" name="lec_hours">
          <input hidden name="sheetID" value="{{$s_row->sheetID}}">
          <input hidden name="course_id" value="{{$s_row->course_id}}">
          <div class="form-group">
            <label for="customSwitch">Mark Your Attendance</label>
            <select class="selectpicker" name="attendance">
              <option value="present">Present</option>
              <option value="absent">Absent</option>
            </select>  
          </div>
          <button type="submit" class="btn btn-block btn-primary btn-sm">Submit</button>
          @endif
        </div>
        </form>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!--/Study Group-->

<!--
      <br>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Messages
              </h3>
            </div>
          
            <div class="card-body">

              <div class="callout callout-info">
                <h5>I am an info callout!</h5>
                <h6>Lecturer</h6>
                <p>Follow the steps to continue to payment.</p>
              </div>

            </div>
            
          </div>
        
        </div>
      </div>

    -->
      @endif
     


    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
