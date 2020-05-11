@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Modules</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Modules</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
 <!--Start Modules-->
 <div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Enrolled Modules</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>

 <!--Student-->
 @if(Auth::check() && (Auth::user()->role == 3))
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Module Code</th>
                    <th>Module Name</th>
                    <th>Lecturer</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Attendance</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1?>
                  @foreach ($module_enroll_student as $m_row)
                  <tr>
                  <td>{{$i}}</td>
                  <td>{{$m_row->module_code}}</td>
                  <td>{{$m_row->module_name}}</td>
                    <td>{{$m_row->conduct_lecturer}}</td>
                    <td>{{$m_row->description}}</td>
                    <td>
                      @if($m_row->enroll_status=='1')
                      <span class="badge bg-primary">Enrolled</span>
                      @endif
                      @if($m_row->enroll_status=='0')
                      <span class="badge bg-danger">Pending</span>
                      @endif
                    </td>
                    <td> <a href="{{url('/viewModuleAttendance/'.$m_row->id.'/'.$m_row->student_id )}}" class="btn btn-block btn-success">Attendance</a></td>    
                  </tr>
                  <?php $i++?>
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
@endif
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
    <script>

      </script>
@endsection