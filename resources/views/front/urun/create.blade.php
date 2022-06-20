@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Ürün <small> Ürün Ekle</small> </h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Ürün Ekle</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center">
                <a href="{{ route('urun.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Ürün Listesi</a>
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


                        <form id="form" action="{{ route('urun.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group row ">

                                <div class="col-md-4 px-3">
                                    <label class="col-form-label" for="l0">ÜRÜN TİPİ SEÇİNİZ</label>
                                    <select required name="urunTipi" id="urunTipi" class="m-b-10 form-control" data-placeholder="Ürün Tipi Seçiniz" data-toggle="select2">
                                        <option value="">Ürün Tipi Seçiniz</option>
                                        <option value="MDF">MDF</option>
                                        <option value="Hırdavat">Hırdavat</option>
                                    </select>
                                </div>

                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class=" col-form-label" for="l0">ÜRÜN ÖZELLİKLERİ</label>
                                        <input name="text" id="text" class="form-control" >
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">STOK</label>
                                    <input required class="form-control stok" id="stok" name="stok" type="number">
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">ÜRÜN TARİHİ</label>
                                    <input class="form-control" required name="urunTarihi" value="{{ date("Y-m-d") }}" type="date">
                                </div>


                            </div>




                            <div class="form-actions mt-4">
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



        $(document).ready(function (){

            $('[data-toggle=select2]').select2();


        });



    </script>

@endsection

