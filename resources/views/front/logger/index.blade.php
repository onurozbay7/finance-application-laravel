@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix d-print-none">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Hareket Listesi</h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex d-print-none">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Hareketler</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <span class=" btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Kullanıcı Hareketleri</span>
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
                        <h5 class="">Hareket Listesi</h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table id="example" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Kullanıcı</th>
                                <th>İşlem</th>
                                <th>Açıklama</th>
                                <th>Tarih</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

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

    <style>
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
    <script src="//cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>


    <script>


        $('#example thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#example thead');
        $(document).ready(function() {

            $.fn.dataTable.moment( 'DD/MM/YYYY' );



            let table =  $('#example').DataTable( {
                lengthMenu: [[-1, 100, 25], ["Hepsi", 100, 25]],
                "order": [[ 3, "desc" ]],

                orderCellsTop: true,
                fixedHeader: true,
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

                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        className: 'btn btn-success btn-sm',
                        title: "Hareket Listesi",

                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-info btn-sm',
                        title: "Hareket Listesi",
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
                    url: '{{route('logger.data')}}',
                    data: function (d) {
                        d.startDate = $('#datepicker_from').val();
                        d.endDate = $('#datepicker_to').val();
                    }
                },
                columns: [
                    { data: 'userName', name: 'userName'},
                    { data: 'islem', name: 'islem'},
                    { data: 'text',name:'text'},
                    { data: 'tarih',name:'tarih'},
                ]
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

            $("body").on("click","#yazdir",function () {
                window.print();
            });


            $('#example_filter').prop('class','dataTables_filter d-print-none');

            $('.dt-buttons').prop('class','dt-buttons d-print-none');

            $('#example_length').prop('class','dataTables_length d-print-none');

            $('.dataTables_paginate').prop('class','dataTables_paginate paging_simple_numbers d-print-none');

            $('#example_info').prop('class','dataTables_info d-print-none');
        });



    </script>


@endsection
