@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" type="text/css">
@endsection
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix d-print-none">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Fiş Listesi</h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex d-print-none">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Fiş</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <a href="{{ route('fis.create',['type'=>FATURA_GELIR]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Gelir Fişi Ekle</a>
                <a href="{{ route('fis.create',['type'=>FATURA_GIDER]) }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-10 pd-lr-10 mr-l-0-rtl mr-r-10-rtl hidden-xs hidden-sm ripple">Gider Fişi Ekle</a>
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
                <div class="rounded widget-bg">
                    <div class=" widget-heading clearfix">
                        <h5 >Fiş Listesi</h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table style="display: flex; justify-content: end">
                            <tbody><tr>
                                <td><label for="min">Şu tarihten:</label></td>
                                <td><input style="border-radius: 5px; border: 1px solid #0dace3;"placeholder=" Bir gün öncesini seçin" type="text" id="min" name="min"></td>
                            </tr>
                            <tr>
                                <td><label for="max">Şu tarihe:</label></td>
                                <td><input style="border-radius: 5px; border: 1px solid #0dace3;" type="text" id="max" name="max"></td>
                            </tr>
                            </tbody></table>
                        <table id="example" class="table table-striped">
                            <thead class="">
                            <tr>
                                <th>Fiş No</th>
                                <th>Müşteri</th>
                                <th>Fiş Tipi</th>
                                <th>Fiş Tarihi</th>
                                <th>Tarih Farkı</th>
                                <th>Toplam Tutar</th>
                                <th>Kalan Tutar</th>
                                <th>Gelir</th>
                                <th>Gider</th>
                                <th>Tarih</th>
                                <th class="d-print-none">F. Detayı</th>
                                <th class="d-print-none">Düzenle</th>
                                <th class="d-print-none">Sil</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                            <tfoot>
                            <tr>
                                <th style=" color: #039f03"></th>
                                <th style=" color: #c51919"></th>
                                <th></th>
                                <th></th>
                                <th style="color: darkblue; text-align:right">Net Toplam:</th>
                                <th style=" text-align:left; color: darkblue"></th>
                                <th style=" text-align:left; color: darkblue"></th>

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
                var date = new Date( data[9] );

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
                lengthMenu: [[-1, 100, 25], ["Hepsi", 100, 25]],
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
                            $(cell).html('<input style="border-radius: 5px; border: 1px solid #0dace3;" type="text" class="search' + colIdx +'" placeholder=" ' + title + '" />');

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

                    toplamGelir = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    toplamGider = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 0 ).footer() ).html(
                       "Gelir: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( toplamGelir ) + ' TL'
                    );
                    $( api.column( 1 ).footer() ).html(
                        "Gider: " + $.fn.dataTable.render.number( ',', '.', 2 ).display( toplamGider ) + ' TL'
                    );

                    $( api.column( 5 ).footer() ).html(
                        $.fn.dataTable.render.number( ',', '.', 2 ).display( toplamGelir - toplamGider ) + ' TL'
                    );


                },


                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        className: 'btn btn-success btn-sm',
                        title: "Fiş Listesi",
                        footer: true,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 5, 6 ]
                        }

                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-info btn-sm',
                        title: "Fiş Listesi",
                        footer: true,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 5, 6 ]
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
                            columns: [ 0, 1, 2, 3, 5, 6 ]
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
                    url: '{{route('fis.data')}}',
                    data: function (d) {
                        d.startDate = $('#datepicker_from').val();
                        d.endDate = $('#datepicker_to').val();
                    }
                },
                columns: [
                    { data: 'faturaNo', name: 'faturaNo'},
                    { data: 'musteri', name: 'musteri'},
                    { data: 'faturaTipi',name:'faturaTipi'},
                    { data: 'formatTarih',name:'formatTarih'},
                    { data: 'created',name:'created'},
                    { data: 'toplamTutar',name:'toplamTutar', render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'kalanTutar',name:'kalanTutar'},
                    { data: 'gelir',name:'gelir', visible:false, render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'gider',name:'gider', visible:false, render: $.fn.dataTable.render.number( ',', '.', 2 )},
                    { data: 'tarih',name:'tarih', visible: false},
                    { data: 'detay', name: 'detay', orderable: false, searchable: false },
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'delete', name: 'delete', orderable: false, searchable: false }
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
            var id = $(this).data('id');
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
