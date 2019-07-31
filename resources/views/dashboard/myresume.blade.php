{{-- Header --}}
@extends('dashboard.layout.public_layout')
@section('page_title')
    HomePage
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('theme/css/tagsinput-combo.css') }}">
    <style>
        .ico-03 {
            border-radius: 3px #a6b1be;
        }

        .help_text {
            color: red;
            display: none;
        }

        .fake-input, input[type="text"], input[type="password"], input[type="email"], input[type="number"], textarea, select {
            background-color: white;
        }
        .mainreumse{
            margin-top: 45px;
        }
        #editresumebtns:first-child{
            margin-left: 120px;
        }
        #editresumebtns {
            margin-top: 30px;
            margin-left: 120px;
        }
        #editresumebtns .row {
            margin: 0px;
        }
        
    </style>
    <section>
        <div class="container" style="width:80%;">

            
        </div>
    </section>

    <div class="nav-header" >
        <nav>
            <ul class="top-nav detail">
                <li class="activeul"><a href="{{url('/inspector/jbs/getProfile/'.$id)}}">Profile</a></li>
                <li><a href="{{url('/inspector/jbs/jobs/'.$id).'/0'}}">Jobs</a></li>
                <li class="lastlicl"><a href="{{url('/inspector/jbs/message/'.$id.'/0')}}">Messages</a></li>
            </ul>
        </nav>
    </div>
    <div id="editresumebtns">
        <div class="row">
            <h4 class="Posthed col-md-2" style="padding:0px"><a href="{{url('/inspector/jbs/getProfile/'.$id)}}"> Settings</a> </h4>
            <h4 class="Posthed col-md-2"><a href="{{url('/inspector/jbs/getresume/'.$id)}}" style="color:#7889FF;">Resume</a></h4>

        </div>
    </div>


    <div class="mainreumse">
    <form method="POST" action="{{url('/inspector/jbs/editresume/postbasicedit/')}}" id="personal_detail_form">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$id}}">
        <section>
            <div class="container">

                <div class="row">
                    <!-- name start -->
                    <div class="col-md-3">

                        <label>First Name<span class="mustbeoption">*</span></label>
                        <input required class="ico-03" value="{{$jobs[0]->first_name}}" type="text" id="first_name" name="first_name" placeholder="First name"/>
                        <small class="help_text">First name required..</small>

                    </div>

                    <div class="col-md-3">

                        <label>Last Name<span class="mustbeoption">*</span></label>
                        <input required class="ico-03" value="{{$jobs[0]->last_name}}" type="text" id="last_name" name="last_name" placeholder="Last name"/>
                        <small class="help_text">Last name required..</small>

                    </div>
                    <!-- name end -->

                    <!-- gender start -->
                    <div class="col-md-3">

                        <label>Gender<span class="mustbeoption">*</span></label>

                        <div class="checkbox checkbox-primary">
                            <input id="jobseeker_gender_male" name="jobseeker_gender_male" type="checkbox" @if($jobs[0]->jobseeker_gender=="male") checked @endif/>
                            <label for="jobseeker_gender_male">
                                Male
                            </label>
                        </div>

                        <div class="checkbox checkbox-primary">
                            <input id="jobseeker_gender_female" name="jobseeker_gender_female" type="checkbox" @if($jobs[0]->jobseeker_gender=="female") checked @endif/>
                            <label for="jobseeker_gender_female">
                                Female
                            </label>
                        </div>

                    </div>
                    <!-- gender end -->

                    <!-- marital status start -->
                    <div class="col-md-3">

                        <p class="fullname ">Marital Status<span class="mustbeoption">*</span></p>

                        <div class="checkbox checkbox-primary">
                            <input id="jobseeker_maritalstatus_single" name="jobseeker_maritalstatus_single" type="checkbox" @if($jobs[0]->jobseeker_maritalstatus=="single") checked @endif/>
                            <label for="jobseeker_maritalstatus_single">
                                Single
                            </label>
                        </div>

                        <div class="checkbox checkbox-primary">
                            <input id="jobseeker_maritalstatus_married" name="jobseeker_maritalstatus_married" type="checkbox" @if($jobs[0]->jobseeker_maritalstatus=="married") checked @endif/>
                            <label for="jobseeker_maritalstatus_married">
                                Married
                            </label>
                        </div>

                    </div>
                    <!-- marital status end -->

                </div>

                <div class="row">
                    <div class='col-md-6'>
                        <p class="fullname ">Date of Birth<span class="mustbeoption">*</span></p>
                        <div class="form-group">
                            <div class='input-group date' id='jobseeker_dob_datetimepicker'>
                                <input style="margin: 0px" required type='text' id="jobseeker_dob" name="jobseeker_dob" value="{{$jobs[0]->jobseeker_dob}}"
                                    style="height:40px; border-right:none;" placeholder="dd/mm/yyyy"/>
                                <small class="help_text">Date of Birth required..</small>
                                <span class="input-group-addon">
                                    <img src="/icon-img/calendar.svg" style="width:30px;height:30px;">                        
                                </span>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class='col-md-3'>

                        <p class="fullname ">Nationality<span class="mustbeoption">*</span></p>
                        <div class="form-row align-items-center">
                            <div class="ico-03" class="col-auto my-1">

                                <select required name="jobseeker_nationality" 
                                        class="ico-03 natidropdo custom-select mr-sm-2" id="jobseeker_nationality">
                                    <option value="" hidden>Choose...</option>
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

                        <p class="fullname ">Residence Location<span class="mustbeoption">*</span></p>
                        <div class="form-row align-items-center">
                            <div class="col-auto my-1">

                                <select required value="{{$jobs[0]->jobseeker_current_location}}"
                                        name="jobseeker_current_location" class="natidropdo custom-select mr-sm-2"
                                        id="jobseeker_current_location">
                                    <option value="" hidden>Choose...</option>

                                    @foreach( $country as $cnt )
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

                        <label>Visa Status<span class="mustbeoption">*</span></label>
                        <select required value="{{$jobs[0]->VISA_status}}"
                                name="VISA_status" class="natidropdo custom-select mr-sm-2"
                                id="VISA_status">
                            <option value="" hidden>Choose...</option>

                            @foreach( $visas as $visa )
                                <option @if($visa==$jobs[0]->VISA_status) selected
                                        @endif value="{{$visa}}"> {{$visa}}</option>
                            @endforeach

                        </select>
                        <small class="help_text">Visa status required..</small>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-6" style="padding-left:0px">
                            <label>Driving License Issued From<span class="mustbeoption">*</span></label>
                        </div>
                        <div class="col-md-6" style="padding-right:0px">
                            <div class="checkbox checkbox-success" style="float:right; margin:0px">
                                <input type="checkbox" name="driving" id="driving">
                                <label for="driving">
                                    I have driving license
                                </label>
                            </div>
                        </div>
                        <input value="{{$jobs[0]->Driving_Licence}}" name="Driving_Licence" class="ico-03" id="Driving_Licence" type="text" placeholder="">
                        <small class="help_text">Driving license required..</small>
                        
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label>Languages<span class="mustbeoption">*</span></label>
                        <input required name="Languages" value="{{$jobs[0]->Languages}}" class="ico-03" class="form-control" id="Languages" type="text" placeholder="">
                        <small class="help_text">Languages required..</small>
                    </div>

                    <div class="col-md-5">

                        <p class="fullname ">NOC<span class="mustbeoption">*</span></p>
                        <div class="checkbox checkbox-primary">
                            <input id="NOC_avaiable" name="NOC_avaiable" type="checkbox" @if($jobs[0]->NOC==1) checked @endif/>
                            <label for="NOC_avaiable">
                                Available
                            </label>
                        </div>

                        <div class="checkbox checkbox-primary">
                        <input id="NOC_navaiable" name="NOC_navaiable" type="checkbox" @if($jobs[0]->NOC==0) checked @endif/>
                            <label for="NOC_navaiable">
                                Non-Available
                            </label>
                        </div>
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
                            value="{{$jobs[0]->email}}" disabled type="text" id="jobseeker_email" placeholder="">
                        <small class="help_text">Email address required..</small>
                    </div>


                    <div class="col-md-6">

                        <label>Mobile<span class="mustbeoption">*</span></label>
                        <input required id="jobseeker_phone1" name="jobseeker_phone1" type="tel" value="{{$jobs[0]->jobseeker_phone1}}" class="ico-03">
                        <input type="hidden" id="jobseeker_phone" name="jobseeker_phone">
                        <small class="help_text">Mobile required..</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ">

                        @if ($errors->any())

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="alert alert-danger" id="basicprofileerrbag" style="text-align:center;display:none;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 " style="margin-top:15px">
                        <button class="profile-btn personal_info" data-form-id="personal_detail_form" 
                                type="submit" id="personaldetailsubmit">UPDATE
                        </button>
                    </div>
                </div>
            </div>

        </section>
    </form>

    <form method="POST" action="/inspector/jbs/editresume/postupdatetargetjob" id="personal_target_job">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$jbid}}">
        <input type="hidden" id="target_jobs" name="target_jobs">
        <section>

            <div class="container">

                <h3 class="personal">Target Job</h3>

                <div class="form-group">
                    <label>Job Target Tags<span class="mustbeoption">*</span> (Comma separate tags, such as required skills
                        or technologies, Minimum of 2)</label>
                    <select required class="multipleSelect ico-03 mr-sm-2" multiple  name="target_job" id="target_job" value="{{$jobs[0]->target_tags}}">
                    </select>
                    <small class="help_text">Target job required..</small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Title<span class="mustbeoption">*</span></label>
                            <input required name="target_title" value="{{$jobs[0]->target_title}}" type="text"
                                class="ico-03" id="target_title" placeholder="">
                            <small class="help_text">Job title required..</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="target_industry">Job Industry<span class="mustbeoption">*</span></label>
                            <select required value="{{$jobs[0]->target_industry}}" name="target_industry"
                                    class="ico-03 natidropdo custom-select mr-sm-2" id="target_industry">
                                    <option value="" hidden>Choose...</option>

                                @foreach($get_ind as $ind)

                                    <option value="{{$ind->industrytypename}}"
                                            @if($ind->industrytypename==$jobs[0]->target_industry) selected @endif>{{$ind->industrytypename}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- ========================= job location start ======================= -->

                    <div class="col-md-6">
                        <div class="form-group" style="position:relative;">
                            <label>Job Location<span class="mustbeoption">*</span></label>
                            <!-- <select required class="multipleSelect ico-03 mr-sm-2" multiple  name="target_location" id="target_location">
                            </select> -->
                            <input type="hidden" id="target_locations" name="target_locations">

                            <div id="target_location_input">
                                <input name="Job Location" id="joblocation" style="position: absolute;background:none;width:100%;border:none;z-index:-1;height:48px;">
                                <input name="target_location" id="target_location" data-role="tagsinput" data-toggle="dropdown">
                            </div>

                            <div id="accordion-city" class="locationdropdown" role="menu" aria-labelledby="target_location">
                                <ul>
                                @foreach($city_areas as $city)
                                    <li>
                                        <div class="checkbox checkbox-primary" style="display:inline-block;">
                                            <input type="checkbox" id="city_area{{$city['id']}}" data-type="city" data-id="{{$city['id']}}" data-name="{{$city['name']}}">
                                            <label for="city_area{{$city['id']}}">
                                                {{$city['name']}}
                                            </label>
                                        </div>

                                        <div data-id="{{$city['id']}}" class="tagsinputtoggle" style="display:inline-block;cursor:pointer;">
                                            <img src="/icon-img/down.png" style="width:20px;height:20px;">
                                        </div>
                                        
                                        <div id="collapse-city{{$city['id']}}" class="collapse">
                                        <ul>
                                            @foreach($city['areas'] as $area)
                                                <li>
                                                    <div class="checkbox checkbox-primary">
                                                        <input type="checkbox" id="city_area{{$area['id']}}" data-type="area" data-parid="{{$city['id']}}" data-id="{{$area['id']}}" data-name="{{$area['name']}}">
                                                        <label for="city_area{{$area['id']}}">
                                                            {{$area['name']}}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- ========================= job location end ======================= -->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="target_career_level">Career Level<span class="mustbeoption">*</span></label>
                            <select required value="{{$jobs[0]->target_career_level}}" name="target_career_level"
                                    class="ico-03 natidropdo custom-select mr-sm-2" id="target_career_level">
                                    <option value="" hidden>Choose...</option>
                                    <option @if($jobs[0]->target_career_level=="Senior Level") selected @endif value="Senior Level">Senior Level</option>
                                    <option @if($jobs[0]->target_career_level=="Director/Head") selected @endif value="Director/Head">Director/Head</option>
                                    <option @if($jobs[0]->target_career_level=="Management") selected @endif value="Management">Management</option>
                                    <option @if($jobs[0]->target_career_level=="Mid Career") selected @endif value="Mid Career">Mid Career</option>
                                    <option @if($jobs[0]->target_career_level=="Entry Level") selected @endif value="Entry Level">Entry Level</option>
                                    <option @if($jobs[0]->target_career_level=="Intermediate") selected @endif value="Intermediate">Intermediate</option>
                            </select>
                            <small class="help_text">Career level required..</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Monthly Salary<span class="mustbeoption">*</span></label>
                            <input required name="target_salary" value="{{$jobs[0]->target_salary}}" type="text"
                                class="ico-03" id="target_salary" placeholder="">
                            <small class="help_text">Monthly salary required..</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="target_notice_period">Notice Period<span class="mustbeoption">*</span></label>
                            <select required value="{{$jobs[0]->target_notice_period}}" name="target_notice_period"
                                    class="ico-03 natidropdo custom-select mr-sm-2" id="target_notice_period">
                                <option value="" hidden>Choose...</option>
                                <option @if($jobs[0]->target_notice_period=="Immediately") selected @endif value="Immediately">Immediately</option>
                                <option @if($jobs[0]->target_notice_period=="1 Month or less") selected @endif value="1 Month or less">1 Month or less</option>
                                <option @if($jobs[0]->target_notice_period=="2 Month or less") selected @endif value="2 Month or less">2 Month or less</option>
                                <option @if($jobs[0]->target_notice_period=="3 Month or less") selected @endif value="3 Month or less">3 Month or less</option>
                            </select>
                        </div>
                    </div>      
                </div>

                <div class="form-group">
                    <label>Career Objective<span class="mustbeoption">*</span></label>
                    <textarea required value="{{$jobs[0]->target_objective}}" name="target_objective" class="ico-03"
                            id="target_objective" style="height: 200px!important;" placeholder="type something here">{{$jobs[0]->target_objective}}</textarea>
                    <small class="help_text">Career Objective required..</small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="target_employment_type">Employment Type(Optional)</label>
                            <select value="{{$jobs[0]->target_employment_type}}" name="target_employment_type"
                                    class="ico-03" id="target_employment_type">
                                    <option value="" hidden>Choose..</option>
                                    <option @if($jobs[0]->target_employment_type=="Commission") selected @endif value="Commission">Commission</option>
                                    <option @if($jobs[0]->target_employment_type=="Freelancer") selected @endif value="Freelancer">Freelancer</option>
                                    <option @if($jobs[0]->target_employment_type=="Full Time Employee") selected @endif value="Full Time Employee">Full Time Employee</option>
                                    <option @if($jobs[0]->target_employment_type=="Internship") selected @endif value="Internship">Internship</option>
                                    <option @if($jobs[0]->target_employment_type=="Part Time Employee") selected @endif value="Part Time Employee">Part Time Employee</option>
                                    <option @if($jobs[0]->target_employment_type=="Temporary Employee") selected @endif value="Temporary Employee">Temporary Employee</option>
                                    <option @if($jobs[0]->target_employment_type=="Volunteer") selected @endif value="Volunteer">Volunteer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6" style="margin-top:10px">
                            <button class="ico-03 profile-btn target_job" data-form-id="personal_target_form" style="float:right"
                                    type="submit" id="personaltargetjobsubmit" >UPDATE
                            </button>
                        </div>
                        <div class="col-md-2"></div>
                </div>
            </div>

        </section>
    </form>

    <section>
        <div class="container">
            <h3 class="personal">Education</h3>
            <div class="row" style="margin-top:100px;" id="EducationHeader">
                <div class="col-md-12">
                    <p style="text-align:center; padding:20px;color:#000; font-weight:600; cursor:pointer;" class="dotted addnew" onclick="addedupanel()">
                        ADD NEW EDUCATION </p>
                </div>
            </div>

            @include('dashboard.education', ['edu' => $nedu, 'country' => $country ,'jbsid'=>$jbid])
            @foreach($edu as $e)
                @include('dashboard.education', ['edu' => $e, 'country' => $country ,'jbsid'=>$jbid])
            @endforeach
        </div>
    </section>

    <section>
        <div class="container">
            <h3 class="personal">Work Experience</h3>
            <div class="row" style="margin-top:100px;" id="ExperienceHeader">
                <div class="col-md-12">
                    <p style="text-align:center; padding:20px;color:#000; font-weight:600; cursor:pointer; " class="dotted addnew" onclick="addexppanel()">
                        ADD NEW EXPERIENCE </p>
                </div>
            </div>

            @include('dashboard.experience', ['exp' => $nexp, 'country' => $country, 'jbsid'=>$id ,'jbsid'=>$jbid])
            @foreach($exp as $e)
                @include('dashboard.experience', ['exp' => $e, 'country' => $country ,'jbsid'=>$id ,'jbsid'=>$jbid])
            @endforeach

            <h4 class="subpersonal" style="margin-top:100px;">Skill Sets</h4>

            <div class="row" style="margin-top:100px;" id="SkillsetHeader">
                <div class="col-md-12">
                    <p style="text-align:center; padding:20px;color:#000; font-weight:600; cursor:pointer;" class="dotted addnew" onclick="addskillset()">
                        ADD NEW SKILL SET </p>
                </div>
            </div>

            @include('dashboard.skillset', ['skillset' => $nskill,'jbsid'=>$jbid])
            @each('dashboard.skillset', $skills, 'skillset')

            <form id="ex_link_form" method="POST" action="/inspector/jbs/editresume/updateProfileExp">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$jbid}}">
                <h4 class="subpersonal" style="margin-top:100px;">External Links</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ex_link1_protocal">URL
                            </label>
                            <div class="websiteurl">
                                <select value="{{$jobs[0]->ex_link1_protocal}}" name="ex_link1_protocal" id="ex_link1_protocal">
                                    <option value="http://" @if($jobs[0]->ex_link1_protocal=="http://") selected @endif>http://</option>
                                    <option value="https://" @if($jobs[0]->ex_link1_protocal=="https://") selected @endif>https://</option>
                                </select>
                                <input style="margin: 0px; padding-left: 100px" type='text' value="{{$jobs[0]->ex_link1}}" name="ex_link1" id="ex_link1"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ex_link2_protocal">URL
                            </label>
                            <div class="websiteurl">
                                <select value="{{$jobs[0]->ex_link2_protocal}}" name="ex_link2_protocal" id="ex_link2_protocal">
                                    <option value="http://" @if($jobs[0]->ex_link2_protocal=="http://") selected @endif>http://</option>
                                    <option value="https://" @if($jobs[0]->ex_link2_protocal=="https://") selected @endif>https://</option>
                                </select>
                                <input style="margin: 0px; padding-left: 100px" type='text' value="{{$jobs[0]->ex_link2}}" name="ex_link2" id="ex_link2"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 " style="margin-top:15px">
                        <button class="profile-btn personal_info" type="submit" id="personalexlinksubmit">UPDATE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section>
        <div class="container">
            <h3 class="personal">Upload CV(Optional)</h3>
            <form id="manage_cv" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$jbid}}">
                <input type="hidden" id="cv_id" name="cv_id"/>

                <!-- cvs start -->
                <div class="row">
                    <div class="col-md-12">
                        <p style="margin-top:20px;">Attachment</p>
                        <div class="form-group">
                            @foreach($cvs as $cv)
                                <div class="certfileinfo" id="cv_{{$cv->id}}">
                                    @include('jobseeker.cv', ['cv' => $cv])
                                </div>
                            @endforeach
                            <span class="btn-certfileupload dotted" id="btn_cvupload">
                                UPLOAD FILE
                                <input type="file" id="cvfileupload" name="cvfile">
                            </span>
                        </div>
                    </div>
                </div>
                <!-- cvs end -->
            </form>
        </div>
    </section>

    <form method="GET" id="alldata" action="/inspector/jbs/editresume/updateProfile">
        {{csrf_field()}}
        <section>
            <div class="container" style="margin-bottom:250px">
                <div class="row" style="margin-top:50px">
                    <div class="col-md-8" style="margin-top:40px;">
                        <label>Please note: Any information you change in "My Account" will also be changed in your CV.</label>
                    </div>
                    <div class="col-md-4">
                        <button class="profile-btn submit" id="allsubmit" data-form-id="alldata" >
                            SUBMIT
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <div class="row">
        <div class="col-md-12 ">
            <div class="alert alert-danger" id="errorstatus" style="text-align:center;display:none;">
            </div>
        </div>
    </div>

    @if ($errors->hasBag('alldataerr'))
        <div class="row" id="allerrorbag">
            <div class="col-md-12 ">
                <div class="alert alert-danger" style="text-align:center;">
                    <ul>
                        @foreach ($errors->alldataerr->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('extrascript')
<script>

    var input = document.querySelector("#jobseeker_phone1");
    var iti = window.intlTelInput(input, {
        separateDialCode: true,
        utilsScript: "/js/countrydiallist/js/utils.js",
    });

    $('#personal_detail_form').submit(function( event ) {
        $('#jobseeker_phone').val(iti.getNumber());

        var errdiv = $("#basicprofileerrbag");

        if($('#profimg').data("chk") == "0") {
            errdiv.css("display", "block");
            errdiv.html("Profile image is required!");
            event.preventDefault();
            return;
        }
    });

    var jobdatas = [];
    @foreach($jtags as $jtag)
        jobdatas.push({id:{{$jtag->id}}, text:'{{$jtag->job_tag}}'})
    @endforeach

    $('#target_job').select2({
        data:jobdatas,
        closeOnSelect: false
    });

    $('#target_job').val("{{$jobs[0]->target_tags}}".split(","));
    $('#target_job').trigger('change');



    // ============================== target location start =======================

    $('.tagsinputtoggle').click( function () {
        var id = $(this).data('id');
        if($('#collapse-city'+id).hasClass("in")){
            $('#collapse-city'+id).collapse('hide');
            $(this).html('<img src="/icon-img/down.png" style="width:20px;height:20px;">');
        }
        else{
            $('#collapse-city'+id).collapse('show');
            $(this).html('<img src="/icon-img/up.png" style="width:20px;height:20px;">');
        }
    });

    $('#target_location').tagsinput({
        itemValue: 'id',
        itemText: 'text'
    });

    
    var city_area_ids = "{{$jobs[0]->target_location}}".split(",");
    for(var i=0; i<city_area_ids.length; i++){
        $('#city_area'+city_area_ids[i]).prop('checked', true);
    }

    $('input[id^="city_area"]').each(function(index) {
        if($(this).prop('checked')){
            $('#target_location').tagsinput('add', {id: $(this).data('id'), text: $(this).data('name') });
        }
    });

    
    $('input[id^="city_area"]').click( function () {
        
        if($(this).data('type') == 'city') {
            var id = $(this).data('id');
            if($(this).prop("checked")) {
                $('input[data-type="area"][data-parid="' + id + '"]').prop("checked", true);
            }
            else{
                $('input[data-type="area"][data-parid="' + id + '"]').prop("checked", false);
            }
        }
        else if($(this).data('type') == 'area') {
            var id = $(this).data('parid');
            if($(this).prop("checked")) {
                $('input[data-type="city"][data-id="' + id + '"]').prop("checked", true);
            }
        }

        $('#target_location').tagsinput('removeAll');

        $('input[id^="city_area"]').each(function(index) {
            if($(this).prop('checked')){
                $('#target_location').tagsinput('add', {id: $(this).data('id'), text: $(this).data('name') });
            }
        });

        $('#target_location').tagsinput('refresh');
    });

    $('#target_location').on('itemRemoved', function(event) {
        $('input[id^="city_area"][data-id="' + event.item.id + '"]').prop("checked", false);
    });

    $('#target_location_input').click(function() {
        if($('#accordion-city').css("display")=="none"){
            $('#accordion-city').css("display", "block");
        }
        else{
            $('#accordion-city').css("display", "none");
        }
        event.stopPropagation();
    });

    $('html').click(function() {
        if($('#accordion-city').css("display")=="block"){
            $('#accordion-city').css("display", "none");
        }
    });

    $('#accordion-city').click(function() {
        event.stopPropagation();    
    });

    // ============================== target location end =======================

    $('#personaltargetjobsubmit').click(function(){
        if($('#target_location').val() == ''){
            var element = $('#joblocation')[0];
            element.setCustomValidity("Job Locations Required!");
            // event.preventDefault();
        }
        else{
            var element = $('#joblocation')[0];
            element.setCustomValidity("");
        }
    });

    $('#personal_target_job').submit(function( event ) {
        $('#target_jobs').val($('#target_job').val());
        $('#target_locations').val($('#target_location').val());
    });

    $('input[id^="jobseeker_gender_"]').click(function () {
        $('input[id^="jobseeker_gender_"]').each(function (index) {
            $(this).prop("checked", false);
        });
        $(this).prop("checked", true);
    });

    $('input[id^="jobseeker_maritalstatus_"]').click(function () {
        $('input[id^="jobseeker_maritalstatus_"]').each(function (index) {
            $(this).prop("checked", false);
        });
        $(this).prop("checked", true);
    });
    
    $('input[id^="NOC_"]').click(function () {
        $('input[id^="NOC_"]').each(function (index) {
            $(this).prop("checked", false);
        });
        $(this).prop("checked", true);
    });

    // profile image upload start

    $('#avatar').fileupload({
        dataType: 'json',
        add: function(e, data) {
            if(data.files[0].size > 4*1000*1000) {
                // e.preventDefault();
            }
            else{
                data.submit();
            }
        },
        done: function (e, data) {
            if(data.result.path) {
                $('#profimg').prop('src', "/"+data.result.path);
                $('#profimg').data("chk",1);
            }            
            else {
                $('#profimg').prop('src', "/img/profile.png");
                $('#profimg').data("chk",0);
            }
        },
        progressall: function (e, data) {
            
        }
    });

    // profile image upload end 

    // datetime picker start
    $(function () {
        $('#jobseeker_dob_datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    });
    // datetime picker end

    // cvs start

    $('#cvfileupload').fileupload({
        url: '/inspector/addcv',
        add: function (e, data) {
            if(data.files[0].size > 4*1000*1000) {
                // e.preventDefault();
            }
            else
            {
                data.submit();
            }
        },
        done: function (e, data) {
            var html = '<div class="certfileinfo" id="cv_' + data.result.cv_id + '">' + data.result.viewdata + '</div>';
            $(html).insertBefore( $('#btn_cvupload') );
        }
    });

    $('input[id^="cvfile_"]').fileupload({
        url: '/jobseeker/updatecv',
        dataType: 'json',
        add: function (e, data) {
            $('#cv_id').val($(this).data('id'));

            if(data.files[0].size > 4*1000*1000) {
                // e.preventDefault();
            }
            else{
                data.submit();
            }
        },
        done: function (e, data) {
            $('#cv_'+data.result.cv_id).html(data.result.viewdata);
        }
    }).bind("fileuploadchange", function(e, data) { console.log("a");});

    function removecv(id) {
        // send ajax get request
        $.ajax({
            url: "/inspector/removecv",
            data: {'cv_id':id},
            dataType: "json",
            success: function (res) {
                $('#cv_'+res.id).remove();
            }
        });
    }
    // cvs end

    // education control start
    function removeedupanel(id) {
        // send ajax get request
        $.ajax({
            url: "/inspector/removeEducation",
            data: {'edu_id':id},
            dataType: "json",
            success: function (res) {
                $('#edudiv'+res.id).remove();
            }
        });
    }

    function editedupanel(id) {
        // $('#edudiv'+id).children().prop('disabled', true);
    }    


    function addedupanel(){
        if($('#edudiv0').hasClass("in")) {
            $('#edudiv0').collapse('hide');
        }
        else{
            $('#edudiv0').collapse('show');
        }
        // if($("#edudiv0").length>0) return;
        // $.ajax({
        //     url: "/jobseeker/addEducation",
        //     success: function (data) {
        //         $(data).insertAfter( $('#EducationHeader') );
        //     }
        // });
    }
    // education control end

    // experience control start
    function removeexppanel(id) {
        // send ajax get request
        $.ajax({
            url: "/inspector/removeExperience",
            data: {'exp_id':id},
            dataType: "json",
            success: function (res) {
                $('#expdiv'+res.id).remove();
            }
        });
    }

    function editexppanel(id) {
        // $('#expdiv'+id).children().prop('disabled', true);
    }    

    function addexppanel(){
        if($('#expdiv0').hasClass("in")) {
            $('#expdiv0').collapse('hide');
        }
        else{
            $('#expdiv0').collapse('show');
        }
    }
    // experience control end    

    // skillset control start
    function removeskillset(id) {
        // send ajax get request
        $.ajax({
            url: "/inspector/removeSkillset",
            data: {'skill_id':id},
            dataType: "json",
            success: function (res) {
                $('#skdiv_'+res.id).remove();
            }
        });
    }

    function addskillset(){
        if($('#skdiv_0').hasClass("in")) {
            $('#skdiv_0').collapse('hide');
        }
        else{
            $('#skdiv_0').collapse('show');
        }
    }
    // skillset control end    
    
    $('#alldata').submit(function( event ) {
        var errdiv = $("#errorstatus");

        if($('#profimg').data("chk") == "0") {
            errdiv.css("display", "block");
            errdiv.html("Profile image is required!");
            event.preventDefault();
            return;
        }

        if($("div[id^='edudiv']").length==1){
            errdiv.css("display", "block");
            errdiv.html("Education is required!");
            event.preventDefault();
            return;
        }

        if($("div[id^='expdiv']").length==1){
            errdiv.css("display", "block");
            errdiv.html("Work Experience is required!");
            event.preventDefault();
            return;
        }
        
        $('#jobseeker_phone').val(iti.getNumber());
        $('#target_jobs').val($('#target_job').val());
        $('#target_locations').val($('#target_location').val());

        $.each ( $('#personal_detail_form input, #personal_detail_form select, #personal_detail_form textarea,' +
                    '#personal_target_job input, #personal_target_job select, #personal_target_job textarea,' +
                    '#ex_link_form input, #ex_link_form select, #ex_link_form textarea').serializeArray(), function ( i, obj ) {
            $('<input type="hidden">').prop( obj ).appendTo( $('#alldata') );
        } );
    });
</script>
@stack('scripts')
@endsection