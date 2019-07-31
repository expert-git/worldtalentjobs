@extends('dashboard.layout.admin_layout')
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


@section('content')
<section>
    <div style="margin-top:80px;" class="container">
		<h4>Notifications</h4>
		<div>
			<h2>Employers</h2>
    @forelse($employers as $j)
		<div class="col-md-12" style="background:#fff;padding:15px;box-shadow:-7px 8px 55px -5px rgba(0,0,0,0.2);border-radius: 3px;margin-bottom:20px; margin-top:30px;">
			<div class="row canditate_list" >
				<div class="col-md-2">
					@if(file_exists($j->companylogo))
						<img width="100" height="100" src="{{url($j->companylogo)}}" alt="">
					@else
						<img width="100px" height="100px" src="{{url('/storage/profile/FOLuvyTwnmWNya5RXpO4SCqJ5lzviVj1mEEk2y0o.jpeg')}}" alt="">
					@endif
				</div>
				<div class="col-md-3 col-sm-6">
					<div >
						<h3><a href="{{url('/inspector/employerdetails/'.$j->id)}}">{{$j->fname}} {{$j->lname}}</a></h3>
						<p><a href="{{url('/inspector/employerdetails/'.$j->id)}}">Approval has been requested</a> </p>
					</div>
				</div>
				
				<div class="col-md-6 pull-right">
					<span style="color: #A6B1BE; font-size: 14px; float: right">{{\Carbon\Carbon::parse($j->created_at)->diffForHumans()}}</span>
				</div>
			</div>
			
			
			<div class="row canditate_details">
				<div class="col-md-4">
				
				</div>
				
					<div >


						<span style="float:right; margin-right: 20px; font-size: 15px;"><a style="color: #e86850;"  href="{{url('/inspector/deleteaccount/'.$j->id)}}">Delete</a>
						</span>
					
					
					</div>
				
				
			</div>
			
			
		</div>
		 
	
    @empty
              <p class="text-warning">Nothing found</p>
              
              @endforelse
              <div class="text-center"> {{$employers->links()}}</div>


		</div>
		<div>
			<h2>Jobseeker</h2>
			@forelse($jobseeker as $k)
				<div class="col-md-12" style="background:#fff;padding:15px;box-shadow:-7px 8px 55px -5px rgba(0,0,0,0.2);border-radius: 3px;margin-bottom:20px; margin-top:30px;">
					<div class="row canditate_list" >
						<div class="col-md-2">
							@if(file_exists($k->companylogo))
								<img width="100" height="100" src="{{url($j->companylogo)}}" alt="">
							@else
								<img width="100px" height="100px" src="{{url('/storage/profile/FOLuvyTwnmWNya5RXpO4SCqJ5lzviVj1mEEk2y0o.jpeg')}}" alt="">
							@endif
						</div>
						<div class="col-md-3 col-sm-6">
							<div >
								<h3><a href="{{url('/inspector/jobseekerdetails/'.$k->id)}}">{{$k->name}}</a></h3>
								<p>Approval has been requested </p>
							</div>
						</div>

						<div class="col-md-6 pull-right">
							<span style="color: #A6B1BE; font-size: 14px; float: right">{{\Carbon\Carbon::parse($k->created_at)->diffForHumans()}}</span>
						</div>
					</div>


					<div class="row canditate_details">
						<div class="col-md-4">

						</div>

						<div >


						<span style="float:right; margin-right: 20px; font-size: 15px;"><a style="color: #e86850;"  href="{{url('/inspector/jbs/deleteaccount/'.$k->id)}}">Delete</a>
						</span>


						</div>


					</div>


				</div>


			@empty
				<p class="text-warning">No one needs for Approval</p>

			@endforelse
			<div class="text-center"> {{$jobseeker->links()}}</div>


		</div>
	</div>


</section>
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css">





	<style>
		.table-bordered>tbody>tr>td{
			color:#000;
		}
		.row{
			clear:both;
		}
		
		.textcenter img{
			height: auto;
    display: inline-block;
    text-align: center;
		}
		
		.btn296{
			margin: 0 10px 0 10px;
    padding: 3px 10px;
    border: 1px solid #000;
    color: #000;
    border-radius: 5px;
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

	