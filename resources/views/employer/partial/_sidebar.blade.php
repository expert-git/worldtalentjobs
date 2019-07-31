<div class="col-md-2">
            <div class="applyjob1img">
                <div class="accounimgpro">
				@if(file_exists($myprofile->companylogo))
					<img style="width:170px;" src="/{{$myprofile->companylogo}}">
				@else
					<img style="width:170px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png">
				@endif  
               
                <h1 class="Posthed">{{$myprofile->companyname}}</h1>
            </div>

            <div class="row">
                <div class="acoonappnum">
                    <div class="col-md-6 col-xs-6">
                        <p class="Posthed" style="font-size:14px; color: #000;" class="accontappl"> Jobs Posted</p>
                        <h1 class="Posthed">{{$alljobs}}<span style="font-size:10px;"> (total)</span></h1>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p class="Posthed" style="font-size:14px; color: #000;"> Active Jobs</p>
                        <h1 class="Posthed">{{$active}}</h1>
                    </div>
                </div>
            </div>
				
			<a href="/employer/postajob"><button class="postjob" @if($pageno==0) disabled @endif>Post a Job</button> </a>	
				
				
            <div class="aconntmenu">
               <a href="/employer/managejobs"> <h4 @if($pageno==1) class="current" @else class="leftcont" @endif><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon fas fa-list" @if($pageno==1) style="color:blue;" @endif></i> </div><div class="col-md-10 col-sm-10 col-xs-10"> Jobs</div></h2></a>
               <a href="/employer/getAllCandidates"> <h4  @if($pageno==2) class="current" @else class="leftcont" @endif><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon far fa-user" @if($pageno==2) style="color:blue;" @endif></i>  </div><div class="col-md-10 col-sm-10 col-xs-10"> Candidates </div></h2></a>
               <a href="/employer/message/0"> <h4 @if($pageno==3) class="current" @else class="leftcont" @endif><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon far fa-envelope" @if($pageno==3) style="color:blue;" @endif></i>  </div><div class="col-md-10 col-sm-10 col-xs-10"> Messages </div></h2></a>
               <a href="/employer/notifications"> <h4  @if($pageno==4) class="current" @else class="leftcont" @endif><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon fas fa-bell" @if($pageno==4) style="color:blue;" @endif></i> </div><div class="col-md-10 col-sm-10 col-xs-10">  Notifications </div></h2></a>
               <a href="/employer/settings"> <h4  @if($pageno==5) class="current" @else class="leftcont" @endif><div class="col-md-2 col-sm-2 col-xs-2"><i class="lefbaricon fas fa-pencil-alt" @if($pageno==5) style="color:blue;" @endif></i> </div><div class="col-md-10 col-sm-10 col-xs-10">  Edit Profile </div></h2></a>
            </div>
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