@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Fatura</h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Fatura</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">Yeni Gider Faturası Ekle</a>
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


                        <form action="{{ route('fatura.store',['type'=>1]) }}" method="POST" enctype="multipart/form-data">
                            @csrf



                            <div class="form-group row firma--area">
                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Fatura No</label>
                                    <input class="form-control" id="faturaNo"  name="faturaNo" type="text">
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class="col-form-label" for="l0">Müşteri Seçiniz</label>
                                    <select name="musteriId" class="m-b-10 form-control" data-placeholder="Müşteri Seçiniz" data-toggle="select2">
                                        <option value="">Müşteri Seçiniz</option>
                                        @foreach(\App\Models\Musteriler::all() as $k => $v)
                                            <option value="{{$v['id']}}"> {{ \App\Models\Musteriler::getPublicName($v['id']) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 px-3">
                                    <label class=" col-form-label" for="l0">Fatura Tarihi</label>
                                    <input class="form-control" required id="faturaTarih" name="faturaTarih" value="{{ date("Y-m-d") }}" type="date">
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="faturaData" class="table">
                                        <thead>
                                        <tr>
                                            <th>Kalem</th>
                                            <th>Adet</th>
                                            <th>Tutar</th>
                                            <th>Toplam Tutar</th>
                                            <th>Kdv</th>
                                            <th>Kdv Toplam</th>
                                            <th>Genel Toplam</th>
                                            <th>Açıklama</th>
                                            <th>Kaldır</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <button type="button" id="addRowBtn" class="btn btn-primary btn-rounded">+</button>
                            <div class="row">
                                <div class="col-md-12 m-3">
                                    <table class="table">
                                        <tr>
                                            <td align="left">Ara Toplam:</td>
                                            <td align="right" class="ara_toplam">0.00</td>
                                        </tr>
                                        <tr>
                                            <td align="left">Kdv Toplam:</td>
                                            <td align="right" class="kdv_toplam">0.00</td>
                                        </tr>
                                        <tr>
                                            <td align="left">Genel Toplam:</td>
                                            <td align="right" class="genel_toplam">0.00</td>
                                        </tr>
                                    </table>
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

    <script>


        $("#kaydet").click(function (){
            var faturaNo = $("#faturaNo").val();
            var random = Math.floor(Math.random() * 9000);
            var tarihNo = $("#faturaTarih").val();
            var year= tarihNo.slice(0,4);
            var month = tarihNo.slice(5,7);
            var day = tarihNo.slice(8,10);
            if(faturaNo == ""){
                var sonuc = day + month + year + random;
                $("#faturaNo").val(sonuc);
            }

        });
        $("#addRowBtn").click(function (){




            var i = $(".islem_field").length;
            var newRow =
                '<tr class="islem_field">'+
                '<td><select class="form-control kalem" name="islem['+i+'][kalemId]">'+
                '<option value="0">Kalem Seçiniz</option>';
            @foreach(\App\Models\Kalem::getList(1) as $key => $value)
                newRow+='<option data-k="{{ $value['kdv'] }}" value="{{ $value['id'] }}"> {{ $value['ad'] }}</option>';
            @endforeach
                newRow+='</select></td>'+
                '<td><input type="text" class="form-control" id="adet" name="islem['+i+'][adet]"></td>'+
                '<td><input type="text" class="form-control" id="tutar" name="islem['+i+'][tutar]"></td>'+
                '<td><input type="text" class="form-control" id="toplam_tutar" name="islem['+i+'][toplam_tutar]"></td>'+
                '<td><input type="text" class="form-control" id="kdv" name="islem['+i+'][kdv]"></td>'+
                '<td><input type="text" class="form-control" id="kdv_toplam" name="islem['+i+'][kdv_toplam]"></td>'+
                '<td><input type="text" class="form-control" id="genel_toplam" name="islem['+i+'][genel_toplam]"></td>'+
                '<td><input type="text" class="form-control" id="text" name="islem['+i+'][text]"></td>'+
                '<td><button id="removeButton" type="button" class="btn btn-danger">X</button></td>'+
                '</tr>';
            $("#faturaData").append(newRow);
            i++;

        });


        $("body").on("change",".kalem", function (){
            var kdv = $(this).find(":selected").data("k");
            $(this).closest(".islem_field").find("#kdv").val(kdv);
        })

        $("body").on("click","#removeButton",function () {
            $(this).closest(".islem_field").remove();
            calc();
        });

        $("body").on("change","#faturaData input", function (){
            var $this = $(this);
            if($this.is("#tutar,#adet, #toplam_tutar, #genel_tutar, #kdv"))
            {
                var adet = $this.closest("tr").find("#adet").val();
                var tutar = $this.closest("tr").find("#tutar").val();
                var kdv = $this.closest("tr").find("#kdv").val();
                var toplam_tutar;
                var genel_tutar;
                var kdv_tutar;

                if(adet =="" && tutar==""){
                    toplam_tutar = $this.closest("tr").find("#toplam_tutar").val();
                    if(toplam_tutar=="") {
                        genel_tutar = parseFloat($this.closest("tr").find("#genel_toplam").val());
                        kdv_tutar = genel_tutar/(1+kdv/100);
                        toplam_tutar = genel_tutar - kdv-tutar;
                    }
                    else {
                        toplam_tutar = parseFloat($this.closest("tr").find("#toplam_tutar").val());
                        kdv_tutar = toplam_tutar*kdv/100;
                        genel_tutar = kdv_tutar + toplam_tutar;
                    }
                }

                else{
                    toplam_tutar = adet*tutar;
                    kdv_tutar = toplam_tutar*kdv/100;
                    genel_tutar = toplam_tutar + kdv_tutar;
                }

                kdv_tutar = kdv_tutar.toFixed(2);
                toplam_tutar = toplam_tutar.toFixed(2);
                genel_tutar = genel_tutar.toFixed(2);
                $this.closest("tr").find("#toplam_tutar").val(toplam_tutar);
                $this.closest("tr").find("#kdv_toplam").val(kdv_tutar);
                $this.closest("tr").find("#genel_toplam").val(genel_tutar);
            }
            calc();
        });

        function calc() {
            var kdv_toplam = 0;
            var ara_toplam = 0;
            var genel_toplam = 0;

            $("[id=kdv_toplam]").each(function (){
                kdv_toplam = parseFloat(kdv_toplam) + parseFloat($(this).val());
            });
            $("[id=toplam_tutar]").each(function (){
                ara_toplam = parseFloat(ara_toplam) + parseFloat($(this).val());
            });
            $("[id=genel_toplam]").each(function (){
                genel_toplam = parseFloat(genel_toplam) + parseFloat($(this).val());
            });

            $(".kdv_toplam").html(kdv_toplam);
            $(".ara_toplam").html(ara_toplam);
            $(".genel_toplam").html(genel_toplam);
        }

    </script>
@endsection
