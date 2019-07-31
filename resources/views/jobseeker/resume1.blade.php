<div class="row" id="btnrow">
    <div class="col-md-5">
        <p style="padding-left:30px;padding-top:20px;font-size:18px;font-weight:bold;">{{$jobprofile->first_name}} {{$jobprofile->last_name}}</p>
        <p style="padding-left:30px;font-size:18px;">{{$jobprofile->target_title}}</p>
    </div>
    <div class="col-md-7 fieldcolor">
        <div class="col-md-4 text-center" style="margin-top:20px;">
            <a style="color:#e86850;font-size:18px;" href="/employer/changeCandidatestatus/{{$ajid}}/4">Mark as Spam</a>
        </div>
        <div class="col-md-4 text-center" style="margin-top:20px;">
            <a style="color:#8998FF;font-size:18px;" href="/createConversation/{{$jobprofile->jobseeker_id}}"><i class="far fa-envelope"></i>  Message</a>
        </div>
        <div class="col-md-4 text-center" style="margin-top:20px;">
            <a style="color:#8998FF;font-size:18px;" href="javascript:print1(1)"><i class="fas fa-print"></i>  Print</a>
        </div>
    </div>
</div>
<hr>

<h1 class="PosthedSmall">Personal Details</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8" style="margin-bottom: 30px;">

        <div class="col-md-7 fieldcolor">
            Birth Date
        </div>
        <div class="col-md-5 fw-900">
            {{$jobprofile->jobseeker_dob}} 
        </div>


        <div class="col-md-7 fieldcolor">
            Gender
        </div>
        <div class="col-md-5 fw-900">
            {{ucfirst($jobprofile->jobseeker_gender)}} 
        </div>

        <div class="col-md-7 fieldcolor">
            Marital Status
        </div>
        <div class="col-md-5 fw-900">
            {{ucfirst($jobprofile->jobseeker_maritalstatus)}} 
        </div>

        <div class="col-md-7 fieldcolor">
            Current Location
        </div>
        <div class="col-md-5 fw-900">
            {{$jobprofile->jobseeker_current_location}} 
        </div>

        <div class="col-md-7 fieldcolor">
            Nationality
        </div>
        <div class="col-md-5 fw-900">
            {{$jobprofile->jobseeker_nationality}} 
        </div>

        <div class="col-md-7 fieldcolor">
            Visa Type
        </div>
        <div class="col-md-5 fw-900">
            {{$jobprofile->VISA_status}} 
        </div>

        <div class="col-md-7 fieldcolor">
            Driving License Issued From
        </div>
        <div class="col-md-5 fw-900">
            {{ucfirst($jobprofile->Driving_Licence)}} 
        </div>

        <div class="col-md-7 fieldcolor">
            NOC
        </div>
        <div class="col-md-5 fw-900">
            @if($jobprofile->NOC)
            Available
            @else
            Not Available
            @endif
        </div>

        <div class="col-md-7 fieldcolor">
            Languages
        </div>
        <div class="col-md-5 fw-900">
            {{$jobprofile->Languages}} 
        </div>
    </div>
    <div class="col-md-3">
        <img style="width:100px;height:100px;" src="/{{$jobprofile->profile_img}}">
    </div>
</div>
<hr>
<h1 class="PosthedSmall">Contact Info</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8" style="margin-bottom: 30px;">

        <div class="col-md-7 fieldcolor">
            Email Address
        </div>
        <div class="col-md-5 fw-900">
            {{App\Jobseeker::find($jobprofile->jobseeker_id)->email}} 
        </div>

        <div class="col-md-7 fieldcolor">
            Phone Number
        </div>
        <div class="col-md-5 fw-900">
            {{$jobprofile->jobseeker_phone1}} 
        </div>
    </div>
</div>
<hr>
<h1 class="PosthedSmall">Preferred Job</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-11">

        <div class="col-md-5 fieldcolor" >
            Target Job Title
        </div>
        <div class="col-md-7 fw-900">
            {{$jobprofile->target_title}} 
        </div>

        <div class="col-md-5 fieldcolor ">
            Career Level
        </div>
        <div class="col-md-7 fw-900">
            {{$jobprofile->target_career_level}} 
        </div>

        <div class="col-md-5 fieldcolor">
            Target Job Location
        </div>
        <div class="col-md-7 fw-900" style="text-align:justify;">
            {{$jobprofile->target_locations}}
        </div>

        <div class="col-md-5 fieldcolor">
            Career Objective
        </div>
        <div class="col-md-7 fw-900">
            {{$jobprofile->target_objective}} 
        </div>

        <div class="col-md-5 fieldcolor">
            Target Industry
        </div>
        <div class="col-md-7 fw-900">
            {{$jobprofile->target_industry}} 
        </div>

        <div class="col-md-5 fieldcolor">
            Employment Type
        </div>
        <div class="col-md-7 fw-900">
            {{$jobprofile->target_employment_type}} 
        </div>

        <div class="col-md-5 fieldcolor">
            Expected Salary
        </div>
        <div class="col-md-7 fw-900">
            {{$jobprofile->target_salary}} 
        </div>

        <div class="col-md-5 fieldcolor">
            Notice Period
        </div>
        <div class="col-md-7 fw-900">
            {{$jobprofile->target_notice_period}} 
        </div>
    </div>
