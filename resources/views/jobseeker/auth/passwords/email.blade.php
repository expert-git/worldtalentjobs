






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
<h1 class="Posthed">Reset</h1>

<p><img class="loginimg" src="/img/Group 2.1.png" width="30%"></p>
<form role="form" id="sendemail" method="POST" action="{{ url('/jobseeker/password/email') }}">
                        {{ csrf_field() }}
Username/Email:<br>
<input class="usenpss" id="email" type="email" name="email" value="{{ old('email') }}" autofocus><br>
@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif


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


  



<script>
$(".loginbtn").on("click", function (e) {
    e.preventDefault();//stop submit event
    swal({
        title: "Reset Link sent!",
        text: "Please check your mailbox to reset your password ",
        icon: "success",
        button: "Ok!",
        }).then(()=>{
            
            $("#sendemail").submit();
        });
});
</script>
@endsection



