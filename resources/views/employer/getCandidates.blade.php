

{{-- Header --}}
@extends('public.layout.public_layout')

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
    <div style="margin-top:2%;    " class="container">
    <div class="row">   
    @include('employer.partial._sidebar')


      
    <div style="" class="col-md-8" >
		<div class="header_listtop">
			<ul>
				<li><a href="/employer/getCandidates/{{$id}}/0">All ({{$all}})</a></li>
				<li><a href="/employer/getCandidates/{{$id}}/1">Shortlisted ({{$shortlisted}})</a></li>
				<li><a href="/employer/getCandidates/{{$id}}/2">Rejected ({{$rejected}})</a></li>
				<li><a href="/employer/getCandidates/{{$id}}/3">Scheduled for interview ({{$scheduled}})</a></li>
				<li><a href="/employer/getCandidates/{{$id}}/4">SPAM ({{$spam}})</a></li>
			</ul>
		</div>   

    
    @forelse($applicants as $j)
		<div class="col-md-12" style="background:#fff;padding:15px;box-shadow:-7px 8px 55px -5px rgba(0,0,0,0.2);border-radius: 3px;margin-bottom:20px; margin-top:30px;">
			<div class="row canditate_list" >
				<div class="col-md-3 col-sm-6">
					<div class="border-right">
						<h3 >{{$jobdata->jobtitle}}</h3>
						<p class="names"  jobid="{{$j->job_id}}" id="{{$j->aj}}">Schedule Interview</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">

                   @foreach(explode(',',$jobdata->job_responsibilities) as $info) 
         <span class="border1">{{$info}}</span>
  @endforeach
				
				</div>
				<div class="col-md-6 pull-right">
				<a href="/createConversation/{{$j->jobseeker_id}}">	<span class="message"> <i class="far fa-envelope"></i> Message </span></a>
				<a href="/employer/changeCandidatestatus/{{$j->aj}}/4">	<span class="markspan">Mark as Spam</span>	</a>				
				</div>
			</div>
			
			
			<div class="row canditate_details">
				<div class="col-md-4">
				<a href="/employer/jobdetails/{{$j->job_id}}/{{$j->jobseeker_id}}">	<h3>{{isset($j->full_name )?$j->full_name :NULL}}</h3>
					<p>{{$j->jobseeker_nationality}}</p>
				</div>
				<div class="col-md-3">
					<div class="border-right">
						<div class="col-md-7">Visa Type</div>
						<div class="col-md-5 text-center">Work</div>
						<div class="col-md-5">NOC</div>
						<div class="col-md-7 text-center"><img src="/img/available.jpg" style="padding-top: 10px; float: left;"> Available</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="col-md-7">Current locations</div>
						<div class="col-md-5 text-center">{{$j->jobseeker_current_location}}</div>
						<div class="col-md-6">Salary Range</div>
						<div class="col-md-6 text-center">{{$j->expected_salary}}</div>
				</div>
			</div>
			
			
		</div>
		 
	
    @empty
              <p class="text-warning">No Candidates Found</p>
              
              @endforelse
              <div class="text-center"> {{$applicants->links()}}</div>
              

              
		

		
		


    </div>



       @include('employer.partial._right_sidebar')
</div>


</section>

	

    <script>
    $(".names").on("click",function(){
       
            swal({
                 title: "Schedule Interview",
                 content: {
                       element: "input",
                       attributes: {
                            placeholder: "Type your password",
                            type: "datetime-local",
                            },
                            },
                }).then((time) => {
                     if (time) {
                        let jid=($(this).attr("id"))
                        let jobid=($(this).attr("jobid"))
                        window.location="/employer/changeCandidatestatus/"+jid+"/3?jobid="+jobid+"&time="+time;
                          }
                          });

    });
    </script>
  @endsection