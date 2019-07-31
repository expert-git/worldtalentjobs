

{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
Sign In
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
     #btnToggle{
         margin-top: -54px;
     }
  } 
</style>

<div style="margin-top:5%; min-height:730px;" class="container"> 
  <div class="col-md-5"> 
    <h4 class="badconlog"> 
      Sign in to World Talent Jobs Portal and stay updated on the latest jobs in Qatar. Post your CV and get noticed by recruiters in Qatar.
    </h4>
  </div> 	

  <div class="col-md-2"></div>

  <div class="loginpage col-md-5">
    <h1 class="Posthed">Login</h1>
    <p><img class="loginimg" src="/img/Group 2.1.png" width="30%"></p>
    <form role="form" method="POST" action="{{ url('/jobseeker/login') }}">
      {{ csrf_field() }}

      Email:<br>
      <input class="usenpss" id="email" type="email" name="email" value="{{ old('email') }}" autofocus><br>
      @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
      @endif
      Password:

      <div class="input-container">

        <input id="password" type="password" name="password">
        @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
                            
        <button type="button" id="btnToggle" class="toggle" onclick="myFunction()">
          <i id="eyeIcon" class="fa fa-eye" style="font-size:25px;"></i>
        </button>

      </div>

      <div style="margin-top:5%;" class="row">
        <div class="col-md-4 col-sm-12">
          <input class="loginbtn"  style="background-color:#7889FF" type="submit" value="LOGIN">
        </div>
        <div class="col-md-8 col-sm-12">
          <p class="pasuser">
            <b style="font-weight: bold !important;">
              <a style="color: #339966;" href="{{ url('/jobseeker/password/reset') }}">	Lost Password? </a>
            </b>
            <br>Don't have an account? 
            <a href="register"><b style="font-weight: bold !important;color: #339966;"> Register Now!</b></a>
          </p>
        </div>
      </div>
    </form>
  </div> 
</div>

<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

@endsection

