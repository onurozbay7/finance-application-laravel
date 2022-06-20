@extends('layouts.app')
@section('header')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css" type="text/css">

@endsection
@section('content')
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Müşteri Listesi</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Müşteriler</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center d-print-none">
                <a href="{{ route('musteriler.create') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Müşteri Ekle</a>
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
                        <h5 class="col-md-11">Müşteri Listesi</h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table id="example" class="row-border table table-striped">
                            <thead>
                            <tr>
                                <th>Ad</th>
                                <th>M. Tipi</th>
                                <th>Telefon</th>
                                <th>E mail</th>
                                <th>Adres</th>
                                <th>Durum</th>
                                <th class="d-print-none">Cari</th>
                                <th class="d-print-none">Düzenle</th>
                                <th class="d-print-none">Sil</th>
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
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>



    <script>






        $(document).ready(function() {




            $('#example thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');



            let table =  $('#example').DataTable( {
                lengthMenu: [[-1, 100, 25], ["Hepsi", 100, 25]],

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

                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        className: 'btn btn-success btn-sm',
                        title: "Müşteri Listesi",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }

                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-info btn-sm',
                        title: "Müşteri Listesi",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        },

                    },
                    {
                        extend: 'print',
                        text: 'YAZDIR',
                        className: 'btn btn-dark btn-sm',
                        title: "",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
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
                    url: '{{route('musteriler.data')}}',
                    data: function (d) {
                        d.startDate = $('#datepicker_from').val();
                        d.endDate = $('#datepicker_to').val();
                    }
                },
                columns: [
                    { data: 'publicname', name: 'publicname'},
                    {data: 'musteriTipi', name: 'musteriTipi'},
                    {data: 'telefon', name: 'telefon'},
                    {data: 'email', name: 'email'},
                    {data: 'adres', name: 'adres'},
                    {data: 'bakiye', name: 'bakiye'},
                    { data: 'cari', name: 'cari', orderable: false, searchable: false },
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'delete', name: 'delete', orderable: false, searchable: false }

                ]
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





            $('#example_filter').prop('class','dataTables_filter d-print-none');

            $('.dt-buttons').prop('class','dt-buttons d-print-none');

            $('#example_length').prop('class','dataTables_length d-print-none');

            $('.dataTables_paginate').prop('class','dataTables_paginate paging_simple_numbers d-print-none');






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
