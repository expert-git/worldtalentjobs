{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
Post a Job
@endsection

@section('style')
<style>
	.help_text {
		color: red;
		display: none;
	}

	.remove {
		border: 1px solid #7889ff;
		color: #7889ff;
	}

	.btn-profile {

		font-size: 10px !important;
	}

	.btn {
		font-size: 12px !important;
	}

	#previous1 {
		cursor: pointer;
	}
	@media (min-width: 768px) {
		.aconntmenu {
			margin-left: -7%;
		}

		.container {}

		.accondlondon {
			margin: -5% 0 15px 0;
			color: gray;
		}

		.leftcont {
			color: gray;
		}

		.current {
			color: #7889ff;

		}

		.current .col-md-10 {
			font-weight: bold;
			color: black;
		}

		.content {
			margin-left: -7%;
			border-right: thin solid lightgray;
		}

		.row {
			margin-bottom: 0px;
		}
	}

	.btn {
		width: 100% !important;
		border: 1px solid #e0e0e0;
		padding: 10px 8px;
		background: #FFF !important;
	}

	.btn2 {
		border: 2px dashed #cccaca;
		padding: 7px 26px;
		background: #f5f5f5;
	}

	.ico-03 {
		float: right;
	}

	.pasuser3 {
		float: left;
		width: 249px;
		padding: 30px 0 10px 0;
		color: #7889ff;
	}

	.bootstrap-select {
		width: 100% !important;
	}

	.dropdown-toggle {
		width: 100% !important;
	}

	select {
		padding: 11px 18px;
	}

	.fr-box.fr-basic.fr-top .fr-wrapper {
		border-bottom: 1px solid #ccc;
	}


	.bootstrap-select .dropdown-menu {
		min-width: 100% !important;
	}

	@media (min-width: 200px) and (max-width: 480px) {
		#btnToggle {
			margin-top: -54px;
		}

		.ico-03 {
			float: none;
		}
	}

	.select2-container .select2-selection--single .select2-selection__rendered {
		display: inline !important;
	}

	.btn {
		width: 100% !important;
		border: 1px solid #e0e0e0;
		padding: 10px 8px;
		background: #FFF !important;
	}

	.btn2 {
		border: 2px dashed #cccaca;
		padding: 7px 26px;
		background: #f5f5f5;
	}

	.ico-03 {
		float: right;
	}

	.pasuser3 {
		float: left;
		width: 249px;
		padding: 30px 0 10px 0;
		color: #7889ff;
	}

	.bootstrap-select {
		width: 100% !important;
	}

	.dropdown-toggle {
		width: 100% !important;
	}

	select {
		padding: 11px 18px;
	}

	.fr-box.fr-basic.fr-top .fr-wrapper {
		border-bottom: 1px solid #ccc;
	}


	.bootstrap-select .dropdown-menu {
		min-width: 100% !important;
	}

	@media (min-width: 200px) and (max-width: 480px) {
		#btnToggle {
			margin-top: -54px;
		}

		.ico-03 {
			float: none;
		}
	}

	/***
	Bootstrap Line Tabs by @keenthemes
	A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
	Licensed under MIT
	***/

	/* Tabs panel */
	.tabbable-panel {
		/* border: 1px solid #eee; */
		padding: 10px;
	}

	/* Default mode */
	.tabbable-line>.nav-tabs {
		border: none;
		margin: 0px;
	}

	.tabbable-line>.nav-tabs>li {
		/* margin-right: 2px; */
		width: 50%;
		border-bottom: 4px solid #A6B1BE;
	}

	.tabbable-line>.nav-tabs>li>a {
		border: 0;
		margin-right: 0;
		color: #737373;
		font-family: 'Quantico';
		font-size: 22px;
	}

	.tabbable-line>.nav-tabs>li>a>i {
		color: #a6a6a6;
	}

	.tabbable-line>.nav-tabs>li.open,
	.tabbable-line>.nav-tabs>li:hover {
		border-bottom: 4px solid rgba(40, 194, 148, .5);
	}

	.tabbable-line>.nav-tabs>li.open>a,
	.tabbable-line>.nav-tabs>li:hover>a {
		border: 0;
		background: none !important;
		color: #333333;
	}

	.tabbable-line>.nav-tabs>li.open>a>i,
	.tabbable-line>.nav-tabs>li:hover>a>i {
		color: #a6a6a6;
	}

	.tabbable-line>.nav-tabs>li.open .dropdown-menu,
	.tabbable-line>.nav-tabs>li:hover .dropdown-menu {
		margin-top: 0px;
	}

	.tabbable-line>.nav-tabs>li.active {
		border-bottom: 4px solid #28C294;
		position: relative;
	}

	.tabbable-line>.nav-tabs>li.active>a {
		border: 0;
		color: #333333;
		background:none;
	}

	.tabbable-line>.nav-tabs>li.active>a>i {
		color: #404040;
	}

	.tabbable-line>.tab-content {
		margin-top: -3px;
		/* background-color: #fff; */
		border: 0;
		border-top: 1px solid #eee;
		padding: 15px 0;
	}

	.portlet .tabbable-line>.tab-content {
		padding-bottom: 0;
	}

	/* Below tabs mode */

	.tabbable-line.tabs-below>.nav-tabs>li {
		border-top: 4px solid transparent;
	}

	.tabbable-line.tabs-below>.nav-tabs>li>a {
		margin-top: 0;
	}

	.tabbable-line.tabs-below>.nav-tabs>li:hover {
		border-bottom: 0;
		border-top: 4px solid #28C294;
	}

	.tabbable-line.tabs-below>.nav-tabs>li.active {
		margin-bottom: -2px;
		border-bottom: 0;
		border-top: 4px solid #28C294;
	}

	.tabbable-line.tabs-below>.tab-content {
		margin-top: -10px;
		border-top: 0;
		border-bottom: 1px solid #eee;
		padding-bottom: 15px;
	}

	.nav-tabs>li.active>a{
		background:none;
	}

	.row{
		margin-top:8px;
	}



	/* bootstrap tagsinput css */
	.bootstrap-tagsinput{
		background-color: #fff;
		border: 1px solid #ccc;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		display: inline-block;
		padding: 4px 6px;
		color: #555;
		vertical-align: middle;
		border-radius: 3px;
		max-width: 100%;
		line-height: 22px;
		cursor: text;
		width:100%;
		height:48px;
	}

	.bootstrap-tagsinput .label-info {
		padding: 5px;
		color: #A0A0A0;
		border-radius: 4px!important;
		border: solid 1px #a0a0a0;
		background-color: white;
		font-weight: 400;
	}

	.bootstrap-tagsinput input{
		border: none;
		box-shadow: none;
		outline: none;
		background-color: transparent;
		padding: 0 6px;
		margin: 0;
		width: auto;
		max-width: inherit;
		display: inline-block;
		height: 30px!important;
	}

	.bootstrap-tagsinput input:focus{
		border: none;
	}
