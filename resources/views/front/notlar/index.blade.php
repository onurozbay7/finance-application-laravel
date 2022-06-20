@extends('layouts.app')
@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css" type="text/css">
@endsection
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Not Listesi</h6>

        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Notlar</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center">
                <a href="{{ route('notlar.create') }}" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple">Not Ekle</a>
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
                        <h5>Not Listesi</h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <table id="example" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Kullanıcı</th>
                                <th>Not</th>
                                <th>Tarih</th>
                                <th>Ayrıntı</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
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

                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"
                },
                processing: true,
                serverSide: false,
                ajax: {
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    url: '{{route('notlar.data')}}',
                    data: function (d) {
                        d.startDate = $('#datepicker_from').val();
                        d.endDate = $('#datepicker_to').val();
                    }
                },
                columns: [
                    { data: 'userName', name: 'userName'},
                    { data: 'baslik',name:'baslik'},
                    { data: 'tarih',name:'tarih'},
                    { data: 'ayrinti',name:'ayrinti'},
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

        $(document).on('click', '.ayrinti', function (e) {
            var kullanici = $(this).attr("data-userName");
            var baslik = $(this).attr("data-baslik");
            var icerik = $(this).attr("data-icerik");
            var tarih = $(this).attr("data-tarih");

            var icerikPre = '<pre style="text-align: left">' + icerik + '</pre>';

            var yazdirma = '<h6 class="baslik">' + baslik + '</h6>' + '<pre class="icerik">' + icerik + '</pre>' + '<span class="kullanici">Not Sahibi: '+ kullanici + '</span>' + '<span class="tarih">'+ tarih + '</span>' +
                '<style> @media print { .baslik { display: flex; font-size: 32px; justify-content: center; } .icerik { font-size: 20px; } .kullanici { display: flex; margin-top: 100px; justify-content: end; } .tarih{ display: flex; margin-top: 10px; justify-content: end; } } </style>';


            swal.fire({
                title: baslik,
                html: icerikPre,
                width: '800px',
                icon: 'info',
                showCancelButton: true,
                cancelButtonText: 'Tamam',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yazdır',


            }).then((result) => {
                if (result.isConfirmed) {
                    var newWin=window.open('','Print-Window');

                    newWin.document.open();

                    newWin.document.write('<html><body onload="window.print()">'+yazdirma+'</body></html>');

                    newWin.document.close();

                    setTimeout(function(){newWin.close();},10);
                }

            });

        });

    </script>

@endsection
