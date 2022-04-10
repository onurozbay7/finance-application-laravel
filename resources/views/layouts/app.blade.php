<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/demo/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pace.css')}}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Default</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/material-icons/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/mono-social-icons/monosocialiconsfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/feather-icons/feather.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    @yield('header')
</head>

<body class="header-dark sidebar-light sidebar-expand">
<div id="wrapper" class="wrapper">
    <!-- HEADER & TOP NAVIGATION -->
    <nav class="navbar">
        <!-- Logo Area -->
        <div class="navbar-header">
            <a href="/" class="navbar-brand">
                <img class="logo-expand" alt="" src="{{asset('assets/demo/logo-expand.png')}}">
                <img class="logo-collapse" alt="" src="{{asset('assets/demo/logo-collapse.png')}}">
                <!-- <p>BonVue</p> -->
            </a>
        </div>
        <!-- /.navbar-header -->
        <!-- Left Menu & Sidebar Toggle -->
        <ul class="nav navbar-nav">
            <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i class="feather feather-menu list-icon fs-20"></i></a>
            </li>
        </ul>
        <!-- /.navbar-left -->
        <!-- Search Form -->
        <form class="navbar-search d-none d-sm-block" role="search"><i class="feather feather-search list-icon"></i>
            <input type="search" class="search-query" placeholder="Search anything..."> <a href="javascript:void(0);" class="remove-focus"><i class="feather feather-x"></i></a>
        </form>
        <!-- /.navbar-search -->
        <div class="spacer"></div>
        <!-- Button: Create New -->
        <div class="btn-list dropdown d-none d-md-flex mr-4 mr-0-rtl ml-4-rtl"><a href="javascript:void(0);" class="btn btn-primary dropdown-toggle ripple" data-toggle="dropdown"><i class="feather feather-plus list-icon"></i> Create New</a>
            <div class="dropdown-menu dropdown-left animated flipInY"><span class="dropdown-header">Create new ...</span>  <a class="dropdown-item" href="#">Projects</a>  <a class="dropdown-item" href="#">User Profile</a>  <a class="dropdown-item" href="#"><span class="d-flex align-items-end"><span class="flex-1">To-do Item</span> <span class="badge badge-pill bg-primary-contrast">7</span> </span></a>
                <a
                    class="dropdown-item" href="#"><span class="d-flex align-items-end"><span class="flex-1">Mail</span>  <span class="badge badge-pill bg-color-scheme-contrast">23</span></span>
                </a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><span class="d-flex align-items-center"><span class="flex-1">Settings</span> <i class="feather feather-settings list-icon icon-muted"></i></span></a>
            </div>
        </div>
        <!-- /.btn-list -->
        <!-- User Image with Dropdown -->
        <ul class="nav navbar-nav">
            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><span class="avatar thumb-xs2"><img src="{{asset('assets/demo/users/user1.jpg')}}" class="rounded-circle" alt=""> <i class="feather feather-chevron-down list-icon"></i></span></a>
                <div
                    class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                    <div class="card">
                        <header class="card-header d-flex mb-0"><a href="javascript:void(0);" class="col-md-4 text-center"><i class="feather feather-user-plus align-middle"></i> </a><a href="javascript:void(0);" class="col-md-4 text-center"><i class="feather feather-settings align-middle"></i> </a>
                            <a
                                href="javascript:void(0);" class="col-md-4 text-center"><i class="feather feather-power align-middle"></i>
                            </a>
                        </header>
                        <ul class="list-unstyled card-body">
                            <li><a href="#"><span><span class="align-middle">Manage Accounts</span></span></a>
                            </li>
                            <li><a href="#"><span><span class="align-middle">Change Password</span></span></a>
                            </li>
                            <li><a href="#"><span><span class="align-middle">Check Inbox</span></span></a>
                            </li>
                            <li><a href="#"><span><span class="align-middle">Sign Out</span></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <!-- /.navbar-right -->
        <!-- Right Menu -->
        <ul class="nav navbar-nav d-none d-lg-flex ml-2 ml-0-rtl">
            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown"><i class="feather feather-hash list-icon"></i></a>
                <div class="dropdown-menu dropdown-left dropdown-card animated flipInY">
                    <div class="card">
                        <header class="card-header d-flex align-items-center mb-0"><a href="javascript:void(0);"><i class="feather feather-bell color-color-scheme" aria-hidden="true"></i></a>  <span class="heading-font-family flex-1 text-center fw-400">Notifications</span>  <a href="javascript:void(0);"><i class="feather feather-settings color-content"></i></a>
                        </header>
                        <ul class="card-body list-unstyled dropdown-list-group">
                            <li><a href="#" class="media"><span class="d-flex thumb-xs"><img src="assets/demo/users/user3.jpg" class="rounded-circle" alt=""> </span><span class="media-body"><span class="heading-font-family media-heading">Dany Miles </span><span class="media-content">commented on your photo</span> <span class="user--online float-right my-auto"></span></span></a>
                            </li>
                            <li><a href="#" class="media"><span class="d-flex thumb-xs"><img src="assets/demo/users/user6.jpg" class="rounded-circle" alt=""> </span><span class="media-body"><span class="heading-font-family media-heading">Emily Woodworth </span><span class="media-content">posted a photo on your wall.</span></span></a>
                            </li>
                            <li><a href="#" class="media"><span class="d-flex thumb-xs"><img src="assets/demo/users/user2.jpg" class="rounded-circle" alt=""> </span><span class="media-body"><span class="heading-font-family media-heading">Palmer Kate </span><span class="media-content">just mentioned you in his post</span></span></a>
                            </li>
                        </ul>
                        <!-- /.dropdown-list-group -->
                        <footer class="card-footer text-center"><a href="javascript:void(0);" class="heading-font-family text-uppercase fs-13">See all activity</a>
                        </footer>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown"><a href="#" class="dropdown-toggle ripple" data-toggle="dropdown"><i class="feather feather-settings list-icon"></i></a>
                <div class="dropdown-menu dropdown-left dropdown-card animated flipInY">
                    <div class="card">
                        <header class="card-header d-flex justify-content-between mb-0"><a href="javascript:void(0);"><i class="feather feather-bell color-color-scheme" aria-hidden="true"></i></a>  <span class="heading-font-family flex-1 text-center fw-400">Notifications</span>  <a href="javascript:void(0);"><i class="feather feather-settings color-content"></i></a>
                        </header>
                        <ul class="card-body list-unstyled dropdown-list-group">
                            <li><a href="#" class="media"><span class="d-flex"><i class="material-icons list-icon">check</i> </span><span class="media-body"><span class="heading-font-family media-heading">Invitation accepted</span> <span class="media-content">Your have been Invited ...</span></span></a>
                            </li>
                            <li><a href="#" class="media"><span class="d-flex thumb-xs"><img src="assets/demo/users/user3.jpg" class="rounded-circle" alt=""> </span><span class="media-body"><span class="heading-font-family media-heading">Steve Smith</span> <span class="media-content">I slowly updated projects</span> <span class="user--online float-right"></span></span></a>
                            </li>
                            <li><a href="#" class="media"><span class="d-flex"><i class="material-icons list-icon">event_available</i> </span><span class="media-body"><span class="-heading-font-family media-heading">To Do</span> <span class="media-content">Meeting with Nathan on Friday 8 AM ...</span></span></a>
                            </li>
                        </ul>
                        <!-- /.dropdown-list-group -->
                        <footer class="card-footer text-center"><a href="javascript:void(0);" class="headings-font-family text-uppercase fs-13">See all activity</a>
                        </footer>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.dropdown -->
            <li><a href="javascript:void(0);" class="right-sidebar-toggle active ripple ml-3 ml-0-rtl"><i class="feather feather-grid list-icon"></i></a>
            </li>
        </ul>
        <!-- /.navbar-right -->
    </nav>
    <!-- /.navbar -->
    <div class="content-wrapper">
        <!-- SIDEBAR -->
        <aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">
            <!-- User Details -->
            <div class="side-user">
                <div class="col-sm-12 text-center p-0 clearfix">
                    <div class="d-inline-block pos-relative mr-b-10">
                        <figure class="thumb-sm mr-b-0 user--online">
                            <img src="{{asset('assets/demo/users/user1.jpg')}}" class="rounded-circle" alt="">
                        </figure><a href="page-profile.html" class="text-muted side-user-link"><i class="feather feather-settings list-icon"></i></a>
                    </div>
                    <!-- /.d-inline-block -->
                    <div class="lh-14 mr-t-5"><a href="page-profile.html" class="hide-menu mt-3 mb-0 side-user-heading fw-500">{{ Auth::user()->name }}</a>
                        <br><small class="hide-menu">Admin</small>
                    </div>
                </div>
                <!-- /.col-sm-12 -->
            </div>
            <!-- /.side-user -->
            <!-- Sidebar Menu -->
            @include('layouts.sidebar')

        </aside>
        <!-- /.site-sidebar -->
        <main class="main-wrapper clearfix">
            @yield('content')
        </main>
        <!-- /.main-wrappper -->
        <!-- RIGHT SIDEBAR -->
        <aside class="right-sidebar scrollbar-enabled suppress-x">
            <div class="sidebar-chat" data-plugin="chat-sidebar">
                <div class="sidebar-chat-info">
                    <h6 class="fs-16">Chat List</h6>
                    <form class="mr-t-10">
                        <div class="form-group">
                            <input type="search" class="form-control form-control-rounded fs-13 heading-font-family pd-r-30" placeholder="Search for friends ..."> <i class="feather feather-search post-absolute pos-right vertical-center mr-3 text-muted"></i>
                        </div>
                    </form>
                </div>
                <div class="chat-list">
                    <div class="list-group row">
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="Julein Renvoye">
                            <figure class="thumb-xs user--online mr-3 mr-0-rtl ml-3-rtl">
                                <img src="assets/demo/users/user2.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name">Gene Newman</span>  <span class="username">@gene_newman</span> </span>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="Eddie Lebanovkiy">
                            <figure class="thumb-xs user--online mr-3 mr-0-rtl ml-3-rtl">
                                <img src="assets/demo/users/user3.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name">Billy Black</span>  <span class="username">@billyblack</span> </span>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="Cameron Moll">
                            <figure class="thumb-xs user--online mr-3 mr-0-rtl ml-3-rtl">
                                <img src="assets/demo/users/user5.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name">Herbert Diaz</span>  <span class="username">@herbert</span> </span>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="Bill S Kenny">
                            <figure class="user--busy thumb-xs mr-3 mr-0-rtl ml-3-rtl">
                                <img src="assets/demo/users/user4.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name">Sylvia Harvey</span>  <span class="username">@sylvia</span> </span>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="Trent Walton">
                            <figure class="user--busy thumb-xs mr-3 mr-0-rtl ml-3-rtl">
                                <img src="assets/demo/users/user6.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name">Marsha Hoffman</span>  <span class="username">@m_hoffman</span> </span>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="Julien Renvoye">
                            <figure class="user--offline thumb-xs mr-3 mr-0-rtl ml-3-rtl">
                                <img src="assets/demo/users/user7.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name">Mason Grant</span>  <span class="username">@masongrant</span> </span>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item" data-chat-user="Eddie Lebaovskiy">
                            <figure class="user--offline thumb-xs mr-3 mr-0-rtl ml-3-rtl">
                                <img src="assets/demo/users/user8.jpg" class="rounded-circle" alt="">
                            </figure><span><span class="name">Shelly Sullivan</span>  <span class="username">@shelly</span></span>
                        </a>
                    </div>
                    <!-- /.list-group -->
                </div>
                <!-- /.chat-list -->
            </div>
            <!-- /.sidebar-chat -->
        </aside>
        <!-- CHAT PANEL -->
        <div class="chat-panel" hidden>
            <div class="card">
                <div class="card-header d-flex justify-content-between"><a href="javascript:void(0);"><i class="feather feather-message-square text-success"></i></a>  <span class="user-name heading-font-family fw-400">John Doe</span>
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="widget-chat-activity flex-1">
                        <div class="messages scrollbar-enabled suppress-x">
                            <div class="message media reply">
                                <figure class="thumb-xs2 user--online">
                                    <a href="#">
                                        <img src="assets/demo/users/user3.jpg" class="rounded-circle">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>Epic Cheeseburgers come in all kind of styles.</p>
                                </div>
                                <!-- /.message-body -->
                            </div>
                            <!-- /.message -->
                            <div class="message media">
                                <figure class="thumb-xs2 user--online">
                                    <a href="#">
                                        <img src="assets/demo/users/user1.jpg" class="rounded-circle">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>Cheeseburgers make your knees weak.</p>
                                </div>
                                <!-- /.message-body -->
                            </div>
                            <!-- /.message -->
                            <div class="message media reply">
                                <figure class="thumb-xs2 user--offline">
                                    <a href="#">
                                        <img src="assets/demo/users/user5.jpg" class="rounded-circle">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>Cheeseburgers will never let you down.</p>
                                    <p>They'll also never run around or desert you.</p>
                                </div>
                                <!-- /.message-body -->
                            </div>
                            <!-- /.message -->
                            <div class="message media">
                                <figure class="thumb-xs2 user--online">
                                    <a href="#">
                                        <img src="assets/demo/users/user1.jpg" class="rounded-circle">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>A great cheeseburger is a gastronomical event.</p>
                                </div>
                                <!-- /.message-body -->
                            </div>
                            <!-- /.message -->
                            <div class="message media reply">
                                <figure class="thumb-xs2 user--busy">
                                    <a href="#">
                                        <img src="assets/demo/users/user6.jpg" class="rounded-circle">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>There's a cheesy incarnation waiting for you no matter what you palete preferences are.</p>
                                </div>
                                <!-- /.message-body -->
                            </div>
                            <!-- /.message -->
                            <div class="message media">
                                <figure class="thumb-xs2 user--online">
                                    <a href="#">
                                        <img src="assets/demo/users/user1.jpg" class="rounded-circle">
                                    </a>
                                </figure>
                                <div class="message-body media-body">
                                    <p>If you are a vegan, we are sorry for you loss.</p>
                                </div>
                                <!-- /.message-body -->
                            </div>
                            <!-- /.message -->
                        </div>
                        <!-- /.messages -->
                    </div>
                    <!-- /.widget-chat-acitvity -->
                </div>
                <!-- /.card-body -->
                <form action="javascript:void(0)" class="card-footer" method="post">
                    <div class="d-flex justify-content-end"><i class="feather feather-plus-circle list-icon my-1 mr-3"></i>
                        <textarea class="border-0 flex-1" rows="1" style="resize: none" placeholder="Type your message here" type="text"></textarea>
                        <button class="btn btn-sm btn-circle bg-transparent" type="submit"><i class="feather feather-arrow-right list-icon fs-26 text-success"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.chat-panel -->
    </div>
    <!-- /.content-wrapper -->
    <!-- FOOTER -->
    <footer class="footer"><span class="heading-font-family">Copyright @ 2017. All rights reserved BonVue Admin by Unifato</span>
    </footer>
</div>
<!--/ #wrapper -->
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.0/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/js/perfect-scrollbar.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.2/countUp.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mithril/1.1.1/mithril.js"></script>
<script src="{{asset('assets/vendors/theme-widgets/widgets.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
@yield('footer')
</body>

</html>
