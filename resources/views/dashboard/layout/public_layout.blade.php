<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jobs in Qatar</title>
    <meta name="description" content="company is a free job board template">
    <meta name="author" content="">
    <meta name="keyword" content="html, css, bootstrap, job-board">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('theme/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/newstyle.css') }}">


    <!-- bootstrap start -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <!-- bootstrap end -->

    <!-- countrydiallist -->
    <link rel="stylesheet" href="/js/countrydiallist/css/intlTelInput.css">

    <!-- tagsinput -->
    <link rel="stylesheet" href="/js/bootstrap-tagsinput/bootstrap-tagsinput.css">

    <!-- richtexteditor     -->
    <link rel="stylesheet" href="/js/jquery-richtext/richtext.min.css">


    <link rel="stylesheet" href="{{ asset('public/responsive.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>


    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="{{ asset('theme/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/newstyle.css') }}">
    <style>

        .remove
        {
            border: 1px solid #7889ff;
            color: #7889ff;

        }
        .btn-profile {

            font-size:10px !important;
        }
        .btn
        {
            font-size:12px !important;
        }


        @media (min-width: 768px) {
            .aconntmenu
            {
                margin-left:-7%;
            }
            .container
            {

            }
            .accondlondon
            {
                margin: -5% 0 15px 0;
                color:gray;
            }
            .leftcont
            {
                color:gray;
            }
            .current
            {
                color:#7889ff;

            }

            .current  .col-md-10
            {
                font-weight:bold;
                color:black;
            }
            .content
            {
                margin-left:-7%;border-right: thin solid lightgray;
            }

            .row {
                margin-bottom: 0px;
            }
        }

        }

        @yeild('style');
    </style>
    <style>

        /*Don't forget to add Font Awesome CSS : "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"*/
        input[type="text"] {
            width: 100%;
            border-radius: 4px;
            margin: 8px 0;
            outline: none;
            padding: 8px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        input[type="text"]:focus {
            border-color: dodgerBlue;
            box-shadow: 0 0 8px 0 dodgerBlue;
        }

        .inputWithIcon input[type="text"] {
            padding-left: 40px;
        }

        .inputWithIcon {
            position: relative;
        }

        .inputWithIcon i {
            position: absolute;
            float:right;
            right: 0;
            top: 4px;
            padding: 9px 1px;
            color: #fff;
            transition: 0.3s;
        }

        .inputWithIcon input[type="text"]:focus + i {
            color: dodgerBlue;
        }

        .inputWithIcon.inputIconBg i {
            background-color: #aaa;
            color: #fff;
            padding: 9px 4px;
            border-radius: 4px 0 0 4px;
        }

        .inputWithIcon.inputIconBg input[type="text"]:focus + i {
            color: #fff;
            background-color: dodgerBlue;
        }

        header{

            width:100%;
            z-index: 1000000;
        }

        #srch::before
        {
            font-family: 'FontAwesome';
            color:red;
            position: relative;
            left: -5px;
            content: "\f007";
        }

        .drobdown_button{
            font-size:16px !important;
        }

        #responsive li:hover, #navigation .float-right li:hover{
            border-bottom: 4px solid #7889FF;
            height: 52px;
        }

        .dropdown{
            float:right;
            font-size:20px;

        }

        .drobdown_button{
            background:none !important;
            padding: 6px 18px;
        }

        .btn.focus, .btn:focus, .btn:hover{
            color:#ffF !important;
        }

        .left_menu{
            color: #FFF;
            font-size: 30px;
            position: absolute;
            top: 22px;
            left: 0;
        }

        .left_menu a:link, .left_menu a:visited{
            color:#FFF;
        }

    </style>

    @yield('style')
</head>

