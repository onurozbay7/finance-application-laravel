@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Personel <small> İşlem Düzenle</small> </h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Personel İşlem</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center">
                <a href="{{ route('personelIslem.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Personel İşlem Listesi</a>
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


                        <form id="form" action="{{ route('personelIslem.update',['id'=>$data[0]['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group row ">

                                <div class="col-md-4 px-3">
                                    <label class="col-form-label" for="l0">Personel SEÇİNİZ</label>
                                    <select required name="personelId" id="personelId" class="m-b-10 form-control" data-placeholder="Personel Seçiniz" data-toggle="select2">
                                        <option value="">Personel Seçiniz</option>
                                        @foreach(\App\Models\Personel::all() as $k => $v)
                                            <option value="{{ $v['id'] }}" @if($v['id'] == $data[0]['personelId']) selected @endif> {{ $v['ad']}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">İŞLEM SEÇİNİZ</label>
                                        <select name="islemTipi" class="m-b-10 form-control" data-placeholder="İşlem Seçiniz" data-toggle="select2">
                                            <option value="1" @if($data[0]['islemTipi'] == ISLEM_MAAS) selected @endif>Maaş Öde</option>
                                            <option value="0" @if($data[0]['islemTipi'] == ISLEM_AVANS) selected @endif>Avans Ver</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">İŞLEM TARİHİ</label>
                                    <input class="form-control" required name="tarih" value="{{ $data[0]['tarih'] }}" type="date">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">HESAP</label>
                                        <select name="hesap" class="m-b-10 form-control" data-placeholder="Hesap Seçiniz" data-toggle="select2">
                                            @foreach(\App\Models\Banka::all() as $k => $v)
                                                <option @if($v['id'] == $data[0]['hesap']) selected @endif value="{{$v['id']}}"> {{ $v['ad'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Tutar</label>
                                    <input required class="form-control tutar" id="tutar" name="tutar" value="{{ $data[0]['tutar'] }}" type="text">
                                </div>

                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class=" col-form-label" for="l0">AÇIKLAMA</label>
                                        <textarea name="text" class="form-control" id="" cols="30" rows="1"> {{ $data[0]['text'] }} </textarea>
                                    </div>
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



        $(document).ready(function (){

            $('[data-toggle=select2]').select2();


        });



    </script>

@endsection

