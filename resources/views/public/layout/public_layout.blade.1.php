 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
		
        <link rel="stylesheet" href="{{ asset('public/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/fontello.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/animate.css') }}">        
        <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/owl.transitions.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/css/base.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
  
        <link rel="stylesheet" href="{{ asset('public/responsive.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @yield('style')
        
        <style>
            #login-dp{
                    min-width: 250px;
                    padding: 14px 14px 0;
                    overflow:hidden;
                    background-color:rgba(255,255,255,.8);
                }
                #login-dp .help-block{
                    font-size:12px    
                }
                #login-dp .bottom{
                    background-color:rgba(255,255,255,.8);
                    border-top:1px solid #ddd;
                    clear:both;
                    padding:14px;
                }
                #login-dp .social-buttons{
                    margin:12px 0    
                }
                #login-dp .social-buttons a{
                    width: 49%;
                }
                #login-dp .form-group {
                    margin-bottom: 10px;
                }
                .btn-fb{
                    color: #fff;
                    background-color:#3b5998;
                }
                .btn-fb:hover{
                    color: #fff;
                    background-color:#496ebc 
                }
                .btn-tw{
                    color: #fff;
                    background-color:#55acee;
                }
                .btn-tw:hover{
                    color: #fff;
                    background-color:#59b5fa;
                }
                @media(max-width:768px){
                    #login-dp{
                        background-color: inherit;
                        color: #fff;
                    }
                    #login-dp .bottom{
                        background-color: inherit;
                        border-top:0 none;
                    }
                }
                .keep{
                    background-color: brown !important;
                }
                        *
        {
            -webkit-border-radius: 0px  !important;
            -moz-border-radius: 0px  !important;
            border-radius: 0px !important;
        }
        htlm, body
        {
            padding: 0;
            margin: 0;
            position: relative;
        }
        
.dropdown-menu2{
    background: #6678f5;
    border:1px solid #6678f5;
    border-radius: 5px;
}

.dropdown-menu2 a:link, .dropdown-menu2 a:visited{
    display: block;
    padding: 10px 10px;
    font-weight: normal;
}

.dropdown-item1{
  border-top: 1px solid #FFF;
}

.dropdown-menu2{
  right: 0px !important;
  left:auto;
}


@media only screen and (max-width: 500px){
  #navigation ul.float-right a{
    margin: 20px 20px 20px 0 ;
  }

  .dropdown-menu2{
     min-width: auto !important;
  }

  .dropdown-menu2 a:link{
      margin: 5px !important;
      background: none;
      display: block !important;
  }

}
                        @yeild('style')
        </style>


        
    </head>
    <body>
 
        
        <!-- Body content -->
        
        <header>
<div class="container">
    <div class="sixteen columns">
    
        <!-- Logo -->
        <div id="logo">
            <li><a href="#"><img class="Joblogo"  src="/img/wtc_logo.png"></a></li>
        </div>

        <!-- Menu -->
        <nav id="navigation" class="menu">
            <ul id="responsive">
  <li><a href="/">Home</a></li>
        <li><a href="/findjob">Find Jobs</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/contactus">Contact Us</a></li>

             
            </ul>




            <ul class="float-right">
            

    @if(Auth::guard('jobseeker')->check())

<li>

      <div class="dropdown show">
        <a class="btn2 btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-tie"></i>
        </a>

          <div class="dropdown-menu dropdown-menu2" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/jobseeker/managejobs/0">JOBS</a>
			  <a class="dropdown-item" href="/jobseeker/myresume">Registration</a>
			    <a class="dropdown-item" href="/jobseeker/getProfile">My profile</a>
            <a class="dropdown-item" href="/jobseeker/message">MESSAGES</a>
            <a class="dropdown-item" href="/jobseeker/notifications">NOTIFICATIONS</a>
            <a class="dropdown-item" href="/jobseeker/editprofile">EDIT PROFILE</a>
                   <form id="logout-form" action="{{ url('/jobseeker/logout')  }}" method="POST" >
                                            {{ csrf_field() }}
                                             <button class="dropdown-item dropdown-item1" >LOGOUT</button>
       
                                        </form> 
              </div>
        </div>


      </li>
@elseif(Auth::guard('employer')->check())


<li>

        <form id="logout-form" action="{{ url('/employer/logout')  }}" method="POST" >
                                            {{ csrf_field() }}
                                             <button class="dropdown-item dropdown-item1" >LOGOUT</button>
       
                                        </form> 


      </li>

       
            
       
@else
    <li><a href="/jobseeker/login">Sign In</a></li>
        <li><a href="/jobseeker/register">Register</a></li>
    <li><a href="/employer">Employer?</a></li>
@endif
            </ul>



        </nav>

        <!-- Navigation -->
        <div id="mobile-navigation">
            <a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
        </div>

    </div>
</div>
</header>

        
        @yield('content')
        @include('public/layout/footer')

       
        <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>
       
      
        @yield('script')
        {{-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> --}}
        {{-- <script>tinymce.init({ selector:'textarea' });</script> --}}
        <script>
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

                // tinymce.init({
                //   selector: 'textarea',
                //   height: 500,
                //   theme: 'modern',
                //   plugins: [
                //     'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                //     'searchreplace wordcount visualblocks visualchars code fullscreen',
                //     'insertdatetime media nonbreaking save table contextmenu directionality',
                //     'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
                //   ],
                //   toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                //   toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                //   image_advtab: true,
                //   templates: [
                //     { title: 'Test template 1', content: 'Test 1' },
                //     { title: 'Test template 2', content: 'Test 2' }
                //   ],
                //   content_css: [
                //     '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                //     '//www.tinymce.com/css/codepen.min.css'
                //   ]
                //  });
                            });

                            

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="{{ asset('theme/scripts/custom.js')}}"></script>
<script src="{{ asset('theme/scripts/jquery.superfish.js')}}"></script>

<script src="{{ asset('theme/scripts/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{ asset('theme/scripts/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{ asset('theme/scripts/jquery.themepunch.showbizpro.min.js')}}"></script>
<script src="{{ asset('theme/scripts/jquery.flexslider-min.js')}}"></script>
<script src="{{ asset('theme/scripts/chosen.jquery.min.js')}}"></script>
<script src="{{ asset('theme/scripts/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('theme/scripts/waypoints.min.js')}}"></script>
<script src="{{ asset('theme/scripts/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('theme/scripts/jquery.jpanelmenu.js')}}"></script>
<script src="{{ asset('theme/scripts/stacktable.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="/js/js/vendor/jquery.ui.widget.js"></script>


<script src="/js/js/jquery.iframe-transport.js"></script>
<script src="/js/js/jquery.fileupload.js"></script>
  <script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        placeholder: "Place ",
        allowClear: true,
        
    });

     $('.js-example-basic-single').select2({
        placeholder: "Place ",
        allowClear: true,
        theme: "classic"
    });
});
    </script>
    </body>
</html>