@extends('dashboard.layout.admin_layout')
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
    <div style="margin-top:10%;" class="container">
    <div class="row">   
    @include('dashboard.partial.employer_sidebar')


    <div style=" 
   
          column-gap: 20px;
}" class="col-md-7" >
         
<h4 class="Posthed " style="font-size:14px"> Company Details</h4>
<form action="/inspector/saveemployersettings" method="POST">
    <div class="row">

    <input type="hidden" id="id" name="id" value="{{$emp->id}}">
                        <div class="col-md-6">
                        <div class="form-group">
                              <label>Company name</label>
                              <input name="companyname" value="{{$emp->companyname}}" type="text" class="ico-03"  value=""/>
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label>Website</label>
                              <input name="websiteaddress" value="{{$emp->websiteaddress}}" type="text" class="ico-03"  value=""/>
                        </div>
                    </div>
                    </div>
                      <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                              <label>Country</label>
                              
                              <select id="location" name="location" class="natidropdo custom-select mr-sm-2" id="inlineFormCustomSelect">
      

         @foreach($division as $dis)

         @if($dis->parent==$dis->id)
                       <option value="{{$dis->id}}" >{{$dis->name}}</option>
                       @endif
      @endforeach

     </select>                          </div>      
                    </div>
                          <div class="col-md-3">
                        <div class="form-group">
                              <label>Area / Location</label>

                                <select value="{{$emp->area}}" name="area" id="area" class="natidropdo custom-select mr-sm-2" id="inlineFormCustomSelect">
       <option selected>Choose...</option>
      

         @foreach($division as $cnt)
         @if($cnt->parent!=$cnt->id)
         <option @if($cnt->id==$emp->area) selected @endif value="{{$cnt->id}}"> {{$cnt->name}}</option> 
                       @endif
      @endforeach

     </select>                       
                        </div>
                                
                {{csrf_field()}}            
                    </div>
                                  
                        <div class="col-md-6">
                        <div class="form-group">
                              <label>Email Address</label>
                              <input name="ContactEmail" disabled value="{{$emp->em}}" type="text" class="ico-03"  name="ContactEmail" />
                        </div>
                            
                    </div>
                    </div>
        
        
        
        <h4 class="Posthed " style="font-size:14px"> Social Links</h4>

    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                              <label>Facebook *</label>
                              <input name="fb" value="{{$emp->fb}}" type="text" class="ico-03"  value=""/>
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label>Twitter *</label>
                              <input name="twitter" value="{{$emp->twitter}}" type="text" class="ico-03"  value=""/>
                        </div>
                    </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                              <label>Linkedin *</label>
                              <input name="linkedin" value="{{$emp->linkedin}}" type="text" class="ico-03"  value=""/>
                        </div>
                    </div>
                        <div class="col-md-6">
                        
                    </div>
                          
    
                    </div>
 
        <hr>
        <h4 class="Posthed " style="font-size:14px">Change Username</h4>
        <input type="hidden" name="id" value="{{$emp->id}}">

<div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Current Username * <span style="color:#E86850;float:right">Edit</span></label>
                          <input name="username" value="{{$emp->em}}" type="text" class="ico-03"  name="username"/>
                      </div>
                  </div>
                    <div class="col-md-8">
                   
                  </div>
                  </div>
                  <button type="submit" style="   
  
  width: 170px;
  height: 38px;
   
  
  background: #28C294;
  border-radius: 3px;
  font-family: Raleway;
  font-style: normal;
  font-weight: bold;
  line-height: normal;
  font-size: 14px;
  text-transform: uppercase;
  color: #FFFFFF;" >Update Profile</button>         
    
    <hr>
    
   <!-- <h4 class="Posthed " style="font-size:14px">Change Password</h4>

