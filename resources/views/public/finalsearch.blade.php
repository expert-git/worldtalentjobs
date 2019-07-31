	@extends('public.layout.public_layout')
	@section('page_title')
	Search
	@endsection
	@section('style')
	{{Html::style('css/search.css')}}
	<style type="text/css">
		.search {
		margin-top: 5px;
		margin-bottom: 10px;
		}
		.headline3 a {
		text-decoration: none;
		}
		.panel.heading {
		padding: 10px 15px;
		}

		<style type="text/css">
			div.checkbox{
				max-height: 200px;
				width: 100%;
				overflow: auto;
				float: left;
			}
		</style>
	</style>
	@endsection
	@section('content')


		<div class="wrapper">
			<div class="container">
			{{-- Start search --}}

			{{-- End search --}}
				<div class="row">
				<div class="col-xs-12"> 
					<div class="row heading-wrapper">
						<div class="col-xs-12">
						
							{{-- <h1 class="search" data-automation="jobseeker-job-count"> @if(isset($countTotalSearchableJob)){{$countTotalSearchableJob}} @endif 
								@if(isset($_GET['category']))
								
								@foreach($_GET['category'] as $cat) @php $array[]=$catMachingName[$cat]; @endphp
								@endforeach {{implode(',',$array)}}

								@endif 



								jobs in
								@if(isset($_GET['industry']))
								
								@foreach($_GET['industry'] as $industry) @php $industryarray[]=$industryMachingName[$industry]; @endphp
								@endforeach {{" for ".implode(',',$industryarray)}}

								@endif 


								@if(isset($_GET['location']))
								
								@foreach($_GET['location'] as $loc) @php $locarray[]=$locMachingName[$loc]; @endphp
								@endforeach {{"in ". implode(',',$locarray)}}

								@endif  </h1> --}}
						</div>
					</div>           
				</div>
				</div>


			<div class="row content-wrapper">
				<div class="col-md-3" style="box-shadow: 0px 3px 49px rgba(0, 0, 0, 0.2); background-color:#fff; padding:30px 30px;">
					<button id="search-collapse-filters" class="btn btn-default icon-minus-circled search-panel-button hidden-lg hidden-md" rel=".search-panel-trigger" type="button">Collapse/expand all filters</button>
					
					<div class="facets-wrapper">
						<div class="row">
					
						<p ><i class="fa fa-filter" aria-hidden="true"></i><span style="font-weight:600;float:right;color:black">Filter</span></p>
						
						<form action="search" id="filterform">

						<input type="text" name="keyword" style="background: rgba(166, 177, 190, 0.3);width:100%;">
						<p></br><b >Location</b></p>
						<hr>

	<div class="checkbox">
											@forelse($divisions as $div)
											<p><label><input type="checkbox" @if($count_by_div[$div->id]==0){{"disabled"}}@endif @if(isset($_GET['location']) &&in_array($div->id, $_GET['location']))
											{{'checked'}}@endif name="location[]" value="{{$div->id}}">{{$div->name." (".$count_by_div[$div->id].")"}}</label></p>
											@empty
											no location found
											@endforelse
											</div>
	<p >Scroll To view more<span style="float:right;">....</span></p>

	<p></br><b>Company industry</b></p>

		<div class="checkbox">
											@forelse($get_ind as $ind)
											<p><label><input type="checkbox" @if($pic[$ind->id]==0){{"disabled"}}@endif  @if(isset($_GET['industry']) &&in_array($ind->id, $_GET['industry']))
											{{'checked'}}@endif name="industry[]" value="{{$ind->id}}">{{$ind->industrytypename." (".$pic[$ind->id].")"}}</label></p>
											@empty
											no Industry type found
											@endforelse
											</div>


											<p></br><b>Job Category</b></p>

	<div class="checkbox">
							
											
							@forelse($categorysForCountJob as $cfc)

							<p><label><input type="checkbox" @if($countCategoryWiseJob[$cfc->id]==0){{"disabled"}}@endif @if(isset($_GET['category']) &&in_array($cfc->id, $_GET['category']))
							{{'checked'}}@endif  name="category[]" value="{{$cfc->id}}">{{$cfc->	catagoryname." (".$countCategoryWiseJob[$cfc->id].")"}}</label></p>
							@empty
							no Industry type found
						@endforelse
						</div>


									<!--	<p></br><b>Date Posted</b></p>

	<div class="checkbox">
											
											<p><label><input type="checkbox" name="date[]" @if(isset($_GET['date']) && in_array('t', $_GET['date']))
											{{'checked'}}@endif @if($todays_job=='0'){{"disabled"}} @endif value="t"> today ({{$todays_job}})</label></p>
											<p><label><input type="checkbox" name="date[]" @if(isset($_GET['date']) && in_array('p2', $_GET['date']))
											{{'checked'}}@endif   @if($two_days_agos_job=='0'){{"disabled"}} @endif value="p2"> Past 2 days ({{$two_days_agos_job}})</label></p>
											<p><label><input type="checkbox" name="date[]" @if(isset($_GET['date']) && in_array('p7', $_GET['date']))
											{{'checked'}}@endif  @if($seven_days_agos_job=='0'){{"disabled"}} @endif value="p7"> Past 7 days  ({{$seven_days_agos_job}})</label></p>
											<p><label><input type="checkbox" name="date[]" @if(isset($_GET['date']) && in_array('p30', $_GET['date']))
											{{'checked'}}@endif  @if($last_months_job=='0'){{"disabled"}} @endif value="p30"> Past 30 days  ({{$last_months_job}})</label></p>
										</div>
