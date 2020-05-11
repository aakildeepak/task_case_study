@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">View Attendace Sheet</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View Attendace Sheet</li>
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




    
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
        <h3>{{$present/$all*100}}<sup style="font-size: 20px">%</sup></h3>
          <p>Class Usage</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
        <h3>{{$present}}</h3>
          <p>Present Student</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
        <h3>{{$absent}}</h3>
          <p>Absent Student</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
  </div>


    <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">View Attendace Sheet</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                <th>#</th>
                  <th>Student Name</th>
                  <th>Lecturer Hours</th>
                  <th>Attendance</th>
                  <th>Edit</th>
                  <th>Summery</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach($atd as $row)
                  <tr>
                  <td>{{$i}}</td>
                  <td>{{$row->name}}</td>
                  <td>{{$row->lec_hours}}</td>
                    <td>
                        @if($row->attendance=="present")
                        <span class="badge bg-primary">Present</span>
                        @endif
                        @if($row->attendance=="absent")
                        <span class="badge bg-danger">Absent</span>
                        @endif
                    </td>
                    <td>
                        @if($row->attendance=="present")
                        <a onclick="return confirm('Do you want to edit addendance?')" href="{{url('/module_absent/'.$row->id )}}" class="btn btn-block btn-danger">Absent</a>
                        @endif
                        @if($row->attendance=="absent")
                        <a onclick="return confirm('Do you want to edit addendance?')" href="{{url('/module_present/'.$row->id )}}" class="btn btn-block btn-success">Present</a>
                        @endif
                    </td>
                    <td><a href="{{url('/viewModuleAttendance/'.$row->course_id.'/'.$row->student_id )}}" class="btn btn-block btn-success">Summery</a></td>
                    
                  </tr>
                  <?php $i++;?>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
  </div>
   <!--End Modules-->







</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
    <script>

      </script>
@endsection