@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">İşlem <small> Ödeme Yap</small> </h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">İşlem</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center">
                <a href="{{ route('islem.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">İşlem Listesi</a>
            </div>
        </div>
        <!-- /.page-title-right -->
    </div>

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

    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">


                        <form id="form" action="{{ route('islem.store',['type'=>0]) }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group row ">

                                <div class="col-md-4 px-3">
                                    <label class="col-form-label" for="l0">FİŞ SEÇİNİZ</label>
                                    <select required name="faturaId" id="faturaId" class="m-b-10 form-control fatura" data-placeholder="Fiş Seçiniz" data-toggle="select2">
                                        <option value="">Fiş Seçiniz</option>
                                        @foreach(\App\Models\Fatura::getList(FATURA_GIDER) as $k => $v)
                                            @if(\App\Models\Fatura::getKalanTutar($v['id']) > 0)
                                            <option data-fiyat = "{{ \App\Models\Fatura::getTotal($v['id']) }}" data-kalanFiyat ="{{ \App\Models\Fatura::getKalanTutarInt($v['id']) }}" data-musteriId = "{{ $v['musteriId'] }}" value="{{ $v['id'] }}"> {{ $v['faturaNo']}} - {{ \App\Models\Musteriler::getPublicName($v['musteriId']) }} - {{ \App\Models\Fatura::getTotal($v['id']) }} TL ({{ \App\Models\Fatura::getKalanTutar($v['id']) }} TL)</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class="col-form-label" for="l0">MÜŞTERİ</label>
                                    <select disabled name="musteriId" id="musteriId" class="m-b-10 form-control musteri" data-placeholder="Müşteri Seçiniz" data-toggle="select2">
                                        <option value="">Müşteri Seçiniz</option>
                                        @foreach(\App\Models\Musteriler::all() as $k => $v)
                                            <option value="{{$v['id']}}"> {{ \App\Models\Musteriler::getPublicName($v['id']) }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">İŞLEM TARİHİ</label>
                                    <input class="form-control" required name="tarih" value="{{ date("Y-m-d") }}" type="date">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">HESAP</label>
                                        <select name="hesap" class="m-b-10 form-control" data-placeholder="Hesap Seçiniz" data-toggle="select2">
                                            @foreach(\App\Models\Banka::all() as $k => $v)
                                                <option value="{{$v['id']}}"> {{ $v['ad'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">ÖDEME ŞEKLİ</label>
                                        <select name="odemeSekli" class="m-b-10 form-control" data-placeholder="Hesap Seçiniz" data-toggle="select2">
                                            <option value="0">Nakit</option>
                                            <option value="1">Banka(EFT/Havale)</option>
                                            <option value="2">Kredi Kartı</option>
                                            <option value="3">Çek/Senet</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">FİYAT</label>
                                    <input required class="form-control fiyat" id="fiyat" name="fiyat" type="text">
                                </div>
                            </div>

                            <div class="col-md-12 px-3">
                                <div class="form-group">
                                    <label class=" col-form-label" for="l0">AÇIKLAMA</label>
                                    <textarea name="text" class="form-control" id="" cols="30" rows="5"></textarea>
                                </div>
                            </div>





                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button id="kaydet" class="btn btn-primary btn-rounded" type="submit">Kaydet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
        </div>
    </div>


@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>

    <script>
        var pathname = window.location.pathname
        pathname = pathname.split('/');
        var faturaId = pathname[4];
        if(pathname.length == 5) {
            $("#faturaId").val(faturaId);
            var fiyat2 = $('#faturaId').find(":selected").attr('data-kalanFiyat');
            var musteriId2 = $('#faturaId').find(":selected").attr('data-musteriId');
            $(".musteri").val(musteriId2).trigger('change');
            $(".fiyat").val(fiyat2);
        }

        $(document).ready(function (){

            $('[data-toggle=select2]').select2();

            $(".fatura").change(function (){
                var fiyat = $(this).find(":selected").attr('data-kalanFiyat');
                var musteriId = $(this).find(":selected").attr('data-musteriId');
                $(".musteri").val(musteriId).trigger('change');
                $(".fiyat").val(fiyat);
            });

            $('#form').on('submit', function() {
                $('#musteriId').prop('disabled', false);
            });

        });



    </script>

@endsection