-->
										<p></br><b>Company Name</b></p>

	<div class="checkbox">
											@if(isset($companyName) && count($companyName)>0)
											@forelse($companyName as $com)
											@if($com->companyname)
											<p><label><input type="checkbox" name="company_id[]" @if($countCompanyWiseJob[$com->id] == "0") {{"disabled"}} @endif value="{{$com->employer_id}}">{{$com->companyname}}({{$countCompanyWiseJob[$com->id]}})</label></p>
											@endif
											@empty
											<h2>No company found</h2>
											@endforelse
											@endif
											</div>


		<p></br><b>Job Type</b></p>
											<div class="checkbox">
										<p><label><input type="checkbox" name="jobtype[]"  @if(isset($_GET['jobtype']) && in_array('full-time', $_GET['jobtype']))
											{{'checked'}} @endif @if($jobtypecount[0]=='0'){{"disabled"}} @endif value="full-time">Full Time ({{$jobtypecount[0]}})</label></p>
											<p><label><input type="checkbox" name="jobtype[]" @if(isset($_GET['jobtype']) && in_array('part-time', $_GET['jobtype']))
											{{'checked'}}@endif @if($jobtypecount[1]=='0'){{"disabled"}} @endif value="part-time">Part Time ({{$jobtypecount[1]}})</label></p>
										<p><label><input type="checkbox" name="jobtype[]"  @if(isset($_GET['jobtype']) && in_array('contactual', $_GET['jobtype']))
											{{'checked'}}@endif @if($jobtypecount[2]=='0'){{"disabled"}} @endif value="contactual">contactual ({{$jobtypecount[2]}})</label></p>
											
											</div>
							
						</div>	
					</div>	
				</div><!--end col-md-4-->
				
				<div class="col-md-8">


				<!--<div class="row">
					<div class="btn-group col-sm-12">
					<select id="sehortby" name="shortby" data-toggle="dropdown" class="btn btn-default dropdown-toggle pull-right" style="text-transform: uppercase;">Sort By Date Posted <span class="caret"></span>

						<ul class="dropdown-menu noclose">

						<li><option value="jobs.created_at desc" @if(isset($_GET['shortby']) && $_GET['shortby']=="jobs.created_at desc")) {{"selected"}} @endif >Date Posted</option></li>
						<li><option value="jobs.jobtitle asc"  @if(isset($_GET['shortby']) && $_GET['shortby']=='jobs.jobtitle asc')) {{"selected"}} @endif >Job title</option></li>
					Other items 
						</ul>
					<select>
					</div>
					<form>
				</div>-->

			{{--  @if(isset($searchableQuery) && count($searchableQuery)>0)
					
					@foreach($searchableQuery as $job)
					<div class="well">
							
					
						<div class="row">
							<div class="col-sm-12">
								<h4 class="text-success">{{ $job->companyname }}</h4>
							</div>
							<div class="col-sm-12">

								<h3>{{ $job->jobtitle }}</h3>
							</div>
							<div class="col-sm-12">
								<div class="row">
								<div class="col-sm-9">
									<div class="row">
										<div class="col-sm-3">Education:</div>
										<div class="col-sm-9">
											{{ $job->educational_qualification }}
										</div>
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-3">Experience:</div>
									<div class="col-sm-9">
										{{ $job->job_experiences_year }} at {{ $job->job_experiences_field }}
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								Deadline: {{ $job->deadline }}
							</div>
						</div>
	--}}
		<div class="row">
			<div class="btn-group col-sm-12">

			<div class="col-md-8" style="padding-left: 5%;">

	<h3><a href="accounting.php"> @if(isset($_GET['category']))
									
									@foreach($_GET['category'] as $cat) @php $array[]=$catMachingName[$cat]; @endphp
									@endforeach {{implode(',',$array)}}
									jobs  
									@endif 



									
									@if(isset($_GET['industry']))
								
									@foreach($_GET['industry'] as $industry) @php $industryarray[]=$industryMachingName[$industry]; @endphp
									@endforeach {{" for ".implode(',',$industryarray)}}

									@endif   @if(isset($_GET['location']))
									
									@foreach($_GET['location'] as $loc) @php $locarray[]=$locMachingName[$loc]; @endphp
									@endforeach {{"in ". implode(',',$locarray)}}

									@endif </a></h3>
	<p><a href="accounting.php">@if(isset($countTotalSearchableJob)){{$countTotalSearchableJob}} @endif  jobs found:showing1-20</a> </p>
	</div>
	<div class="col-md-4">
	<select id="shortby" name="date[]" data-toggle="dropdown" class="btn btn-default dropdown-toggle pull-right" style="height:57px;background: #FFFFFF;opacity: 0.8;box-shadow: 0px 3px 49px rgba(0, 0, 0, 0.2);border-radius: 3px;float:right">Sort By Date Posted <span class="caret"></span>
