{{-- Header --}}
@extends('dashboard.layout.admin_layout')
@section('page_title')
HomePage
@endsection

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
    <div style="margin-top:5%;" class="container">
    <div class="row">   

      
    <div style="" class="col-md-10" >
		<div class="header_listtop dashbord_listtop">
			<ul>

      
				<li><a href="/inspector/jobdetail/{{$ida}}/0">Active Jobs ({{$active}})</a></li>
				<li><a href="/inspector/jobdetail/{{$ida}}/1">Expired ({{$passed}})</a></li>
				<li><a href="/inspector/jobdetail/{{$ida}}/2">Closed ({{$closed}})</a></li>
			</ul>
		</div>  
              @forelse($job as $j)
  
		<div class="row dashbord">
			<div class="col-md-8 col-sm-12">
				<h2>{{isset($j->jobtitle )?$j->jobtitle :NULL}}</h2>
				<div class="border-right left_content">
					<h3></h3>
					<p>{{isset($j->created_at )?$j->created_at :NULL}}</p>
				</div>

         @foreach(explode(',',$j->job_responsibilities) as $info) 
         <span class="border1">{{$info}}</span>
  @endforeach
			
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="action_buttons">
					<span class="edit_button"><a href="/inspector/editajob/{{$j->id}}">EDIT</a></span>
					<span class="more_icon"><a href="#">...</a></span>
					<div class="actions_buttons2" style="display:none;">
						<img class="top_arrow" src="/img/arrowtop.jpg" />						
						<div class="editicons23">
							<div><a href="/employer/changestatus/{{$j->id}}"><img src="/img/close.jpg" style="padding-top: 10px; padding-right: 10px; float: left;"> Close</a></div>
							<div><a href="/employer/changestatus/{{$j->id}}"><img src="/img/delete.jpg" style="padding-top: 10px; padding-right: 10px; float: left;"> Delete</a></div>
							<br clear="all" />
						</div>
						<br clear="all" /><br clear="all" /><br clear="all" /><br clear="all" />
					</div>
				</div>
			
				<div class="row" style="padding-top:10px;">
					<div class="col-md-7 col-xs-7">Status</div>
					<div class="col-md-5 col-xs-5 text-right"><img src="/img/available.jpg" style="padding-top: 10px; float: left;">  {!!isset($j->published) && $j->published == '1'?'<span >Approved</span>':'<span >Pending</span>'!!}</div>
					<div class="col-md-7 col-xs-7">Expire in</div>
					<div class="col-md-5 col-xs-5 text-right">  {{$j->deadline}}</div>
					<div class="col-md-7 col-xs-7">Total Views</div> 
					<div class="col-md-5 col-xs-5 text-right"> 1</div>
				</div>
				
				
				
				
			</div>
			
			
			
			<div class="row">
				<div class="col-md-12 title_tag">
    	<div class="col-md-12">
					<h3>Applicants</h3>
    </div>
				</div>
				
<div class="col-md-12 text-center" style="padding:0 30px;">

@if (!$applied2[$j->id])
<div class="notification_1 col-md-12" >

					No Applicants yet!<!--<a href="/employer/invites/{{$j->id}}"> <b style="color:#7889ff;">Invite</b> </a> top candidates before they are booked--></div>
        
        @else
        <div class="notification_2 col-md-12" >

       <a href="/inspector/getCandidates/{{$ida}}/{{$j->id}}/0"> <h3>Applicants <span style="color:#e86850;">({{$applied2[$j->id]}})</span></h3>	</a>	

        </div>
        @endif

				</div>
				<div class="col-md-12">
					<div class="col-md-12" style="padding-top:10px;">
						<hr />
					</div>
				</div>
				
			</div>
		
		</div>
		
    @empty
              <p class="text-warning">No Job Found</p>
              
              @endforelse
              <div class="text-center"> {{$job->links()}}</div>
              

              
		
	

		 
		
		
		
		
		
		
		
		
		
		


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
	
	<style>
		.row{
			clear:both;
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
	
	
@endsection