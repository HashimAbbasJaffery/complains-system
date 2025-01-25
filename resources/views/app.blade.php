<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/black_logo.png">
    <title>
        {{ config('app.name', 'Laravel') }}
    </title>
    <!-- Custom CSS -->
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/3a7e8b6e65.js" crossorigin="anonymous"></script>
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" style="padding-top: 0px; @if(request()->route()->uri === "login") display: none; @endif" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <img src="/assets/images/card_logo.png" alt="homepage" class="dark-logo" />
                        <li class="sidebar-item">
                            <a href="/admin/complains" class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span class="hide-menu">Complains</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/admin/types" class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false">
                                <i class="fa-solid fa-list"></i>
                                <span class="hide-menu">Types</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/admin/users" class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                                <span class="hide-menu">Users</span>
                            </a>
                        </li>
                    </ul>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger mt-3 rounded-md" style="width: 90%; background: #fa5838 !important; margin-left: 5%;">Logout</button>
                    </form>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper" @if(request()->route()->uri === "login") style="margin-left: 0px" @endif>
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->


                @inertia

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Developed by Hashim Abbas
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/dist/js/custom.min.js"></script>
</body>

</html>
