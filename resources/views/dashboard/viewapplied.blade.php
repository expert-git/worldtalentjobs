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
                        <li><a href="#">Profile</a></li>
                        <li class="active_link21"><a href="#">Job</a></li>
                        <li><a href="#">Candidates</a></li>
                        <li><a href="#">Message</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:80px;" class="container">
	
		
		<div style="" class="col-md-10" >
	
		
		<div class="row">
			
			<div class="col-md-3 col-sm-12 message_userlist">
				<h4>Applicants</h4>
				<ul>
					 
                    @foreach($ap as $job)
					<li>
						<a href="/inspector/viewapplied/{{$id}}/{{$jid}}">
							<span class="logo1">
								<img src="img/photo2.jpg">
							</span>
							<span class="whatsdesc">
								<h3>{{$job->full_name}}</h3>
								<p>{{$job->jobtitle}}</p>
								
							</span>
						</a>
					</li>
                    @endforeach
					 
				</ul>
			</div>
			
			
			<div class="col-md-9">
				<div class="inner_border">
					<div class="row padding_row">
						<div class="col-md-offset-1 col-md-6 col-md-6 col-sm-12 top_contet2">
								<h3>{{$job->full_name}}</h3>
							<p>{{$job->jobtitle}}<br /><b>{{$job->company_name}}</b></p>
								
						</div>
						
						<div class="col-md-5 pull-right">							
							<span class="markspan markspan2">Reject</span>	
							<span class="message message2"> Accept </span>
							<span class="message message2"> <i class="fa fa-print" aria-hidden="true"></i> Print </span>				
						</div>
					</div>
					
					<hr style="margin-bottom:0px;" />
					<div class="row padding_row">
						<div class="col-md-12"><h3 class="headh3">Application Info</h3></div>
							
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Reference Id:</div>
							<div class="col-md-7 col-xs-6">23354</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Current Status</div>
							<div class="col-md-7 col-xs-6">Active</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Job Location:</div>
							<div class="col-md-7 col-xs-6">Qatar</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue">Country:</div>
							<div class="col-md-7">Qatar</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue">Date of Post:</div>
							<div class="col-md-7">{{$job_description->created_at}}.</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue">Date of Expiery:</div>
							<div class="col-md-7">{{$job_description->deadline}}</div>
						</div>
						
					</div>


					<hr style="margin-bottom:0px;" />
                    <div class="row padding_row">
                    	<div class="form-row">
	                        <div class="col-md-12"><h3 class="headh3">Employer Details</h3></div>
	                    </div>

	                    <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Employer Id:</div>
                            <div class="col-md-7 col-xs-6">#{{$job_description->employer_id}}</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Email Name:</div>
                            <div class="col-md-7 col-xs-6">{{$job_description->username}}</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Email Address:</div>
                            <div class="col-md-7 col-xs-6">{{$job_description->ContactEmail}}</div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Mobile Number:</div>
                            <div class="col-md-7 col-xs-6">{{$job_description->ContactPhone}}</div>
                        </div>

                         <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Website:</div>
                            <div class="col-md-7 col-xs-6">{{$job_description->websiteaddress}}</div>
                        </div>
                       </div>

					
					<hr style="margin-bottom:0px;" />
					<div class="row padding_row">
						<div class="col-md-12"><h3 class="headh3">Candidate Info</h3></div>
							
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Career Level:</div>
							<div class="col-md-7 col-xs-6">{{$job->target_career_level}}</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Experience:</div>
							<div class="col-md-7 col-xs-6">{{$job->target_career_level}}</div>
						</div>
						
						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Residence Location:</div>
							<div class="col-md-7 col-xs-6">Qatar/</div>
						</div>

						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Nationality:</div>
							<div class="col-md-7 col-xs-6">{{$job->jobseeker_nationality}}</div>
						</div>

						<div class="form-row">
							<div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Education:</div>
							<div class="col-md-7 col-xs-6">{{$job->education}}</div>
						</div>


					</div>
					
					<hr style="margin-bottom:0px;" />
					<div class="row padding_row">
						<div class="form-row">
							<div class="col-md-12"><h3 class="headh3">Job Description</h3></div>
						</div>
						<div class="form-row">
                           <div class="col-md-11 col-md-offset-1">
                           		{{$job_description->educational_qualification}}
                           		                        	
                           </div>
                           <br clear="all" />
                           
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
	
	
	
	.profile_link1 li a:link, .profile_link1 li a:visited{
		border:none;
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

	


@endsection