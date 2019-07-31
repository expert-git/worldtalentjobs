

@extends('public.layout.public_layout')
@section('page_title')
Search
@endsection
@section('style')
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

	.filter-box {
		max-height: 420px;
		/* height: 400px; */
		width: 100%;
		overflow-y: auto;
		overflow-x: hidden;
	}

	li label {
		font-size: 18px!important;
	}

	li .checkbox{
		height:38px;
	}

	div.checkbox label{
		font-size: 18px!important;
	}

	div.checkbox p{
		margin-bottom: 22px;
	}
</style>
@endsection
@section('content')
<div class="wrapper">
	<div class="container" style="width:90%;">
		<div class="row content-wrapper" style="margin-top:30px;">
			<form action="{{url('search')}}" id="filterform">

				<div class="col-md-3"
					style="box-shadow: 0px 3px 49px rgba(0, 0, 0, 0.2); background-color:#fff; padding:20px 50px;">
					{{-- <button id="search-collapse-filters"
						class="btn btn-default icon-minus-circled search-panel-button hidden-lg hidden-md" rel=".search-panel-trigger"
						type="button">Collapse/expand all filters</button> --}}

					<div class="row">
						<button style="background:none;" id="filterbtn"><i style="font-size:20px;color:#7889FF;" class="fas fa-sort-amount-down" aria-hidden="true"></i></button>
						<div class="searchbox1">
						<input type="text" name="keyword" @isset($keyword) value="{{$keyword}}" @endisset>
							<a id="searchbtn" href="#"><i class="fas fa-search"></i></a>
						</div>

						{{-- ======================= location start ======================= --}}
						<h3><b>Location</b></h3>
						<hr style="margin-bottom:5px;border-width:2px 0 0;">
						<div id="accordion-city" class="locationlist">
							<ul>
								<li>
									<div class="checkbox checkbox-primary">
										<input type="checkbox" id="all_city_area" name="all_city_area">
										<label for="all_city_area">
											All
										</label>
									</div>
								</li>
								@foreach($city_areas as $city)
								<li>
									<div class="checkbox checkbox-primary">
										<input type="checkbox" id="city_area{{$city['id']}}" data-type="city" data-id="{{$city['id']}}"
											@if($count_by_div[$city['id']]==0) disabled @endif 
											data-name="{{$city['name']}}" @isset($location_select[$city['id']]) checked @endisset>
										<label for="city_area{{$city['id']}}">
											{{$city['name']}} ({{$count_by_div[$city['id']]}})
										</label>
										<a style="float:right;" href="#collapse_city{{$city['id']}}" data-toggle="collapse"
											aria-expanded="false"><i class="fas fa-chevron-down"></i></a>
									</div>

									<ul class="collapse" id="collapse_city{{$city['id']}}">
										@foreach($city['areas'] as $area)
										<li>
											<div class="checkbox checkbox-primary">
												<input type="checkbox" id="city_area{{$area['id']}}" data-type="area" name="location[]"
												@if($count_by_div[$area['id']]==0) disabled @endif
												data-parid="{{$city['id']}}" data-id="{{$area['id']}}" data-name="{{$area['name']}}" value="{{$area['id']}}"
												@isset($location_select[$area['id']]) checked @endisset>
												<label for="city_area{{$area['id']}}">
													{{$area['name']}} ({{$count_by_div[$area['id']]}})
												</label>
											</div>
										</li>
										@endforeach
									</ul>
								</li>
								@endforeach
							</ul>
						</div>
						<p style="color:#a6b1be;cursor:pointer;" class="showmore" data-id="city">Show More<span style="float:right;"><i
									class="fas fa-ellipsis-h" style="font-size: 18px;"></i></span></p>
						{{-- ======================= location end ======================= --}}
						{{-- ======================= job category start ======================= --}}
						<!--<h3><br><b>Job Category</b></h3>
						<hr style="margin-bottom:5px;border-width:2px 0 0;">

						<div class="filter-box">
							<?php $cnt=0 ?>
							<div class="checkbox checkbox-primary">
								<input type="checkbox" id="all_job_category" name="all_job_category">
								<label for="all_job_category">All</label>
							</div>
							@forelse($categorysForCountJob as $cfc)
							<div class="checkbox checkbox-primary @if($cnt>6) additional_category @endif" style="@if($cnt>6) display:none; @endif margin-top:20px; margin-bottom:20px;">
								<input type="checkbox"
									@if($countCategoryWiseJob[$cfc->id]==0){{"disabled"}}@endif
									name="category[]"
									id="category_{{$cfc->id}}"
									@isset($category_select[$cfc->id]) checked @endisset
									value="{{$cfc->id}}">
								<label for="category_{{$cfc->id}}">{{$cfc->catagoryname." (".$countCategoryWiseJob[$cfc->id].")"}}</label>
							</div>
							<?php $cnt++ ?>
							@empty
							no Job Category found
							@endforelse
						</div>
						<p style="color:#a6b1be;cursor:pointer;" class="showmore" data-id="category">
							Show More
							<span style="float:right;">
								<i class="fas fa-ellipsis-h" style="font-size: 18px;"></i>
							</span>
						</p>-->
						{{-- ======================= job category end ======================= --}}

						{{-- ======================= job type start ======================= --}}
						<h3><br><b>Employment Type</b></h3>
						<hr style="margin-bottom:5px;border-width:2px 0 0;">
						<div class="filter-box">
							<div class="checkbox checkbox-primary">
								<input type="checkbox" id="all_job_type" name="all_job_type">
								<label for="all_job_type">All</label>
							</div>
							@foreach($etypes as $et)
							<div class="checkbox checkbox-primary" style="margin-top:20px; margin-bottom:20px;">
								<input type="checkbox" name="jobtype[]" @if($jobtypecount[$et->id]=='0' ){{"disabled"}} @endif
									id="jobtype_{{ $et->name }}"
									@isset($jobtype_select[$et->name]) checked @endisset
									value="{{ $et->name }}">
								<label for="jobtype_{{ $et->name }}">{{ $et->name }} ({{$jobtypecount[$et->id]}})</label>
							</div>
							@endforeach
						</div>
						{{-- ======================= job type end ======================= --}}

						{{-- ======================= job industry start ======================= --}}
						<h3><br><b>Job industry</b></h3>
						<hr style="margin-bottom:5px;border-width:2px 0 0;">

						<div class="filter-box">
							<div class="checkbox checkbox-primary">
								<input type="checkbox" id="all_job_industry" name="all_job_industry">
								<label for="all_job_industry">All</label>
							</div>
							<?php $cnt=0 ?>
							@forelse($get_ind as $ind)
							<div class="checkbox checkbox-primary @if($cnt>6) additional_industry @endif" style="@if($cnt>6) display:none; @endif margin-top:20px; margin-bottom:20px;">
								<input type="checkbox"
									@if($pic[$ind->id]==0) disabled @endif
									@isset($industry_select[$ind->id]) checked @endisset
									id="industry_{{$ind->id}}"
									name="industry[]" value="{{$ind->id}}">
								<label for="industry_{{$ind->id}}">
									{{$ind->industrytypename." (".$pic[$ind->id].")"}}
								</label>
							</div>
							<?php $cnt++ ?>
							@empty
							no Industry type found
							@endforelse
						</div>
						<p style="color:#a6b1be;cursor:pointer;" class="showmore" data-id="industry">Show More<span
								style="float:right;"><i class="fas fa-ellipsis-h" style="font-size: 18px;"></i></span></p>
						{{-- ======================= job industry end ======================= --}}

						<button type="button" id="reset"
							style="margin-top:400px;width:100%; border-radius:4px; color:black;background:#e2e6e9; border:1px solid #8897FE;height:48px;">Reset
							Filters
						</button>
					
					</div>
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="btn-group col-sm-12">
							<div class="col-md-8" style="padding-left: 5%;">

								<h1 style="font-size:30px;font-weight:bold;">
									Jobs in Qatar
								</h1>
								<p style="font-size:18px;color:#a7a7aa;">
									{{$catjobs->total()}}
									Jobs found: Showing {{json_decode($catjobs->toJson(), true)['from']}} - {{json_decode($catjobs->toJson(), true)['to']}}
								</p>
							</div>
							<div class="col-md-4" style="padding-right:0px;">
								<select id="shortby" name="date" data-toggle="dropdown" class="btn btn-default dropdown-toggle pull-right"
									style="height:67px!important;background: #FFFFFF;opacity: 0.8;box-shadow: 0px 3px 49px rgba(0, 0, 0, 0.2);border-radius: 4px!important;float:right;font-size:20px;" value="any"
									@isset($date) value="{{ $date }}" @endisset>
									<option value="any" @isset($date) @if($date=="any") selected @endif @else selected @endisset> Date Posted: Any Time </option>
									<option value="week" @isset($date) @if($date=="week") selected @endif @endisset> Date Posted: This Week </option>
									<option value="month" @isset($date) @if($date=="month") selected @endif @endisset> Date Posted: This Month </option>
								</select>
							</div>

						</div>
					</div>
					<div class="col-md-12">
						<div class="joblist" style="padding-left:5%;">
							@if(isset($catjobs) && count($catjobs)>0)

							@forelse($catjobs as $job)
							<div class="row joblistitem">
								<div class="joblistitem-logo">
									<img 
										@if(file_exists(App\empprofile::find($job->employer_id)->companylogo))
											src="/{{App\empprofile::find($job->employer_id)->companylogo}}"
										@else
											src="https://remotive.io/wp-content/uploads/2018/10/Crossover-logo-remotive.jpg"
										@endif
									>
								</div>
								<div class="joblistitem-description">
									<div class="row" style="height:50%;">
										<div class="col-md-7 col-sm-7" style="padding-bottom:20px;">
											<a href="/showdetails/{{$job->id}}">
												{{$job->jobtitle}}
											</a> 
											<br>
											<span class="joblistitem-companyname">
												{{ $job->companyname }} - {{ App\CityArea::find($job->area_id)->name }}
											</span>
										</div>
										<div class="col-md-5 col-sm-5 text-right">
											@if($job->featured==1)
												<span class="featured" style="margin-right:20px;">Featured</span>
											@endif
											<small class="joblistitem-date">
												{{App\Utils\Utils::cdateformat($job->created_at)}}
											</small>
										</div>
									</div>
									<div class="row" style="height:50%;">
										<div class="col-md-12" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
											{{ strip_tags($job->job_description) }}
										</div>
									</div>
								</div>
							</div>
							@empty
							<h2>No Jobs Found </h2>`
							@endforelse
							<div class="row text-right">
								{{$catjobs->links()}}
							</div>
							@endif
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--container end-->
@endsection

@section('extrascript')
<script>
	$('.showmore').click( function () {
		var id = $(this).data("id");
		if(id == 'city'){
			$('ul[id^="collapse_city"]').collapse("show");
		}
		else{
			$('.additional_'+id).show();
		}
		$(this).hide();
	});

	$('input[id^="city_area"]').click( function () {
		if($(this).data('type') == 'city') {
			var id = $(this).data('id');
			if($(this).prop("checked")) {
				$('input[data-type="area"][data-parid="' + id + '"]:enabled').prop("checked", true);
			}
			else{
				$('#all_city_area').prop("checked", false);
				$('input[data-type="area"][data-parid="' + id + '"]:enabled').prop("checked", false);
			}
		}
		else if($(this).data('type') == 'area') {
			var id = $(this).data('parid');
			if($(this).prop("checked")) {
				$('input[data-type="city"][data-id="' + id + '"]:enabled').prop("checked", true);
			}
			else{
				$('#all_city_area').prop("checked", false);
			}
		}
	});

	$('#all_city_area').click( function () {
		if(!$(this).prop("checked")){
			$('input[data-type="area"]:enabled').prop("checked", false);
			$('input[data-type="city"]:enabled').prop("checked", false);
		}
		else{
			$('input[data-type="area"]:enabled').prop("checked", true);
			$('input[data-type="city"]:enabled').prop("checked", true);
		}
	});

	$('#all_job_category').click( function () {
		if(!$(this).prop("checked")){
			$('input[type="checkbox"][id^="category_"]:enabled').prop("checked", false);
		}
		else{
			$('input[type="checkbox"][id^="category_"]:enabled').prop("checked", true);
		}
	});

	$('input[type="checkbox"][id^="category_"]:enabled').click( function () {
		if(!$(this).prop("checked")){
			$('#all_job_category').prop("checked", false);
		}
	});

	$('#all_job_type').click( function () {
		if(!$(this).prop("checked")){
			$('input[type="checkbox"][id^="jobtype_"]:enabled').prop("checked", false);
		}
		else{
			$('input[type="checkbox"][id^="jobtype_"]:enabled').prop("checked", true);
		}
	});

	$('input[type="checkbox"][id^="jobtype_"]:enabled').click( function () {
		if(!$(this).prop("checked")){
			$('#all_job_type').prop("checked", false);
		}
	});

	$('#all_job_industry').click( function () {
		if(!$(this).prop("checked")){
			$('input[type="checkbox"][id^="industry_"]:enabled').prop("checked", false);
		}
		else{
			$('input[type="checkbox"][id^="industry_"]:enabled').prop("checked", true);
		}
	});

	$('input[type="checkbox"][id^="industry_"]:enabled').click( function () {
		if(!$(this).prop("checked")){
			$('#all_job_industry').prop("checked", false);
		}
	});

	$('#reset').click( function () {
		$('input[type="checkbox"]').prop("checked", false);
		$('#filterbtn').trigger('click');
	});

	$('#shortby').change( function () {
		$('#filterbtn').trigger('click');
	});

	$('#searchbtn').click( function () {
		$('#filterbtn').trigger('click');
	});
</script>
@endsection