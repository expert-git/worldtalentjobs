

{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
HomePage
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
}
</style>




<div style="margin-top:5%; min-height:550px;" class="container"> 



<div class="col-md-4"> <h4 class="badconlog"> 

</h4></div> 	

<div class="col-md-2"></div>

<div class="lgoinpage col-md-6">
<h1 class="Posthed">Reset Password</h1>
<p><img class="loginimg" src="/img/Group 2.1.png" width="30%"></p>
<form role="form" method="POST" action="{{ url('/jobseeker/password/reset') }}">
                        {{ csrf_field() }}

                                                <input type="hidden" name="token" value="{{ $token }}">

Username/Email:<br>
<input class="usenpss" id="email" type="email" name="email" value="{{ old('email') }}" autofocus><br>
@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
Password:

<div class="input-container">

  <input id="password" type="password" name="password" >
  @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                           
   <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
      
</div>

Confirm Password:

<div class="input-container">

  <input id="password-confirm" type="password"  name="password_confirmation">
  @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                           
   <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
      
</div>


                       
<div style="margin-top:5%;" class="row">
<div class="col-md-4 col-sm-12">
<input class="loginbtn"  style="background-color:#7889FF" type="submit" value="Reset Password">
</div>

</div>
</form>


</div> 








</div>




<style>
 @media (min-width: 200px) and (max-width: 480px) {
     #btnToggle{
         margin-top: -54px;
     }
} 

</style>



</body>
</html>

@endsection

