<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Task Management - Take Home Project</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!--<script type="text/javascript" src="assets/js/fontawesome.min.js"></script>-->
    <script type="text/javascript" src="assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

</head>

<body>
    <!-- HEADER SECTION -->
    <div id="page-wrapper">
        <img class="img-responsive" src="{{ URL('assets/img/header.jpg') }}" width="100%" alt="Header Image">
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                @if (Route::has('login'))
                    @auth
                        <li><b><a href="{{ URL('/home') }}"><i class="fa fa-home fa-2x"></i>Home</a></b></li>
                        <li><b><a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket fa-2x"></i>Logout</a></b>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li><b><a href="{{ route('login') }}"><i
                                        class="fa-solid fa-right-to-bracket fa-2x"></i>Login</a></b></li>
                    @endauth
                @endif
            </ol>
            <div class="alert alert-success alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <font size='3'><b>PT.INFORMATIKA MEDIA PRATAMA</b></font>
                @if (session('user_email'))
                    <p>Welcome, {{ session('user_email') }}!</p>
                    <!--<p>Token: {{ session('api_token') }}!</p>-->
                @endif
            </div>
        </div>
    </div><!-- /.row -->
    <!-- ######END HEADER######## -->


    <main>
        @yield('content')

        <!-- FOOTER SECTION -->
        <br />
        <div align="center" class="alert alert-success alert-dismissable"><b>Copyright &#169;
                <script type='text/javascript'>
                    var creditsyear = new Date();
                    document.write(creditsyear.getFullYear());
                </script>
            </b> | All Right Reserved.
            <br><b class="bluetext">By HIDAYAT WS - Fullstack Laravel</b><br>
            <font face="consolas">Version 1.0.0</font>
        </div>
        <br><br>
        </div>
        <!-- ######END FOOTER######## -->
    </main>

</body>

</html>
