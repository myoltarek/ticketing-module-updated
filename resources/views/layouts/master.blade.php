
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Ticketing Module</title>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> -->

<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="/asset/style.css">
<link rel="stylesheet" href="/asset/css/reset.css">
<!-- <script src="https://use.fontawesome.com/3c93f095a2.js"></script> -->
</head>
<body class="hold-transition sidebar-mini layout-footer-fixed layout-navbar-fixed layout-fixed">
    <div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
    </div>
<div id="app">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom" title="Logout">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-widget="control-sidebar" data-slide="true" role="button">
            <span><i class="fas fa-sign-out-alt fa-lg"></i></span> Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </span>
      </li>
    </ul>

    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('/img/logo-dark3.png') }}" alt="AdminLTE Logo" class="brand-image">
      {{-- <span class="brand-text font-weight-light">DBL Ceramics</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @php if(isset(Auth::user()->name)){
          @endphp
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          @php
          }
          @endphp
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav tabs nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ '/' == \Request::path() ? 'active' : '' }}">
              <i style="color: #ECBF08;" class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home Page
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <i style="color: #4BE7EF;" class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Ticket Panel
                <i style="color: #1A4772;" class="right fa fa-angle-left"></i>
              </p>
            </a>
            @php
              $currentURL= "";
              $currentPath = \Request::path();
              if(isset($_SERVER['QUERY_STRING'])){
                $queryString = $_SERVER['QUERY_STRING'];
                $currentURL = $currentPath.'?'.$queryString;
              }
            @endphp
            <ul class="nav nav-treeview sub-nav">
              <li class="nav-item">
                <a href="{{ route('ticket', ['type' => 'new']) }}" class="nav-link {{ 'ticket?type=new' == $currentURL ? 'active' : '' }}">
                  <i  style="color: #007bff;" class="fa fa-calendar-plus nav-icon"></i>
                  <p>
                    New Ticket
                    <span class="right badge badge-primary">New</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ticket', ['type' => 'wip']) }}" class="nav-link {{ 'ticket?type=wip' == $currentURL ? 'active' : '' }}">
                  <i style="color: #ffc107;" class="fa fa-spinner nav-icon"></i>
                  <p>
                    WIP Ticket
                    <span class="right badge badge-warning">WIP</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ticket', ['type' => 'answered']) }}" class="nav-link {{ 'ticket?type=answered' == $currentURL ? 'active' : '' }}">
                  <i style="color: #28a745;" class="fa fa-reply nav-icon"></i>
                  <p>
                    Answered Ticket
                    <span class="right badge badge-success">Ans</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ticket', ['type' => 'closed']) }}" class="nav-link {{ 'ticket?type=closed' == $currentURL ? 'active' : '' }}">
                  <i style="color: #dc3545;" class="fa fa-times nav-icon"></i>
                  <p>
                    Closed Ticket
                    <span class="right badge badge-danger">Closed</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ticket.downloadPanel') }}" class="nav-link {{ 'ticket/downloadPanel' ==  $currentPath ? 'active' : '' }}">
                  <i style="color: #C48D2C;" class="fas fa-clipboard nav-icon"></i>
                  <p>
                    Report Download
                  </p>
                </a>
              </li>
            </ul>
          </li>
          @php
              if(Auth::user()->isAdmin){
          @endphp
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <i  style="color: #4BE7EF;" class="nav-icon fa fa-paperclip"></i>
              <p>
                Static Content
                <i style="color: #1A4772;" class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview sub-nav">
              <li class="nav-item">
                <a href="{{ route('department.index') }}" class="nav-link {{ 'department' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #15BAA6;" class="fa fa-building nav-icon"></i>
                  <p>
                    Departments
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('division.index') }}" class="nav-link {{ 'division' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #15BA65;" class="fas fa-globe-asia nav-icon"></i>
                  <p>
                    Divisions
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('district.index') }}" class="nav-link {{ 'district' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #BA6A15;" class="fas fa-map-marked-alt nav-icon"></i>
                  <p>
                    Districts
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('query-type.index') }}" class="nav-link {{ 'query-type' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #5F6BF2;" class="fa fa-question-circle nav-icon"></i>
                  <p>
                    Query Type
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('complain-type.index') }}" class="nav-link {{ 'complain-type' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #ff0000;" class="fa fa-exclamation-triangle nav-icon"></i>
                  <p>
                    Complain Type
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('call-remarks.index') }}" class="nav-link {{ 'call-remarks' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #59b300;" class="fas fa-comment-dots nav-icon"></i>
                  <p>
                    Call Remarks
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <i  style="color: #4BE7EF;" class="nav-icon fa fa-paperclip"></i>
              <p>
                Ticketing Matrix
                <i style="color: #1A4772;" class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview sub-nav">
              <li class="nav-item">
                <a href="{{ route('assign-tickets.index') }}" class="nav-link {{ 'assign-tickets' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #D41397;" class="fas fa-people-carry nav-icon"></i>
                  <p>
                    Assign Ticket Persons
                  </p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview sub-nav">
              <li class="nav-item">
                <a href="{{ route('escalation-levels.index') }}" class="nav-link {{ 'escalation-levels' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #48DBFB;" class="fas fa-shoe-prints nav-icon"></i>
                  <p>
                    Escalation Levels
                  </p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview sub-nav">
              <li class="nav-item">
                <a href="{{ route('escalation-matrix.index') }}" class="nav-link {{ 'escalations' == \Request::segment(1) ? 'active' : '' }}">
                  <i style="color: #F7941D;" class="fas fa-sitemap nav-icon"></i>
                  <p>
                    Ticket Escallation
                  </p>
                </a>
              </li>
            </ul>
          </li>

          @php
              }
          @endphp
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <i  style="color: #4BE7EF;" class="nav-icon fa fa-paperclip"></i>
              <p>
                Crm Panel
                <i style="color: #1A4772;" class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview sub-nav">
              <li class="nav-item">
                <a href="{{ route('crm') }}" class="nav-link {{ 'crm' == $currentPath ? 'active' : '' }}">
                  <i style="color: #BBC868;" class="nav-icon fas fa-poll-h"></i>
                  <p>
                    Crm List
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('crm.downloadPanel') }}" class="nav-link {{ 'crm/downloadPanel' == $currentPath ? 'active' : '' }}">
                  <i style="color: #C48D2C;" class="nav-icon fas fa-clipboard"></i>
                  <p>
                    Report Download
                  </p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->
    <!-- Main content -->
    <main class="content">
            @yield('content')
        </main>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div> -->
    <!-- Default to the left -->
    <strong>Copyright &copy <a href="https://myolbd.com">MY Outsourcing Ltd.</a>.</strong> All rights reserved.
  </footer>
</div>
</div>

<!-- ./wrapper -->
    @include('sweetalert::alert')
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.3/TweenMax.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/MorphSVGPlugin.min.js"></script>
    <script src="/asset/js/active.js"></script>
    <script src="{{ asset('/js/Chart.js') }}"></script>

    @yield('scripts')

    <script>

      $(document).ready(function(){
        $('.nav-link').click(function(e){
          console.log(e);
        })
      });
    </script>
</body>
</html>