<div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Current Password * </label>
                          <input name="old" id="old" type="text" class="ico-03"  value=""/>
                      </div>
                  </div>

                   <div class="col-md-4">
                      <div class="form-group">
                          <label>New Password * </label>
                          <input name="new" id="new" type="text" class="ico-03"  value=""/>
                      </div>
                  </div>

                   <div class="col-md-4">
                      <div class="form-group">
                          <label>Retype New Username * </label>
                          <input name="username" id="username" type="text" class="ico-03" value=""/>
                      </div>
                       
                  </div>
                   
                    
 
                  </div>
        
        
        <button type="button" style="   
  
 
width: 170px;
height: 40px;
 
 

background: #7889FF;
             
 
 
 

font-family: Raleway;
font-style: normal;
font-weight: bold;
line-height: normal;
font-size: 14px;
text-transform: uppercase;
color: #FFFFFF;                              
                                     
                                     " id="loginbtn">ChangePassword</button>
                
    
    <hr>

<div class="row">
<div class="col-md-12" style="color: #E86850;">
<small>Warning! You will not be able to reactivate your account or retrieve any of the content or information you  have added.</small>
</div>
<div class="col-md-12" style="color: #E86850;">
<a href="/employer/changeAccountStatus"><h5> 
    Delete My Account
</h5></a>
</div>

</div>
-->
<div style="margin-top:10%;text-align:center">
 </form>
</div>
  </div>


<div style="margin-left:7%;" class="col-md-2">
            <div class="applyjob1img">
                 
      
        <h4 class="Posthed " style="font-size:14px">Logo</h4>
 


<div class="row" style="margin-top:30%,">



  <form method="POST" id="basic" enctype="multipart/form-data" action="/inspector/updateempimage">






{{ csrf_field() }}

@if($emp->companylogo)
<div class=""><img style="width:100px;" src="/{{$emp->companylogo}}">
@else
<div class=""><img style="width:100px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png">
@endif

</div>
<br>
<input type="file" name="avatar" id="avatar"><br>
    <input type="hidden" id="id" name="id" value="{{$emp->id}}">
     <div class="col-xs-12">

    
        <button type="button" style="  border: 1px solid #7889ff; color:#7889ff;"
                                class="remove    btn-profile change_profile_pic">Change
                        </button>
    
    
    
    
    
    
    <button type="submit" style="  border: 1px solid #e86850; float:right; color:#e86850"
                                class="remove    btn-profile">Remove
                        </button>
    </div>
     <form>
 <!--<div class="col-md-7">
     <br>
     
     <h4 class="Posthed " style="font-size:14px">Indusatry</h4>

     
    Internet/E-commerce
    Employer Type
    Employer ( Private Sector)
    
       
    </div>-->
    </div>
</div>
</div>
</div>


</section>

<script>
$(document).ready(function(){
	$('.change_profile_pic').click(function(e){
				e.preventDefault();
				var image = $('#avatar')[0].files.length;
				if(image > 0){
					$('#basic').submit();
				}else{
					swal({
					  text: "Please select an image to chnage the current image!",
					  icon: 'warning'
					});
				}
			})
})
$("#location").on("change",function()
{
	//alert("a");
    var locs = {!! json_encode($division) !!};
    //console.log(locs)
   // alert($("#locationdrop").val());
    $('#area').empty();
   for(var i=0;i<locs.length;i++)
   {
       if(locs[i].parent==$("#location").val()&&locs[i].parent!=locs[i].id)
       {
    
           $('#area').append('<option value='+locs[i]["id"]+'>'+locs[i]["name"]+'</option>'); 

       }
   }
  
})

 $("#loginbtn").click(function(e ){
    e.preventDefault();
    var data={
        "_token":  $("input[name='_token']").val(),
        "id":$("#id").val(),
        "old":$("#old").val(),
        "username":$("#username").val(),
        "new":$("#new").val()
    }
     console.log(data);
 
    $.ajax({
  type: "POST",
  url: "/inspector/saveemployersettings",
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
		//text: "Password is different"+JSON.stringify(e),
		text: e.err,
		icon: "error",
		button: "Go Back",
	});
}
</script>
@endsection