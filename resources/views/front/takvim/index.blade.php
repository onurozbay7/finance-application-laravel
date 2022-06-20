@extends('layouts.app')
@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"/>
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <style>
        .fc-event {
            height: 30px !important;
            font-size: 20px;
        }
    </style>
@endsection
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Takvim</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Takvim</li>
            </ol>

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
                        <h5>Takvim</h5>
                    </div>
                    <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                        <div id="calendar"></div>
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
    </style>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

<script>

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
        });

        var calendar = $('#calendar').fullCalendar({
            monthNames: ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'],
            monthNamesShort: ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'],
            dayNames: ['Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi'],
            dayNamesShort: ['Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi'],
            editable:true,
            buttonText: {
                today:    'Bugün',
                month:    'Ay',
                week:     'Hafta',
                day:      'Gün',
                list:     'Liste',
                listMonth: 'Aylık Liste',
                listYear: 'Yıllık Liste',
                listWeek: 'Haftalık Liste',
                listDay: 'Günlük Liste'
            },
            header:{
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            contentHeight: 700,
            events:'/takvim',
            eventColor: '#303033',
            eventTextColor: 'white',
            selectable:true,
            selectHelper: true,

            select:function(start, end, allDay)
            {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');

                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD');
                Swal.fire({
                    title: 'Yeni Plan Ekle',
                    input: 'text',
                    inputPlaceholder: "Plan Ekle",
                    showCancelButton: true,
                    confirmButtonText: 'Ekle',
                    cancelButtonText: 'İptal',
                    showLoaderOnConfirm: true,
                }).then((result) => {

                    if (result.isConfirmed) {

                            $.ajax({
                                url:"/takvim/action",
                                type:"POST",
                                data:{
                                    title: result.value,
                                    start: start,
                                    end: end,
                                    type: 'add'
                                },
                                success:function(data)
                                {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Yeni Plan Eklendi',
                                        showConfirmButton: false,
                                        timer: 800
                                    });
                                    calendar.fullCalendar('refetchEvents');

                                }
                            });

                    }
                });


            },
            editable:true,
            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/takvim/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Plan Güncellendi!',
                            showConfirmButton: false,
                            timer: 800
                        });
                        calendar.fullCalendar('refetchEvents');
                    }
                })
            },
            eventDrop: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/takvim/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Plan Güncellendi!',
                            showConfirmButton: false,
                            timer: 800
                        });
                        calendar.fullCalendar('refetchEvents');

                    }
                })
            },

            eventClick:function(event)
            {

                var id = event.id;

                swal.fire({
                    title: 'Emin misiniz?',
                    text: "'"+event.title + "'" +" planı silinecek.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, Sil!',
                    cancelButtonText: 'İptal!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"/takvim/action",
                            type:"POST",
                            data:{
                                id:id,
                                type:"delete"
                            },
                            success:function(response)
                            {
                                Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Plan Silindi!',
                                showConfirmButton: false,
                                timer: 800
                            });
                                calendar.fullCalendar('refetchEvents');

                            }
                        })
                    }

                });




            }
        });

    });



</script>
@endsection

