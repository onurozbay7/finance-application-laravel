@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Kullanıcı <small> Kullanıcı Ekle</small></h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Kullanıcı</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <a href="{{ route('user.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Kullanıcı Listesi</a>
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



    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <form action="{{ route('user.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                            @csrf





                            <div class="form-group row ">
                                <div class="col-md-12">
                                    <label class="col-form-label" for="l0">Kullanıcı Adı</label>
                                    <input class="form-control" required name="name"  type="text">
                                </div>

                                <div class="col-md-12">
                                    <label class="col-form-label" for="l0">Kullanıcı Email</label>
                                    <input class="form-control" required name="email"  type="email">
                                </div>

                                <div class="col-md-12">
                                    <label class="col-form-label" for="l0">Kullanıcı Şifre</label>
                                    <input class="form-control" required name="password"  type="password">
                                </div>
                            </div>

                            <div class="row col-md-3">

                                    <h6 class="page-title-heading mr-0 mr-r-5 col-md-12">Kullanıcı Yetkileri</h6>
                                <div class="col-md-12 mt-3 mb-2">
                                        <input type="checkbox" id="selectall" name="selectall" value="">
                                    <label for="selectall">Tümünü Seç</label>
                                </div>
                                @foreach(\Illuminate\Support\Facades\Config::get('app.permissions') as $k => $v)
                                    <div class="col-md-4 mt-2 mb-2">
                                        <input id="{{ $v }}" type="checkbox" name="permission[]" value="{{ $k }}" >
                                        <label for="{{ $v }}"> {{ $v }}</label><br>
                                    </div>
                                @endforeach

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
        $(document).ready(function() {
            $('#selectall').click(function(event) {  //on click
                if(this.checked) { // check select status
                    $(":checkbox").attr("checked", true);
                }else{
                    $(":checkbox").attr("checked", false);
                }
            });

        });
    </script>
@endsection
