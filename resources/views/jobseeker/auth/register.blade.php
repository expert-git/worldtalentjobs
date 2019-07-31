
{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
Sign Up
@endsection

@section('content')
 
<style>
    .toggle {
        background: none;
        border: none;
        color: #a6b1be;
        /* display: none; */
        /* font-size: .9em; */
        font-weight: 600;
        padding: 1.0 em;
        position: absolute;
        right: .75em;
        margin-top: -9%;
        /* top: 2.25em; */
        z-index: 9;
    }
    .toggle:hover{
        background: none;
    }
    @media (min-width: 200px) and (max-width: 480px) {
        #btnToggle,#btnToggle1{
            margin-top: -54px;
        }
    } 
</style>

<div style="margin-top:5%; min-height:730px;" class="container"> 

    <div class="col-md-5"> 
        <h4 class="badconlog">
            Register with World Talent Jobs and stay updated on the latest jobs in Qatar. Post your CV and get noticed by the recruiters in Qatar.
        </h4>
    </div> 	

    <div class="col-md-2"></div>

    <div class="loginpage col-md-5">
        <h1 class="Posthed">Sign Up</h1>
        <p><img class="loginimg" src="/img/Group 2.1.png" width="30%"></p>
        <form role="form" id="sendemail" method="POST" action="{{ url('/jobseeker/register') }}">
            {{ csrf_field() }}

            Username/Email:<br>
            <input class="usenpss" id="email" type="email" name="email" value="{{ old('email') }}" autofocus><br>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            Password:
            <div class="input-container">
                <input id="password" type="password" name="password">
                <button type="button" id="btnToggle" class="toggle" onclick="myFunction()">
                    <i class="fa fa-eye" style="font-size:25px;"></i>
                </button>
            </div>
    
            <br>
            Confirm  Password:
            <div class="input-container">
                <input id="password_confirmation" type="password" name="password_confirmation">
                <button type="button" id="btnToggle1" class="toggle" onclick="myFunction1()">
                    <i class="fa fa-eye" style="font-size:25px;"></i>
                </button>
            </div>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <div style="margin-top:5%;" class="row">
                <div class="col-md-4 col-sm-12">
                    <button class="ico-03 submit" id="signup" type="submit">Register</button>
                </div>
                <div class="col-md-8 col-sm-12">
                    <p class="pasuser">Do you have an account?
                        <a href="login"><b style="font-weight: bold !important;color: #339966;">Sign In Now!</b></a>
                    </p>
                </div>
            </div>   
        </form>
    </div>
</div>

<script>
    // $("#signup").on("click", function (e) {
    //     e.preventDefault();//stop submit event
    //     swal({
    //         title: "User Registered!",
    //         text: "Please check your mailbox to verify your account ",
    //         icon: "success",
    //         button: "Ok!",
    //     }).then(()=>{    
    //         $("#sendemail").submit();
    //     });
    // });

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function myFunction1() {
        var x = document.getElementById("password_confirmation");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection

