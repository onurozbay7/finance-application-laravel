@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" type="text/css">
@endsection
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">İşlem Listesi</h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">İşlem</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <a href="{{ route('islem.create',['type'=>ISLEM_TAHSILAT]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Tahsilat Al</a>
                <a href="{{ route('islem.create',['type'=>ISLEM_ODEME]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-10 pd-lr-10 mr-l-0-rtl mr-r-10-rtl hidden-xs hidden-sm ripple">Ödeme Yap</a>
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
                    <div class="widget-heading clearfix">
                        <h5>İşlem Listesi</h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table style="display: flex; justify-content: end">
                            <tbody><tr>
                                <td><label for="min">Şu tarihten:</label></td>
                                <td><input style="border-radius: 5px; border: 1px solid #0dace3;" type="text" placeholder=" Bir gün öncesini seçin" id="min" name="min"></td>
                            </tr>
                            <tr>
                                <td><label for="max">Şu tarihe:</label></td>
                                <td><input style="border-radius: 5px; border: 1px solid #0dace3;" type="text" id="max" name="max"></td>
                            </tr>
                            </tbody></table>
                        <table id="example" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Fiş No</th>
                                <th>Müşteri</th>
                                <th>İşlem Tipi</th>
                                <th>İşlem Tarihi</th>
                                <th>Tarih Farkı</th>
                                <th>Tutar</th>
                                <th>Hesap</th>
                                <th>Açıklama</th>
                                <th>Tahsilat</th>
                                <th>Odeme</th>
                                <th>Tarih</th>
                                <th>Ödeme Şekli</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                            <tfoot>
                            <tr>
                                <th style=" color: #039f03"></th>
                                <th style=" color: #c51919"></th>
                                <th></th>
                                <th style="color: darkblue; text-align:right">Net Toplam:</th>
                                <th></th>
                                <th style=" text-align:left; color: darkblue"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                            </tfoot>

                        </table>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->
    <style> thead input {
            width: 100%;
        }
        .dataTables_filter {
            display: none;
        }
    </style>
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
                var date = new Date( data[8] );

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

        $.fn.dataTable.moment( 'DD/MM/YYYY' );
        $(document).ready(function() {

            minDate = new DateTime($('#min'), {
                format: 'DD/MM/YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'DD/MM/YYYY'
            });


            $('#example thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');

            let table =  $('#example').DataTable( {
                lengthMenu: [[-1, 100, 25 , 10], ["Hepsi", 100, 25, 10]],
                "order": [[ 3, "desc" ]],

                orderCellsTop: true,
                initComplete: function () {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input style="border-radius: 5px; border: 1px solid #0dace3;" type="text" placeholder=" ' + title + '" />');

                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('keyup change', function (e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value.replace(/i/g, 'İ').replace(/ı/g, 'I') + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },

                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over this page
                    toplamTahsilat = api
                        .column(8, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    toplamOdeme = api
                        .column(9, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    tahsilatNakit = api
                        .column(14, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    tahsilatBanka = api
                        .column(15, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    tahsilatKredi = api
                        .column(16, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    tahsilatCek = api
                        .column(17, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    odemeNakit = api
                        .column(18, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    odemeBanka = api
                        .column(19, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    odemeKredi = api
                        .column(20, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    odemeCek = api
                        .column(21, { page: 'current'})
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 0 ).footer() ).html(
                       "Tahsilat:  " + $.fn.dataTable.render.number( ',', '.', 2 ).display( toplamTahsilat ) + ' TL' + '<br>' +
                        "Nakit: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( tahsilatNakit ) + ' TL' + '<br>' +
                        "Banka: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( tahsilatBanka ) + ' TL' + '<br>' +
                        "Kredi: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( tahsilatKredi ) + ' TL ' + '<br>' +
                        "Cek: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( tahsilatCek ) + ' TL'

                    );
                    $( api.column( 1 ).footer() ).html(
                        "Ödeme: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( toplamOdeme ) + ' TL' + '<br>' +
                        "Nakit: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( odemeNakit ) + ' TL' + '<br>' +
                        "Banka: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( odemeBanka ) + ' TL' + '<br>' +
                        "Kredi: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( odemeKredi ) + ' TL ' + '<br>' +
                        "Cek: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( odemeCek ) + ' TL'
                    );
                    $( api.column( 5 ).footer() ).html(
                        $.fn.dataTable.render.number( ',', '.', 2 ).display( toplamTahsilat - toplamOdeme ) + ' TL',
                    );



                },


                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        className: 'btn btn-success btn-sm',
                        title: "İşlem Listesi",
                        footer: true,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 5, 9 ]
                        }

                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-info btn-sm',
                        title: "İşlem Listesi",
                        footer: true,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 5, 9 ]
                        },
                        customize: function(doc) {
                            doc.styles.tableHeader.alignment = 'left';
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }

                    },
                    {
                        extend: 'print',
                        text: 'YAZDIR',
                        className: 'btn btn-dark btn-sm',
                        title: "",
                        footer: true,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 5, 9 ]
                        }

                    },
                ],

                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
                },
                processing: true,
                serverSide: false,
                ajax: {
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    url: '{{route('islem.data')}}',
                    data: function (d) {
                        d.startDate = $('#datepicker_from').val();
                        d.endDate = $('#datepicker_to').val();
                    }
                },
                columns: [
                    { data: 'faturaNo', name: 'faturaNo'},
                    { data: 'musteri', name: 'musteri'},
                    { data: 'tip',name:'tip'},
                    { data: 'formatTarih',name:'formatTarih'},
                    { data: 'created',name:'created'},
                    { data: 'fiyat',name:'fiyat', render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'hesap',name:'hesap'},
                    { data: 'aciklama',name:'aciklama'},
                    { data: 'tahsilat',name:'tahsilat', visible:false, render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'odeme',name:'odeme', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'tarih',name:'tarih', visible: false},
                    { data: 'odemeSekli',name:'odemeSekli'},
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'delete', name: 'delete', orderable: false, searchable: false },
                    { data: 'tahsilatNakit',name:'tahsilatNakit', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'tahsilatBanka',name:'tahsilatBanka', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'tahsilatKredi',name:'tahsilatKredi', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'tahsilatCek',name:'tahsilatCek', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'odemeNakit',name:'odemeNakit', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'odemeBanka',name:'odemeBanka', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'odemeKredi',name:'odemeKredi', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'odemeCek',name:'odemeCek', visible:false ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
                ]
            });

            $('#min, #max').on('change', function () {
                table.draw();
            });
            jQuery.fn.DataTable.ext.type.search.string = function(data) {
                var testd = !data ?
                    '' :
                    typeof data === 'string' ?
                        data
                            .replace(/i/g, 'İ')
                            .replace(/ı/g, 'I') :
                        data;
                return testd;
            };
            $('#example_filter input').keyup(function() {
                table
                    .search(
                        jQuery.fn.DataTable.ext.type.search.string(this.value)
                    )
                    .draw();
            });


        });

        $(document).on('click', '.deleteButton', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
            swal.fire({
                title: 'Emin misiniz?',
                text: "İlgili veriler silinecek.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, Sil!',
                cancelButtonText: 'İptal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }

            });

        });


    </script>


@endsection
