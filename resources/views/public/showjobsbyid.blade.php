@extends('public.layout.public_layout')
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
@section('style')
<style>

	.postjoin {
		margin-top: 0% !important;
	}

	.sidhedcolor {
		color: #7889FF;
	}

	.digitalullist li::before {
		content: "\2022";
		color: #A6B1BE;
		font-weight: bold;
		display: inline-block;
		width: 1em;
		margin-left: -1em;
	}

</style>
@endsection
@section('content')

 <div class="container" style="width:80%;margin:auto;margin-top:100px;">
	<div class="row">
		<div class="col-md-9 col-sm-12 col-xs-12 jobadver">
			<img class="img-thumbnail img-mythumb" src="/img/profile.png">
			<div class="jobadver-panel">
				<h2 class="Posthed uihed">{{$jobdata->jobtitle}}</h2>
				<p class="uber">{{$jobdata->companyname}}</p>
				<p class="doha">{{$jobdata->divname}} - {{App\CityArea::find($jobdata->city_id)->name}}</p>

				@if($jobdata->deadline< Date('Y-m-d')) <button class='job-closed'>CLOSED OR EXPIRED JOB POST. THIS JOB POST IS CLOSED OR HAS EXPIRED AND IS NO LONGER OPEN FOR APPLICATIONS.</button>
				@else
				{!! $apply=="true" ? "<button class='postjoin'>ALREADY APPLIED</button>" : "<button id='applyon'
					class='job-apply'>APPLY NOW </button>"!!}

				@endif

				<span class="job-posted-date">Date Posted:<br>{{App\Utils\Utils::cdateformat1($jobdata->created_at)}}</span>
			</div>
		</div>
		<div class="sidecontfind2 col-md-3 col-sm-12 col-xs-12">
			<h1 class="Posthed text-center">Similar Jobs</h1>
			@forelse($relatedJobs as $related)
			<div class="row" style="height:80px;margin-left:20px;margin-right:20px;">
				<div class="col-md-3" style="padding:0;height:100%;">
					<img style="height:100%;" src="/img/regicon1.png">
				</div>
				<div class="col-md-9" style="vertical-align: middle;">
					<a href="/showdetails/{{$related->id}}" style="color:#7889FF;font-size:18px;">
						{{$related->jobtitle}}
					</a>
					<p style="margin: 0;color:#a7a7aa;">{{$related->companyname}}</p>
					<p style="margin-top:5px;">{{$related->divname}}</p>
				</div>
			</div>
			@empty
			No Related Jobs Found
			@endforelse
			<br>
			<a style="float:right;color:#28C294; font-weight:bold;margin-bottom: 20px;" href="/category/{{$jobdata->catagory_id}}" class="tablro1">See More</a>
		</div>
	</div>
	<div class="row">
		<div class="jobfind2">
			<h1 class="Posthed">Job Description</h1>
			<p class="digital">{!! $jobdata->job_description !!}</p>
		</div>

		<br><br>
		<div class="jobfind2">
			<h1 class="Posthed">Skills</h1>
			<div style="margin-left:120px;">
				@foreach(explode(',',$jobdata->skills) as $skill)
				<div class="skilldiv">{{$skill}}</div>
				@endforeach
			</div>
	</div>
		<br><br>
		<div class="jobfind2">
			<h1 class="Posthed">Job Details</h1>
			<div class="row">
				<div class="col-md-8">
					<div class="row" style="margin-top:20px;font-size:24px;">
						<div class="col-md-6" style="font-weight:bold">
							Country
						</div>
						<div class="col-md-6">
							Qatar
						</div>
					</div>
					<div class="row" style="margin-top:20px;font-size:24px;">
						<div class="col-md-6" style="font-weight:bold">
							Job Location
						</div>
						<div class="col-md-6">
							{{$jobdata->divname}} - {{App\CityArea::find($jobdata->city_id)->name}}
						</div>
					</div>
					<div class="row" style="margin-top:20px;font-size:24px;">
						<div class="col-md-6" style="font-weight:bold">
							Company Industry
						</div>
						<div class="col-md-6">
							{{$jobdata->industrytypename}}
						</div>
					</div>
					<div class="row" style="margin-top:20px;font-size:24px;">
						<div class="col-md-6" style="font-weight:bold">
							Employment Type
						</div>
						<div class="col-md-6">
							{{$jobdata->employment_type}} .
						</div>
					</div>
					<div class="row" style="margin-top:20px;font-size:24px;">
						<div class="col-md-6" style="font-weight:bold">
							Monthly Salary Range
						</div>
						<div class="col-md-6">
							@if($jobdata->salaryrange=="")
								Unspecified
							@else
								{{$jobdata->salaryrange}}
							@endif
						</div>
					</div>
					<div class="row" style="margin-top:20px;font-size:24px;">
						<div class="col-md-6" style="font-weight:bold">
							Monthly Salary Range
						</div>
						<div class="col-md-6">
							@if($jobdata->salaryrange=="")
								Unspecified
							@else
								{{$jobdata->salaryrange}}
							@endif
						</div>
					</div>
					<div class="row" style="margin-top:20px;font-size:24px;">
						<div class="col-md-6" style="font-weight:bold">
							Number of Vacancies
						</div>
						<div class="col-md-6">
							{{$jobdata->vacancies}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br>
		<div class="jobfind2">
			<h1 class="Posthed">Preferred Candidate</h1>
			<div class="row no-gutters row-no-gutters">
				<div class="col-md-8">
					@if($jobdata->quest_location_req == 1 && $jobdata->quest_location != null)
						<div class="row" style="margin-top:20px;font-size:24px;">
							<div class="col-md-6" style="font-weight:bold">
								Location
							</div>
							<div class="col-md-6">
								{{App\country::find($jobdata->quest_location)->name}}
							</div>
						</div>
					@endif
					@if($jobdata->quest_exp_req == 1)
						<div class="row" style="margin-top:20px;font-size:24px;">
							<div class="col-md-6" style="font-weight:bold">
								Year of Experience
							</div>
							<div class="col-md-6">
								Min:{{$jobdata->quest_exp_min}} Max:{{$jobdata->quest_exp_max}}
							</div>
						</div>
					@endif
					@if($jobdata->quest_salary_req == 1)
						<div class="row" style="margin-top:20px;font-size:24px;">
							<div class="col-md-6" style="font-weight:bold">
								Salary
							</div>
							<div class="col-md-6">
								Min:{{$jobdata->quest_salary_min}} Max:{{$jobdata->quest_salary_max}}
							</div>
						</div>
					@endif
					@if($jobdata->quest_language_req == 1)
						<div class="row" style="margin-top:20px;font-size:24px;">
							<div class="col-md-6" style="font-weight:bold">
								Language
							</div>
							<div class="col-md-6">
								@foreach(explode(',',$jobdata->quest_language) as $language)
									<div class="skilldiv">{{$language}}</div>
								@endforeach
							</div>
						</div>
					@endif
					@if($jobdata->quest_min_edu_req == 1)
						<div class="row" style="margin-top:20px;font-size:24px;">
							<div class="col-md-6" style="font-weight:bold">
								Minimum Year of Education
							</div>
							<div class="col-md-6">
								{{$jobdata->quest_min_edu}}
							</div>
						</div>
					@endif
					@if($jobdata->quest_license_req == 1)
						<div class="row" style="margin-top:20px;font-size:24px;">
							<div class="col-md-6" style="font-weight:bold">
								License
							</div>
							<div class="col-md-6">
								{{$jobdata->quest_license_req}}
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
 	<div class="row">
 		<div class="uidevel2 col-md-12" style="padding-left:30px; padding-right:30px;">
			<h1 class="Posthed" style="margin-left: 40px;">Similar Jobs</h1>
			@forelse($relatedJobs as $related)
			<div style="width:20%;height:80px;margin-left:20px;margin-right:20px;display:inline-block;">
				<div class="col-md-3" style="padding:0;height:100%;">
					<img style="height:100%;" src="/img/regicon1.png">
				</div>
				<div class="col-md-9" style="vertical-align: middle;">
					<a href="/showdetails/{{$related->id}}" style="color:#7889FF;font-size:18px;">
						{{$related->jobtitle}}
					</a>
					<p style="margin: 0;color:#a7a7aa;">{{$related->companyname}}</p>
					<p style="margin-top:5px;">{{$related->divname}}</p>
				</div>
			</div>
			@empty
			<h4>No Related Jobs Found</h4>
			@endforelse
			<div style="width:100%;text-align:right;">
					<a style="float:right;color:#28C294; font-weight:bold;" href="/category/{{$jobdata->catagory_id}}" class="tablro1">See More</a>				
			</div>
 		</div>
 	</div>

 	<hr class="line" style="margin-top:250px;"/>
 	<div class="container">
 		<div class="col-md-1"></div>
 		<div class="col-md-11">
 			<ul>
 				<li class="foico2">Home ></li>
 				<li class="foico2">Job ></li>
 				<li class="foico2">Doha ></li>
 				<li class="foico2">Qatar ></li>
 			</ul>
 		</div>
 		<div class="col-md-1"></div>
 		<div class="col-md-11">
 			<h1 class="Posthed">Job Detalis</h1>
 			<div class="row">
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 			</div>
 			<div class="row">
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 			</div>
 			<div class="row">
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 				<div class="col-md-2">job details</div>
 			</div>
 		</div>
 	</div>

 	<hr class="line" />
 	<div class="container ">
 		<div class="col-md-1"></div>
 		<div class="col-md-8 col-sm-11">
 			<h1 class="Posthed">About worldtalentjobs.com</h1>
 			<p class="find2world">It is a long established fact that a reader will be distracted by the readable content of a
 				page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
 				distribution of letters, as opposed to using 'Content here, content here', making it look like readable
 				English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text,
 				and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
 		</div>
 	</div>
 </div>

 <!-- Modal -->
 <div id="myModal" class="modal fade" role="dialog">
 	<div class="modal-dialog">
 		<!-- Modal content-->
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal">&times;</button>
 				<h4 class="modal-title">Expected Sallary</h4>
 			</div>
 			<div class="modal-body">
 				<form action="{{url('jobseeker/apply')}}">
 					<input type="hidden" name="jobid" value="{{$jobdata->id}}">
 					<input type="hidden" name="employerid" value="{{$jobdata->employer_id}}">
 					<div class="form-group">
 						<input type="text" name="expected_sallary" class="form-control" placeholder="Your Expected Sallary">
 					</div>
 					<div class="form-group">
 						<input type="submit" class="btn btn-primary btn-block" value="Apply">
 					</div>

 				</form>
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn" data-dismiss="modal">Close</button>
 			</div>
 		</div>
 	</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="actiondialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="height:300px;">
        <div class="modal-body">
            <div class="container" style="width:90%;margin-right:10px;margin-left:auto;">
				<div class="row" style="margin-bottom:30px;">
					<div class="col-md-12">
						<a href="#" data-dismiss="modal" style="color:red;font-size:20px;">Go Back</a>
					</div>
				</div>
				<div class="row" style="margin-bottom:30px;font-size:18px;font-weight:bold;">
					<div class="col-md-12">
						YOUR CV DOESN'T MATCH THE REQUIREMENTS THAT WERE SET FOR THIS JOB VACANCY BY THE EMPLOYER.
					</div>
				</div>
				<div class="row" style="margin-bottom:30px;font-size:18px;font-weight:bold;">
					<div class="col-md-12">

					</div>
				</div>
                <div class="row" style="margin-bottom:30px;">
                    <div class="col-md-12 text-right">
                        <button class="acceptbtn" style="background:#dd4b39;margin-right:30px;" id="applybtn">APPLY ANYWAY</button>
                        <button class="acceptbtn" style="background:#7889FF" id="viewbtn">VIEW SIMILAR JOBS</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('extrascript')
<script>
$("#applyon").on("click", function () {
	@if(!$jobseekerdetails)
		window.location = "/jobseeker/login";
	@else
		$.ajax({
			url:'/jobseeker/checkvacancy/{{$jobdata->id}}',
			success: function(data){
				if(data.able == 0){
					swal({
						title: "Vacancies Limited",
						icon: "error",
						buttons: ["Go Back"],
						dangerMode: true,
					});
				}
				else if(data.able == 2){
					swal({
						title: "Your resume have not been completed!",
						icon: "error",
						buttons: ["Go Back"],
						dangerMode: true,
					});
				}
				else{
					@php $array[] = explode(',', $jobseekerdetails->target_tags); @endphp
					@if(!in_array($jobdata->catagory_id, $array))

					if(data.hasFilter) {
						// $('#actiondialog').modal();
						window.location = "/apply/{{$jobdata->id}}";
					} else {
						window.location = "/jobseeker/applydirectly/{{$jobdata->id}}";
					}

					@else
						window.location = "/apply/{{$jobdata->id}}"
					@endif
				}
			}
		});
	@endif

	$('#applybtn').click( function() {
		window.location = "/apply/{{$jobdata->id}}";
	});

	$('#viewbtn').click( function() {
		window.location = "/category/{{$jobdata->catagory_id}}"
	});
	
});
// @if($jobseekerdetails && $jobseekerdetails->target_industry != $jobdata->catagory_id)
	// swal({
	// 	title: "Your CV does not match the requirement",
	// 	icon: "error",
	// 	buttons: ["Cancel", "Apply anyway!"],
	// 	dangerMode: true,
	// }).then(function (isConfirm) {
	// 	if (isConfirm) {
	// 		//	alert("a"); 
	// 		window.location = "/apply/{{$jobdata->id}}"
	// 	}
	// });
	// @else
	// window.location = "/apply/{{$jobdata->id}}"
	// @endif
</script>
@endsection
