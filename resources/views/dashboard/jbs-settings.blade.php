@extends('dashboard.layout.admin_layout')
@section('page_title')
    Setting
@endsection
@section('style')
    {!!Html::style('css/singleJob.css')!!}
    <style>
        .postjoin {
            margin-top: 30px !important;
        }
        .remove{
            border: 1px solid #7889ff;
            color: #7889ff;
        }

        @media (min-width: 768px) {
            .aconntmenu{
                margin-left:-7%;
            }
            .container{
                /* width: 1600px !important;*/
            }
            .accondlondon{
                margin: -5% 0 15px 0;
                color:gray;
            }
            .leftcont{
                color:gray;
            }
            .current{
                color:#7889ff;

            }
            .current  .col-md-10{
                font-weight:bold;
                color:black;
            }
            .content{
                margin-left:-7%;border-right: thin solid lightgray;
            }

            .row {
                margin-bottom: 0px;
            }
        }
    </style>
@endsection
@section('script')
    {{--asset('js/managejob.js')--}}
    {!!Html::script('js/managejob.js')!!}
@endsection
@section('content')
    <section class="minheight">
        <div class="nav-header" >
            <nav>
                <ul class="top-nav detail">
                    <li class="activeul"><a href="{{url('/inspector/jbs/getProfile/'.$id)}}">Profile</a></li>
                    <li><a href="{{url('/inspector/jbs/jobs/'.$id)}}/0">Jobs</a></li>
                    <li class="lastlicl"><a href="{{url('/inspector/jbs/message/'.$id.'/0')}}">Messages</a></li>
                </ul>
            </nav>
        </div>
        <div style="padding-top:2%;width:80%;" class="container nav-in">
            <div class="row ">
                <div class="col-md-8">
                    <div class="row row-settings">
                        <h4 class="Posthed col-md-2" style="padding:0px"><a href="{{url('/inspector/jbs/getProfile/'.$id)}}" style="color:#7889FF;"> Settings</a> </h4>
                        <h4 class="Posthed col-md-2"><a href="{{url('/inspector/jbs/getresume/'.$id)}}">Resume</a  ></h4>
                        <h4 class="Posthed col-md-8" >
                        <a href="#" style="float:right;">

                        </a>
                    </h4>
                    </div>
                    <h4 class="Posthed " style="font-size:16px">Change Password</h4>
                    <form method="POST" id="passwordform" enctype="multipart/form-data" action="{{url('/inspector/jbs/resetpassword')}}">
                        {{ csrf_field() }}
                        <div class="row">


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <input  type="password" class="ico-03" id="password" name="password" required value=""/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Retype New Password</label>
                                    <input  type="password" class="ico-03" id="password_confirmation" name="password_confirmation" required value=""/>
                                </div>
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>
                        @if ($errors->hasBag('password'))
                            <div class="row" id="passworderrorbag">
                                <div class="col-md-12 ">
                                    <div class="alert alert-danger" style="text-align:center;">
                                        <ul>
                                            @foreach ($errors->password->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <button id="changepassword" class="postbtn" style="background:#28c294 ;margin-top: 10px!important;"  data-form-id="passwordform">Change Password</button>
                    </form>
                    <hr>
                    <h4 class="Posthed " style="font-size:14px">Change Email</h4>
                    <form method="POST" id="emailform" enctype="multipart/form-data" action="{{url('/inspector/jbs/changeemail')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Email </label>
                                    <input  type="email" class="ico-03" id="email" name="email" required value="{{$myprofile->email}}"/>
                                </div>
                            </div>
                        </div>
                        @if ($errors->hasBag('email'))
                            <div class="row" id="emailerrorbag">
                                <div class="col-md-12 ">
                                    <div class="alert alert-danger" style="text-align:center;">
                                        <ul>
                                            @foreach ($errors->email->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <button id="changeemail" class="postbtn" style="background:#28c294;margin-top: 10px!important;" data-form-id="emailform">Change Email</button>
                    </form>
                    <div class="row">
                        <div class="col-md-12" style="color: #E86850;">
                            <small>Warning! You will not be able to reactivate your account or retrieve any of the content or information you  have added.</small>
                        </div>
                        <div class="col-md-12" style="color: #E86850;">
                            <a href="{{url('/inspector/jbs/deleteaccount/'.$id)}}">
                                <h5 style="font-weight:bold;color:#e86850;">Delete My Account</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <form method="POST" id="basic" enctype="multipart/form-data"
                          action="{{url('/inspector/jbs/updateimage')}}">
                        <input name="id" type="hidden" value="{{$id}}">
                        <p>Profile Picture<span class="mustbeoption">*</span></p>
                        <div class="">
                            <div class="profileicon" style="min-width: 150px !important; min-height: 150px !important;">
                                <div class="">
                                    <div class="">
                                        {{ csrf_field() }}
                                        @if(file_exists($jobprofile->profile_img))
                                            <img src="/{{$jobprofile->profile_img}}" style=" margin-left: auto; margin-right: auto; width:100px; height:100px;" id="profimg" data-chk="1">
                                        @else
                                            <img  src="/img/profile.png" style=" margin-left: auto; margin-right: auto; width:100px; height:100px;" id="profimg" data-chk="0">
                                        @endif
                                    </div>

                                    <div class="row" style="margin-top:2%">
                                        <div class="btn-admin" style=" margin-left: auto; margin-right: auto; width:196px;">
                                    <span type="submit" class=" " style="">
                                        <label for="avatarup" class="custom-file-upload">
                                             Change
                                        </label>
                                        <input required type="file" id="avatarup" accept="image/png,image/jpeg" name="avatar"/><a
                                                href="{{url('/inspector/jbs/removeimage/'.$id)}}">
                                        <label  class="custom-file-upload remove-btn">
                                            remove
                                        </label>
                                            </a>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:2%">
                                <div class="col-md-8">
                                    <div id="progress" class="progress" style="display:none;">
                                        <div class="progress-bar progress-bar-success"></div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div></div>
    </section>
    <script>
            document.getElementById("avatarup").onchange = function() {
            document.getElementById("basic").submit();
        }
    </script>
@endsection
@section('extrascript')
    <script>
        @if(!empty($passwordmessage))
        console.log("{{$passwordmessage}}");
        swal({
            title: "Change password error.",
            text: "{{$passwordmessage}}",
            icon: "error",
            button: "Go Back",
        });
        @endif
        $('#changepassword').click( function (e) {

            var password = document.getElementById("password");
            var confirm_password = document.getElementById("password_confirmation");

            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            }
            else{
                confirm_password.setCustomValidity("");
            }
        });

        // $("#loginbtn").click(function(e ){
        // var data={
        //     'token':$('{{csrf_field()}}').val(),
        //     "oldpassword":$("#currentpassword").val(),
        //     "password":$("#newpassword").val(),
        //     "password_confirmation":$("#retyped").val()
        // }
        // console.log(data);

        // $.ajax({
        //     type: "POST",
        //     url: "/jobseeker/password/resetmanually",
        //     data: JSON.stringify(data),
        //     success: success,
        //     error:error,
        //     dataType: "json",
        //     contentType: "application/json"
        // });
        // });

        function success(){
            swal({
                title: "Profile Updated Successfully",
                text: "Profile updated successfully",
                icon: "success",
                button: "Go Back",
            });
        }

        function error(e){
            swal({
                title: "Error Updating Profile",
                text: "Entered data could not be saved",
                icon: "error",
                button: "Go Back",
            });
        }
    </script>
    <script>

    </script>
@endsection

