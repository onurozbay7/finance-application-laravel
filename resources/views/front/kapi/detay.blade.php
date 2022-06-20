@extends('layouts.app')
@section('content')

    <style>
    </style>
    <div class="row page-title clearfix">
        <div class="page-title-left ">
            <h6 class="page-title-heading mr-0 mr-r-5">Kapı</h6>
            <h6 class="page-title-heading d-print-block">Fiş No: {{ $urunData[0]['faturaNo'] }}</h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb d-print-none">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Kapı Detayı</li>
            </ol>

            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <a href="{{ route('kapi.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Kapı Listesi</a>
            </div>
        </div>
        <!-- /.page-title-right -->
    </div>

    <div class="widget-list">
        <div class="row d-print-none">
            <!-- User Summary -->
            <div class="col-12 col-md-12 widget-holder widget-full-content">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="widget-user-profile">
                            <div class="col-md-12" style="margin-top: 10px;"></div>
                            <div class="profile-body">
                                <h6 class="h3 profile-user-name ">Fiş No: {{ $urunData[0]['faturaNo']}}</h6>
                                <small class="profile-user-address"></small>

                                <hr class="profile-seperator">
                                <div class="mb-3 mt-3">
                                    <a href="{{ route('kapi.edit',['id'=>$urunData[0]['id']]) }}" class="btn btn-outline-color-scheme btn-rounded btn-lg px-5 border-thick text-uppercase mr-2 mr-0-rtl ml-2-rtl fw-700 fs-11 heading-font-family">Kapı Düzenle</a>

                                </div>

                                <!-- /.profile-user-description -->
                            </div>
                        </div>
                        <!-- /.widget-user-profile -->
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
        </div>
        <div class="row">

            <div class="col-md-12" style="margin-top: 20px; background-color: white">
                <div class="d-inline-flex justify-center align-items-center ml-2 mt-4 mb-4 d-print-none">
                    <button id="yazdir" class="btn btn-dark btn-sm">Yazdır</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Boy</th>
                            <th>En</th>
                            <th>Kasa</th>
                            <th>Adet</th>
                            <th>Kenar</th>
                            <th>Model</th>
                            <th>Renk</th>
                            <th>Açıklama</th>
                        </tr>
                        </thead>
                        <body>
                        @foreach($olcuData as $k => $v)
                            <tr>
                                <td>{{ $v['boy'] }}</td>
                                <td>{{ $v['en'] }}</td>
                                <td>{{ $v['kasa'] }}</td>
                                <td>{{ $v['adet'] }}</td>
                                <td>{{ $v['kenar'] }}</td>
                                <td>{{ $v['model'] }}</td>
                                <td>{{ $v['renk'] }}</td>
                                <td>{{ $v['text'] }}</td>
                            </tr>



                        @endforeach
                        </body>
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('footer')
    <script>
        $("body").on("click","#yazdir",function () {
            window.print();

        });

    </script>
@endsection
