@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Ürün <small> Kapı Ekle</small></h6>


        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Ürün</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center">
                <a href="{{ route('kapi.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Ürün Listesi</a>
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


                        <form action="{{ route('kapi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group row firma--area">
                            <div class="col-md-4 px-3">
                                <label class="col-form-label" for="l0">FİŞ SEÇİNİZ</label>
                                <select required name="faturaNo" id="faturaNo" class="m-b-10 form-control fatura" data-placeholder="Fiş Seçiniz" data-toggle="select2">
                                    <option value="">Fiş Seçiniz</option>
                                    @foreach(\App\Models\Fatura::getList(FATURA_GELIR) as $k => $v)
                                            <option value="{{ $v['faturaNo'] }}"> {{ $v['faturaNo']}} - {{ \App\Models\Musteriler::getPublicName($v['musteriId']) }} - {{ \App\Models\Fatura::getTotal($v['id']) }} TL</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Ürün Tarihi</label>
                                    <input class="form-control" id="urunTarih" required name="tarih" value="{{ date("Y-m-d") }}" type="date">
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="kapiData" class="table">
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
                                            <th>Kaldır</th>
                                        </tr>
                                        </thead>
                                        <tr class="kapi_field">
                                            <td><input type="text" class="form-control" required name="kapi[0][boy]"></td>
                                            <td><input type="text" class="form-control" required name="kapi[0][en]"></td>
                                            <td><input type="text" class="form-control" required name="kapi[0][kasa]"></td>
                                            <td><input type="text" class="form-control" required name="kapi[0][adet]"></td>
                                            <td><input type="text" class="form-control" name="kapi[0][kenar]"></td>
                                            <td><input type="text" class="form-control" name="kapi[0][model]"></td>
                                            <td><input type="text" class="form-control" name="kapi[0][renk]"></td>
                                            <td><input type="text" class="form-control" name="kapi[0][text]"></td>
                                        </tr>
                                    </table>


                                </div>
                            </div>

                            <button type="button" id="addRowBtn" class="btn btn-primary btn-rounded">+</button>



                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list mt-5">
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
        $(document).ready(function () {

            $('[data-toggle=select2]').select2();
        });


                $("#addRowBtn").click(function (){

                    var i = $(".kapi_field").length;

                    var newRow =
                        '<tr class="kapi_field">'+
                        '<td><input type="text" class="form-control" required name="kapi['+i+'][boy]"></td>'+
                        '<td><input type="text" class="form-control" required name="kapi['+i+'][en]"></td>'+
                        '<td><input type="text" class="form-control" required name="kapi['+i+'][kasa]"></td>'+
                        '<td><input type="text" class="form-control" required name="kapi['+i+'][adet]"></td>'+
                        '<td><input type="text" class="form-control" name="kapi['+i+'][kenar]"></td>'+
                        '<td><input type="text" class="form-control" name="kapi['+i+'][model]"></td>'+
                        '<td><input type="text" class="form-control" name="kapi['+i+'][renk]"></td>'+
                        '<td><input type="text" class="form-control" name="kapi['+i+'][text]"></td>'+
                        '<td><button id="removeButton" type="button" class="btn btn-danger">X</button></td>'+
                        '</tr>';
                    $("#kapiData").append(newRow);
                    i++;

                });


                $("body").on("click","#removeButton",function () {
                    $(this).closest(".kapi_field").remove();
                });







    </script>
@endsection
