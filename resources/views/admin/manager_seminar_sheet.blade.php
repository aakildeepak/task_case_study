@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Seminar sheets</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Seminar Sheets</li>
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
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Seiminar Sheets</h3>
              <div class="card-tools">
                <form method="get" action="{{url('/search_sem_sheet')}}">
                    @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                  <select id="search" name="search" class="custom-select group-select form-control float-right">
                    @foreach($seminars as $row)
                  <option value="{{$row->id}}">{{$row->seminar_name}}</option>
                   @endforeach
                    </select>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    
                </div>
                </div>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Conducted Date</th>
                    <th>Attendance Sheet</th>
                  </tr>
                </thead>
                <tbody>
                    @isset($sheet_data)     
                    <?php $i=1; ?>
                    @foreach($sheet_data as $item)
                  <tr>
                  <td>{{$i}}</td>
                  <td>{{$item->date}}</td>
                    <td><a href="{{url('/viewSeminarSheet/'.$item->id)}}" class="btn btn-block btn-success">View Attendance Sheet</a></td>
                    
                  </tr>
                  <?php $i++;?>
                  @endforeach
                  @endisset
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
  </div>




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