@extends('dashboard.layout.admin_layout')

@section('content')




<style>
    .remove
    {
        border: 1px solid #7889ff;
    color: #7889ff;

    }
    .btn-profile {
        
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

	<div class="container-fluid" style="background: #ececed; padding: 10px; margin-top:180px;">
        <div class="container">
            <div class="row" style="margin-bottom: 0px;">
                <div class="col-md-12">
                    <ul class="profile_link">
                        <li class="active_link21"><a href="#">Profile</a></li>
                        <li><a href="/inspector/jobdetail/{{$data->employer_id}}/0">Job Posts</a></li>
                        <li><a href="#">Candidates</a></li>
                        <li><a href="/inspector/message/{{$data->employer_id}}">Message</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:80px;" class="container">
		
		
		<div class="row" style="padding-top:30px">
			<div class="col-md-12">
				     <div class="row">   
  

      
    <div style="" class="col-md-12" >
 
        <div class="row dashbord">
            <div class="col-md-9 col-sm-12">
                <h2>{{$data->companyname}}</h2>
                <div class="left_content">
                    <p>Total Job Posts</p>
                </div> 
                <div class="left_content">
                    <p>{{$cnt}}</p>
                </div>               
 
            </div>
            <div class="col-md-3 col-sm-12 text-right">
            @if($data->isnew)
                <button class="message message2" onclick="myFunction(1)" style="background-color:green;color:white">  Verify</button>
                <button class="message message2" onclick="myFunction(0)" style="background-color:red;color:white">  Reject</button>
            @endif
            </div>
            <br clear="all" />
        </div>
        
        <div class="row">
            
            <div class="col-md-12">
                <div>
                    
                    
                    <hr style="margin-bottom:0px;" />
                    <div class="row padding_row">
                        <div class="form-row">
                        	<div class="col-md-10"><h3 class="headh3">Job Post Info</h3></div>
                        	<div class="col-md-2"><a href="/inspector/employersettings/{{$data->employer_id}}"><div class="action_buttons25">Edit</div></a></div>
                        </div>


                        <div class="form-row">
                        	<div class="col-md-11"> 
		                        <div class="form-row">
		                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Employer Id</div>
		                            <div class="col-md-7 col-xs-6">#{{$data->employer_id}}</div>
		                        </div>
		                        <div class="form-row">
		                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Employer Name</div>
		                            <div class="col-md-7 col-xs-6">{{$data->companyname}}</div>
		                        </div>
		                    </div>
		                    <div class="col-md-1"> </div>



                        </div>

                        <div class="form-row">
                        	<div class="col-md-11">                        		
		                        <div class="form-row">
		                            <div class="col-md-4 col-md-offset-1 colorblue">Country</div>
		                            <div class="col-md-7">{{$data->country}}.</div>
		                        </div>
		                        
		                        <div class="form-row">
		                            <div class="col-md-4 col-md-offset-1 colorblue">Location / Area</div>
		                            <div class="col-md-7">{{$data->division}}</div>
		                        </div>		                        
		                        <div class="form-row">
		                            <div class="col-md-4 col-md-offset-1 colorblue">Company Type</div>
		                            <div class="col-md-7">{{$data->industrytype}}.</div>
		                        </div>
		                        <div class="form-row">
		                            <div class="col-md-4 col-md-offset-1 colorblue">Total Job Posts</div>
		                            <div class="col-md-7">{{$cnt}}</div>
		                        </div>
		                        <div class="form-row">
		                            <div class="col-md-4 col-md-offset-1 colorblue">Date Posted</div>
                                    <div class="col-md-7">{{$data->created_at}}.</div>
		                        </div>
                        	</div>


                        	<div class="col-md-1">
                        		<div class="form-row">
                                    <h1 class="Posthed" style="padding:0 0 0 0;">Logo</h1>
                                  @if($data->companylogo)
                                  <img src="/{{$data->companylogo}}">
                                    @else
                                    <img src="/img/wtc_logo.png">
                                    @endif
		  							
                        		</div>
                        	</div>
                        </div>

                    </div>
                    
                    <hr style="margin-bottom:0px;" />
                    <div class="row padding_row">
                    	<div class="form-row">
	                        <div class="col-md-10"><h3 class="headh3">Job Details</h3></div>
	                        <div class="col-md-2"><a href="/inspector/employersettings/{{$data->employer_id}}"><div class="action_buttons25">Edit</div></a></div>
	                    </div>


                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Email Address:</div>
                            <div class="col-md-7 col-xs-6">{{$data->ContactEmail}}.</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Mobile Phone</div>
                            <div class="col-md-7">{{$data->ContactPhone}}.</div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Website</div>
                            <div class="col-md-7">{{$data->websiteaddress}}.</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Username</div>
                            <div class="col-md-7">{{$data->username}}.</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Password</div>
                            <div class="col-md-7">. . . . . .</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Facebook</div>
                            <div class="col-md-7">{{$data->fb}}.</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Twitter</div>
                            <div class="col-md-7">{{$data->twitter}}. </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Linked in</div>
                            <div class="col-md-7">{{$data->linkedin}} .</div>
                        </div>
							                    
                    </div>
                    
                    <hr style="margin-bottom:0px;" />
                    
                    <div class="row padding_row">
                        <div class="form-row">
                        	<div class="col-md-10"><h3 class="headh3">Job Post Info</h3></div>
                        </div>


                        <div class="form-row">
                        	<div class="col-md-4 col-md-offset-1 colorblue">Status</div>
                            
                        	<div class="col-md-5"><label class="switch">
  <input type="checkbox" id="status" value="1" @if($data->status==1) checked @endif>
  <span class="slider round"></span>
</label>
</div>
                        	<div class="col-md-2"><span style="color:#e86850;">Delete Employer</span></div>
                        </div>

<style>
.btn {
    background:transparent !important;
}
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
                    </div>

                    
                </div>
            </div>
            
            
            
            
            
            
        
        </div>
        
        
        
        
        
        
        
    </div>



      
</div>
			
			</div>
		</div>
		
	</div>


</section>





	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
<script>
$(document).ready(function(){
  $(".more_icon").click(function(){
    $(".actions_buttons2").toggle();
  });
});
</script>   


<script>
function myFunction() {
  window.print();
}
</script>
    
    <style>
        .row{
            clear:both;
        }
        
        .postlist{
        	margin:0;
        	padding:0 0 30px 30px;

        }

        .postlist li{
        	list-style: disc;
        	padding: 15px 0;
        }

        @media screen and (max-width: 500px) {
            .border-right{
                border-right: none;
                overflow: auto;
            }
            .border1 {
                margin: 0 2px;
                padding: 1px 0px;
                display: block;
                border: 1px solid #868686;
                float: left;
                font-size: 12px;
            }
            
            .action_buttons {
                float: left;
                border: 1px solid #a0a0a0;
                border-radius: 5px;
                position: relative;
                z-index: 10;
                clear: both;
                margin-top: 10px;
            }
            
        }
        
        
        
        
    </style>
    
    

    
    <style>
        
        
    .btn {
        width: 100% !important;
    border: 1px solid #e0e0e0;
    padding: 10px 8px;
        background:#FFF !important;
}
    
    .btn2{
        border: 2px dashed #cccaca;
        padding: 7px 26px;
        background: #f5f5f5;
    }
    
    .ico-03{
        float:right;
    }
    .pasuser3{
    float: left;
    width: 249px;
    padding: 30px 0 10px 0;
    color: #7889ff;
    }
    
    .bootstrap-select{
        width:100% !important;
    }
    
    .dropdown-toggle{
        width:100% !important;
    }
    
    select{
        padding:11px 18px;
    }
    
    .fr-box.fr-basic.fr-top .fr-wrapper{
        border-bottom: 1px solid #ccc;
    }
        
        
    .bootstrap-select .dropdown-menu{
        min-width: 100% !important;
    }

    #example2{
    	margin: 20px 0;
    }

    #example2 tbody>tr>td{
    	    border-top: none;
    	    font-weight: bold;
    	    color: #000;

    }
    
     @media (min-width: 200px) and (max-width: 480px) {
         #btnToggle{
             margin-top: -54px;
         }
         
         .ico-03{
            float:none;
        }
    } 
        
        
    </style>

	<script>
    $('#status').on('change', function() {
        var id=$('#status').is(":checked");
        var l=0;
if(id)
{
    l=1;
}
$.ajax({
          type:'get',
          dataType:'html',
          url:'/inspector/changestatus?status='+l+'&id='+{{$data->employer_id}},
          success:function(data){
            swal({
title: "Status Changed",
text: "Employee Status changed",
icon: "success",
button: "Go Back",
})
          }
         });
 

});

function myFunction(l)
{
    $.ajax({
          type:'get',
          dataType:'html',
          url:'/inspector/changestatus?status='+l+'&id='+{{$data->employer_id}},
          success:function(data){
            swal({
title: "Status Changed",
text: "Employee Status changed",
icon: "success",
button: "Go Back",
})
          }
         });
}
    </script>
@endsection