<ul class="dropdown-menu noclose">
print_r($_GET);
<li><option value="p2"  @if(isset($_GET['date']) && in_array('p2', $_GET['date']))	{{'checked'}} @endif      >Past 2 days  ({{$two_days_agos_job}})</option></li>
<li><option value="p7"  @if(isset($_GET['date']) && in_array('p7', $_GET['date']))	{{'checked'}} @endif   >Past 7 days  ({{$seven_days_agos_job}})</option></li>
<li><option value="p30"  @if(isset($_GET['date']) && in_array('p30', $_GET['date']))	{{'checked'}} @endif      >Past 30 days  ({{$last_months_job}})</option></li>

 <!-- Other items -->
</ul>
</select>


	</div>

			</div>
		</div>

<div class="joblist" style="padding-left:5%;">
		@if(isset($searchQuery) && count($searchQuery)>0)
					
			@forelse($searchQuery as $job)

			<div class="col-md-12" style="background:#fff;padding-left:0px;padding-right:0px;box-shadow:-7px 8px 55px -5px rgba(0,0,0,0.2);border-radius: 3px;margin-bottom:20px; margin-top:30px;">
		
	<div class="col-md-3" style="padding-right: 0px;padding-left:0px;">

	@if($job->companylogo)
	<img style="max-width:100%; min-height:100%" src="{{$job->companylogo}}">
				@else
				<img style="max-width:100%; min-height:100%" src="https://remotive.io/wp-content/uploads/2018/10/Crossover-logo-remotive.jpg">
			@endif
	
	</div>
	<div class="col-md-9">
	<p>
	<h3><a style="color:#7889FF;font-weight:bold" href="/showdetails/{{$job->id}}">{{$job->jobtitle}} <small style="font-size: 18px;">{{"(".$job->jobtype.")"}}</small></a> <small style="float:right" class="text-muted">{{substr($job->created_at,0,strpos($job->created_at," "))}}</small></h3>
	<p><a style="color:#a6b1be" href="/showdetails/{{$job->id}}">{{ $job->companyname }} - 		{{ $job->div_name }}   @php
						$modified=explode(' ',$job->jobtitle);
							
							$slice=array_slice($modified,-2);
							//print_r($slice);
							$final= implode(' ',$slice);
							echo $final;

							@endphp</a></p>
	
	<p style="line-height:20px;height:60px;overflow:hidden">{{$job->educational_qualification}} </p>
	</div>
	</div>
				
				@empty
				<h2>NO jobs Found </h2>`
				@endforelse
					{{$searchQuery->links()}}
				@endif
</div>
			</div>
			</div>	
						
			</div><!--container end-->
			@section('script')


			{{Html::script('')}}
			@endsection
			<style>
			.checkbox{
    max-height: 150px;
    overflow: scroll;
}
			</style>
			@endsection
