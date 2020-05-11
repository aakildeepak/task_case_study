@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">User Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
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



   @foreach($user_data as $row)
   @endforeach

   <section class="col-lg-12 connectedSortable ui-sortable">
    <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="Images/{{$row->profile_pic}}" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">
          @if($row->role==1)
              Manager
          @endif

          @if($row->role==2)
              Lecturer
          @endif

          @if($row->role==3)
            Student
          @endif
          </h3>

        <p class="text-muted text-center">{{$row->name}}</p>

        <p class="text-muted text-center">{{$row->admission_no}}</p>

         
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">About Me</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fas fa-book mr-1"></i>Description</strong>

          <p class="text-muted">
          {{$row->description}}
          </p>

          <hr>
          @if($row->role==3)
          <div class="text:center">
          <strong><i class="fas fa-book mr-1"></i>Degree Year</strong>
          <p class="text-muted">Year 
          {{$row->degree_year}}</p>
          </div>
          <hr>
          @endif

         
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->


    


  <div class="col-md-9">
    <div class="card card-primary">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">Profile Update</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ url('/update_profile') }}" id="invoice" role="form" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="card-body">

            <div class="form-group">
                  <label>Name</label>
                  <input name="name" type="text" class="form-control" value="{{$row->name}}" placeholder="{{$row->name}}">
            </div>  
           <!-- 
            <div class="form-group">
                <label>Admission No</label>
                <input disabled name="admission_no" type="text" class="form-control" value="{{$row->admission_no}}" placeholder="{{$row->admission_no}}">
          </div> 
        --> 
          
            @if($row->role==3)
            <div class="form-group">
                  <label>Degree Year</label>
                  <select id="year" name="year" class="custom-select">
                    <option selected value="{{$row->degree_year}}">{{$row->degree_year}}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>  
            @endif
               
        


            <div class="form-group">
              <label for="Message">Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="">{{$row->description}}</textarea>
            </div>

           
            <div class="form-group">
              <label for="exampleInputFile">Upload Your Profile Picture</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" multiple="" name="image" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text" id="">Upload</span>
                </div>
              </div>
            </div>

        
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>  
    </div>
    <!-- /.col -->
  </div>
    </section>




</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
    $('.dep-select').select2();
});
</script>
@endsection