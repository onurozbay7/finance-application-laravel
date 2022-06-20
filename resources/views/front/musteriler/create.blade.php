@extends('layouts.app')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Müşteri <small> Müşteri Ekle</small></h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Müşteriler</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <a href="{{ route('musteriler.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Müşteri Listesi</a>
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


                        <form action="{{ route('musteriler.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Müşteri Resmi</label>
                                    <input class="form-control" name="photo" type="file">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div>
                                <h6  class="col-form-label">Müşteri Tipi</h6>
                                    <div>
                                    <label class="container">
                                        <input type="radio" class="change-cumstomerType" checked name="musteriTipi" value="0"> Bireysel
                                    </label>
                                    <label class="container">
                                        <input type="radio" class="change-cumstomerType" name="musteriTipi" value="1"> Kurumsal

                                    </label>
                                        <style> .container input, label { cursor: pointer; } </style>
                                    </div>


                                </div>
                            </div>

                            <div class="form-group row firma--area" style="display: none;">
                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Firma Adı</label>
                                    <input class="form-control" id="firmaAdi" name="firmaAdi" type="text">
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class="col-form-label" for="l0">Vergi Numarası</label>
                                    <input class="form-control" name="vergiNumarasi" type="text">
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Vergi Dairesi</label>
                                    <input class="form-control" name="vergiDairesi" type="text">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 px-3">
                                    <label class=" col-form-label" for="l0">Ad</label>
                                    <input class="form-control" maxlength="20" id="ad" name="ad" type="text">
                                </div>

                                <div class="col-md-6 px-3">
                                    <label class="col-form-label" for="l0">Soyad</label>
                                    <input class="form-control" maxlength="20" id="soyad" name="soyad" type="text">
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-md-6 px-3">
                                    <label class=" col-form-label" for="l0">TC</label>
                                    <input class="form-control" maxlength="11" minlength="11" name="tc" type="text">
                                </div>

                                <div class="col-md-6 px-3">
                                    <label class="col-form-label" for="l0">Adres</label>
                                    <input class="form-control" maxlength="100" name="adres" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 px-3">
                                    <label class=" col-form-label" for="l0">Telefon</label>
                                    <input class="form-control" name="telefon" type="text">
                                </div>

                                <div class="col-md-6 px-3">
                                    <label class="col-form-label" for="l0">E mail</label>
                                    <input class="form-control" name="email" type="text">
                                </div>
                            </div>


                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button class="btn btn-primary btn-rounded" type="submit">Kaydet</button>
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
    <script>

        $("#ad").attr('required',true);
        $("#soyad").attr('required',true);

        $(".change-cumstomerType").click(function (){
            var value = $(this).val();
            if(value == 1)
            {
                $(".firma--area").show();
                $("#firmaAdi").attr('required',true);
                $("#ad").attr('required',false);
                $("#soyad").attr('required',false);
            }
            else {
                $(".firma--area").hide();
                $("#firmaAdi").attr('required',false);
                $("#ad").attr('required',true);
                $("#soyad").attr('required',true);
            }
        });
    </script>



    @endsection
