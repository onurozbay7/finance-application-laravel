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
    @if(session("status"))
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="alert alert-success">{{ session("status") }}</div>
            </div>
        </div>

    @endif

    @if(session("statusDanger"))
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="alert alert-danger">{{ session("statusDanger") }}</div>
            </div>
        </div>

    @endif
    @if(\App\Models\UserPermission::getMyControl(10))
    <div class="widget-list row">
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-4 ">
            <div class="widget-bg bugun">
                <div class="widget-heading bg-youtube-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Bugün Yapılacaklar</span>  <i class="widget-heading-icon feather feather-alert-circle"></i>
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <div class="counter-w-info">
                        <ul>
                            @if(count(\App\Models\Event::getTodayPlan()) != 0)
                                @foreach(\App\Models\Event::getTodayPlan() as $k => $v)
                                    <li style="color: #ad0000"> <span class="blink">{{ $v['title'] }}</span></li>
                                @endforeach

                        @else
                                <li>İşlem Yok</li>
                        @endif
                        </ul>
                    </div>
                    <!-- /.counter-w-info -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-4 ">
            <div class="widget-bg yaklasan">
                <div class="widget-heading bg-teal-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Yaklaşan Etkinlikler</span>  <i class="widget-heading-icon feather feather-bookmark"></i>
                </div>
                <div class="widget-body">
                    <div class="counter-w-info">
                        <ul>
                            @if(count(\App\Models\Event::getSoonPlan()) != 0)
                                @foreach(\App\Models\Event::getSoonPlan() as $k => $v)
                                    <li style="color: #303033">{{ $v['title'] }} - {{ \App\Models\Event::getStartDate($v['id']) }}</li>
                                @endforeach

                            @else
                                <li>İşlem Yok</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-4 ">
            <div class="widget-bg sonNotlar">
                <div class="widget-heading bg-blue-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Son Notlar</span>  <i class="widget-heading-icon feather feather-message-square"></i>
                </div>
                <div class="widget-body">
                    <div class="counter-w-info">
                        <ul>
                            @if(count(\App\Models\Notlar::sonNotlar()) != 0)
                                @foreach(\App\Models\Notlar::sonNotlar() as $k => $v)
                                    <li style="color: #303033">{{ $v['baslik'] }} - {{ \App\Models\Notlar::getTarih($v['id']) }} - {{ $v['userName'] }}</li>
                                @endforeach

                            @else
                                <li>Not Yok</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>

        <!-- /.widget-holder -->
    </div>
    @endif
    <!-- /.widget-list -->
    <hr>
    <div class="col-md-12 mt-4">
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
                {
                    "symbols": [
                    {
                        "description": "USD / TRY",
                        "proName": "FX:USDTRY"
                    },
                    {
                        "description": "EUR / TRY",
                        "proName": "FX:EURTRY"
                    },
                    {
                        "description": "GBP / TRY",
                        "proName": "FX_IDC:GBPTRY"
                    },
                    {
                        "description": "GRAM ALTIN",
                        "proName": "FX_IDC:XAUTRYG"
                    },
                    {
                        "description": "BTC / USD",
                        "proName": "BINANCE:BTCUSDT"
                    }
                ],
                    "colorTheme": "light",
                    "isTransparent": false,
                    "showSymbolLogo": true,
                    "locale": "tr"
                }
            </script>
        </div>

    </div>
    <!-- TradingView Widget BEGIN -->

    <!-- TradingView Widget END -->


    <div class="widget-list row">
        <!-- /.widget-holder -->
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-5">
            <div class="widget-bg">
                <div class="widget-heading bg-cyan-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Gelir Fişi</span>  <i class="widget-heading-icon feather feather-file-text"></i>
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
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-5">
            <div class="widget-bg">
                <div class="widget-heading bg-youtube-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Gider Fişi</span>  <i class="widget-heading-icon feather feather-file-text"></i>
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
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-5">
            <div class="widget-bg">
                <div class="widget-heading bg-cyan-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Tahsilat</span>  <i class="widget-heading-icon feather feather-file-text"></i>
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
        <div class="widget-holder widget-sm widget-border-radius col-md-3 mt-5">
            <div class="widget-bg">
                <div class="widget-heading bg-youtube-dark"><span class="widget-title my-0 color-white fs-12 fw-600">Toplam Ödeme</span>  <i class="widget-heading-icon feather feather-file-text"></i>
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
                </div>
                <!-- /.widget-heading -->
                <div class="widget-body">
                    <table class="widget-latest-transactions">
                        @if(\App\Models\Logger::loggerVarMi() == 1)
                        @foreach($logger as $k => $v)
                        <tr>
                            <td class="thumb-xs2">
                               <img class="rounded-circle" src="{{ \App\Models\Logger::getUserPhoto($v['userId']) }}">
                            </td>
                            <td class="single-user-details"><p class="single-user-name">{{ $v['userName'] }}</p></td>
                            <!-- /.single-user-details -->
                            <td class="single-amount"> <p style="margin-block-end: 0.2em;">{{$v['text']}}</p> <small>{{ \App\Models\Logger::getTarih($v['id']) }}</small></td>

                            <!-- /.single-status -->
                        </tr>
                        @endforeach
                        @else
                            <td class="single-user-details"><a class="single-user-name" href="">İşlem Yok</a></td>
                        @endif

                    </table>
                    <!-- /.widget-latest-transactions -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>
    </div>
    <!-- /.widget-list -->
    <style>
        @media screen and (max-width: 512px) {
            .rounded-circle {
                display: none;
            }
        }


        .blink {
            animation: blinker 4s linear infinite;
            color: #ad0000;
            font-size: 15px;
        }
        @keyframes blinker {
            50% { opacity: 0; }
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script>
       var bugunH = $('.bugun').height();
       var yaklasanH = $('.yaklasan').height();
       var sonNotlarH = $('.sonNotlar').height();

       if(bugunH > yaklasanH && bugunH > sonNotlarH){
           $('.yaklasan').height(bugunH);
           $('.sonNotlar').height(bugunH);
       }
       else if(yaklasanH > bugunH && yaklasanH > sonNotlarH){
           $('.bugun').height(yaklasanH);
           $('.sonNotlar').height(yaklasanH);
       }
       else {
           $('.bugun').height(sonNotlarH);
           $('.yaklasan').height(sonNotlarH);
       }


    </script>
@endsection
