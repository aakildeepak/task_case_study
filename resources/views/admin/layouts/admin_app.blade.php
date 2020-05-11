<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE | Dashboard</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--Select2-->
  <link href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <!--Date Picker-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/home')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>



      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}

            <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->
    <?php $profile_pic=Auth::user()->profile_pic;  ?>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('/home')}}" class="brand-link">
        <img src="{{asset("AdminLTE/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset("Images/$profile_pic")}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <!--
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>

-->
            <!--Manager-->
            @if(Auth::check() && (Auth::user()->role == 1))
     
  
  
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Course Settings
                    <i class="fas fa-angle-left right"></i>
               
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <a href="{{url('modules_settings')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Modules Settings</p>
                    </a>
                  </li>
                  <li class="nav-item">
                  <a href="{{url('seminars_settings')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Seminars Settings</p>
                    </a>
                  </li>
                  <li class="nav-item">
                  <a href="{{url('study_groups_settings')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Study Groups Settings</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Attendance Sheet
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <a href="{{url('manager_module_sheet')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Module Sheet</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('manager_seminar_sheet')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Seminar Sheet</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{url('manager_study_group_sheet')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Study Group Sheet</p>
                        </a>
                      </li>
                
             
                </ul>
              </li>

            @endif
            <!--/Manager-->

            <!--Lecturer-->
            @if(Auth::check() && (Auth::user()->role == 2))
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Attendance Sheet
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('module_atd_sheet')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Module Sheet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('seminar_atd_sheet')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Seminar Sheet</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('study_group_atd_sheet')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Study Group Sheet</p>
                      </a>
                    </li>
              
           
              </ul>
            </li>
            @endif
            <!--/Lecturer-->


            <!--Student-->
            @if(Auth::check() && (Auth::user()->role == 3))
          


            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Course Information
                  <i class="fas fa-angle-left right"></i>
             
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('all_courses')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Courses</p>
                    </a>
                  </li>
                <li class="nav-item">
                <a href="{{url('modules')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Modules</p>
                  </a>
                </li>
                <li class="nav-item">
                <a href="{{url('seminars')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Seminars</p>
                  </a>
                </li>
                <li class="nav-item">
                <a href="{{url('study_groups')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Study Groups</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
          <!--/Student--->

            <li class="nav-header">User Settings</li>
            <li class="nav-item">
              <a href="{{url('user_profile')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  User Profile

                </p>
              </a>
            </li>

            <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Reset Password
              </p>
            </a>
          </li>
-->
            <li class="nav-item">
              <a href="{{url('logout')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Log Out

                </p>
              </a>
            </li>





          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>






    <!--Yield Content Here-->

    @yield('content')

    <!--End Yield Content Here-->






    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="#">TaskCaseStudy</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->



  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE -->
  <script src="{{asset('AdminLTE/dist/js/adminlte.js')}}"></script>
  <!--Select2-->
  <script src="{{asset('AdminLTE/plugins/select2/js/select2.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
<!--Date Picker-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  @yield('script')

</body>

</html>