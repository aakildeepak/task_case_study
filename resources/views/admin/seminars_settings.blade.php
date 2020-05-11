@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Seminars Settings <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Create Seminar
          </button></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Seminars Settings</li>
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
        <h4 class="modal-title">Create Seminar </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('/create_seminar')}}">
          @csrf
        <div class="form-group">
          <label for="">Seminar Name</label>
          <input name="seminar_name" class="form-control" type="text" placeholder="Seminar Name">
        </div>
        <div class="form-group">
          <label for="">Conduct Date</label>
          <input id="date" name="date" class="form-control" type="text" placeholder="Conduct Date">
        </div>
        <div class="form-group">
          <label for="">Student Category</label>
          <select name="student_category" class="custom-select group-select">
            <option value="1">1st Year</option>
            <option value="2">2nd Year</option>
            <option value="3">3rd Year</option>
            <option value="4">4th Year</option>
        </select>
        </div>
        <div class="form-group">
          <label for="">Conduct Lecturer</label>
          <input name="conduct_lecturer" class="form-control" type="text" placeholder="Conduct Lecturer">
        </div>
        <div class="form-group">
          <label for="">Seminar Description</label>
          <textarea class="form-control" name="seminar_description"></textarea>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Seminar</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!--Start Moduels Settings-->
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Seminar Settings</h3>
            <div class="card-tools">
       
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Seminar Name</th>
                  <th>Conduct Date</th>
                  <th>Conducted Lecturer</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($seminars as $item)
                <tr>
                <td>{{$i}}</td>
                <td>{{$item->seminar_name}}</td>
                <td>{{$item->conducted_date}}</td>
                <td>{{$item->conducted_lecturer}}</td>
                <td>{{$item->description}}</td>
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
 <!--End Modules Settings-->












</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
    <script>
  $( function() {
    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
      </script>
@endsection