<body>

    <!-- Body content -->
    <header>
        <div class="container mainheader">
        <div class="sixteen columns mainheader">


            <!-- Logo -->

            <div class="col-md-6">
                <div class="left_menu"><a href="#"><i class="fa fa-reorder"></i></a></div>

                <div id="logo">
                    <li><a href="#"><img class="Joblogo"  src="{{url('/img/wtc_logo.png')}}"></a></li>
                </div>
            </div>
            <!-- Menu -->
            <div class="col-md-6 text-right">
                <nav class="menu">
                    <ul id="responsive">
                        <div class="dropdown">
                            <button class="drobdown_button btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin &nbsp; &nbsp; <i class="fa fa-caret-down" aria-hidden="true"></i>

                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="{{ url('/inspector/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"> Signout</a>
                                <a href="{{url('/inspector/settings')}}">Settings</a>

                            </div>
                        </div>

                        <div class="dropdown">
                            <a class="drobdown_button btn-secondary dropdown-toggle" style="color: white" href="{{url('/inspector/contactform')}}">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                            </div>
                        </div>

                        <div class="dropdown">
                            <a class="drobdown_button btn-secondary dropdown-toggle" style="color: white" href="{{url('/inspector/notifications')}}">
                                <i class="fa fa-bell-o" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <a class="dropdown-item" href="#">Action</a>

                            </div>
                        </div>




                    </ul>
                </nav>
            </div>


            <!-- Navigation -->
            <div id="mobile-navigation">
                <a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
            </div>

        </div>




    </div>
    </header>
    <div class="page-wrap">

        <div class="main-nav" style="min-height: 681px">
            <div class="" >
                <div class="top_menu" >
                    <ul>
                        <li><a href="{{url('/inspector/dashboard')}}"><img src="{{url('/img/dashboard.png')}}" /> Dashboard</a></li>
                        <li><a href="{{url('/inspector/joblist')}}"><img src="{{url('/img/post.png')}}" /> Jobs</a></li>
                        <li><a href="{{url('/inspector/jobseekerlist')}}"><img src="{{url('/img/caditates.png')}}" /> Job Seekers</a></li>
                        <li><a href="{{url('/inspector/employerlist')}}"><img src="{{url('/img/emp.png')}}" /> Employers</a></li>
                        <li><a href="{{url('/inspector/revenue')}}"><img width="20" height="20" src="{{url('/img/surface1.png')}}" /> Revenue</a></li>
                    </ul>
                </div>
                <div class="pors"></div>
                <div class="bottom_nav top_menu">
                    <ul>
                        <li><a href="{{ url('/inspector/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><img src="/img/signout.png" /> Signout</a></li>
                    </ul>



                    <form id="logout-form" action="{{ url('/inspector/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>

        <div class="main-content">
        @yield('content')
        </div>
    </div>
    @yield('script')

    {{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> --}}
    {{-- <script>tinymce.init({ selector:'textarea' });</script> --}}
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

    var pusher = new Pusher('7fb56899b7aed2daa104', {
      cluster: 'ap3',
      forceTLS: true
    });

    $(document).ready(function() {
        var passwordReset = $(document).find('#password-reset');
        $(document).find('#employer').click(function(event) {
            //KEEP OPEN FORM
            event.stopPropagation();
            $(document).find('#dropdown-li').addClass('open');
            $(this).addClass('keep');
            $("#jobseeker").removeClass('keep');
            $(document).find('#login-nav-form').attr('action', '{!! url("employer/login")!!}');
            passwordReset.attr('href', '{!! url("employer/password/reset")!!}');
        });
        $(document).find('#jobseeker').click(function(event) {
            //KEEP OPEN FORM
            event.stopPropagation();
            $(document).find('#dropdown-li').addClass('open');
            $(this).addClass('keep');
            $("#employer").removeClass('keep');
            $(document).find('#login-nav-form').attr('action', '{!! url("jobseeker/login") !!}');
            passwordReset.attr('href', '{!! url("jobseeker/password/reset")!!}');
        });

        $(document).find('#keep-me-login').click(function(event) {
            //KEEP OPEN FORM
            event.stopPropagation();
        });


        $(document).find('#login-nav-form > .form-group').click(function(event) {
            //KEEP OPEN FORM
            event.stopPropagation();
        });

    });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- moment -->
    <script type="text/javascript" src="/js/moment/moment.min.js"></script>

    <!-- bootstrap library -->
    <!-- <script src="{{ asset('public/js/bootstrap.min.js')}}"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- bootstrap datetimepicker -->
    <script src="/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

    <!-- bootstrap tagsinput start -->
    <script src="/js/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <!-- bootstrap tagsinput end -->

    {{-- <script src="{{ asset('/js/public.js')}}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/js/js/vendor/jquery.ui.widget.js"></script>


    <script src="/js/js/jquery.iframe-transport.js"></script>
    <script src="/js/js/jquery.fileupload.js"></script>

    <!-- country dial list -->
    <script src="/js/countrydiallist/js/intlTelInput.js"></script>

    <!-- jquery rich text editor -->
    <script src="/js/jquery-richtext/jquery.richtext.min.js"></script>


    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}


    @yield('extrascript')

</body>

</html>