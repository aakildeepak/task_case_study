@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Modules Settings <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Create Sheet
          </button></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Module Attendance Sheet</li>
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

  <!-- modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Module Sheet</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    
        <form method="post" action="{{url('/create_module_sheet')}}">
            @csrf
            <div class="form-group row">
              <label for="">Module</label><br>
              <div class="col-12">
              <select name="module" class="form-control group-select">
                @foreach ($module as $row)
              <option value="{{$row->id}}">{{$row->module_name}}</option>
                @endforeach
            </select>
              </div>
            </div>

          <div class="form-group">
            <label for="">Date</label>
            <input name="date" class="form-control" type="text" id="date">
          </div>

          <div class="form-group">
            <label for="">Hours</label>
            <input value="1" class="form-control" type="number" id="hours" name="hours" step="1">
          </div>
      
          <div class="form-group">
            <label for="">Status</label><br>
            <select name="status" class="custom-select">
              <option value="0">Deactive</option>
              <option value="1">Active</option>
          </select>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create Sheet</button>
        </div>
      </form>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->



<!--Start Module Atd Sheet-->
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Attendance Sheets</h3>
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
                  <th>Module Name</th>
                  <th>Hours</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach($sheet_data as $row_sheet)
                <tr>
                <td>{{$i}}</td>
                <td>{{$row_sheet->module_name}}</td>
                <td>{{$row_sheet->hours}}</td>
                <td>{{$row_sheet->date}}</td>
                <td>
                  @if($row_sheet->status==1)
                  <span class="badge bg-primary">
                    Active</span>
                  @endif
                  @if($row_sheet->status==0)
                  <span class="badge bg-danger">
                    Deactive</span>
                  @endif
                </td>
                  <td>
                    @if($row_sheet->status==0)
                    <a onclick="return confirm('Do you want to active attendance sheet?')" href="{{url('/active_module_sheet/'.$row_sheet->id )}}" class="btn btn-block btn-success">Active</a>
                    @endif
                    @if($row_sheet->status==1)
                    <a onclick="return confirm('Do you want to deactive attendance sheet?')" href="{{url('/deactive_module_sheet/'.$row_sheet->id )}}" class="btn btn-block btn-danger">Deactive</a>
                    @endif
                  </td>
                  <td> <a href="{{url('/viewModuleSheet/'.$row_sheet->id)}}" class="btn btn-block btn-success">View Attendance Sheet</a></td>
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
 <!--End Module Atd Sheet-->



</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script>
  $( function() {
    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
  <script>
    $(document).ready(function() {
    $('.group-select').select2();
});
</script>
@endsection