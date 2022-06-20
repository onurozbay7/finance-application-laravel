
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/demo/favicon.png')}}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Teksöz Finans</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600|Roboto:400" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/material-icons/material-icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/mono-social-icons/monosocialiconsfont.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/feather-icons/feather.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body class="body-bg-full profile-page">
<div id="wrapper" class="wrapper">
    <div class="row container-min-full-height">
        <div class="col-lg-8 p-3 login-left">
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding-bottom: 30px">
            <img src="{{ asset('assets/demo/teksoz-logo.png') }}" alt=""><p style="margin-left: 30px;">Finans Uygulaması</p>
            </div>
            <div class="w-50">

                <h2 class="mb-4 text-center">Hoşgeldiniz</h2>
                <form method="POST" action="{{ route('login') }}" class="text-center">
                    @csrf
                    <div class="form-group">
                        <label class="text-muted" for="example-email">Email</label>
                        <input type="email" placeholder="example@gmail.com" class="form-control form-control-line" name="email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="example-password">Şifre</label>
                        <input type="password" placeholder="password" class="form-control form-control-line" name="password">
                    </div>


                    <!-- /.form-group -->
                    <div class="form-group mr-b-20">
                        <button class="btn btn-block btn-rounded btn-md btn-color-scheme text-uppercase fw-600 ripple" type="submit">Giriş Yap</button>
                    </div>
                </form>
                <!-- /form -->

            </div>
            <!-- /.w-75 -->
        </div>
        <div class="col-lg-4 login-right d-lg-flex d-none pos-fixed pos-right text-inverse container-min-full-height" style=" background-image: url({{ asset('assets/demo/background.jpg') }})">
            <div class="login-content px-3 w-75 text-center">
                <h2 class="mb-4 text-center fw-300">Kayıt olmadınız mı?</h2>
                <p class="heading-font-family fw-300 letter-spacing-minus">Lütfen yetkili adminden üyelik isteyiniz.</p>


            </div>
            <!-- /.login-content -->
        </div>
        <!-- /.login-right -->
    </div>
    <!-- /.row -->
</div>
<!-- /.wrapper -->
<!-- Scripts -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('assets/js/material-design.js')}}"></script>
</body>

</html>
