@extends('jobseeker.ample.index')
@section('title')
Manage Jobs
@endsection
@section('style')
{!!Html::style('css/managejobs.css')!!}
@endsection
@section('script')
{{--asset('js/managejob.js')--}}
{!!Html::script('js/managejob.js')!!}
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
Sign in to World Talent Jobs Portal and stay updted on the latest jobs in Qatar with world Talent Recruitment. Post your CV and get noticed by recuiters in Qatar.
</h4></div> 	

<div class="col-md-2"></div>

<div class="lgoinpage col-md-6">
<h1 class="Posthed">Login</h1>
<p><img class="loginimg" src="img/Group 2.1.png" width="30%"></p>
<form>
Username/Email:<br>
<input class="usenpss" type="text" name="username"><br>
Password:

<div class="input-container">

  <input id="password-field" type="password"  name="password" value="secret">

   <button type="button" id="btnToggle" class="toggle" onclick="myFunction()"><i id="eyeIcon" class="fa fa-eye"></i></button>
      
</div>

<div style="margin-top:5%;" class="row">
<div class="col-md-4 col-sm-12">
<input class="loginbtn"  style="background-color:#7889FF" type="submit" value="LOGIN">
</div>
<div class="col-md-8 col-sm-12">
<p class="pasuser"><b style="font-weight: bold !important;">	Lost Password? </b><br/>Don't have an account? <b style="font-weight: bold !important;"> Register Now!</p>
</div>
</div>
</form>


</div> 








</div>



<script>
function myFunction() {
  var x = document.getElementById("password-field");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
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

