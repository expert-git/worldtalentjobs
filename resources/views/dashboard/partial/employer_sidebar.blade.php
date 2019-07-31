<div class="col-md-2">
            <div class="applyjob1img">
                <div class="accounimgpro">
				@if(file_exists($myprofile->companylogo))
					<img style="width:100px;" src="/{{$myprofile->companylogo}}">
				@else
					<img style="width:100px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png">
				@endif  
               
                <h1 class="Posthed">{{$myprofile->contactperson}}</h1>
            </div>

            <div class="row">
                <div class="acoonappnum">
                    <div class="col-md-6 col-xs-6">
                        <p class="Posthed" style="font-size:11px; color: #000;" class="accontappl"> Jobs Posted</p>
                        <p class="Posthed" style="font-size:25px;">{{$alljobs}}<span style="font-size:14px;"> (total)</span></p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p class="Posthed" style="font-size:11px; color: #000;"> Active Jobs</p>
                        <p class="Posthed" style="font-size:25px;">{{$active}}</p>
                    </div>
                </div>
            </div>
				
			<!--<a href="/employer/postajob"><button style="   
  
 
width: 170px;
height: 40px;
 
 

background: #E86850;
 			 
 
 
 

font-family: Raleway;
font-style: normal;
font-weight: bold;
line-height: normal;
font-size: 14px;
text-transform: uppercase;
color: #FFFFFF;	border-radius: 3px !important;							 
									 ">Post Job</button> </a>	
				
				
            <div class="aconntmenu">
               <a href="/employer/managejobs/0"> <h4 class="leftcont"><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon fas fa-list"></i> </div><div class="col-md-10 col-sm-10 col-xs-10"> Job</div></h2></a>
               <a href="/employer/getAllCandidates"> <h4  class="leftcont"><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon far fa-user"></i>  </div><div class="col-md-10 col-sm-10 col-xs-10"> Candidates </div></h2></a>
               <a href="/employer/message"> <h4 class="leftcont"><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon far fa-envelope"></i>  </div><div class="col-md-10 col-sm-10 col-xs-10"> Messages </div></h2></a>
               <a href="/employer/notifications"> <h4  class="leftcont"><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon fas fa-bell"></i> </div><div class="col-md-10 col-sm-10 col-xs-10">  Notications </div></h2></a>
               <a href="/employer/settings"> <h4  class="leftcont"><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon fas fa-pencil-alt"></i> </div><div class="col-md-10 col-sm-10 col-xs-10">  Edit Profile </div></h2></a>
            </div>-->
        </div> 
    </div>

	{{--<!--
  @if($emp->companylogo)
<img style="width:100px;" src="/{{$emp->companylogo}}">
@else
<img style="width:100px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png">
@endif  
		-->--}}

        <script>
        @if(isset($clss))
     //   alert({{$clss}});
        //$( ".aconntmenu a h4:nth-child({{$clss}})" ).addClass( "current" );
        @endif
        </script>