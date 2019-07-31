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

<section class="row">
    <div class="col-md-10 col-md-offset-1">
		
		<div class="row">
			<div class="col-md-8">
				<div class="row" style="padding-top:20px;">
					<div class="col-md-12">
						<div id="chartContainer" style="width: 100%;">
							<span class="Posthed">ANALYTICS</span>
						<canvas id="canvas"></canvas>
						</div>
					</div>
				</div>
				<div class="row" style="padding-top:25px;">
					<div class="col-md-12">
						<h3 class="Posthed">Recent Jobs</h3>
						@foreach($job as $j)
						<div class="row dashbord">
							
								<div class="col-md-8 col-sm-12">
									<h2>{{$j->jobtitle}}</h2>
									<div class="border-right left_content">
										<h3>{{$j->company_name}}</h3>
										<p>{{$j->created_at}}</p>
									</div>
									
									<div class="notification_24 text-center">
										<h3>Applicants <span style="color:#e86850;">({{$applied2[$j->id]}})</span></h3>	
			
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="row" style="padding-top:10px;">
										<div class="col-md-7 col-xs-7">Status</div>
										<div class="col-md-5 col-xs-5 text-right"><img src="/img/available.jpg" style="padding-top: 10px; float: left;">  Available</div>
										<div class="col-md-7 col-xs-7">Expires in</div>
										<div class="col-md-5 col-xs-5 text-right">  {{$j->deadline}}</div>
										 
									</div>
								</div>
							</div>
						@endforeach
						
					</div>
				</div>			
			</div>
			
			
			<div class="col-md-3 col-md-offset-1">
				<div class="row side_bar" style="margin-top:50px;">
					<div class="col-md-8 col-xs-8"><h3>TOTAL <br />JOB SEEKERS</h3></div>
					<div class="col-md-4 text-center textcenter col-xs-4"><img src="/img/green.png" /><p>{{$jobs}}</p></div>
				</div>
				<div class="row side_bar">
					<div class="col-md-8 col-xs-8"><h3>TOTAL <br />JOB EMPLOYERS</h3></div>
					<div class="col-md-4 text-center textcenter col-xs-4"><img src="/img/blue.png" /><p>{{$js}}</p></div>
				</div>
				<div class="row side_bar">
					<div class="col-md-8 col-xs-8"><h3>TOTAL <br />JOBS</h3></div>
					<div class="col-md-4 text-center textcenter col-xs-4"><img src="/img/red.png" /><p>{{$emp}}</p></div>
				</div>
				
				
				<div class="row side_bar" style="margin-top:50px;">
					<div class="col-md-12 ">
						<h4 class="sidenotifi">Recent Notifications</h4>
						
						@foreach($employers as $emp)
						
						<div class="row" style="margin-top:20%">
					
						<div class="col-md-4 col-xs-4">
						
						<div class=""><img width="80px;" src="/empimage/{{$emp->id}}"></div>
						</div>
						<div class="col-md-8 col-xs-8">
						<h6><a href="/inspector/employerdetail/{{$emp->id}}">{{$emp->name}} </a></h6>
						<h6 class="croshour">{{$emp->created_at}}</h6>
						<br>
						</div>
						</div>
						
						<hr style="max-width:400px; border:1px solid #999; text-align:left; margin-top:20px;">
								 
								  
								 
								  @endforeach
							 
				</div>
			</div>			
		</div>
	
	</div>


</section>
@endsection
	
 @section('script')
<script src="{{url('/js/Chart.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>

<script>
		window.chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)'
		};

	var config = {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March','April','May','June','July','August','September','October','November','December'],
				datasets: [{
					label: 'Jobs',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
						@foreach($jobcount as $js)
						{{$js->cnt}},
						@endforeach
					
					],
				}, {
					label: 'Job Seekers',
					fill: false,
					backgroundColor: window.chartColors.green,
					borderColor: window.chartColors.green,
					data: [
						@foreach($jscount as $js)
						{{$js->cnt}},
						@endforeach
					],
				}, {
					label: 'Employers',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [
						@foreach($empcount as $js)
						{{$js->cnt}},
						@endforeach
					],
					fill: true,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: ''
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
	</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	@endsection
@section('style')
	<style>
		.row{
			clear:both;
		}
		
		.textcenter img{
			height: auto;
    display: inline-block;
    text-align: center;
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