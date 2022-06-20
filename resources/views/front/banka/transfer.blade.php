@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Banka <small> Transfer Yap</small></h6>


        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Transfer</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center">
                <a href="{{ route('banka.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Banka Listesi</a>
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


                        <form action="{{ route('banka.transferYap') }}" method="POST" enctype="multipart/form-data">
                            @csrf




                            <div class="form-group row firma--area">

                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">Gönderen Hesap</label>
                                        <select name="gonderenHesap" class="m-b-10 form-control" data-placeholder="Hesap Seçiniz" data-toggle="select2">
                                            @foreach(\App\Models\Banka::all() as $k => $v)
                                                <option value="{{$v['id']}}"> {{ $v['ad'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label class="col-form-label" for="l0">Yatırılan Hesap</label>
                                        <select name="yatirilanHesap" class="m-b-10 form-control" data-placeholder="Hesap Seçiniz" data-toggle="select2">
                                            @foreach(\App\Models\Banka::all() as $k => $v)
                                                <option value="{{$v['id']}}"> {{ $v['ad'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Tutar</label>
                                    <input required class="form-control tutar" id="tutar" name="tutar" type="text">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>



    <script>
        $('[data-toggle=select2]').select2();
    </script>


@endsection
