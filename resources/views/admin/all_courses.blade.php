@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">All Courses</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">All Courses</li>
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





  <!--Start Modules-->
  <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Modules</h3>

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
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>#</th>
                <th>Module Code</th>
                <th>Module Name</th>
                <th>Conducted Lecturer</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
               
              
              </tr>
            </thead>
            <tbody>
              <?php $i=1;?>
              @foreach ($modules as $m_row)
               <!--Check Module-->
                @php
                $checkMod=App\Http\Controllers\UserController::checkEnrollModule($m_row->id); 
                $checkMod = json_decode($checkMod,true);
                @endphp
    
                @foreach($checkMod as $c_mod)
                @endforeach
              <tr>
              <td>{{$i}}</td>
              <td>{{$m_row->module_code}}</td>
              <td>{{$m_row->module_name}}</td>
              <td>{{$m_row->description}}</td>
              <td>{{$m_row->conduct_lecturer}}</td>
              <td>
                @if(empty($checkMod))
                <span class="badge bg-primary">Please Enroll</span>
                @endif
              
                @if(!empty($checkMod))
                <span class="badge bg-success">Enrolled Successfully</span>
                @endif
               
              
              </td>
              <td>
                @if(empty($checkMod))
                <a href="{{url('/enrollModule/'.$m_row->id )}}" class="btn btn-block btn-success">Enroll</a>
                @endif
                
               
              </td>
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
 
  <!--Start Seminars-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Seminars</h3>
  
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
          <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Seminar Name</th>
                  <th>Conducted Date</th>
                  <th>Conducted Lecturer</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach ($seminars as $s_row)
                   <!--Check Seminar-->
                   @php
                   $checkSem=App\Http\Controllers\UserController::checkEnrollSeminar($s_row->id); 
                   $checkSem = json_decode($checkSem,true);
                   @endphp
       
                   @foreach($checkSem as $c_sem)
                   @endforeach
                <tr>
                <td>{{$i}}</td>
                <td>{{$s_row->seminar_name}}</td>
                <td>{{$s_row->conducted_date}}</td>
                <td>{{$s_row->conducted_lecturer}}</td>
                <td>{{$s_row->description}}</td>
                <td>
                  @if(empty($checkSem))
                  <span class="badge bg-primary">Please Enroll</span>
                  @endif
                
                  @if(!empty($checkSem))
                  <span class="badge bg-success">Enrolled Successfully</span>
                  @endif
                 
                </td>
                <td>     
                  @if(empty($checkSem))
                  <a href="{{url('/enrollSeminar/'.$s_row->id )}}" class="btn btn-block btn-success">Enroll</a>
                  @endif
                </td>
                 
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
    <!--End Seminars-->

  <!--Start Study Groups-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Study Groups</h3>
  
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
          <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Group Name</th>
                  <th>Conducted Lecturer</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach ($study as $std)
                   <!--Check Seminar-->
                   @php
                   $checkStudy=App\Http\Controllers\UserController::checkEnrollStudy($std->id); 
                   $checkStudy = json_decode($checkStudy,true);
                   @endphp
       
                   @foreach($checkStudy as $s)
                   @endforeach
                <tr>
                <td>{{$i}}</td>
                <td>{{$std->group_name}}</td>
                <td>{{$std->conducted_lecturer}}</td>
                <td>{{$std->description}}</td>  
                  <td>      
                    
                    @if(empty($checkStudy))
                    <span class="badge bg-primary">Please Enroll</span>
                    @endif
                  
                    @if(!empty($checkStudy))
                    <span class="badge bg-success">Enrolled Successfully</span>
                    @endif
                   </td>
                   <td>     
                    @if(empty($checkStudy))
                    <a href="{{url('/enrollStudy/'.$std->id )}}" class="btn btn-block btn-success">Enroll</a>
                    @endif
                  </td>
                  
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
    <!--End Study Groups-->

</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
    $('.group-select').select2();
});
</script>
@endsection