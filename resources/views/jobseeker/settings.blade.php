@extends('public.layout.public_layout')
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
        <div style="padding-top:2%;width:90%;" class="container">
            <div class="row">   
                @include('jobseeker.partial._sidebar')
                <div class="col-md-8">
                    <h4 class="Posthed col-md-2" style="padding:0px"><a href="/jobseeker/getProfile" style="color:#7889FF;"> Settings</a> </h4>  
                    <h4 class="Posthed col-md-2"><a href="/jobseeker/myresume">Resume</a  ></h4>  
                    <h4 class="Posthed col-md-8" >
                        <a href="#" style="float:right;">
                            <button class="editbut" ><i class="fa fa-pencil"></i>Edit</button>
                        </a>
                    </h4>
                    <h4 class="Posthed " style="font-size:16px">Change Password</h4>
                    <form method="POST" id="passwordform" enctype="multipart/form-data" action="/jobseeker/password/resetmanually">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Current Password </label>
                                    <input  type="password" class="ico-03" id="oldpassword" name="oldpassword" required  value=""/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input  type="password" class="ico-03" id="password" name="password" required value=""/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Retype New Password</label>
                                    <input  type="password" class="ico-03" id="password_confirmation" name="password_confirmation" required value=""/>
                                </div>
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
                        <button id="changepassword" class="postbtn" style="background:#28c294"  data-form-id="passwordform">Change Password</button>
                    </form>
                    <hr>
                    <h4 class="Posthed " style="font-size:14px">Change Email</h4>
                    <form method="POST" id="emailform" enctype="multipart/form-data" action="/jobseeker/email/resetmanually">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Email </label>
                                    <input  type="email" class="ico-03" id="email" name="email" required value=""/>
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
                        <button id="changeemail" class="postbtn" style="background:#28c294" data-form-id="emailform">Change Email</button>
                    </form>
                    <div class="row">
                        <div class="col-md-12" style="color: #E86850;">
                            <small>Warning! You will not be able to reactivate your account or retrieve any of the content or information you  have added.</small>
                        </div>
                        <div class="col-md-12" style="color: #E86850;">
                            <a href="/jobseeker/changeAccountStatus">
                                <h5 style="font-weight:bold;color:#e86850;">Delete My Account</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <!-- <h4 class="sidenotifi">Profile Photo</h4> -->
                </div>
            </div>
        </div>
    </section>
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
@endsection

