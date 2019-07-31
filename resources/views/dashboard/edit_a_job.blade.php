@extends('dashboard.layout.admin_layout')
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
	<section>
        <div class="nav-header" >
            <nav>
                <ul class="top-nav detail">
                    <li ><a href="{{url('/inspector/employerdetail/'.$job->employer_id)}}">Profile</a></li>
                    <li ><a href="{{url('/inspector/jobposts/'.$job->employer_id)}}">Job Posts</a></li>
                    <li class="activeul" ><a href="{{url('/inspector/getAllCandidates/'.$job->employer_id)}}">Candidates</a></li>
                    <li class="lastlicl"><a href="{{url('/inspector/emp/message/'.$job->employer_id.'/0')}}">Messages</a></li>
                </ul>
            </nav>
        </div>
		<div style="margin-top:2%;" class="container nav-in">
			<div class="row">

				<div style="" class="col-md-8">
					<form method="POST" action="{{url('/inspector/edit_post_job')}}">
						{{ csrf_field() }}
						<input type="hidden" id="job_id" name="job_id" value="{{$job->id}}">
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label for="jobtitle">Job Title<span class="mustbeoption">*</span></label>
									<input class="ico-03" required type="text" name="jobtitle" id="jobtitle"
										   placeholder="Php Developer need for our website " value="{{$job->jobtitle}}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label for="job_description">Description<span class="mustbeoption">*</span></label>
									<textarea required id="job_description" name="job_description">{{$job->job_description}}</textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="job_industry">Job Industry<span class="mustbeoption">*</span></label>
									<select required name="job_industry" id="job_industry"
											class="ico-03 natidropdo custom-select mr-sm-2" value="{{$job->industrytype_id}}">
										<option value="" hidden>Choose...</option>
										@foreach($industry as $ind)
											<option value="{{$ind->id}}" @if($job->industrytype_id==$ind->id) selected @endif>{{$ind->industrytypename}}</option>
										@endforeach
									</select>
								</div>
							</div>
							{{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="job_category">Job Category<span class="mustbeoption">*</span></label>
                                    <select required class="multipleSelect ico-03 mr-sm-2"  name="job_category" id="job_category" value="{{$job->catagory_id}}">
                                        <option value="" hidden>Choose...</option>
                                        @foreach($jtags as $jtag)
                                        <option value="{{ $jtag->id }}" @if($job->catagory_id==$jtag->id) selected @endif>{{ $jtag->job_tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
							<div class="col-md-3">
								<label>City<span class="mustbeoption">*</span></label>
								<select id="city" name="city" value="{{$job->city_id}}" class="natidropdo custom-select mr-sm-2" required>
									<option value="">Choose...</option>
									@foreach($cityareas as $city)
										@if($city->parent_id==0)
											<option value="{{$city->id}}" @if($job->city_id==$city->id) selected @endif>{{$city->name}}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-md-3">
								<label>Location/Area<span class="mustbeoption">*</span></label>
								<select name="area" id="area" value="{{$job->area_id}}" class="natidropdo custom-select mr-sm-2" required>
									<option value="">Choose...</option>
									@foreach($cityareas as $city)
										@if($city->parent_id==$job->city_id)
											<option value="{{$city->id}}" @if($job->area_id==$city->id) selected @endif>{{$city->name}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<label for="employment_type">Employment Type<span class="mustbeoption">*</span></label>
								<select required name="employment_type" class="ico-03" id="employment_type" value="{{$job->employment_type}}">
									<option value="" hidden>Choose..</option>
									<option value="Commission" @if($job->employment_type=="Commission") selected @endif>Commission</option>
									<option value="Freelancer" @if($job->employment_type=="Freelancer") selected @endif>Freelancer</option>
									<option value="Full Time Employee" @if($job->employment_type=="Full Time Employee") selected @endif>Full Time Employee</option>
									<option value="Internship" @if($job->employment_type=="Internship") selected @endif>Internship</option>
									<option value="Part Time Employee" @if($job->employment_type=="Part Time Employee") selected @endif>Part Time Employee</option>
									<option value="Temporary Employee" @if($job->employment_type=="Temporary Employee") selected @endif>Temporary Employee</option>
									<option value="Volunteer" @if($job->employment_type=="Volunteer") selected @endif>Volunteer</option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="career_level">Career Level<span class="mustbeoption">*</span></label>
								<div class="col-auto my-1">
									<select name="career_level" required value="{{$job->career_level}}"
											style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
											placeholder="Place" class="ico-02 js-example-basic-single">
										<option value="Senior Level" @if($job->career_level=="Senior Level") selected @endif>Senior Level</option>
										<option value="Director/Head" @if($job->career_level=="Director/Head") selected @endif>Director/Head</option>
										<option value="Management" @if($job->career_level=="Management") selected @endif>Management</option>
										<option value="Mid Career" @if($job->career_level=="Mid Career") selected @endif>Mid Career</option>
										<option value="Entry Level" @if($job->career_level=="Entry Level") selected @endif>Entry Level</option>
										<option value="Intermediate" @if($job->career_level=="Intermediate") selected @endif>Intermediate</option>
									</select>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<label for="vacancies">Number of Vacancies<span class="mustbeoption">*</span></label>

								<div class="col-auto my-1">
									<select name="vacancies" value="{{$job->vacancies}}"
											style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
											placeholder="Place" class="ico-02 js-example-basic-single" value="20">
										<option value="" hidden>Choose..</option>
										@for ($i = 1; $i <= 20; $i++)
											<option value="{{ $i }}" @if($job->vacancies==$i) selected @endif>{{ $i }}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<label for="salaryrange">Salary Range (Optional)</label>
								<input class="ico-03" name="salaryrange" type="text" id="salaryrange"
									   placeholder="Qr 7000" value="{{$job->salaryrange}}">
								<small class="help_text">Salary range required..</small>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="skills">Required Skills</label>
								<input requried class="ico-03" type="text" id="skills"
									   data-role="tagsinput" name="skills" value="{{$job->skills}}">
							</div>
							<div class='col-md-6'>
								<label for="deadlinepicker">Job Expires On<span class="mustbeoption">*</option></label>
								<div class="form-group">
									<div class='input-group date' id='deadlinepicker'>
										<input required type='text' id="deadline" name="deadline" value="{{$job->deadline}}"
											   style="height:40px; border-right:none;" placeholder="dd/mm/yyyy" />
										<span class="input-group-addon">
										<img src="/icon-img/calendar.svg" style="width:30px;height:30px;">
									</span>
										<br>
									</div>
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:40px;">
							<div class="form-group">
								<div class="col-md-3">
									<button style="background-color:#28C294; width:100%;border-radius:3px;" id="update">UPDATE</button>

								</div>
							</div>
						</div>
					</form>

					<div class="row">
						<div class="col-md-12">
							<span class="height50"></span>
							<br clear="all">
							<p>By clicking POST YOUR JOB button you are agreeing to the <b style="color:#7889ff;">Terms and
									Conditions</b></p>
							<br clear="all">
						</div>
					</div>
				</div>
			</div>
	</section>
@endsection
@section('extrascript')
	<script>
		var jobdatas = [];
		@foreach($jtags as $jtag)
		jobdatas.push({id:{{$jtag->id}}, text:'{{$jtag->job_tag}}'})
		@endforeach

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
			$('#deadlinepicker').datetimepicker({
				format: 'DD/MM/YYYY'
			});
		});
		// datetime picker end

		$('#skills').tagsinput();

		$('#job_description').richText();

	</script>
@endsection
