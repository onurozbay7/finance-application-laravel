@extends('layouts.app')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Default</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and events</p>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Default</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Buy Now</a>
            </div>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list row">
        <div class="widget-holder widget-full-content widget-full-height col-md-6">
            <div class="widget-bg">
                <div class="widget-body">
                    <div class="counter-gradient">
                        <h3 class="fs-60 fw-600 mt-3 pt-1 h1 letter-spacing-minus"><span class="counter">6843</span></h3>
                        <h5 class="mb-4 fw-500">New Registered Users</h5>
                        <p class="text-muted">Number of all users who have registered
                            <br>on your website last week</p>
                    </div>
                    <!-- /.widget-counter -->
                    <div class="row columns-border-bw border-top">
                        <div class="col-6 d-flex flex-column justify-content-center align-items-center pd-tb-30">
                            <label class="d-flex flex-md-row flex-column align-items-center cursor-pointer">
                                <input type="checkbox" checked="checked" class="js-switch" data-color="#8253eb" data-size="small"> <span class="text-muted mr-l-20 mr-l-0-rtl mr-r-20-rtl d-inline-block">User Registrations</span>
                            </label>
                        </div>
                        <!-- /.col-6 -->
                        <div class="col-6 d-flex flex-column justify-content-center align-items-center pd-tb-30">
                            <label class="d-flex flex-md-row flex-column align-items-center cursor-pointer">
                                <input type="checkbox" class="js-switch" data-color="#8253eb" data-size="small"> <span class="text-muted mr-l-20 mr-l-0-rtl mr-r-20-rtl d-inline-block">Total Sales</span>
                            </label>
                            <!-- /.col-6 -->
                        </div>
                        <!-- /.col-6 -->
                    </div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-full-height widget-flex col-md-6">
            <div class="widget-bg">
                <div class="widget-heading">
                    <h4 class="widget-title"><span class="color-color-scheme fw-600">876</span> <small class="h5 ml-1 my-0 fw-500">New Users</small></h4>
                    <div class="widget-graph-info"><i class="feather feather-chevron-up arrow-icon color-success"></i>  <span class="color-success ml-2">+34%</span>  <span class="text-muted ml-1">more than last week</span>
                    </div>
                    <!-- /.widget-graph-info -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="mr-t-10 flex-1">
                        <div class="h-100" style="max-height: 270px">
                            <canvas id="chartJsNewUsers" style="height:100%"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">AVG Conversion Time</span>  <i class="widget-heading-icon feather feather-box"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">2.5</span>hrs</div>
                        <!-- /.counter-title -->
                        <div class="counter-info"><span class="badge bg-success-contrast"><i class="feather feather-arrow-up"></i> 23% increase </span>in conversion</div>
                        <!-- /.counter-info -->
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading bg-purple"><span class="widget-title my-0 color-white fs-12 fw-600">Daily Earnings</span>  <i class="widget-heading-icon feather feather-briefcase"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-purple">&dollar;<span class="counter">846</span>
                        </div>
                        <!-- /.counter-title -->
                        <div class="counter-info"><span class="badge bg-danger-contrast"><i class="feather feather-arrow-down"></i> 6% decrease </span>in earnings</div>
                        <!-- /.counter-info -->
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading"><span class="widget-title my-0 fs-12 fw-600">Completed Tasks</span>  <i class="widget-heading-icon feather feather-anchor"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title">
                            <div class="d-flex justify-content-center align-items-end">
                                <div data-toggle="circle-progress" data-start-angle="30" data-thickness="6" data-size="40" data-value="0.58" data-line-cap="round" data-empty-fill="#E2E2E2" data-fill='{"gradient": ["#40E4C2", "#0087FF"], "gradientAngle": -90}'></div><span class="counter ml-3">432</span>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                        <!-- /.counter-title -->
                        <div class="counter-info"><span class="badge bg-success-contrast"><i class="feather feather-arrow-up"></i> 5% increase</span>
                        </div>
                        <!-- /.counter-info -->
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading"><span class="widget-title my-0 fs-12 fw-600">Advertising Credits</span>  <i class="widget-heading-icon feather feather-zap"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title">
                            <div class="d-flex justify-content-center align-items-center"><span data-toggle="sparklines" sparkheight="25" sparktype="bar" sparkchartrangemin="0" sparkbarspacing="3" sparkbarcolor="#947AE8" sparkbarcolor="red"><!-- 2,4,5,3,2,3,5 --> </span><span class="align-bottom ml-2"><span class="counter">670</span></span>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                        <!-- /.counter-title -->
                        <div class="counter-info"><span class="badge bg-success-contrast"><i class="feather feather-arrow-up"></i> 5% increase </span>in advertising</div>
                        <!-- /.counter-info -->
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.widget-list -->
    <hr>
    <div class="widget-list row">
        <div class="widget-holder widget-full-height col-md-6">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">Latest Transactions</h5>
                    <div class="widget-actions">
                        <div class="predefinedRanges badge bg-success-contrast px-3 cursor-pointer heading-font-family" data-plugin-options='{

                    "locale": {

                      "format": "MMM YYYY"

                    }

                   }'><span></span>  <i class="feather feather-chevron-down ml-1"></i>
                        </div>
                    </div>
                    <!-- /.widget-actions -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <table class="widget-latest-transactions">
                        <tr>
                            <td class="thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user2.jpg">
                                </a>
                            </td>
                            <td class="single-user-details"><a class="single-user-name" href="#">Gene Newman</a>  <small>on Sep 16, 2017</small>
                            </td>
                            <!-- /.single-user-details -->
                            <td class="single-amount">IDR 250.875</td>
                            <td class="single-status"><i class="material-icons fs-18 color-success">fiber_manual_record</i>  <span class="text-muted d-none d-sm-inline">confirmed</span>
                            </td>
                            <!-- /.single-status -->
                        </tr>
                        <tr>
                            <td class="thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user3.jpg">
                                </a>
                            </td>
                            <td class="single-user-details"><a href="#" class="single-user-name">Billy Black</a>  <small>on Aug 21, 2017</small>
                            </td>
                            <!-- /.single-user-details -->
                            <td class="single-amount">IDR 875.250</td>
                            <td class="single-status"><i class="material-icons fs-18 color-warning">fiber_manual_record</i>  <span class="text-muted d-none d-sm-inline">waiting payment</span>
                            </td>
                            <!-- /.single-status -->
                        </tr>
                        <tr>
                            <td class="thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user5.jpg">
                                </a>
                            </td>
                            <td class="single-user-details"><a href="#" class="single-user-name">Herbert Diaz</a>  <small>on Aug 13, 2017</small>
                            </td>
                            <!-- /.single-user-details -->
                            <td class="single-amount">IDR 520.758</td>
                            <td class="single-status"><i class="material-icons fs-18 color-success">fiber_manual_record</i>  <span class="text-muted d-none d-sm-inline">confirmed</span>
                            </td>
                            <!-- /.single-status -->
                        </tr>
                        <tr>
                            <td class="thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user4.jpg">
                                </a>
                            </td>
                            <td class="single-user-details"><a href="#" class="single-user-name">Sylvia Harvey</a>  <small>on Aug 8, 2017</small>
                            </td>
                            <!-- /.single-user-details -->
                            <td class="single-amount">IDR 250.875</td>
                            <td class="single-status"><i class="material-icons fs-18 color-danger">fiber_manual_record</i>  <span class="text-muted d-none d-sm-inline">payment expired</span>
                            </td>
                            <!-- /.single-status -->
                        </tr>
                        <tr>
                            <td class="thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user6.jpg">
                                </a>
                            </td>
                            <td class="single-user-details"><a href="#" class="single-user-name">Marsha Hoffman</a>  <small>on July 30, 2017</small>
                            </td>
                            <!-- /.single-user-details -->
                            <td class="single-amount">IDR 875.250</td>
                            <td class="single-status"><i class="material-icons fs-18 color-success">fiber_manual_record</i>  <span class="text-muted d-none d-sm-inline">confirmed</span>
                            </td>
                            <!-- /.single-status -->
                        </tr>
                        <tr>
                            <td class="thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user7.jpg">
                                </a>
                            </td>
                            <td class="single-user-details"><a href="#" class="single-user-name">Mason Grant</a>  <small>on July 16, 2017</small>
                            </td>
                            <!-- /.single-user-details -->
                            <td class="single-amount">IDR 250.875</td>
                            <td class="single-status"><i class="material-icons fs-18 color-success">fiber_manual_record</i>  <span class="text-muted d-none d-sm-inline">confirmed</span>
                            </td>
                            <!-- /.single-status -->
                        </tr>
                        <tr>
                            <td class="thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user8.jpg">
                                </a>
                            </td>
                            <td class="single-user-details"><a href="#" class="single-user-name">Shelly Sullivan</a>  <small>on July 13, 2017</small>
                            </td>
                            <!-- /.single-user-details -->
                            <td class="single-amount">IDR 875.250</td>
                            <td class="single-status"><i class="material-icons fs-18 color-warning">fiber_manual_record</i>  <span class="text-muted d-none d-sm-inline">waiting payment</span>
                            </td>
                            <!-- /.single-status -->
                        </tr>
                        <!-- /.single -->
                    </table>
                    <!-- /.widget-latest-transactions -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-full-height col-md-6">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">User Activities</h5>
                    <div class="widget-actions"><a href="#" class="badge bg-info-contrast px-3 cursor-pointer heading-font-family">See all activities</a>
                    </div>
                    <!-- /.widget-actions -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="widget-user-activities">
                        <div class="single media">
                            <figure class="single-user-avatar user--online thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user2.jpg">
                                </a>
                            </figure>
                            <div class="media-body">
                                <div class="single-header clearfix">
                                    <div class="float-left"><a href="#" class="single-user-name">Gene Newman</a>  <small>Sep 16, via Tapatalk+</small>
                                    </div>
                                    <!-- /.float-left --> <a href="#" class="single-likes float-right"><i class="feather feather-thumbs-up"></i> <small>47 likes</small> </a>
                                    <!-- /.float-right -->
                                </div>
                                <!-- /.clearfix --> <a href="#" class="single-attachment"><i class="feather feather-download-cloud single-attachment-icon"></i> <span class="single-attachment-filename">Vacation Plans for Ibiza</span> <span class="single-attachment-filesize">67 mb</span> </a>
                                <!-- /.single-attachment -->
                            </div>
                            <!-- /.media -->
                        </div>
                        <!-- /.single -->
                        <div class="single media">
                            <figure class="single-user-avatar user--online thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user4.jpg">
                                </a>
                            </figure>
                            <div class="media-body">
                                <div class="single-header clearfix">
                                    <div class="float-left"><a href="#" class="single-user-name">Sylvia Harvey</a>  <small>July 31</small>
                                    </div>
                                    <!-- /.float-left --> <a href="#" class="single-likes float-right"><i class="feather feather-thumbs-up"></i> <small>86 likes</small> </a>
                                    <!-- /.float-right -->
                                </div>
                                <!-- /.clearfix -->
                                <p>Night fill together itself. Midst. Beginning. Behold living god had.</p>
                                <div class="single-gallery row">
                                    <figure class="col-6">
                                        <a class="d-block" href="assets/demo/status-gallery-1.jpg">
                                            <img class="w-100" src="assets/demo/status-gallery-1-thumb.jpg">
                                        </a>
                                    </figure>
                                    <!-- /.col-6 -->
                                    <figure class="col-6">
                                        <a class="d-block" href="assets/demo/status-gallery-2.jpg">
                                            <img class="w-100" src="assets/demo/status-gallery-2-thumb.jpg">
                                        </a>
                                    </figure>
                                    <!-- /.col-6 -->
                                </div>
                                <!-- /.single-gallery -->
                            </div>
                            <!-- /.media-body -->
                        </div>
                        <!-- /.single -->
                        <div class="single media">
                            <div class="single-event-icon bg-purple"><i class="feather feather-map"></i>
                            </div>
                            <!-- /.single-event-icon -->
                            <div class="media-body">
                                <div class="single-header clearfix">
                                    <div class="float-left"><a href="#" class="single-user-name">World Camp Meetup</a>  <small><i class="feather feather-clock color-danger"></i> 6:30, July 31, Illionois</small>
                                    </div>
                                    <!-- /.float-left --> <a href="#" class="single-likes float-right"><i class="feather feather-thumbs-up"></i> <small>348 likes</small> </a>
                                    <!-- /.float-right -->
                                </div>
                                <!-- /.single-header -->
                                <div class="single-users-list">
                                    <a href="#">
                                        <img src="assets/demo/users/user6.jpg">
                                    </a>
                                    <a href="#">
                                        <img src="assets/demo/users/user5.jpg">
                                    </a>
                                    <a href="#">
                                        <img src="assets/demo/users/user4.jpg">
                                    </a>
                                    <a href="#">
                                        <img src="assets/demo/users/user3.jpg">
                                    </a>
                                    <a href="#">
                                        <img src="assets/demo/users/user2.jpg">
                                    </a><a href="#" class="more">( ... )</a>
                                </div>
                                <!-- /.single-user-list -->
                            </div>
                            <!-- /.media-body -->
                        </div>
                        <!-- /.single -->
                    </div>
                    <!-- /.widget-user-activities -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.widget-list -->
    <hr>
    <div class="widget-list row">
        <div class="widget-holder widget-latest-posts col-md-6">
            <div class="widget-bg">
                <div class="widget-body">
                    <div class="cursor-move carousel" data-slick='{"slidesToShow": 1, "dots": true, "arrows": false}'>
                        <article>
                            <div class="row">
                                <figure class="col-5 post-img">
                                    <img src="assets/demo/blog-post-1.jpg" alt="A book is a dream that you hold in your hands">
                                </figure>
                                <div class="col-7 post-details">
                                    <h5 class="box-title">Latest Posts</h5>
                                    <h4 class="post-title"><a href="#">A book is a dream that you hold in your hands</a></h4>
                                    <div class="post-links">
                                        <figure>
                                            <a href="#">
                                                <img class="rounded-circle" src="assets/demo/users/user1.jpg" alt="User 1">
                                            </a>
                                        </figure>
                                        <ul>
                                            <li><a href="#"><i class="feather feather-eye"></i> 684</a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-thumbs-up"></i> 53</a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-eye"></i> 21</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.post-links -->
                                </div>
                                <!-- /.col-7 -->
                            </div>
                            <!-- /.row -->
                        </article>
                        <article>
                            <div class="row">
                                <figure class="col-5 post-img">
                                    <img src="assets/demo/blog-post-2.jpg" alt="A book is a dream that you hold in your hands">
                                </figure>
                                <div class="col-7 post-details">
                                    <h5 class="box-title">Latest Posts</h5>
                                    <h4 class="post-title"><a href="#">A book is a dream that you hold in your hands</a></h4>
                                    <div class="post-links">
                                        <figure>
                                            <a href="#">
                                                <img class="rounded-circle" src="assets/demo/users/user1.jpg" alt="User 1">
                                            </a>
                                        </figure>
                                        <ul>
                                            <li><a href="#"><i class="feather feather-eye"></i> 684</a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-thumbs-up"></i> 53</a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-eye"></i> 21</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.post-links -->
                                </div>
                                <!-- /.col-7 -->
                            </div>
                            <!-- /.row -->
                        </article>
                        <article>
                            <div class="row">
                                <figure class="col-5 post-img">
                                    <img src="assets/demo/blog-post-3.jpg" alt="A book is a dream that you hold in your hands">
                                </figure>
                                <div class="col-7 post-details">
                                    <h5 class="box-title">Latest Posts</h5>
                                    <h4 class="post-title"><a href="#">A book is a dream that you hold in your hands</a></h4>
                                    <div class="post-links">
                                        <figure>
                                            <a href="#">
                                                <img class="rounded-circle" src="assets/demo/users/user1.jpg" alt="User 1">
                                            </a>
                                        </figure>
                                        <ul>
                                            <li><a href="#"><i class="feather feather-eye"></i> 684</a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-thumbs-up"></i> 53</a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-eye"></i> 21</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.post-links -->
                                </div>
                                <!-- /.col-7 -->
                            </div>
                            <!-- /.row -->
                        </article>
                    </div>
                    <!-- /.carousel -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-full-height widget-no-padding widget-flex col-md-3">
            <div class="widget-bg bg-facebook color-white radius-5">
                <div class="widget-body">
                    <div class="facebook-widget flex-1" data-plugin-options='{"user": "envato", "limit": 3}'></div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-full-height widget-no-padding widget-flex col-md-3">
            <div class="widget-bg bg-twitter color-white radius-5">
                <div class="widget-body">
                    <div class="twitter-widget flex-1" data-plugin-options='{"screen_name": "elonmusk", "count": 3}'></div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.widget-list -->
    <hr>
    <div class="widget-list row">
        <div class="widget-holder col-md-6">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">Latest Comments</h5>
                    <div class="widget-actions"><a href="#" class="badge bg-info-contrast px-3 cursor-pointer heading-font-family">See all comments</a>
                    </div>
                    <!-- /.widget-actions -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="widget-latest-comments">
                        <div class="single media">
                            <figure class="single-user-avatar user--online thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user2.jpg">
                                </a>
                            </figure>
                            <div class="media-body">
                                <div class="single-header"><a href="#" class="single-user-name">Gene Newman</a>  <span class="single-timestamp text-muted">7:30 pm</span>
                                </div>
                                <!-- /.single-header -->
                                <p>Midst fourth moving lesser of moved may thing meat dominion had second i likeness to it replenish very seas brought. Replenish multi.</p>
                                <div class="single-footer clearfix"><span class="badge bg-info-contrast">Pending</span>
                                    <div class="float-right float-left-rtl">
                                        <ul class="animated fadeInLeft">
                                            <li><a href="#"><i class="feather feather-edit"></i></a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-check-circle"></i></a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-thumbs-up"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                                <!-- /.single-footer -->
                            </div>
                            <!-- /.single-body -->
                        </div>
                        <!-- /.single -->
                        <div class="single media">
                            <figure class="single-user-avatar user--online thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user4.jpg">
                                </a><span class="single-user-avatar-status offline"></span>
                            </figure>
                            <div class="media-body">
                                <div class="single-header"><a href="#" class="single-user-name">Sylvia Harvey</a>  <span class="single-timestamp text-muted">Sept 16, 2017</span>
                                </div>
                                <!-- /.single-header -->
                                <p>Midst fourth moving lesser of moved may thing meat dominion had second i likeness to it replenish very seas brought. Replenish multi.</p>
                                <div class="single-footer clearfix"><span class="badge bg-success-contrast">Approved</span>
                                    <div class="float-right float-left-rtl">
                                        <ul class="animated fadeInLeft">
                                            <li><a href="#"><i class="feather feather-edit"></i></a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-check-circle"></i></a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-thumbs-up"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                                <!-- /.d-flex -->
                            </div>
                            <!-- /.single-body -->
                        </div>
                        <!-- /.single -->
                        <div class="single media">
                            <figure class="single-user-avatar user--offline thumb-xs2">
                                <a href="#">
                                    <img class="rounded-circle" src="assets/demo/users/user5.jpg">
                                </a><span class="single-user-avatar-status online"></span>
                            </figure>
                            <div class="media-body">
                                <div class="single-header"><a href="#" class="single-user-name">Herbert Diaz</a>  <span class="single-timestamp text-muted">Sept 16, 2017</span>
                                </div>
                                <!-- /.single-header -->
                                <p>Midst fourth moving lesser of moved may thing meat dominion had second i likeness to it replenish very seas brought. Replenish multi.</p>
                                <div class="single-footer clearfix"><span class="badge bg-danger-contrast">Rejected</span>
                                    <div class="float-right float-left-rtl">
                                        <ul class="animated fadeInLeft">
                                            <li><a href="#"><i class="feather feather-edit"></i></a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-check-circle"></i></a>
                                            </li>
                                            <li><a href="#"><i class="feather feather-thumbs-up"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                                <!-- /.d-flex -->
                            </div>
                            <!-- /.single-body -->
                        </div>
                        <!-- /.single -->
                    </div>
                    <!-- /.widget-latest-comments -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-full-height widget-flex col-md-6">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">Chat Activity</h5>
                    <div class="widget-actions">
                        <div class="float-right user-avatar-list"><a href="#" class="thumb-xxs more-link">+24</a>
                            <a href="#" class="thumb-xxs">
                                <img src="assets/demo/users/user2.jpg" class="rounded-circle" alt="User 2">
                            </a>
                            <a href="#" class="thumb-xxs">
                                <img src="assets/demo/users/user3.jpg" class="rounded-circle" alt="User 3">
                            </a>
                            <a href="#" class="thumb-xxs">
                                <img src="assets/demo/users/user4.jpg" class="rounded-circle" alt="User 4">
                            </a>
                            <a href="#" class="thumb-xxs">
                                <img src="assets/demo/users/user5.jpg" class="rounded-circle" alt="User 5">
                            </a>
                        </div>
                        <!-- /.user-avatar-list -->
                    </div>
                    <!-- /.widget-actions -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="widget-chat-activity scrollbar-enabled flex-1">
                        <div class="messages">
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
                    <!-- /.widget-chat -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.widget-list -->
    <hr>
    <div class="widget-list row">
        <div class="widget-holder widget-full-content col-md-6">
            <div class="widget-bg">
                <div class="widget-body">
                    <div class="widget-user-profile">
                        <figure class="profile-wall-img">
                            <img src="assets/demo/user-widget-bg.jpeg" alt="User Wall">
                        </figure>
                        <div class="profile-body">
                            <figure class="profile-user-avatar thumb-md">
                                <a href="page-profile.html">
                                    <img src="assets/demo/users/user1.jpg" alt="User Wall">
                                </a>
                            </figure>
                            <h6 class="h3 profile-user-name">Scott Adams</h6><small class="profile-user-address">Los Angeles, California</small>
                            <hr class="profile-seperator">
                            <div class="profile-user-description mb-4">
                                <p>Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p><a href="#"
                                                                                                                                                                                                                                                   class="heading-font-family color-color-scheme fs-12 fw-700">http://instagram.com/scott</a>
                            </div>
                            <!-- /.profile-user-description -->
                            <div class="mb-5"><a href="page-profile.html" class="btn btn-outline-color-scheme btn-rounded btn-lg px-5 border-thick text-uppercase mr-2 mr-0-rtl ml-2-rtl fw-700 fs-11 heading-font-family">Edit Profile</a>  <a href="page-profile.html"
                                                                                                                                                                                                                                                class="btn btn-color-scheme btn-circle btn-md fs-18"><i class="feather feather-settings"></i></a>
                            </div>
                        </div>
                        <!-- /.d-flex -->
                        <div class="row columns-border-bw border-top">
                            <div class="col-4 d-flex flex-column justify-content-center align-items-center py-4">
                                <h6 class="my-0"><span class="counter">274</span></h6><small>Comments</small>
                            </div>
                            <!-- /.col-4 -->
                            <div class="col-4 d-flex flex-column justify-content-center align-items-center py-4">
                                <h6 class="my-0"><span class="counter">2483</span></h6><small>Followers</small>
                            </div>
                            <!-- /.col-4 -->
                            <div class="col-4 d-flex flex-column justify-content-center align-items-center py-4">
                                <h6 class="my-0"><span class="counter">146</span></h6><small>Following</small>
                            </div>
                            <!-- /.col-4 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.widget-user-profile -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-full-height widget-flex col-md-6">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">To-Do Widget</h5>
                    <div class="widget-actions"><a href="#" class="badge bg-info-contrast px-3 cursor-pointer heading-font-family">View Calendar</a>
                    </div>
                    <!-- /.widget-actions -->
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="widget-todo">
                        <div class="single media"><i class="single-icon feather feather-circle color-color-scheme"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">09:30 - 10:30</div>
                                <h6 class="single-title">Make an appointment with Doctor</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> Dr. Schoeb's Spine Center</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media"><i class="single-icon feather feather-circle color-info"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">16:00 - 20:00</div>
                                <h6 class="single-title">Visit WordCamp 2017 Ontario</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> Carleton University, Ontario</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="user-avatar-list align-self-center mr-3"><a href="#" class="thumb-xxs more-link">+24</a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user2.jpg" class="rounded-circle" alt="User 2">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user3.jpg" class="rounded-circle" alt="User 3">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user4.jpg" class="rounded-circle" alt="User 4">
                                </a>
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user5.jpg" class="rounded-circle" alt="User 5">
                                </a>
                            </div>
                            <!-- /.user-avatar-list -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media"><i class="single-icon feather feather-circle color-success"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">16:00 - 20:00</div>
                                <h6 class="single-title">Skype call to Herbert Diaz</h6>
                                <ul class="single-tags list-unstyled list-inline">
                                    <li><a href="#">skype</a>
                                    </li>
                                    <li><a href="#">business</a>
                                    </li>
                                    <li><a href="#">call</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.media-body -->
                            <div class="user-avatar-list align-self-center mr-3">
                                <a href="#" class="thumb-xxs">
                                    <img src="assets/demo/users/user5.jpg" class="rounded-circle" alt="User 2">
                                </a>
                            </div>
                            <!-- /.user-avatar-list -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media done"><i class="single-icon feather feather-check-circle color-warning"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">1 day ago</div>
                                <h6 class="single-title">Visit our boys in Battle Exhibition</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> St. Mary's Museum, Ontario</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single -->
                        <div class="single media done"><i class="single-icon feather feather-check-circle color-color-scheme"></i>
                            <div class="media-body">
                                <div class="text-muted heading-font-family fw-500">2 day ago</div>
                                <h6 class="single-title">Meeting with WordCamp Speakers</h6>
                                <p class="fw-400 fs-13 mb-0 text-muted"><i class="feather feather-map-pin mr-2"></i> Carleton University, Ontario</p>
                            </div>
                            <!-- /.media-body -->
                            <div class="dropdown align-self-center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="feather feather-more-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="list-icon feather feather-check"></i> Done</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="list-icon feather feather-delete"></i> Delete</a>
                                </div>
                                <!-- /.dropdown-menu -->
                            </div>
                            <!-- /.dropdown -->
                        </div>
                        <!-- /.single --> <a href="#" class="add-btn btn btn-circle btn-md fs-20 btn-color-scheme"><i class="feather feather-plus"></i></a>
                    </div>
                    <!-- /.widget-todo -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>
    <!-- /.widget-list -->
@endsection
