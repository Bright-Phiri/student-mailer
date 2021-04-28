<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Laravel Ajax crud</title>
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-white">Laravel Crud</div>
            <ul>
                <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('students.create') }}"><i class="fa fa-user"></i> Add Student</a></li>
                <li><a href="{{ route('students.index') }}"><i class="fa fa-list"></i> View Students</a></li>
                <li><a href="{{ route('students.mail') }}"><i class="fa fa-envelope"></i> Mail</a></li>
                <li><a href=" {{ route('students.settings') }}"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a data-toggle="modal" data-target="#logoutModal" href="#"> <i class="fa fa-sign-out"></i>
                    Signout</a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Logout modal -->
       <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <button type="submit" onclick="" class="btn btn-primary">Signout</button>
                </form>
            </div>
        </div>
     </div>
     </div>
    <!-- End of Logout modal -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="page-content-header">
                <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="container-fluid">
                @yield('content')
            </div>
            <div class="page-content-footer">
                <center>Copyright &copy; <?php echo date('Y') ?> Bright. All rights reserved.</center>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    @section('scripts')
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    @show

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
