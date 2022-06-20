@extends('layouts.app')
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Müşteri Düzenle <small> {{ \App\Models\Musteriler::getPublicName($data[0]['id']) }}</small></h6>

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


                        <form action="{{ route('musteriler.update',['id'=>$data[0]['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if($data[0]['photo']!="")
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <img src="{{ asset($data[0]['photo']) }}" class="img-thumbnail" style="width: 250px;" alt="">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Müşteri Resmi</label>
                                    <input class="form-control" name="photo" type="file">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="" class="col-form-label">Müşteri Tipi</label>
                                    <div>
                                        <input type="radio" class="change-cumstomerType" @if($data[0]['musteriTipi'] == 0) checked @endif name="musteriTipi" value="0"> Bireysel
                                    </div>
                                    <div>
                                        <input type="radio" class="change-cumstomerType" @if($data[0]['musteriTipi'] == 1) checked @endif name="musteriTipi" value="1"> Kurumsal
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row firma--area" @if($data[0]['musteriTipi'] == 0) style="display: none;" @endif>
                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Firma Adı</label>
                                    <input class="form-control" name="firmaAdi" type="text" value="{{ $data[0]['firmaAdi'] }}">
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class="col-form-label" for="l0">Vergi Numarası</label>
                                    <input class="form-control" name="vergiNumarasi" type="text" value="{{ $data[0]['vergiNumarasi'] }}">
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Vergi Dairesi</label>
                                    <input class="form-control" name="vergiDairesi" type="text" value="{{ $data[0]['vergiDairesi'] }}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 px-3">
                                    <label class=" col-form-label" for="l0">Ad</label>
                                    <input class="form-control" name="ad" type="text" value="{{ $data[0]['ad'] }}">
                                </div>

                                <div class="col-md-6 px-3">
                                    <label class="col-form-label" for="l0">Soyad</label>
                                    <input class="form-control" name="soyad" type="text" value="{{ $data[0]['soyad'] }}">
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-md-6 px-3">
                                    <label class=" col-form-label" for="l0">TC</label>
                                    <input class="form-control" name="tc" type="text" value="{{ $data[0]['tc'] }}">
                                </div>

                                <div class="col-md-6 px-3">
                                    <label class="col-form-label" for="l0">Adres</label>
                                    <input class="form-control" name="adres" type="text" value="{{ $data[0]['adres'] }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 px-3">
                                    <label class=" col-form-label" for="l0">Telefon</label>
                                    <input class="form-control" name="telefon" type="text" value="{{ $data[0]['telefon'] }}">
                                </div>

                                <div class="col-md-6 px-3">
                                    <label class="col-form-label" for="l0">E mail</label>
                                    <input class="form-control" name="email" type="text" value="{{ $data[0]['email'] }}">
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
        $(".change-cumstomerType").click(function (){
            var value = $(this).val();
            if(value == 1)
            {
                $(".firma--area").show();
            }
            else {
                $(".firma--area").hide();
            }
        });
    </script>



@endsection
