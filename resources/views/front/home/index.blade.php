@extends('layouts.app')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Panel</h6>
            <p class="page-title-description mr-0 d-none d-md-inline-block">Teksöz Finans</p>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Panel</a>
                </li>
                <li class="breadcrumb-item active">Anasayfa</li>
            </ol>

        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list row">
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3">
            <div class="widget-bg">
                <div class="widget-heading bg-green-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Gelir Faturası</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Models\Fatura::getGelirCount() }}</span> Adet</div>
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
                <div class="widget-heading bg-red-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Gider Faturası</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Models\Fatura::getGiderCount() }}</span> Adet</div>
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
                <div class="widget-heading bg-green-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Tahsilat</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Models\Rapor::getTahsilat() }}</span> TL</div>
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
                <div class="widget-heading bg-red-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Ödeme</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Models\Rapor::getOdeme() }}</span> TL</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
    </div>

    <div class="widget-list row">
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-4">
            <div class="widget-bg">
                <div class="widget-heading bg-green-dark"><span class="widget-title my-0 color-white fs-12 fw-600">USD / TRY Alış</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter"></span> Adet</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-4">
            <div class="widget-bg">
                <div class="widget-heading bg-red-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Gider Faturası</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Models\Fatura::getGiderCount() }}</span> Adet</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-4">
            <div class="widget-bg">
                <div class="widget-heading bg-green-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Tahsilat</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Models\Rapor::getTahsilat() }}</span> TL</div>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-4">
            <div class="widget-bg">
                <div class="widget-heading bg-red-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Ödeme</span>  <i class="widget-heading-icon feather feather-file-text"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <div class="counter-title color-color-scheme"><span class="counter">{{ \App\Models\Rapor::getOdeme() }}</span> TL</div>
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
        <div class="widget-holder widget-full-height col-md-12">
            <div class="widget-bg">
                <div class="widget-heading widget-heading-border">
                    <h5 class="widget-title">Son Yapılan İşlemler</h5>
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
    </div>
    <!-- /.widget-list -->
@endsection
