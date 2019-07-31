@extends('public.layout.public_layout')
@section('page_title')
Search
@endsection
@section('style')
{!!Html::style('css/singleJob.css')!!}
@endsection
@section('script')
{{--asset('js/managejob.js')--}}
{!!Html::script('js/managejob.js')!!}
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

  <div class="row">
  <div class="col-md-12 col-sm-9">
  <style>
    .postjoin {
	 margin-top: 0% !important; 
}
    .remove
    {
        border: 1px solid #7889ff;
    color: #7889ff;

    }
    .btn-profile {
        width:auto;
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
       /* width: 1600px !important;*/
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
</style>

<section>
    <div style="margin-top:2%;    " class="container">
    <div class="row">   
    @include('employer.partial._sidebar')

      
    <div style="" class="col-md-7" >
        <h4 class="Posthed col-md-4" style="font-size:14px"> Settings </h4>  <h4 class="Posthed col-md-4" style="font-size:14px">Resume</h4>  <h4 class="Posthed col-md-4" style="font-size:14px">  <button class="remove btn-profile" >Edit</button></h4>

<h4 class="Posthed " style="font-size:14px"> Social Links</h4>
<form id="myform">


	<div class="row">
                		<div class="col-md-6">
                  		<div class="form-group">
                              <label>Facebook *</label>
                              <input  type="text" class="ico-03" id="fb" value=" {{$myprofile['fb']}}"/>
                  		</div>
                  	</div>
                    	<div class="col-md-6">
                  		<div class="form-group">
                          <label>Twitter *</label>
                              <input  type="text" class="ico-03" id="twitter" value=" {{$myprofile['twitter']}}"/>
                  		</div>
                  	</div>
                  	</div>
                      <div class="row">
                		<div class="col-md-6">
                  		<div class="form-group">
                              <label>Linkedin *</label>
                              <input  type="text" class="ico-03" id="linkedin" value=" {{$myprofile['linkedin']}}"/>
                  		</div>
                  	</div>
                    	<div class="col-md-6">
                  		
                  	</div>
                  	</div>
		
		<hr>
		
        <h4 class="Posthed " style="font-size:14px">Change Username</h4>

<div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Current Username * <span style="color:#E86850;float:right">Edit</span></label>
                          <input  type="text" class="ico-03" name="username" id="username" value="{{$myprofile['username']}}"/>
                      </div>
                  </div>
                    <div class="col-md-8">
                    <span>
                    you can direct go to  www.candidate.wtrecruitment.com/mohamemed321
                    </span>
                  </div>
                  </div>
                
    
    <hr>
    
    <h4 class="Posthed " style="font-size:14px">Change Password</h4>

<div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Current Password * </label>
                          <input  type="text" class="ico-03" id="currentpassword"  value=""/>
                      </div>
                  </div>

                   <div class="col-md-4">
                      <div class="form-group">
                          <label>New Password * </label>
                          <input  type="text" class="ico-03" id="newpassword" value=""/>
                      </div>
                  </div>

                   <div class="col-md-4">
                      <div class="form-group">
                          <label>Retype New Username * </label>
                          <input  type="text" class="ico-03" id="retyped" value=""/>
                      </div>
                  </div>
                  <div class="col-md-4">
                  <button id="loginbtn" class="postjoin">Change Password</button>
</div>
                  </div>
      </form>          
    
    <hr>
    <h4 class="Posthed " style="font-size:14px">Change Username</h4>

<div class="row">
<div class="col-md-12" style="color: #E86850;">
<small>Warning! You will not be able to reactivate your account or retrieve any of the content or information you  have added.</small>
</div>
<div class="col-md-12" style="color: #E86850;">
<h5> 
    Delete My Account
</h5></div>

</div>
<div style="margin-top:10%;text-align:center">
<span ><small style="color: #E86850;">Please note: Any information you change in "My Account" will also be changed in your Resume.</small></span>
</div>
  </div>



      <div class="col-md-2">

<h4 class="sidenotifi">Profile Photo</h4>


<div class="row" style="margin-top:20%">

<div class=""><img width="150px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png"></div>


</div>
<br>
<div class="row">
    <div class="col-md-6">
        <button type="button" style="  border: 1px solid #7889ff; color:#7889ff;" class=  "remove    btn-profile">Change</button>
    </div>
    <div class="col-md-6">
        <button type="button" style="  border: 1px solid #e86850; float:right; color:#e86850" class="remove    btn-profile">Remove</button>
    </div>
</div>
</div>
</div>


</section>
 
  </div>
</div>

   
<script>
 $("#loginbtn").click(function(e ){
    e.preventDefault();
    var data={
        "fb":$("#fb").val(),
       
        "twitter":$("#twitter").val(),
        "linkedin":$("#linkedin").val(),
        "old":$("#currentpassword").val(),
        "username":$("#username").val(),
        "new":$("#newpassword").val()
    }
     console.log(data);
 
    $.ajax({
  type: "POST",
  url: "/employer/setProfile",
  data: JSON.stringify(data),
  success: success,
  error:error,
  dataType: "json",
  contentType: "application/json"

});

});

function success()
{
    swal({
  title: "Profile Updated Successfully",
  text: "Profile updated successfully",
  icon: "success",
  button: "Go Back",
});
}

function error(e)
{
swal({
  title: "Passwords do not match",
  text: "Password is different"+JSON.stringify(e),
  icon: "error",
  button: "Go Back",
});
}
</script>
@endsection

