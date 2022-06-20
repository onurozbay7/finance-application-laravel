@extends('layouts.app')
@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" type="text/css">

    <style>

        @media print {

            #example_filter, .dt-buttons, #example_length , .dataTables_paginate {
                display: none;
            }
        }

    </style>
    <div class="row page-title clearfix">
        <div class="page-title-left ">
            <h6 class="page-title-heading mr-0 mr-r-5">Müşteri Cari Hareketleri</h6>
            <h6 class="page-title-heading d-print-block">{{ \App\Models\Musteriler::getPublicName($data[0]['id']) }}</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb d-print-none">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Müşteri Cari Hareketleri</li>
            </ol>

            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <a href="{{ route('musteriler.index') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Müşteri Listesi</a>
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
                            <div class="col-md-12" style="margin-top: 100px;"></div>
                            <div class="profile-body">
                                <figure class="profile-user-avatar thumb-md">
                                    <img src="{{ asset(\App\Models\Musteriler::getPhoto($data[0]['id'])) }}" alt="User Wall">
                                </figure>
                                <h6 class="h3 profile-user-name ">{{\App\Models\Musteriler::getPublicName($data[0]['id'])}}</h6>
                                <small class="profile-user-address">@if($data[0]['musteriTipi'] == 0) Bireysel @else Kurumsal @endif</small>

                        <div class="row">
                            <div class="col-md-12" style="margin-top: 20px; background-color: white">
                              <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@if($data[0]['musteriTipi'] == 0) Ad Soyad @else Kurum Adı @endif</th>
                                        <th>Telefon</th>
                                        <th>E mail</th>
                                        <th>Adres</th>
                                        <th>TC</th>
                                        @if($data[0]['musteriTipi'] == 1)
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Vergi Dairesi</th>
                                            <th>Vergi Numarası</th>
                                            @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $k => $v)
                                        <tr>
                                            <td> {{ \App\Models\Musteriler::getPublicName($data[0]['id']) }} </td>
                                            <td>{{ $v['telefon'] }}</td>
                                            <td>{{ $v['email'] }}</td>
                                            <td>{{ $v['adres'] }}</td>
                                            <td>{{ $v['tc'] }}</td>
                                            @if($data[0]['musteriTipi'] == 1)
                                                <td>{{ $v['ad'] }}</td>
                                                <td>{{ $v['soyad'] }}</td>
                                                <td>{{ $v['vergiDairesi'] }}</td>
                                                <td>{{ $v['vergiNumarasi'] }}</td>
                                                @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>

                                <hr class="profile-seperator">

                                <!-- /.profile-user-description -->
                                <div class="mb-5">
                                    <a href="{{ route('musteriler.edit',['id'=>$data[0]['id']]) }}" class="btn btn-outline-color-scheme btn-rounded btn-lg px-5 border-thick text-uppercase mr-2 mr-0-rtl ml-2-rtl fw-700 fs-11 heading-font-family">Müşteriyi Düzenle</a>

                                </div>
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
                <div class="widget-body clearfix">
                    <table class="d-print-none" style="display: flex; justify-content: end">
                        <tbody><tr>
                            <td><label for="min">Şu tarihten:</label></td>
                            <td><input style="border-radius: 5px; border: 1px solid #0dace3;" placeholder=" Bir gün öncesini seçin" type="text" id="min" name="min"></td>
                        </tr>
                        <tr>
                            <td><label for="max">Şu tarihe:</label></td>
                            <td><input style="border-radius: 5px; border: 1px solid #0dace3;" type="text" id="max" name="max"></td>
                        </tr>
                        </tbody></table>
                    <table id="example" class="row-border table table-striped cell-border">
                        <thead>
                        <tr>
                            <th>İşlem</th>
                            <th>Fiyat</th>
                            <th>Tarih</th>
                            <th>Tarih</th>
                        </tr>
                        </thead>
                        <body>
                        @foreach($viewData as $k => $v)
                            <tr>
                                <td>
                                    @if($v['uType'] == "fatura")
                                        @if($v['type'] == FATURA_GELIR)
                                            <a href=" {{ route('fis.detay', ['id' => $v->id]) }}">Gelir Fişi</a>
                                            <table>
                                                @foreach(\App\Models\Fatura::getFaturaIslems($v->id) as $key => $value)
                                                    <tr class="faturaIslem"><td>|| Miktar: {{ $value['miktar'] }}</td><td> Fiyat: {{ $value['fiyat'] }}</td>@if(\App\Models\Fatura::getKdv($v->id) !=0)<td> Kdv: {{ $value['kdv'] }}</td>@endif<td> Toplam: {{ $value['genelToplam'] }}</td>@if($value['text'] != null)<td> Açıklama: {{ $value['text'] }}</td>@endif</tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <a href=" {{ route('fis.detay', ['id' => $v->id]) }}">Gider Fişi</a>
                                            <table>
                                                @foreach(\App\Models\Fatura::getFaturaIslems($v->id) as $key => $value)
                                                    <tr class="faturaIslem"><td>|| Miktar: {{ $value['miktar'] }}</td><td> Fiyat: {{ $value['fiyat'] }}</td>@if(\App\Models\Fatura::getKdv($v->id) !=0)<td> Kdv: {{ $value['kdv'] }}</td>@endif<td> Toplam: {{ $value['genelToplam'] }}</td>@if($value['text'] != null)<td> Açıklama: {{ $value['text'] }}</td>@endif</tr>
                                                @endforeach
                                            </table>
                                        @endif
                                    @else
                                        @if($v['type'] == ISLEM_ODEME)
                                            Ödeme
                                        @else
                                            Tahsilat
                                        @endif
                                    @endif

                                </td>
                                <td>{{ $v['fiyat'] }}</td>
                                <td>{{ $v['tarih'] }}</td>
                                <td>{{ $v['tarih'] }}</td>
                            </tr>



                        @endforeach
                        </body>
                        <tfoot>
                        <tr>
                        <th></th>
                        @if(\App\Models\Rapor::getMusteriBakiye($data[0]['id']) < 0 )
                            <th style="color: #c51919">{{ \App\Models\Rapor::getMusteriBakiye($data[0]['id'])*-1 }} TL Borçlu</th>
                            @elseif(\App\Models\Rapor::getMusteriBakiye($data[0]['id']) == 0)
                            <th style="">Borcu/Alacağı Yok</th>
                        @else
                            <th style="color: #039f03">{{ \App\Models\Rapor::getMusteriBakiye($data[0]['id']) }} TL Alacaklı</th>
                            @endif
                        <th></th>
                        </tr>





                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('footer')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <script>

        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[3] );

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );


        $(document).ready(function() {

            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });



        let table =  $('#example').DataTable( {
            lengthMenu: [[-1, 100, 25], ["Hepsi", 100, 25]],
            info: false,
            "order": [[ 3, "desc" ]],

            columnDefs: [
                {
                    targets: 2, render: function (data) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                { targets: 3, visible:false}
            ],




            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
            },
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: 'PDF',
                    footer: true,
                    className: 'btn btn-info btn-sm',
                    title: "{{ \App\Models\Musteriler::getPublicName($data[0]['id']) }} Cari Hareketleri",
                    exportOptions: {
                        columns: [ 0, 1, 2 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'YAZDIR',
                    footer: true,
                    className: 'btn btn-dark btn-sm',
                    title: "",
                    exportOptions: {
                        columns: [ 0, 1, 2 ]
                    }
                },


            ],

        });



        $('#example_filter input').keyup(function() {
            table
                .search(
                    jQuery.fn.DataTable.ext.type.search.string(
                        this.value != ''
                            ? regexr.replace('{search}', '(((' + this.value.replace(/i/g, 'İ').replace(/ı/g, 'I') + ')))')
                            : '',
                        this.value != '',
                        this.value == ''
                    )
                )
                .draw();
        });

            $('#min, #max').on('change', function () {
                table.draw();
            });





        });


        $("body").on("click","#yazdir",function () {
            window.print();

        });

        $.fn.dataTable.moment( 'YYYY-MM-DD' );

    </script>
@endsection