</style>
@endsection
@section('content')
<section class="minheight">
	<div style="margin-top:2%;width:90%;" class="container">
		<div class="row">
			@include('employer.partial._sidebar')
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12" style="padding-left:30px;">
						<h1 class="pagetitle1"> Post a Job </h1>
					</div>
				</div>
				<div class="tabbable-panel">
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li class="active" >
								<a href="#tab_part_1" data-toggle="tab" id="basictab">
								Basic Info </a>
							</li>
							<li>
								<a href="#tab_part_2" data-toggle="tab" id="questiontab">
								Questions </a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_part_1">
								<form method="POST" action="/employer/postjob" id="basicinfoform">
									{{ csrf_field() }}
									<div class="row">
										<div class="form-group">
											<div class="col-md-12">
												<label for="jobtitle">Job Title<span class="mustbeoption">*</span></label>
												<input class="ico-03" required type="text" name="jobtitle" id="jobtitle">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="form-group">
											<div class="col-md-12">
												<label for="job_description">Description<span class="mustbeoption">*</span></label>
												<textarea required id="job_description" name="job_description"></textarea>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="job_industry">Job Industry<span class="mustbeoption">*</span></label>
												<!-- <label for="job_tag">Job Tags<span class="mustbeoption">*</span></label>
												<input type="hidden" id="job_tags" name="job_tags">
												<select required class="multipleSelect ico-03 mr-sm-2" multiple  name="job_tag" id="job_tag">
                    							</select> -->
												<select required name="job_industry" id="job_industry" class="ico-03 natidropdo custom-select mr-sm-2" >
													<option value="" hidden>Choose...</option>
													@foreach($industry as $ind)
														<option value="{{$ind->id}}">{{$ind->industrytypename}}</option>
													@endforeach
												</select>
											</div>
										</div>
										{{-- <div class="col-md-6">
											<div class="form-group">
												<label for="job_category">Job Category<span class="mustbeoption">*</span></label>
												<select required class="multipleSelect ico-03 mr-sm-2"  name="job_category" id="job_category">
													<option value="" hidden>Choose...</option>
													@foreach($jtags as $jtag)
													<option value="{{ $jtag->id }}">{{ $jtag->job_tag }}</option>
													@endforeach
                    							</select>
											</div>
										</div> --}}
										<div class="col-md-3">
											<label>City<span class="mustbeoption">*</span></label>
											<select id="city" name="city" class="natidropdo custom-select mr-sm-2" required>
												<option value="">Choose...</option>
												@foreach($cityareas as $city)
												@if($city->parent_id==0)
												<option value="{{$city->id}}">{{$city->name}}</option>
												@endif
												@endforeach
											</select>
										</div>
										<div class="col-md-3">
											<label>Location/Area<span class="mustbeoption">*</span></label>
											<select name="area" id="area" class="natidropdo custom-select mr-sm-2" required>
												<option value="">Choose...</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<label for="employment_type">Employment Type<span class="mustbeoption">*</span></label>
											<select name="employment_type" class="ico-03" id="employment_type" required>
												<option value="" hidden>Choose..</option>
												<option value="Commission">Commission</option>
												<option value="Freelancer">Freelancer</option>
												<option value="Full Time Employee">Full Time Employee</option>
												<option value="Internship">Internship</option>
												<option value="Part Time Employee">Part Time Employee</option>
												<option value="Temporary Employee">Temporary Employee</option>
												<option value="Volunteer">Volunteer</option>
											</select>
										</div>
										<div class="col-md-6">
											<label for="career_level">Career Level<span class="mustbeoption">*</span></label>
											<div class="col-auto my-1">
												<select required name="career_level" style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
												placeholder="Place" class="ico-02 js-example-basic-single">
													<option value="" hidden>Choose..</option>
													<option value="Senior Level">Senior Level</option>
													<option value="Director/Head">Director/Head</option>
													<option value="Management">Management</option>
													<option value="Mid Career">Mid Career</option>
													<option value="Entry Level">Entry Level</option>
													<option value="Intermediate">Intermediate</option>
												</select>
											</div>
										</div>
									</div>
									

									<div class="row">
										<div class="col-md-6">
											<label for="vacancies">Number of Vacancies<span class="mustbeoption">*</span></label>
											
											<div class="col-auto my-1">
												<select required name="vacancies" style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
												placeholder="Place" class="ico-02 js-example-basic-single" value="20">
													<option value="" hidden>Choose..</option>
													@for ($i = 1; $i <= 20; $i++)
													<option value="{{ $i }}">{{ $i }}</option>
													@endfor
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<label for="salaryrange">Salary Range (Optional)</label>
											<input class="ico-03" name="salaryrange" type="text" id="salaryrange">
											<small class="help_text">Salary range required..</small>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<label for="skills">Required Skills</label>
											<input requried class="ico-03" type="text" id="skills" placeholder="type tag here" data-role="tagsinput" name="skills">
											<!-- <label for="companyname">Required Years Of Experiences</label> -->
											<!-- <div class="row">
												<div class="col-md-6" style="padding-right:0px;">
													<div class="col-auto my-1">
														<select name="job_experiences_year1" style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
														placeholder="Place" class="ico-02 js-example-basic-single">
															<option value="" hidden>Min.</option>
															@for ($i = 1; $i <= 20; $i++)
															<option value="{{ $i }}">{{ $i }}</option>
															@endfor
														</select>
													</div>
												</div>
												<div class="col-md-6" style="padding-left:0px;">
													<div class="col-auto my-1">
														<select name="job_experiences_year2" style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
														placeholder="Place" class="ico-02 js-example-basic-single">
															<option value="" hidden>Max.</option>
															@for ($i = 1; $i <= 20; $i++)
															<option value="{{ $i }}">{{ $i }}</option>
															@endfor
														</select>
													</div>
												</div>
											</div> -->
										</div>
										<div class='col-md-6'>
											<label for="deadlinepicker">Job Expires On<span class="mustbeoption">*</option></label>
											<div class="form-group">
												<div class='input-group date' id='deadlinepicker'>
													<input required type='text' max="{{$limit}}" id="deadline" name="deadline"
														style="height:40px; border-right:none;" placeholder="dd/mm/yyyy"/>
													<span class="input-group-addon">
														<img src="/icon-img/calendar.svg" style="width:30px;height:30px;">                        
													</span>
													<br>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										
									</div>
									
									<div class="row" style="margin-top:40px;">
										<div class="form-group">
											<div class="col-md-3">
												<button style="background-color:#28C294; width:100%;border-radius:3px;" id="continue">CONTINUE</button>
											</div>
											<div class="col-md-6">
												<a href="#" style="margin-top:13px; display: inline-block;"><b>Cancel</b></a>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div class="tab-pane" id="tab_part_2">
								<form method="POST" action="/employer/postjobquestion" id="questionform">
									{{ csrf_field() }}
									<input type="hidden" id="questjobid" name="job_id" value="0">
									<div class="row">
										<div class="col-md-3">
											<button class="chk_btn" id="location" type="button">Location</button>
										</div>
										<div class="col-md-3">
											<button class="chk_btn" id="experience" type="button">Experience</button>
										</div>
										<div class="col-md-3">
											<button class="chk_btn" id="salary" type="button">Salary</button>
										</div>
										<div class="col-md-3">
											<button class="chk_btn" id="language" type="button">Language</button>
										</div>
										<div class="col-md-3">
											<button class="chk_btn" id="education" type="button">Education</button>
										</div>
										<div class="col-md-3">
											<button class="chk_btn" id="license" type="button">License</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 optional" id="locationtab" style="display:none;">
											<div class="row" style="margin-bottom:3px;">
												<div class="col-sm-6">
													<label style="margin-bottom:0px;font-size:12px!important;">Candidate's Location</label>
												</div>
												<div class="col-sm-6">
													<span class="mustbeoption closetab" style="font-size:12px;cursor:pointer; float:right;" data-id="location">Close X</span>
												</div>
											</div>
											<div class="row" style="margin-bottom:0px;margin-top:0px;">
												<div class="col-sm-12">
													<select name="quest_location" style="" class="selectpicker">
														<option value="" hidden>Choose..</option>
														@foreach($countries as $cnt)
														<option value="{{$cnt->id}}">{{$cnt->name}}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="row" style="margin-top:3px;">
												<div class="col-md-6 col-xs-4"><span style="font-size:12px!important;">Required</span></div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_location_req_no" name="quest_location_req_no" type="checkbox" data-id="location"/>
														<label for="quest_location_req_no">
															No
														</label>
													</div>
												</div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_location_req_yes" name="quest_location_req_yes" type="checkbox" data-id="location"/>
														<label for="quest_location_req_yes">
															Yes
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 optional" id="experiencetab" style="display:none;">
											<div class="row" style="margin-bottom:3px;">
												<div class="col-sm-8">
													<label style="margin-bottom:0px;font-size:12px!important;">Minimum Years Of Experiences</label>
												</div>
												<div class="col-sm-4">
													<span class="mustbeoption closetab" style="font-size:12px;cursor:pointer; float:right;" data-id="experience">Close X</span>
												</div>
											</div>
											<div class="row" style="margin-bottom:0px;margin-top:0px;">
												<div class="col-md-6" style="padding-right:0;">
													<select name="quest_exp1" style="" class="selectpicker">
														<option value="" hidden selected>Mini.</option>
														@for($i=1; $i<=20; $i++)
														<option>{{$i}}</option>
														@endfor
													</select>
												</div>
												<div class="col-md-6" style="padding-left:0;">
													<select name="quest_exp2" style="" class="selectpicker">
														<option value="" hidden>Max.</option>
														@for($i=1; $i<=20; $i++)
														<option>{{$i}}</option>
														@endfor
													</select>
												</div>
											</div>
											<div class="row" style="margin-top:3px;">
												<div class="col-md-6 col-xs-4"><span style="font-size:12px!important;">Required</span></div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_experience_req_no" name="quest_experience_req_no" type="checkbox" data-id="experience"/>
														<label for="quest_experience_req_no">
															No
														</label>
													</div>
												</div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_experience_req_yes" name="quest_experience_req_yes" type="checkbox" data-id="experience"/>
														<label for="quest_experience_req_yes">
															Yes
														</label>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6 optional" id="salarytab" style="display:none;">
											<div class="row" style="margin-bottom:3px;">
												<div class="col-sm-8">
													<label style="margin-bottom:0px;font-size:12px!important;">Expected Salary Range</label>
												</div>
												<div class="col-sm-4">
													<span class="mustbeoption closetab" style="font-size:12px;cursor:pointer; float:right;" data-id="salary">Close X</span>
												</div>
											</div>
											<div class="row" style="margin-bottom:0px;margin-top:0px;">
												<div class="col-md-6" style="padding-right:0;">
													<input class="ico-03" type="text" id="quest_salary1" name="quest_salary1">
												</div>
												<div class="col-md-6" style="padding-left:0;">
													<input class="ico-03" type="text" id="quest_salary2" name="quest_salary2">
												</div>
											</div>
											<div class="row" style="margin-top:3px;">
												<div class="col-md-6 col-xs-4"><span style="font-size:12px!important;">Required</span></div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_salary_req_no" name="quest_salary_req_no" type="checkbox" data-id="salary"/>
														<label for="quest_salary_req_no">
															No
														</label>
													</div>
												</div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_salary_req_yes" name="quest_salary_req_yes" type="checkbox" data-id="salary"/>
														<label for="quest_salary_req_yes">
															Yes
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 optional" id="languagetab" style="display:none;">
											<div class="row" style="margin-bottom:3px;">
												<div class="col-sm-6">
													<label style="margin-bottom:0px;font-size:12px!important;">Language</label>
												</div>
												<div class="col-sm-6">
													<span class="mustbeoption closetab" style="font-size:12px;cursor:pointer; float:right;" data-id="language">Close X</span>
												</div>
											</div>
											<div class="row" style="margin-bottom:0px;margin-top:0px;">
												<div class="col-md-12">
													<input class="ico-03" type="text" id="quest_language" placeholder="Language" data-role="tagsinput" name="quest_language">
												</div>
											</div>
											<div class="row" style="margin-top:3px;">
												<div class="col-md-6 col-xs-4"><span style="font-size:12px!important;">Required</span></div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_language_req_no" name="quest_language_req_no" type="checkbox" data-id="language"/>
														<label for="quest_language_req_no">
															No
														</label>
													</div>
												</div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_language_req_yes" name="quest_language_req_yes" type="checkbox"/>
														<label for="quest_language_req_yes">
															Yes
														</label>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6 optional" id="educationtab" style="display:none;">
											<div class="row" style="margin-bottom:3px;">
												<div class="col-sm-8">
													<label style="margin-bottom:0px;font-size:12px!important;">Minimum Education Level</label>
												</div>
												<div class="col-sm-4">
													<span class="mustbeoption closetab" style="font-size:12px;cursor:pointer; float:right;" data-id="education">Close X</span>
												</div>
											</div>
											<div class="row" style="margin-bottom:0px;margin-top:0px;">
												<div class="col-md-12">
													<select name="quest_min_edu" style="" class="selectpicker">
														<option value="" hidden>Choose..</option>
														@foreach($edulevels as $e)
														<option value="{{$e->id}}">{{$e->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="row" style="margin-top:3px;">
												<div class="col-md-6 col-xs-4"><span style="font-size:12px!important;">Required</span></div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_education_req_no" name="quest_education_req_no" type="checkbox" data-id="education"/>
														<label for="quest_education_req_no">
															No
														</label>
													</div>
												</div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_education_req_yes" name="quest_education_req_yes" type="checkbox" data-id="education"/>
														<label for="quest_education_req_yes">
															Yes
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 optional" id="licensetab" style="display:none;">
											<div class="row" style="margin-bottom:3px;">
												<div class="col-sm-6">
													<label style="margin-bottom:0px;font-size:12px!important;">License</label>
												</div>
												<div class="col-sm-6">
													<span class="mustbeoption closetab" style="font-size:12px;cursor:pointer; float:right;" data-id="license">Close X</span>
												</div>
											</div>
											<div class="row" style="margin-bottom:0px;margin-top:0px;">
												<div class="col-md-12">
													<input class="ico-03" type="text" id="quest_license" name="quest_license">
												</div>
											</div>
											<div class="row" style="margin-top:3px;">
												<div class="col-md-6 col-xs-4"><span style="font-size:12px!important;">Required</span></div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_license_req_no" name="quest_license_req_no" type="checkbox" data-id="license"/>
														<label for="quest_license_req_no">
															No
														</label>
													</div>
												</div>
												<div class="col-md-3 col-xs-4">
													<div class="checkbox small checkbox-primary">
														<input id="quest_license_req_yes" name="quest_license_req_yes" type="checkbox" data-id="license"/>
														<label for="quest_license_req_yes">
															Yes
														</label>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-md-8" style="margin-top:120px;">
											<b style="font-size:12px;">Only notify me after candidates who meet all 'Required' Criteria above.</b>
										</div>
										<div class="col-md-2" style="margin-top:120px;">
											<div class="checkbox small checkbox-primary">
												<input id="quest_notify_req_no" name="quest_notify_req_no" type="checkbox" data-id="notify"/>
												<label for="quest_notify_req_no">
													No
												</label>
											</div>
										</div>
										<div class="col-md-2" style="margin-top:120px;">
											<div class="checkbox small checkbox-primary">
												<input id="quest_notify_req_yes" name="quest_notify_req_yes" type="checkbox" data-id="notify" checked/>
												<label for="quest_notify_req_yes">
													Yes
												</label>
											</div>
										</div>

										<div class="col-md-12" style=";">
											<span class="hint" style="font-size:12px;text-alignment:justify;">
												Candidates whose answers do not meet your 'Required' crieria will be stored in your account and marked as Rejected. These candidates will not be notified of their applications status unless you tell them. You can access their applications at anytime.
											</span>
										</div>

										<div class="col-md-3" style="margin-top:40px;">
											<button style="background-color:#28C294; border-radius:3px; width:100%;" type="submit">POST A JOB</button>
										</div>
										<div class="col-md-3" style="margin-top:40px;">
											<button style="background-color:#7889FF; border-radius:3px; width:100%;" type="button" id="skipbtn" >SKIP AND POST</button>
										</div>
										<div class="col-md-6" style="margin-top:40px;" style="">
											<a style="margin-top:13px; display: inline-block;" id="previous1"><b>Go Back</b></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<span class="height50"></span>
						<br clear="all">
						<p>By clicking CONTINUE button you are agreeing to the <b style="color:#7889ff;">Terms and Conditions</b></p>
					</div>
				</div>
			</div>
			@include('employer.partial._right_sidebar')
		</div>
	</div>
</section>
@endsection
@section('extrascript')
<script>
// var jobdatas = [];
// @foreach($jtags as $jtag)
// 	jobdatas.push({id:{{$jtag->id}}, text:'{{$jtag->job_tag}}'})
// @endforeach

// $('#job_tag').select2({
// 	data:jobdatas,
// 	closeOnSelect: false
// });

$("#city").on("change", function () {
  var locs = {!!json_encode($cityareas)!!};
  $('#area').empty();
  $('#area').append('<option value="">Choose..</option>');
  for (var i = 0; i < locs.length; i++) {
    if (locs[i].parent_id == $("#city").val()) {
      $('#area').append('<option value=' + locs[i]["id"] + '>' + locs[i]["name"] + '</option>');
    }
  }
});
// datetime picker start
$(function () {
	var todayDate = new Date().getDate();
	$('#deadlinepicker').datetimepicker({
		format: 'DD/MM/YYYY',
		maxDate: new Date(new Date().setDate(todayDate + 30))
	});
});
// datetime picker end
$(".chk_btn").click(function () {
	if($(this).hasClass('chk_btn_checked')){
		$(this).removeClass('chk_btn_checked');
		var a = $(this).attr("id") + "tab";
		$("#" + a).hide();

		$('#quest_'+$(this).attr("id")+'_req_no').trigger("click");
	}
	else{
		$(this).addClass('chk_btn_checked');
		var a = $(this).attr("id") + "tab";
		$('#quest_'+$(this).attr("id")+'_req_yes').trigger("click");
		$("#" + a).show();
	}
});

$(".closetab").click(function() {
	$('#'+$(this).data("id")+"tab").hide();
	$("#"+$(this).data("id")).removeClass('chk_btn_checked');
});

$('input[type="checkbox"][id^="quest_"]').click( function() {
	var id = $(this).data("id");
	if($(this).prop("id").indexOf('yes')!=-1){
		$('#'+id+'tab input[name^="quest_"]').not('input[type="checkbox"]').prop("required", true);
		$('#'+id+'tab select[name^="quest_"]').not('input[type="checkbox"]').prop("required", true);

		$('#quest_'+id+'_req_yes').prop("checked", true);
		$('#quest_'+id+'_req_no').prop("checked", false);
	}
	else if($(this).prop("id").indexOf('no')!=-1){
		$('#'+id+'tab input[name^="quest_"]').prop("required", false);
		$('#'+id+'tab select[name^="quest_"]').prop("required", false);

		$('#quest_'+id+'_req_yes').prop("checked", false);
		$('#quest_'+id+'_req_no').prop("checked", true);
	}
});

$('#skills').tagsinput();
$('#quest_language').tagsinput();

$('#job_description').richText();

$('#basicinfoform').submit( function (event) {
	event.preventDefault();
	// $('#job_tags').val($('#job_tag').val());
	var data = $('#basicinfoform').serialize();

	$.ajax({
		url : '/employer/postjob',
		// type : "POST",
		data: data,
		success: function(data){
			$('#questjobid').val(data.jobid);
			$('#questiontab').trigger('click');
		}
	});
	return false;
});

$('#skipbtn').click( function () {
	if($('#questjobid').val() == 0) {
		return;
	}
	window.location="/employer/postjobpublish?job_id="+$('#questjobid').val();
	// $.ajax({
	// 	url : '/employer/postjobpublish',
	// 	data: {job_id:$('#questjobid').val()},
	// 	success: function(data){
	// 		$('#questjobid').val(data.jobid);
	// 	}
	// });
});

$('#previous1').on('click', function (event) {
	$('#basictab').trigger('click');
});

$('#questionform').submit( function () {
	if($('#questjobid').val() == 0) {
		event.preventDefault();
	}
});
</script>
@endsection