</div>

<hr>
<h1 class="PosthedSmall">Education</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        @foreach($jobprofile->educations as $edu)
        <div class="col-md-12">
            <div class="row" style="padding-right:20px;">
                <div class="col-md-6 fw-900">
                    {{ $enumDegrees[$edu->degree] }}, {{ $edu->major_stream }}
                </div>
                <div class="col-md-2 fw-900">
                    {{ $edu->grade }}
                </div>
                <div class="col-md-4 fw-900" style="text-align:right;">
                    {{ $edu->university }}, {{ $edu->city }}, {{ $country[$edu->country]}}
                    <br>
                    {{date_format(DateTime::createFromFormat('d/m/Y', $edu->start_date), "F Y")}}-
                    {{date_format(DateTime::createFromFormat('d/m/Y', $edu->end_date), "F Y")}}
                </div>
            </div>
            @if(count($edu->certificates)>0)
            <div class="row certpart">
                <div class="col-md-12">
                    <p class="mclrb" style="font-size: 14px;">Attachments</p>
                    @foreach($edu->certificates as $cert)
                    <a href="/{{$cert->path}}" target="_blank">
                        <button class="certbut"><i
                                class="fa fa-file-pdf-o"></i>{{$cert->displayname}}</button>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

<br>
<hr>
<h1 class="PosthedSmall">Work Experience</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        @foreach($jobprofile->experiences as $e)
        <div class="col-md-12">
            <div class="row" style="margin-bottom:0px;">
                <div class="col-md-6">
                    <h4 style="font-weight:bold;margin-bottom:0px;">
                        {{$e->job_title}}
                    </h4>
                    <h5 style="margin-bottom:0px;margin-top:0px;">
                        {{$e->company_name}}, {{$e->website}}
                    </h5>
                </div>
                <div class="col-md-5" style="text-align:right;">
                    <h5 style="font-weight:bold;margin-bottom:0px;">
                        {{$e->location}}
                    </h5>
                    <h5 style="font-weight:bold;margin-bottom:0px;margin-top:0px;">
                        {{date_format(DateTime::createFromFormat('d/m/Y', $e->start_date), "F Y")}}
                        -
                        @if($e->current_work)
                        Current
                        @else
                        {{date_format(DateTime::createFromFormat('d/m/Y', $e->end_date), "F Y")}}
                        @endif
                    </h5>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-11">
                    <hr class="line">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-11">
                    <h5 style="margin-top:0px;">
                        {!! $e->job_description !!}
                    </h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<br>

<hr>
<h1 class="PosthedSmall">Skills</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <div class="col-md-12">
            @foreach($jobprofile->skillsets as $skill)
            <div class="skilldiv">{{$skill->title}}</div>
            @endforeach
        </div>
    </div>
</div>
<br>
<br>

<hr>
<div id="resumeatt">
<h1 class="PosthedSmall">Resume Attachments</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <div class="col-md-12">
            <h5>
                @foreach($jobprofile->cvs as $cv)
                <a href="/{{$cv->path}}" target="_blank">
                    <button class="certbut"><i
                            class="fa fa-file-pdf-o"></i>{{$cv->displayname}}</button>
                </a>
                @endforeach
            </h5>
        </div>
    </div>
</div>
<hr>
</div>

<h1 class="PosthedSmall">Website</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <div class="col-md-6">
            <h5 class="fw-900">
            @if($jobprofile->ex_link1 != '')
                <a href="{{$jobprofile->ex_link1_protocal}}{{$jobprofile->ex_link1}}" target="_blank">
                    {{$jobprofile->ex_link1_protocal}}{{$jobprofile->ex_link1}}
                </a>
            @endif
            </h5>
        </div>

        <div class="col-md-6">
            <h5 class="fw-900">
            @if($jobprofile->ex_link2 != '')
                <a href="{{$jobprofile->ex_link2_protocal}}{{$jobprofile->ex_link2}}" target="_blank">
                    {{$jobprofile->ex_link2_protocal}}{{$jobprofile->ex_link2}}
                </a>
            @endif
            </h5>
        </div>

    </div>
</div>

<hr>
<div class="row" id="btnrow1">
    <div class="col-md-12">
        <div class="col-md-12 text-right">
            <button class="acceptbtn" style="margin-right:10px;" id="acceptbtn" type="button">Accept</button>        
            <button class="rejectbtn" type="button" id="rejectbtn">Reject</button>        
        </div>
    </div>
</div>