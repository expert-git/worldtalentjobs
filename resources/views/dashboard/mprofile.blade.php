{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
    HomePage
@endsection

@section('content')

    <style>
        .ico-03
        {
            border-radius: 3px #a6b1be;
        }
    </style>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <h1 class="getsta">Get Started with World Talent Jobs</h1>

            </div>

            <h3 class="personal" style="padding-bottom:5%">Personal Info</h3>
            <p>Profile Picture</p>
            <div class="profileicon" style="min-width: 150px !important; min-height: 150px !important;">
                <div class="row">
                    <div class="col-md-3">
                        <form method="POST" enctype="multipart/form-data" action="/jobseeker/updateProfileBasic">

                            {{ csrf_field() }}
                            @if($jobs[0]->profile_img)
                                <img src="/{{$jobs[0]->profile_img}}" style=" margin-left: auto; margin-right: auto;" width="250px;">
                            @else
                                <img src="/img/profile.png" style=" margin-left: auto; margin-right: auto;" width="250px;">
                        @endif
                    </div>
                    <div class="col-md-9"></div>
                </div>
            </div>
            <div class="profilebtn">
                <div class="row" style="margin-top:2%">
                    <div class="col-md-3">
                        <input type="file" name="avatar">
                        <button type="submit" style="  border: 1px solid #7889ff; color:#7889ff;" class=  "remove    btn-profile">Change</button>
                        <button type="button" style="  border: 1px solid #e86850; float:right; color:#e86850" class="remove    btn-profile">Remove</button>
                    </div>
                    <div class="col-md-9"></div>
                </div>
            </div>

            <div class="row">

                <form method="POST" action="/jobseeker/updateProfileBasic">
                    <div class="col-md-6">
                        {{ csrf_field() }}

                        <label>Full Name</label>
                        <input name="full_name" required class="ico-03" value="{{$jobs[0]->full_name}}" type="text" placeholder="Name">




                    </div>

                    <div class="col-md-3">

                        <label>Gender</label>


                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" id="inlineCheckbox1" name="jobseeker_gender" checked  value="Male">Male
                        </div>
                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" id="inlineCheckbox2" value="Female" @if($jobs[0]->jobseeker_gender=="female") checked @endif name="jobseeker_gender">Female
                        </div>


                    </div>

                    <div class="col-md-3">

                        <p  class="fullname ">Status</p>


                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" name="jobseeker_maritalstatus" id="inlineCheckbox1" checked value="Single">Single
                        </div>
                        <div class="form-check form-check-inline">
                            <input required class="form-check-input" type="radio" name="jobseeker_maritalstatus" id="inlineCheckbox2" @if($jobs[0]->jobseeker_maritalstatus=="married") checked @endif value="Married">Married
                        </div>


                    </div>

            </div>


            <div class="row">

                <div class='col-md-6'>
                    <p  class="fullname ">Date of Birth</p>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='date' name="jobseeker_dob" value="{{$jobs[0]->jobseeker_dob}}" style="    line-height: 50px;" class="ico-03" class="form-control" />
                            <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                        </div>
                    </div>
                </div>

                <div class='col-md-3'>

                    <p  class="fullname ">Nationality</p>
                    <div class="form-row align-items-center">
                        <div class="ico-03" class="col-auto my-1">

                            <select required name="jobseeker_nationality" value="{{$jobs[0]->jobseeker_nationality}}" class="ico-03 natidropdo custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option required>Choose...</option>
                                @foreach($nationality as $nation)
                                    <option @if($nation->name==$jobs[0]->jobseeker_nationality) selected @endif value="{{$nation->name}}"> {{$nation->name}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                </div>

                <div class='col-md-3'>

                    <p  class="fullname ">Residence Location</p>
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">

                            <select required value="{{$jobs[0]->jobseeker_current_location}}" name="jobseeker_current_location" class="natidropdo custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option selected>Choose...</option>

                                <option></option>

                                @foreach($country as $cnt)
                                    <option @if($cnt->name==$jobs[0]->jobseeker_current_location) selected @endif value="{{$cnt->name}}"> {{$cnt->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">

                    <label>Visa Status</label>
                    <input required value="{{$jobs[0]->VISA_status}}" name="VISA_status" class="ico-03" class="form-control" type="text" placeholder="">

                </div>

                <div class="col-md-6">
                    <div class="checkbox">
                        <label>Driving License Issued From

                            <label style="float:right" class="chelisence"><input value="{{$jobs[0]->jobseeker_dob}}" type="checkbox" value="1" name="driving">I have License</label>
                        </label>
                        <input required value="{{$jobs[0]->Driving_Licence}}" name="Driving_Licence" class="ico-03" class="form-control" type="text" placeholder="">
                    </div>
                </div>


            </div>

            <div class="row">

                <div class="col-md-6">

                    <label>Languages</label>
                    <input required name="Languages" value="{{$jobs[0]->Languages}}" class="ico-03" class="form-control" type="text" placeholder="">

                </div>

                <div class="col-md-5">

                    <p  class="fullname ">NOC</p>


                    <p>
                    <div class="col-sm-12 col-md-6">
                        <input required  class="form-check-input" type="radio" name="NOC" @if($jobs[0]->NOC==1) checked @endif id="inlineCheckbox1" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Available</label>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <input  required class="form-check-input" type="radio" name="NOC"  @if($jobs[0]->NOC==0) checked @endif id="inlineCheckbox2" value="0">
                        <label class="form-check-label" for="inlineCheckbox2">Non-Available</label>
                    </div>
                    </p>


                </div>


            </div>
    </section>

    <section>
        <div class="container">
            <h3 class="personal">Contact Info</h3>
            <div class="row">
                <div class="col-md-6">

                    <label>Email Address</label>
                    <input required class="ico-03" class="form-control" name="jobseeker_email" value="{{$jobs[0]->jobseeker_email}}" type="text" placeholder="">

                </div>


                <div class="col-md-6">

                    <label>Mobile</label>
                    <input required class="ico-03" class="form-control" name="jobseeker_phone1" value="{{$jobs[0]->jobseeker_phone1}}" type="text" placeholder="">

                </div>
            </div>

            <div class="row">
                <div class="col-md-2" ></div>
                <div class="col-md-8 col-sm-12" style="margin-top:5%">
                    <button class="ico-03 profile-btn" style="float:right" type="submit">UPDATE</button>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    </section>


    <section>

        <div class="container">

            <h3 class="personal">Target Job</h3>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Job Target Tags (Comma separate tags, such as required skills or technologies, for this job minimum of 2)</label>
                <textarea required name="target_tags" value="{{$jobs[0]->target_tags}}" class="ico-03" id="exampleFormControlTextarea1" rows="3">{{$jobs[0]->target_tags}}</textarea>
            </div>


            <div class="col-md-6">

                <div class="row">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Job Title</label>
                        <input required name="target_title" value="{{$jobs[0]->target_title}}" type="test" class="ico-03" id="exampleFormControlInput1" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Job Location</label>

                        <select value="{{$jobs[0]->target_location}}" name="target_location" class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
                            @foreach($division as $ind)

                                <option value="{{$ind->id}}" @if($ind->id==$jobs[0]->target_location) selected @endif>{{$ind->name}}</option>


                            @endforeach


                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Monthly Salary</label>
                        <input required name="target_salary" value="{{$jobs[0]->target_salary}}" type="test" class="ico-03" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>
            </div>


            <div class="col-md-6">

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Job Industry</label>
                    <select value="{{$jobs[0]->target_industry}}" name="target_industry" class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
                        @foreach($get_ind as $ind)

                            <option value="{{$ind->id}}" @if($ind->id==$jobs[0]->target_industry) selected @endif>{{$ind->industrytypename}}</option>


                        @endforeach


                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Career Level</label>
                    <select  reqquired value="{{$jobs[0]->target_career_level}}" name="target_career_level" class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
                        <option value="1">Fresher</option>
                        <option value="2">Mid level</option>

                        <option value="3">Experienced</option>
                        <option value="4">5</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlSelect1">Notice Period</label>
                    <select value="{{$jobs[0]->target_notice_period}}" name="target_notice_period" class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
                        <option>2 Month</option>
                        <option>5 Month</option>

                    </select>
                </div>


            </div>


            <div class="form-group">
                <label >Career Objective</label>
                <textarea required value="{{$jobs[0]->target_objective}}" name="target_objective" class="ico-03" id="exampleFormControlTextarea1" rows="3">{{$jobs[0]->target_objective}}</textarea>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Employment Type  </label>
                        <select value="{{$jobs[0]->target_employment_type}}" name="target_employment_type" class="ico-03" id="exampleFormControlSelect1">
                            <option>Full-time</option>
                            <option>Part-time</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="col-md-2" ></div>
                <div class="col-md-8 col-sm-12" style="margin-top:5%">
                    <button class="ico-03 profile-btn" style="float:right" type="submit">UPDATE</button>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        </form>
    </section>


    <section>
        <br><br>
        <div class="container">




            <form method="POST" id="education_form" action="/jobseeker/updateEducation">
                {{ csrf_field() }}

                <h3 class="personal">Education</h3>

                <p>Degree</p>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check form-check-inline">
                                <input   class="form-check-input" @if($edu->high==1) checked @endif name="high" type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">High school </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input   class="form-check-input" name="diploma" @if($edu->diploma==1) checked @endif type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Diploma</label>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-check form-check-inline">
                                <input    class="form-check-input" name="bach" @if($edu->bach==1) checked @endif type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Bachelor's degree</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input  class="form-check-input" name="higher" @if($edu->higher==1) checked @endif type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Higher diploma</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check form-check-inline">
                                <input  class="form-check-input" name="master" @if($edu->master==1) checked @endif type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Master degree</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input   class="form-check-input" name="doctorate" @if($edu->doctorate==1) checked @endif type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Doctorate</label>
                            </div>
                        </div>



                    </div></div>
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
                    </div> </div>
                @foreach($edu->details as $e)

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Major / Stream</label>
                                <input required  type="text"  name="stream[]" value="{{$e->stream}}" class="ico-03" id="exampleFormControlInput1" placeholder="">
                            </div></div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Start Date</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input required type='date' name="sdate[]" value="{{$e->sdate}}" name="sdate" style="    line-height: 50px;" class="ico-03" class="form-control" />
                                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                                </div>
                            </div></div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">End Date</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input required type='date' name="edate[]" value="{{$e->edate}}" name="edate" style="    line-height: 50px;" class="ico-03" class="form-control" />
                                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                                </div>


                                <input required class="form-check-input" type="checkbox" id="inlineCheckbox1" name="current" value="option1"> I currently Study Here
                            </div></div>
                    </div>







                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Country  </label>
                                <select value="{{$e->country}}" name="country[]" class="ico-03" id="exampleFormControlSelect1">
                                    <option>India</option>
                                    <option>US</option>
                                </select>
                            </div></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">City</label>
                                <input type="test" class="ico-03" value="{{$e->city}}" name="city[]" id="exampleFormControlInput1" placeholder="">
                            </div></div>



                    </div>


                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Grading System  </label>
                                <select class="ico-03" value="{{$e->grading}}" name="grading[]" id="exampleFormControlSelect1">
                                    <option value="GPA">GPA</option>
                                    <option value="percent">Percent</option>
                                </select>
                            </div></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">score</label>
                                <input type="test" class="ico-03" value="{{$e->score}}" name="score[]" id="exampleFormControlInput1" placeholder="">
                            </div></div>



                    </div>




                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea  name="description[]" class="ico-03" id="exampleFormControlTextarea1" rows="3">{{$e->description}}</textarea>

                            </div>


                            @endforeach


                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Major / Stream</label>
                                        <input type="text"  name="stream[]"  class="ico-03" id="exampleFormControlInput1" placeholder="">
                                    </div></div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Start Date</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='date' name="sdate[]" value="{{$jobs[0]->jobseeker_dob}}" name="sdate" style="    line-height: 50px;" class="ico-03" class="form-control" />
                                            <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                                        </div>
                                    </div></div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">End Date</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='date' name="edate[]" value="edate" name="edate" style="    line-height: 50px;" class="ico-03" class="form-control" />
                                            <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                                        </div>


                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="current" value="option1"> I currently Study Here
                                    </div></div>
                            </div>







                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Country  </label>
                                        <select value="{{$jobs[0]->jobseeker_dob}}" name="country[]" class="ico-03" id="exampleFormControlSelect1">
                                            <option>India</option>
                                            <option>US</option>
                                        </select>
                                    </div></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">City</label>
                                        <input type="test" class="ico-03" name="city[]" id="exampleFormControlInput1" placeholder="">
                                    </div></div>



                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Grading System  </label>
                                        <select class="ico-03" name="grading[]" id="exampleFormControlSelect1">
                                            <option value="GPA">GPA</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                    </div></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">score</label>
                                        <input type="test" class="ico-03" name="score[]" id="exampleFormControlInput1" placeholder="">
                                    </div></div>



                            </div>




                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea value="{{$jobs[0]->description}}" name="description" description class="ico-03" id="exampleFormControlTextarea1" rows="3">{{$jobs[0]->description}}</textarea>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2" ></div>
                                        <div class="col-md-8 col-sm-12" style="margin-top:5%">
                                            <button class="ico-03 profile-btn" style="float:right" id="edu_form" type="submit">Add</button>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
            </form>
    </section>

    <section>
        <form action="/jobseeker/updateProfileExp" method="POST">
            {{ csrf_field() }}

            <div class="container">
                <h3 class="personal">Work Experience</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea required name="bio" class="ico-03" id="bio" rows="3">{{$exp->bio}}</textarea>

                        </div>
                    </div>
                </div>
                @foreach($exp->experience as $e)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Company Name</label>
                                <input required type="test" name="companyname[]" value="{{$e->companyname}}" required class="ico-03" id="exampleFormControlInput1" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Website</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input required type='text' value="{{$e->website}}" required name="website[]" style="    line-height: 50px;" class="ico-03" class="form-control" />
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
                                <input required type="test" name="location[]" value="{{$e->location}}" required class="ico-03" id="exampleFormControlInput1" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Start Date</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input required  type='date' value="{{$e->sdate}}" required name="sdate[]" style="    line-height: 50px;" class="ico-03" class="form-control" />
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
                                    <input required type='date' value="{{$e->edate}}" required name="edate[]" required style="    line-height: 50px;" class="ico-03" class="form-control" />
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
                                <textarea class="ico-03" value="{{$e->description}}" name="description[]" required id="exampleFormControlTextarea1" rows="3">{{$e->description}}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Company Name</label>
                            <input type="test" name="companyname[]" value=""  class="ico-03" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Website</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' value=""  name="website[]" style="    line-height: 50px;" class="ico-03" class="form-control" />
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
                            <input  required type="test" name="location[]"  class="ico-03" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Start Date</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='date'  name="sdate[]" style="    line-height: 50px;" class="ico-03" class="form-control" />
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
                                <input required  type='date'  name="edate[]"  style="    line-height: 50px;" class="ico-03" class="form-control" />
                                <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                            </div>
                        </div></div>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="ico-03" name="description[]"  id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div  id="alerts"></div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <p style="text-align:center; padding:20px;color:#000; font-weight:600; " class="dotted addnew">ADD NEW EXPERIENCE  </p>
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

                            <textarea class="ico-03" id="exampleFormControlTextarea1" name="skills" rows="3">{{$exp->skills}}</textarea>

                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!--<div class="form-group">

                           <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>

                         </div>-->

                        <p style="text-align:center; padding:20px; color:#000; font-weight:600; " class="dotted">ADD NEW SKILL SET</p>
                        <p>External link</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">URL</label>
                            <input  required type="test" name="link1" value="{{$exp->link1}}" class="ico-03" id="exampleFormControlInput1" placeholder="">
                        </div></div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">URL</label>
                            <input required  type="test" name="link2" value="{{$exp->link2}}" class="ico-03" id="exampleFormControlInput1" placeholder="">
                        </div></div>

                </div>
                <div class="row">
                    <div class="col-md-8">

                        <p style="margin-top:50px;">Please note: Any information you change in "My Account" will also be changed in your CVs.</p>

                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-2" ></div>
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
        <form id="manage_cv" action="/jobseeker/addcv" method="POST">
            <div class="container">
                <h3 class="personal">Contact Info</h3>
                {{ csrf_field() }}

                <p style="margin-top:20px;">Attachments</p>

                <div class="form-group">
                    <input type="hidden" name="cv" value="{{$jobs[0]->cv}}">
                    <p id="loading"></p>
                    <input type="file" id="addcv" name="photos[]" data-url="/jobseeker/uploaddoc" multiple="">

                    <div id="mycvs"></div>
                    <button type="file" id="uploadcv" class="dergpdf1 form-control-file" btn btn-default">UPLOAD NEW</button>

                </div


            </div>

    </section>


    <div class="row">
        <div class="col-md-2" ></div>
        <div class="col-md-8 col-sm-12" style="margin-top:5%">
            <button class="ico-03 " style="background-color:#28C294;float:right" type="submit">SUBMIT</button>
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
        select
        {
            height: 38px;
            -ms-box-sizing:content-box;
            -moz-box-sizing:content-box;
            -webkit-box-sizing:content-box;
            box-sizing:content-box;
        }

        .fake-input, input[type="text"], input[type="password"], input[type="email"], input[type="number"], textarea, select {
            background-color:white;
        }
    </style>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>

        $( document ).ready(function() {
            var files= @php echo $edu->degree; @endphp;
            var cv= @php echo $jobs[0]->cv; @endphp;

            console.log(files);
            $.each(files, function (index, file) {
                console.log(file);
                $('#certificates').append("<a href='"+file.path+"'><button type='button' class='dergpdf form-control-file btn btn-default'>"+file.name+"</button></a>");
            });

            $.each(cv, function (index, file) {
                console.log(file);
                $('#mycvs').append("<a href='"+file.path+"'><button type='button' class='dergpdf form-control-file btn btn-default'>"+file.name+"</button></a>");
            });

            $('#alerts').append(msg);
            console.log( "ready!" );
            var msg = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="exampleFormControlInput1">Company Name</label><input type="test" name="companyname[]" value="" required class="ico-03" id="exampleFormControlInput1" placeholder=""></div></div><div class="col-md-6"><div class="form-group"> <label for="exampleFormControlInput1">Website</label> <div class="input-group date" id="datetimepicker1"> <input type="text" value="" required name="website[]" style="    line-height: 50px;" class="ico-03" class="form-control" /> <span class="input-group-addon">  <span class="glyphicon glyphicon-calendar"></span>  </span></div></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"> <label for="exampleFormControlInput1">Location</label> <input type="test" required name="location[]" class="ico-03" id="exampleFormControlInput1" placeholder=""> </div></div> <div class="col-md-3"> <div class="form-group"> <label for="exampleFormControlInput1">Start Date</label> <div class="input-group date" id="datetimepicker1"> <input type="date" name="sdate[]" required style=" line-height: 50px;" class="ico-03" class="form-control" /> <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div> </div></div> <div class="col-md-3"> <div class="form-group"> <label for="exampleFormControlInput1">End Date</label> <div class="input-group date" id="datetimepicker1"> <input type="date" required name="edate[]" style=" line-height: 50px;" class="ico-03" class="form-control" /> <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div> </div></div> <div class="col-md-12"> <div class="form-group"> <label for="exampleFormControlTextarea1">Description</label> <textarea required name="description[]" class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea> </div>';
            $(".addnew").on('click',function(){
                $('#alerts').append(msg);

            })

            var quill = new Quill('#bio', {
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Compose an epic...',
                theme: 'snow'  // or 'bubble'
            });


            $("#edu_form").on("click",function(e){

                var $input = $("#education_form").find("input[name=degree]");
                console.log($input.val());
                $input.val(JSON.stringify(files));

                //alert("e");
                // e.preventDefault();
            })

            $("#uploadcv").on("click",function(e){

                var $input = $("#manage_cv").find("input[name=cv]");
                console.log($input.val());
                $input.val(JSON.stringify(cv));

//alert("e");
// e.preventDefault();
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

                        $('#certificates').append("<button class='dergpdf form-control-file btn btn-default'>"+file.name+"</button>");

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

                        $('#mycvs').append("<button class='dergpdf form-control-file btn btn-default'>"+file.name+"</button>");

                    });
                    $('#loading').text('');
                }
            });
        });
    </script>
    </html>
@endsection