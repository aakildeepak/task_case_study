@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Attendance</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View Module Attendance</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
    <!-- PIE CHART -->
    <div class="card card-danger">
        <div class="card-header">
        <h3 class="card-title">{{$module}}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      </div>
    </div>
  </div>

  <!--atd Data-->
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Attendance</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  
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
                    <th>Conducted Lecturer</th>
                    <th>Conducted Date</th>
                    <th>Description</th>
                    <th>Attendance</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($std_mod_atd as $row)
                  <tr>
                  <td>{{$i}}</td>
                  <td>{{$row->module_name}}</td>
                  <td>{{$row->conduct_lecturer}}</td>
                  <td>{{$row->created_at}}</td>
                  <td>{{$row->description}}</td>
                  <td>
                @if($row->attendance=='present')
                <span class="badge bg-success">Present</span>
                @endif
                @if($row->attendance=='absent')
                <span class="badge bg-danger">Absent</span>
                @endif
                </td>
                  </tr>
                  <?php $i++ ?>
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


  </div>




<!-- /.content-wrapper -->
@endsection
@section('script')
    <script>
    var present = @json($present);
    var absent = @json($absent);
    var attendanceData = {
      labels: [
        'Present',
        'Absent',      
      ],
      datasets: [
        {
          data: [present,absent],
          backgroundColor : [ '#00a65a','#f56954'],
        }
      ]
    }
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = attendanceData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
      </script>
@endsection