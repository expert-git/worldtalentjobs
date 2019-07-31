{{-- Header --}}
@extends('dashboard.layout.admin_layout')
@section('page_title')
    HomePage
@endsection

@section('content')

    <style>
        .ico-03 {
            border-radius: 3px #a6b1be;
        }

        .help_text {
            color: red;
            display: none;
        }
    </style>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <h1 class="getsta">Get Started with World Talent Jobs</h1>

            </div>
            <form method="POST" id="basic" enctype="multipart/form-data"
                  action="/inspector/updateimage">

                    <input type="hidden" value="{{$id}}" name="id">
            <h3 class="personal" style="padding-bottom:5%">Personal Info</h3>
            <p>Profile Picture</p>
            <div class="profileicon" style="min-width: 150px !important; min-height: 150px !important;">
                <div class="row">
                    <div class="col-md-3">
                            {{ csrf_field() }}
							@if(file_exists($jobs[0]->profile_img))	
                                <img src="/{{$jobs[0]->profile_img}}" style=" margin-left: auto; margin-right: auto;"
                                     width="250px;">
                            @else
                                <img src="/img/profile.png" style=" margin-left: auto; margin-right: auto;"
                                     width="250px;">
                        @endif
                    </div>
                    <div class="col-md-9"></div>
                </div>
            </div>
            <div class="profilebtn">
                <div class="row" style="margin-top:2%">
                    <div class="col-md-3">
                        <input type="file" id="avatar" name="avatar">
                        @if(file_exists($jobs[0]->profile_img))	

                         <button type="submit" style="  border: 1px solid #e86850; float:right; color:#e86850" class="remove btn-profile">Remove
                        </button>
                      
                        @else
                        <button type="button" style="  border: 1px solid #7889ff; color:#7889ff;"
                                class="remove btn-profile change_profile_pic">Change
                        </button>
                        @endif
                    </div>
                    <div class="col-md-9"></div>
                </div>
            </div>
            </form>
        </div>
    </section>
    <form method="POST" action="/inspector/updateProfileBasic" id="personal_detail_form">
    <section>
        <div class="container">

            <div class="row">


                    <div class="col-md-6">
                        {{ csrf_field() }}

                        <input type="hidden" value="{{$id}}" name="id">
                        <label>Full Name</label>
                        <input name="full_name" required class="ico-03" value="{{$jobs[0]->full_name}}" type="text" id="full_name" placeholder="Name">
                        <small class="help_text">Full name required..</small>


                    </div>

                    <div class="col-md-3">

                        <label>Gender</label>


                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" id="jobseeker_gender"
                                   name="jobseeker_gender" checked value="Male">Male
                        </div>
                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" id="jobseeker_gender" value="Female"
                                   @if($jobs[0]->jobseeker_gender=="female") checked @endif name="jobseeker_gender">Female
                        </div>

                    </div>

                    <div class="col-md-3">

                        <p class="fullname ">Status</p>


                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" name="jobseeker_maritalstatus"
                                   id="jobseeker_maritalstatus" checked value="Single">Single
                        </div>
                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" name="jobseeker_maritalstatus"
                                   id="inlineCheckbox2" @if($jobs[0]->jobseeker_maritalstatus=="married") checked
                                   @endif value="Married">Married
                        </div>


                    </div>

            </div>


            <div class="row">

                <div class='col-md-6'>
                    <p class="fullname ">Date of Birth</p>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='date' id="jobseeker_dob" name="jobseeker_dob" value="{{$jobs[0]->jobseeker_dob}}"
                                   style="    line-height: 50px;" class="ico-03" class="form-control"/>
                                   <small class="help_text">Date of Birth required..</small>
                            <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                   <br>
                  
                        </div>
                    </div>
                </div>

                <div class='col-md-3'>

                    <p class="fullname ">Nationality</p>
                    <div class="form-row align-items-center">
                        <div class="ico-03" class="col-auto my-1">

                            <select required name="jobseeker_nationality" value="{{$jobs[0]->jobseeker_nationality}}"
                                    class="ico-03 natidropdo custom-select mr-sm-2" id="jobseeker_nationality">
                                <option value="">Choose...</option>
                                @foreach($nationality as $nation)
                                    <option @if($nation->name==$jobs[0]->jobseeker_nationality) selected
                                            @endif value="{{$nation->name}}"> {{$nation->name}}</option>
                                @endforeach


                            </select>
							<small class="help_text">Nationality required..</small>
                        </div>
                        
                    </div>

                </div>

                <div class='col-md-3'>

                    <p class="fullname ">Residence Location</p>
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">

                            <select required value="{{$jobs[0]->jobseeker_current_location}}"
                                    name="jobseeker_current_location" class="natidropdo custom-select mr-sm-2"
                                    id="jobseeker_current_location">
                               

                                @foreach($country as $cnt)
                                    <option @if($cnt->name==$jobs[0]->jobseeker_current_location) selected
                                            @endif value="{{$cnt->name}}"> {{$cnt->name}}</option>
                                @endforeach

                            </select>
                            <small class="help_text">Residence location required..</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">

                    <label>Visa Status</label>
                    <input required value="{{$jobs[0]->VISA_status}}" name="VISA_status" class="ico-03"
                           class="form-control" type="text" id="VISA_status" placeholder="">
                    <small class="help_text">Visa status required..</small>
                </div>

                <div class="col-md-6">
                    <div class="checkbox">
                        <label>Driving License Issued From

                            <label style="float:right" class="chelisence"><input value="{{$jobs[0]->jobseeker_dob}}"
                                                                                 type="checkbox" value="1"
                                                                                 name="driving">I have License</label>
                        </label>
                        <input value="{{$jobs[0]->Driving_Licence}}" name="Driving_Licence" class="ico-03 form-control" id="Driving_Licence" type="text" placeholder="">
                        <small class="help_text">Driving license required..</small>
                    </div>

                </div>


            </div>

            <div class="row">

                <div class="col-md-6">

                    <label>Languages</label>
                    <input required name="Languages" value="{{$jobs[0]->Languages}}" class="ico-03" class="form-control" id="Languages" type="text" placeholder="">
                    <small class="help_text">Languages required..</small>
                </div>

                <div class="col-md-5">

                    <p class="fullname ">NOC</p>


                    <p>
                    <div class="col-sm-12 col-md-6">
                        <input required class="form-check-input" type="radio" name="NOC" @if($jobs[0]->NOC==1) checked
                               @endif id="inlineCheckbox1" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Available</label>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <input required class="form-check-input" type="radio" name="NOC" @if($jobs[0]->NOC==0) checked
                               @endif id="inlineCheckbox2" value="0">
                        <label class="form-check-label" for="inlineCheckbox2">Non-Available</label>

                    </div>
                    </p>

                </div>


            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h3 class="personal">Contact Info</h3>
            <div class="row">
                <div class="col-md-6">

                    <label>Email Address</label>
                    <input required class="ico-03" class="form-control" name="jobseeker_email"
                           value="{{$email}}" disabled type="text" id="jobseeker_email" placeholder="">
                    <small class="help_text">Email address required..</small>
                </div>


                <div class="col-md-6">

                    <label>Mobile</label>
                    <input required class="ico-03 form-control" name="jobseeker_phone1"
                           value="{{$jobs[0]->jobseeker_phone1}}" id="jobseeker_phone1" type="text" placeholder="">
                    <small class="help_text">Mobile required..</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 col-sm-12" style="margin-top:5%">
                    <button class="ico-03 profile-btn personal_info" data-form-id="personal_detail_form" style="float:right"
                            type="submit">UPDATE
                    </button>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    </section>


    <section>

        <div class="container">

            <h3 class="personal">Target Job</h3>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Job Target Tags (Comma separate tags, such as required skills
                    or technologies, for this job minimum of 2)</label>
                <textarea required name="target_tags" value="{{$jobs[0]->target_tags}}" class="ico-03"
                          id="target_tags" rows="3">{{$jobs[0]->target_tags}}</textarea>
                <small class="help_text">Target job required..</small>
            </div>


            <div class="col-md-6">

                <div class="row">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Job Title</label>
                        <input required name="target_title" value="{{$jobs[0]->target_title}}" type="test"
                               class="ico-03" id="target_title" placeholder="">
                        <small class="help_text">Job title required..</small>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                   
                        <label for="exampleFormControlInput1">Job Location</label>

                        <select value="{{$jobs[0]->target_location}}" name="target_location"
                                class="ico-03 natidropdo custom-select mr-sm-2" id="locationdrop">
                            @foreach($division as $ind)
                            @if($ind->id==$ind->parent)
                                <option value="{{$ind->id}}"
                                        @if($ind->id==$jobs[0]->target_location) selected @endif>{{$ind->name}}</option>

                                        @endif

                            @endforeach


                        </select>

                        
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                   
                        <label for="exampleFormControlInput1">Job Location</label>

                        <select value="{{$jobs[0]->target_location}}" name="target_location"
                                class="ico-03 natidropdo custom-select mr-sm-2" id="target_location">
                            @foreach($division as $ind)

                                <option value="{{$ind->id}}"
                                        @if($ind->id==$jobs[0]->target_location) selected @endif>{{$ind->name}}</option>


                            @endforeach


                        </select>

                        
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Monthly Salary</label>
                        <input required name="target_salary" value="{{$jobs[0]->target_salary}}" type="test"
                               class="ico-03" id="target_salary" placeholder="">
                        <small class="help_text">Monthly salary required..</small>
                    </div>
                </div>
            </div>


            <div class="col-md-6">

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Job Industry</label>
                    <select value="{{$jobs[0]->target_industry}}" name="target_industry"
                            class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
                        @foreach($get_ind as $ind)

                            <option value="{{$ind->industrytypename}}"
                                    @if($ind->industrytypename==$jobs[0]->target_industry) selected @endif>{{$ind->industrytypename}}</option>


                        @endforeach


                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Career Level</label>
                    <select required value="{{$jobs[0]->target_career_level}}" name="target_career_level"
                            class="ico-03 natidropdo custom-select mr-sm-2" id="target_career_level">
							<option value="Senoior Level">Senoior Level</option>
							<option value="Director/Head">Director/Head</option>
							<option value="Management">Management</option>
							<option value="Mid Career">Mid Career</option>
							<option value="Entry Level">Entry Level</option>
							<option value="Intermediate">Intermediate</option>
                    </select>
                    <small class="help_text">Career level required..</small>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlSelect1">Notice Period</label>
                    <select value="{{$jobs[0]->target_notice_period}}" name="target_notice_period"
                            class="ico-03 natidropdo custom-select mr-sm-2" id="target_notice_period">
                        <option value="Immediately">Immediately</option>
                        <option value="1 Month or less">1 Month or less</option>
                        <option value="3 Month or less">3 Month or less</option>
                        <option value="6 Month or less">6 Month or less</option>
                        <option value="More than 6 Months">More than 6 Months</option>
                        <option value="More than 1 Year">More than 1 Year</option>

                    </select>
                </div>


            </div>


            <div class="form-group">
                <label>Career Objective</label>
                <textarea required value="{{$jobs[0]->target_objective}}" name="target_objective" class="ico-03"
                          id="target_objective" rows="3">{{$jobs[0]->target_objective}}</textarea>
                <small class="help_text">Career Objective required..</small>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Employment Type </label>
                        <select value="{{$jobs[0]->target_employment_type}}" name="target_employment_type"
                                class="ico-03" id="target_employment_type">
								<option value="Commission">Commission</option>
								<option value="Contractor">Contractor</option>
								<option value="Freelancer">Freelancer</option>
								<option value="Full Time Employee">Full Time Employee</option>
								<option value="Internship">Internship</option>
								<option value="Part Time Employee">Part Time Employee</option>
								<option value="Temporary Employee">Temporary Employee</option>
								<option value="Volunteer">Volunteer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="col-md-2"></div>
                <div class="col-md-8 col-sm-12" style="margin-top:5%">
                    <button class="ico-03 profile-btn target_job" data-form-id="personal_detail_form" style="float:right"
                            type="submit">UPDATE
                    </button>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    </section>
    </form>

    <section>
        <br><br>
        <div class="container">


            <form method="POST" id="education_form" action="/inspector/updateEducation">
                {{ csrf_field() }}

                                    <input type="hidden" value="{{$id}}" name="id">

                <h3 class="personal">Education</h3>


                <div class="Ceritificatesinfot">
                    <p class="Ceritificatesinfot">Ceritificates </p>
                    <div class="form-group">
                        <input type="hidden" name="degree" value="{{$edu->degree}}">
                        <p id="loading"></p>
                        <input type="file" id="fileupload" name="photos[]" data-url="/jobseeker/uploaddoc" multiple="">
                        <div id="certificates">
                        </div>

                        <!--<button type="file" id="exampleFormControlFile1" class="dergpdf1 form-control-file" btn btn-default">UPLOAD NEW</button>
                        -->
                    </div>
                </div>
                @php $i = 1; @endphp
                @foreach($edu->details as $key=>$e)
                  
                    <div   id="eduid{{$key}}">
                    <p>Degree</p>
                    <div class="col-md-12" >
                        <div class="row" id="education_detail_{{$i}}">
                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
							<!--	{{$high = ''}}
								@isset($e->high)
									@if($e->high==1) 
										$high = checked; 
									@endif
								@endisset-->
								
                                    <input class="form-check-input degree_detail" data-type="{{$i}}"
                                            name="high[]" type="checkbox"
                                           id="inlineCheckbox1" {{ $high }} value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">High school </label>
                                </div>

                                <div class="form-check form-check-inline">
								<!--	{{$diploma = ''}}
									@isset($e->diploma)
										@if($e->diploma==1) 
											$diploma = checked; 
										@endif
									@endisset-->
                                    <input class="form-check-input degree_detail" data-type="{{$i}}" name="diploma[]" {{ $diploma }} type="checkbox" id="inlineCheckbox1"
                                           value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Diploma</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
									{{$bach = ''}}
								<!--	@isset($e->bach)
										@if($e->bach==1) 
											$bach = checked; 
										@endif
									@endisset -->
                                    <input class="form-check-input degree_detail" data-type="{{$i}}" name="bach[]" {{ $bach }} type="checkbox" id="inlineCheckbox1"
                                           value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Bachelor's degree</label>
                                </div>

                                <div class="form-check form-check-inline">
								<!--	{{$higher = ''}}
									@isset($e->higher)
										@if($e->higher==1) 
											$higher = checked; 
										@endif
									@endisset-->
                                    <input class="form-check-input degree_detail" data-type="{{$i}}" name="higher[]" {{ $higher }} type="checkbox" id="inlineCheckbox1"
                                           value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Higher diploma</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
									<!--{{$master = ''}}
									@isset($e->master)
										@if($e->master==1) 
											$master = checked; 
										@endif
									@endisset-->
                                    <input class="form-check-input degree_detail" data-type="{{$i}}" name="master[]" {{ $master }} type="checkbox" id="inlineCheckbox1"
                                           value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Master degree</label>
                                </div>

                                <div class="form-check form-check-inline">
								<!--	{{$doctorate = ''}}
									@isset($e->doctorate)
										@if($e->doctorate==1) 
											$doctorate = checked; 
										@endif
									@endisset-->
                                    <input class="form-check-input degree_detail" data-type="{{$i}}" name="doctorate[]" {{ $doctorate }} type="checkbox" id="inlineCheckbox1"
                                           value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">Doctorate</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Major / Stream</label>
                                <input type="text" name="stream[]" value="{{$e->stream}}" class="ico-03"
                                       id="exampleFormControlInput1" placeholder="">

                                       <small class="help_text">Major/ Stream required..</small>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Start Date</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='date' name="sdate[]" value="{{$e->sdate}}" name="sdate"
                                           style="    line-height: 50px;" class="ico-03" class="form-control"/>
                                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>

                   </span>
                   <small class="help_text">Start Date required..</small>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">End Date <span style="color:red;float:right" kid="{{$key}}" class="edudel"><b>Delete</b></span></label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='date' name="edate[]" value="{{$e->edate}}" name="edate"
                                           style="    line-height: 50px;" class="ico-03" class="form-control"/>
                                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                   <small class="help_text">End Date required..</small>
                                </div>


                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="current"
                                       value="option1"> I currently Study Here
                            </div>
                        </div>
                    </div>







                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Country </label>
                                <select value="{{$e->country}}" name="country[]" class="ico-03"
                                        id="exampleFormControlSelect1">
                                    <option value="">Choose...</option>
									@foreach($country as $cnt)
										<option @if($cnt->name==$e->country) selected
												@endif value="{{$cnt->name}}"> {{$cnt->name}}</option>
									@endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">City</label>
                                <input type="test" class="ico-03" value="{{$e->city}}" name="city[]"
                                       id="exampleFormControlInput1" placeholder="">
                                       <small class="help_text">City required..</small>
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Grading System </label>
                                <select class="ico-03" value="{{$e->grading}}" name="grading[]"
                                        id="exampleFormControlSelect1">
									<option value="1" @if($e->grading == 1) selected
												@endif>4-Point GPA</option>
									<option value="2" @if($e->grading == 2) selected
												@endif>5-Point GPA</option>
									<option value="3" @if($e->grading == 3) selected
												@endif>20-Point GPA</option>
									<option value="4" @if($e->grading == 4) selected
												@endif>Percentage (out of 100)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">score</label>
                                <input type="test" class="ico-03" value="{{$e->score}}" name="score[]"
                                       id="exampleFormControlInput1" placeholder="">
                                       <small class="help_text">Score required..</small>
                            </div>
                        </div>


                    </div>




                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea name="description[]" class="ico-03" id="exampleFormControlTextarea1"
                                          rows="3">{{$e->description}}</textarea>

                                          <small class="help_text">Description required..</small>

                            </div>
                            </div>
                            </div>
                            </div>
                            @php $i++; @endphp
                            
                            @endforeach

                            <p>Degree</p>
                            <div class="col-md-12">
                                <div class="row" id="education_detail_1">
                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input degree_detail" data-type="1" name="high[]"
                                                   type="checkbox" id="inlineCheckbox1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">High school </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input degree_detail" data-type="1" name="diploma[]"
                                                   type="checkbox" id="inlineCheckbox1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Diploma</label>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input degree_detail" data-type="1" name="bach[]"
                                                   type="checkbox" id="inlineCheckbox1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Bachelor's
                                                degree</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input degree_detail" data-type="1" name="higher[]"
                                                   type="checkbox" id="inlineCheckbox1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Higher diploma</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input degree_detail" data-type="1" name="master[]"
                                                   type="checkbox" id="inlineCheckbox1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Master degree</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input degree_detail" data-type="1"
                                                   name="doctorate[]" type="checkbox" id="inlineCheckbox1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Doctorate</label>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Major / Stream</label>
                                        <input type="text" name="stream[]" class="ico-03" id="exampleFormControlInput1"
                                               placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Start Date</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='date' name="sdate[]" value="{{$jobs[0]->jobseeker_dob}}"
                                                   name="sdate" style="    line-height: 50px;" class="ico-03"
                                                   class="form-control"/>
                                            <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">End Date </label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='date' name="edate[]" value="edate" name="edate"
                                                   style="    line-height: 50px;" class="ico-03" class="form-control"/>
                                            <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                                        </div>


                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                               name="current" value="option1"> I currently Study Here
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Country </label>
                                        <select value="{{$jobs[0]->jobseeker_dob}}" name="country[]" class="ico-03"
                                                id="exampleFormControlSelect1">
                                            <option value="">Choose...</option>
									@foreach($country as $cnt)
										<option @if($cnt->name==$jobs[0]->jobseeker_current_location) selected
												@endif value="{{$cnt->name}}"> {{$cnt->name}}</option>
									@endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">City</label>
                                        <input type="test" class="ico-03" name="city[]" id="exampleFormControlInput1"
                                               placeholder="">
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Grading System </label>
                                        <select class="ico-03" name="grading[]" id="exampleFormControlSelect1">
                                            <option value="1">4-Point GPA</option>
											<option value="2">5-Point GPA</option>
											<option value="3">20-Point GPA</option>
											<option value="4">Percentage (out of 100)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">score</label>
                                        <input type="test" class="ico-03" name="score[]" id="exampleFormControlInput1"
                                               placeholder="">
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea value="{{$jobs[0]->description}}" name="description" description
                                                  class="ico-03" id="exampleFormControlTextarea1"
                                                  rows="3">{{$jobs[0]->description}}</textarea>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 col-sm-12" style="margin-top:5%">
                                            <button class="ico-03 profile-btn" style="float:right" id="edu_form"
                                                    type="submit">Add
                                            </button>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
           
           
           
            </form>
    </section>

    <section>
        <form action="/inspector/updateProfileExp" method="POST">
            {{ csrf_field() }}

             <input type="hidden" value="{{$id}}" name="id">
            <div class="container">
                <h3 class="personal">Work Experience</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="bio">Bio </label>
                            <textarea name="bio" id="bio" class="ico-03" id="bio" rows="3">{{$exp->bio}}.</textarea>
                            <small class="help_text">Bio required..</small>
                        </div>
                    </div>
                </div>
                @foreach($exp->experience as $key=>$e)
                    <div id="itm{{$key}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Company Name</label>
                                    <input type="test" name="companyname[]" value="{{$e->companyname}}" class="ico-03"
                                           id="exampleFormControlInput1" placeholder="">
                                           <small class="help_text">Company required..</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Website <span class="deletebtn" id="{{$key}}"
                                                                                        style="float:right"> Delete</span></label>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' value="{{$e->website}}" name="website[]"
                                               style="line-height: 50px;" class="ico-03" class="form-control"/>
                                        <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                       
                   </span>
                   <small class="help_text">Website required..</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Location</label>
                                    <input type="test" name="location[]" value="{{$e->location}}" class="ico-03"
                                           id="exampleFormControlInput1" placeholder="">
                                           <small class="help_text">Location required..</small>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Start Date</label>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='date' value="{{$e->sdate}}" name="sdate[]"
                                               style="    line-height: 50px;" class="ico-03" class="form-control"/>
                                        <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                   <small class="help_text">Date required..</small>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">End Date </label>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='date' value="{{$e->edate}}" name="edate[]"
                                               style="    line-height: 50px;" class="ico-03" class="form-control"/>
                                        <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                   <small class="help_text">Date required..</small>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="ico-03" value="{{$e->description}}" name="description[]"
                                              id="exampleFormControlTextarea1" rows="3">{{$e->description}}.</textarea>
                                              <small class="help_text">Description required..</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Company Name</label>
                            <input type="test" name="companyname[]" value="" class="ico-03"
                                   id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Website</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' value="" name="website[]" style="    line-height: 50px;"
                                       class="ico-03" class="form-control"/>
                                <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Location</label>
                            <input type="test" name="location[]" class="ico-03" id="exampleFormControlInput1"
                                   placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Start Date</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='date' name="sdate[]" style="    line-height: 50px;" class="ico-03"
                                       class="form-control"/>
                                <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">End Date</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='date' name="edate[]" style="    line-height: 50px;" class="ico-03"
                                       class="form-control"/>
                                <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="ico-03" name="description[]" id="exampleFormControlTextarea1"
                                      rows="3"></textarea>
                        </div>
                        <div id="alerts"></div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <p style="text-align:center; padding:20px;color:#000; font-weight:600; " class="dotted addnew">
                            ADD NEW EXPERIENCE </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Skills</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

                            <textarea class="ico-03" id="exampleFormControlTextarea1" name="skills"
                                      rows="3">{{$exp->skills}}</textarea>

                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!--<div class="form-group">

                           <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>

                         </div>-->

                       <!-- <p style="text-align:center; padding:20px; color:#000; font-weight:600; " class="dotted">ADD NEW
                            SKILL SET</p>-->
                        <p>External link</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">URL</label>
                            <input  type="test" name="link1" value="{{$exp->link1}}" class="ico-03"
                                   id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">URL</label>
                            <input  type="test" name="link2" value="{{$exp->link2}}" class="ico-03"
                                   id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8">

                        <p style="margin-top:50px;">Please note: Any information you change in "My Account" will also be
                            changed in your CVs.</p>

                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 col-sm-12" style="margin-top:5%">
                                <button class="ico-03 profile-btn" style="float:right" type="submit">UPDATE</button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>

                </div>


            </div>
        </form>
    </section>

    <section>
        <form id="manage_cv" action="/inspector/addcv" method="POST">
            <div class="container">
                <h3 class="personal">Resume</h3>
                {{ csrf_field() }}
                <input type="hidden" value="{{$id}}" name="id">
                <p style="margin-top:20px;">Attachments</p>

                <div class="form-group">
                    <input type="hidden" name="cv" value="{{$jobs[0]->cv}}">
                    <p id="loading"></p>
                    <input type="file" id="addcv" name="photos[]" data-url="/jobseeker/uploaddoc" multiple="">

                    <div id="mycvs"></div>
                    <button type="file" id="uploadcv" class="dergpdf1 form-control-file" btn btn-default
                    ">UPLOAD NEW</button>

                </div


            </div>

    </section>


    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12" style="margin-top:5%">
            <button class="ico-03 submit_jobse_profile" style="background-color:#28C294;float:right" type="button" data-form-id="personal_detail_form">SUBMIT</button>
        </div>
        <div class="col-md-2"></div>
    </div>
    </form>


    <!---
    <form method="post" id="programmer_form">
    <div class="form-group">
    <input name="name" type="text" id="skill" name="Skill" class="form-control">
    </div>

    <form>-->








    </body>


    <style>
        select {
            height: 38px;
            -ms-box-sizing: content-box;
            -moz-box-sizing: content-box;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
        }

        .fake-input, input[type="text"], input[type="password"], input[type="email"], input[type="number"], textarea, select {
            background-color: white;
        }
    </style>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>

        $(document).ready(function () {
            $("#locationdrop").on("change",function()
{
	//alert("a");
    var locs = {!! json_encode($division) !!};
    console.log(locs)
   // alert($("#locationdrop").val());
    $('#target_location').empty();
   for(var i=0;i<locs.length;i++)
   {
       if(locs[i].parent==$("#locationdrop").val()&&locs[i].parent!=locs[i].id)
       {
    
           $('#target_location').append('<option value='+locs[i]["id"]+'>'+locs[i]["name"]+'</option>'); 

       }
   }
  
})
			$('.change_profile_pic').click(function(e){
				e.preventDefault();
				var image = $('#avatar')[0].files.length;
				if(image > 0){
					$('#basic').submit();
				}else{
					swal({
					  text: "Please select an image to chnage the current image!",
					  icon: 'warning'
					});
				}
			})
			
			$('.submit_jobse_profile').click(function(e){
				e.preventDefault();
				var form_id = $.trim($(this).data('form-id'));
				if(validateJobseekerInfo(1) && validateJobseekerInfo(2)&&validateJobseekerEdu() && validateJobseekerExp()){
					$('#'+form_id).submit();
				}
                else
                {
                    validateJobseekerInfo(2);
                    validateJobseekerEdu();
                    validateJobseekerExp();
                }
			})
            /*update form */
			$('.personal_info').click(function(e){
				var form_id = $.trim($(this).data('form-id'));
				if (validateJobseekerInfo(1)) {
                    $('#'+form_id).submit();
                }
			})
			
			$('.target_job').click(function(){
				var form_id = $.trim($(this).data('form-id'));
				if (validateJobseekerInfo(2)) {
                    $('#'+form_id).submit();
                }
			})


            
            $('.edudel').click(function(e){
            //    alert("eduid"+$(this).attr("kid"));
               // $("#eduid"+$(this).attr("kid")).remove();
                $("#eduid" + $(this).attr("kid")).remove();
			})
            $('#edu_form').click(function(e){
                e.preventDefault();
				var form_id = $("#education_form");
				if (validateJobseekerEdu()) {
                   // alert("asd");
                    $('#education_form').submit();
                }
			})

            function validateJobseekerExp(){
				var field = '';
				var error = false;
                var companyname = document.getElementsByName('companyname[]');
                var sdate = document.getElementsByName('sdate[]');
                var edate = document.getElementsByName('edate[]');
                var location = document.getElementsByName('location[]');
                var website = document.getElementsByName('website[]');
                var description = document.getElementsByName('description[]');
                var bio=$("#bio").val();
                
                for(var i=0;i<companyname.length-1;i++) {
                 //   alert(companyname[i].value);
                  //  continue;
                    var companynamei                  = companyname[i].value;
                var sdatei      = sdate[i].value;
                var edatei = edate[i].value;
                var locationi                = location[i].value;
            
                var websitei                 = website[i].value;
              
                var descriptioni           =description[i].value;
                
                if (companynamei == '') {
                  //  alert("major"+i);
                    
                    
                    $(companyname[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(companyname[i]).parent().find('.help_text').css("display", "none");
                }

                 if (sdatei == '') {
                    $(sdate[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(sdate[i]).parent().find('.help_text').css("display", "none");
                }

                 if (edatei == '') {
                    $(edate[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(edate[i]).parent().find('.help_text').css("display", "none");
                }

                 if (locationi == '') {
                    $(location[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(location[i]).parent().find('.help_text').css("display", "none");
                }

                 if (websitei == '') {
                    $(website[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(website[i]).parent().find('.help_text').css("display", "none");
                }

              

               

                 if (descriptioni == '') {
                    $(description[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(description[i]).parent().find('.help_text').css("display", "none");
                }

                };

                if (bio == '') {
                  //  alert("major"+i);
                    
                    
                    $("#bio").parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $("#bio").parent().find('.help_text').css("display", "none");
                }
                if(error)
                {
                   // alert("false");
                    return false;
                }
                else
                {
                   // alert("true");
                    return true;
                }
            }
            function validateJobseekerEdu(){
				var field = '';
				var error = false;
                var stream = document.getElementsByName('stream[]');
                var sdate = document.getElementsByName('sdate[]');
                var edate = document.getElementsByName('edate[]');
                var country = document.getElementsByName('country[]');
                var city = document.getElementsByName('city[]');
                var grading = document.getElementsByName('grading[]');
                var score = document.getElementsByName('score[]');
                var description = document.getElementsByName('description[]');


				for(var i=0;i<stream.length-1;i++) {
                   // alert(stream[i].value);
                  //  continue;
                    var majori                  = stream[i].value;
                var sdatei      = sdate[i].value;
                var edatei = edate[i].value;
                var countryi                = country[i].value;
                var cityi            = city[i].value;
                var gradingi                 = grading[i].value;
                var scorei            = score[i].value;
                var descriptioni           =description[i].value;
                
                if (majori == '') {
                  //  alert("major"+i);
                    
                    
                    $(stream[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(stream[i]).parent().find('.help_text').css("display", "none");
                }

                 if (sdatei == '') {
                    $(sdate[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(sdate[i]).parent().find('.help_text').css("display", "none");
                }

                 if (edatei == '') {
                    $(edate[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(edate[i]).parent().find('.help_text').css("display", "none");
                }

                 if (countryi == '') {
                    $(country[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(country[i]).parent().find('.help_text').css("display", "none");
                }

                 if (cityi == '') {
                    $(city[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(city[i]).parent().find('.help_text').css("display", "none");
                }

                 if (gradingi == '') {
                    $(grading[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(grading[i]).parent().find('.help_text').css("display", "none");
                }

                 if (scorei == '') {
                    $(score[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(score[i]).parent().find('.help_text').css("display", "none");
                }

                 if (descriptioni == '') {
                    $(description[i]).parent().find('.help_text').css("display", "block");
                    if(field == ''){
                        field = 'full_name';
                    }
                    error = true;
                } else {
                    $(description[i]).parent().find('.help_text').css("display", "none");
                }

                };
                if(error)
                {
                   // alert("false");
                    return false;
                }
                else
                {
                   // alert("true");
                    return true;
                }
                }
            
			function validateJobseekerInfo(type){
				var field = '';
				var error = false;
				if(type == 1){
					var full_name                  = $('#full_name').val();
					var jobseeker_nationality      = $('#jobseeker_nationality').val();
					var jobseeker_current_location = $('#jobseeker_current_location').val();
					var VISA_status                = $('#VISA_status').val();
					var Driving_Licence            = $('#Driving_Licence').val();
					var Languages                  = $('#Languages').val();
					var jobseeker_email            = $('#jobseeker_email').val();
					var jobseeker_phone1           = $('#jobseeker_phone1').val();
					
					if (full_name == '') {
						$('#full_name').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'full_name';
						}
						error = true;
					} else {
						$('#full_name').parent().find('.help_text').css("display", "none");
					}
					
					if (jobseeker_nationality == '') {
						$('#jobseeker_nationality').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'jobseeker_nationality';
						}
						error = true;
					} else {
						$('#jobseeker_nationality').parent().find('.help_text').css("display", "none");
					}
					
					if (jobseeker_current_location == '') {
						$('#jobseeker_current_location').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'jobseeker_current_location';
						}
						error = true;
					} else {
						$('#jobseeker_current_location').parent().find('.help_text').css("display", "none");
					}
					
					if (VISA_status == '') {
						$('#VISA_status').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'VISA_status';
						}
						error = true;
					} else {
						$('#VISA_status').parent().find('.help_text').css("display", "none");
					}
					
					/*if (Driving_Licence == '') {
						$('#Driving_Licence').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'Driving_Licence';
						}
						error = true;
					} else {
						$('#Driving_Licence').parent().find('.help_text').css("display", "none");
					}
					*/
					if (Languages == '') {
						$('#Languages').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'Languages';
						}
						error = true;
					} else {
						$('#Languages').parent().find('.help_text').css("display", "none");
					}
					if (jobseeker_email == '') {
						$('#jobseeker_email').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'jobseeker_email';
						}
						error = true;
					} else {
						$('#jobseeker_email').parent().find('.help_text').css("display", "none");
					}
					
					if (jobseeker_phone1 == '') {
						$('#jobseeker_phone1').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'jobseeker_phone1';
						}
						error = true;
					} else {
						$('#jobseeker_phone1').parent().find('.help_text').css("display", "none");
					}
				}else if(type == 2){
					var target_tags = $("[name='target_tags']").val();
					var target_salary = $("[name='target_salary']").val();
					var target_objective = $("[name='target_objective']").val();
					var form_id = $.trim($(this).data('form-id'));
                    var target_title = $("[name='target_title']").val();
					var error = false;
					if (target_tags == '') {
						$('#target_tags').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'target_tags';
						}
						error = true;
					} else {
						var array = target_tags.split(",");
						if(array.length >= 2){
							if(array[0] != '' && array[1] != ''){
								$('#target_tags').parent().find('.help_text').css("display", "none");
							}else{
								var msg = 'Atleast 2 comma sepreated tags are required';
								$('#target_tags').parent().find('.help_text').css("display", "block");
								$('#target_tags').parent().find('.help_text').text(msg);
								if(field == ''){
									field = 'target_tags';
								}
								error = true;
							}
							
						}else{
							var msg = 'Atleast 2 comma sepreated tags are required';
							$('#target_tags').parent().find('.help_text').css("display", "block");
							$('#target_tags').parent().find('.help_text').text(msg);
							if(field == ''){
								field = 'target_tags';
							}
							error = true;
						}
						
					}
					
					if (target_title == '') {
						$('#target_title').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'target_title';
						}
						error = true;
					} else {
						$('#target_title').parent().find('.help_text').css("display", "none");
					}
					
					if (target_salary == '') {
						$('#target_salary').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'target_salary';
						}
						error = true;
					} else {
						$('#target_salary').parent().find('.help_text').css("display", "none");
					}
					if (target_objective == '') {
						$('#target_objective').parent().find('.help_text').css("display", "block");
						if(field == ''){
							field = 'target_objective';
						}
						error = true;
					} else {
						$("[name='target_objective']").parent().find('.help_text').css("display", "none");
					}

                    	if (target_title == '') {
						$("[name='target_title']").parent().find('.help_text').css("display", "block");
						$("[name='target_title']").focus();
						error = true;
						//return false;
					} else {
						$("[name='target_title']").parent().find('.help_text').css("display", "none");
					}
					if (error == false) {
						return true;
					}else{
						return false;
					}
					
				}
				
				if (error == false) {
					return true;
				}else{
					$('#'+field).focus();
					return false;
				}
				
			}
            /* add education details*/
            $('.degree_detail').click(function () {
                var curre_obj = $(this);
                var div_id = $(this).data('type');
                $('div#education_detail_' + div_id + ' input[type=checkbox]').each(function () {
                    if ($(this).is(":checked") && $(this).attr('name') != curre_obj.attr('name')) {
                        $(this).attr('checked', false);
                    }
                });
            })
            var files = @php echo $edu->degree; @endphp;
            var cv = @php echo $jobs[0]->cv; @endphp;

            console.log(files);
            $.each(files, function (index, file) {
                console.log(file);
                $('#certificates').append("<a href='" + file.path + "'><button type='button' class='dergpdf form-control-file btn btn-default'>" + file.name + "</button></a>");
            });

            $.each(cv, function (index, file) {
                console.log(file);
                $('#mycvs').append("<a href='/" + file.path + "'><button type='button' class='dergpdf form-control-file btn btn-default'>" + file.name + "</button></a>");
            });

            $('#alerts').append(msg);
            console.log("ready!");
            var msg = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="exampleFormControlInput1">Company Name</label><input type="test" name="companyname[]" value="" required class="ico-03" id="exampleFormControlInput1" placeholder=""></div></div><div class="col-md-6"><div class="form-group"> <label for="exampleFormControlInput1">Website</label> <div class="input-group date" id="datetimepicker1"> <input type="text" value="" required name="website[]" style="    line-height: 50px;" class="ico-03" class="form-control" /> <span class="input-group-addon">  <span class="glyphicon glyphicon-calendar"></span>  </span></div></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"> <label for="exampleFormControlInput1">Location</label> <input type="test" required name="location[]" class="ico-03" id="exampleFormControlInput1" placeholder=""> </div></div> <div class="col-md-3"> <div class="form-group"> <label for="exampleFormControlInput1">Start Date</label> <div class="input-group date" id="datetimepicker1"> <input type="date" name="sdate[]" required style=" line-height: 50px;" class="ico-03" class="form-control" /> <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div> </div></div> <div class="col-md-3"> <div class="form-group"> <label for="exampleFormControlInput1">End Date</label> <div class="input-group date" id="datetimepicker1"> <input type="date" required name="edate[]" style=" line-height: 50px;" class="ico-03" class="form-control" /> <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div> </div></div> <div class="col-md-12"> <div class="form-group"> <label for="exampleFormControlTextarea1">Description</label> <textarea required name="description[]" class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea> </div>';
            $(".addnew").on('click', function () {
                $('#alerts').append(msg);

            })

            var quill = new Quill('#bio', {
                modules: {
                    toolbar: [
                        [{header: [1, 2, false]}],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Compose an epic...',
                theme: 'snow'  // or 'bubble'
            });


            $("#edu_form").on("click", function (e) {

                var $input = $("#education_form").find("input[name=degree]");
                console.log($input.val());
                $input.val(JSON.stringify(files));

                //alert("e");
                // e.preventDefault();
            })

            $("#uploadcv").on("click", function (e) {

                var $input = $("#manage_cv").find("input[name=cv]");
                console.log($input.val());
                $input.val(JSON.stringify(cv));

//alert("e");
//e.preventDefault();
            })

            $("#avatar").change(function () {
                $("#basic").submit();
                //  alert('changed!');
            });

            $(".deletebtn").on("click", function () {
         //       alert($(this).attr("id"));

                $("#itm" + $(this).attr("id")).remove();
            })

            $('#fileupload').fileupload({
                dataType: 'json',
                add: function (e, data) {
                    $('#loading').text('Uploading...');
                    data.submit();
                },
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        files.push(file);
                        console.log(files);

                        $('#certificates').append("<button class='dergpdf form-control-file btn btn-default'>" + file.name + "</button>");

                    });
                    $('#loading').text('');
                }
            });

            $('#addcv').fileupload({
                dataType: 'json',
                add: function (e, data) {
                    $('#loading').text('Uploading...');
                    data.submit();
                },
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        cv.push(file);
                        console.log(cv);

                        $('#mycvs').append("<button class='dergpdf form-control-file btn btn-default'>" + file.name + "</button>");

                    });
                    $('#loading').text('');
                }
            });
        });
    </script>
    </html>
@endsection