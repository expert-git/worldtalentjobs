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

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">


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
    @yield('style')
</head>

<body>

    <!-- Body content -->
    <header>
        <div class="container" style="width:90%;">
            <div>
                <nav id="navigation" class="menu">

                    <div class="col-md-3" style="padding:0px;">
                        <!-- Logo -->
                        <div id="logo">
                            <a href="#"><img class="Joblogo" src="/img/wtc_logo.png"></a>
                        </div>
                    </div>

                    <div class="col-md-6" style="text-align:center">
                        <!-- Menu -->

                        @if(!Auth::guard('employer')->check())
                        <ul id="responsive" class="pull-left" style="width:100%;">
                            <li><a href="/">Home</a></li>
                            <li><a href="/findjob">Find Jobs</a></li>
                            <li><a href="/about">About</a></li>
                            <li><a href="/contactus">Contact Us</a></li>
                            <li>
                                <a href="#" style="display:inline-block;">Job Needed</a>

                                <img src="/icon-img/lamp.png"
                                    style="display:inline-block;vertical-align:top;width:30px; height:30px; margin-left: -18px;">
                            </li>
                        </ul>
                        @endif

                    </div>

                    <div class="col-md-3">
                        @if(Auth::guard('jobseeker')->check())
                        <div class="inputWithIcon" style="margin-left: 0px;width: 80%;margin-top: 15px;">
                            <form class="searchForm" action="/search">
                                <input type="text" name="search" placeholder="type tag here" style="position: relative;">
                                <button class=" btn-link" style="height:100%;">
                                    <i class="fas fa-search" style="right: 10px;"></i>
                                </button>
                            </form>
                        </div>
                        <ul class="float-right">
                            <li class="ml-0">
                                <div class="dropdown show">
                                    <a class="btn2 btn-secondary dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-user-tie"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu2" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="/jobseeker/managejobs/0">Jobs</a>
                                        <a class="dropdown-item" href="/jobseeker/myresume">My resume</a>
                                        <a class="dropdown-item" href="/jobseeker/getProfile">Settings</a>
                                        <a class="dropdown-item" href="/jobseeker/message">Messages</a>
                                        <a class="dropdown-item" href="/jobseeker/notifications">Notifcations</a>
                                        <a class="dropdown-item" href="/jobseeker/editprofile">Edit Profile</a>
                                        <form id="logout-form" action="{{ url('/jobseeker/logout')  }}" method="POST">
                                            {{ csrf_field() }}
                                            <button class="dropdown-item dropdown-item1">Log out</button>

                                        </form>
                                         
                                    </div>
                                </div>


                            </li>
                        </ul>
                        @elseif(Auth::guard('employer')->check())
                        <ul class="float-right">
                            <li>
                                <div class="dropdown">
                                    <a href="/employer/message">
                                        <button class="drobdown_button btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton1">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        </button>
                                    </a>

                                </div>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a href="/employer/notifications">
                                        <button class="drobdown_button btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2">
                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                        </button>
                                    </a>

                                </div>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <button class="drobdown_button btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Admin &nbsp; &nbsp; <i class="fa fa-caret-down" aria-hidden="true"></i>

                                    </button>
                                    <div style="background-color:transparent" class="dropdown-menu"
                                        aria-labelledby="dropdownMenuButton">
                                        <form id="logout-form" action="{{ url('/employer/logout')  }}" method="POST">
                                            {{ csrf_field() }}
                                            <button class="dropdown-item dropdown-item1">LOGOUT</button>

                                        </form>
                                         

                                    </div>
                                </div>
                            </li>

                            </li>
                        </ul>
                        @else
                        <ul class="float-right ">
                            <li><a href="/jobseeker/login">Sign In</a></li>
                            <li><a href="/jobseeker/register">Register</a></li>
                            <li><a href="/employer">Employer?</a></li>
                        </ul>
                        @endif
                        <!-- Navigation -->
                        <div id="mobile-navigation">
                            <a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>


    @yield('content')
    @include('public/layout/footer')
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- bootstrap datetimepicker -->
    <script src="/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

    <!-- bootstrap tagsinput start -->
    <script src="/js/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <!-- bootstrap tagsinput end -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/js/js/vendor/jquery.ui.widget.js"></script>


    <script src="/js/js/jquery.iframe-transport.js"></script>
    <script src="/js/js/jquery.fileupload.js"></script>

    <!-- country dial list -->
    <script src="/js/countrydiallist/js/intlTelInput.js"></script>

    <!-- jquery rich text editor -->
    <script src="/js/jquery-richtext/jquery.richtext.min.js"></script>


    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    @yield('extrascript')

</body>

</html>