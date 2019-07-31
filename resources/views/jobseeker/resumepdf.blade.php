<!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Quantico:400,300,700,800' rel='stylesheet' type='text/css'>

    <style>
        body {
            font-family: 'Quantico';
        }

        .Posthed {
            font-family: 'Quantico';
            font-size: 24px;
            margin: 12px 0px;
        }

        hr {
            border: 1px solid black;
            margin-top: 10px;
        }

        table {
            border-spacing: 0px;
        }

        td {
            vertical-align: top;
            padding: 0px;
        }

        .right-dot-line {
            position: relative;
            border-right: solid #a6b1be 3px;
        }
        .right-dot-line::after {
            content: '';
            position: absolute;
            right: -9px;
            top: -0px;
            width: 15px;
            height: 15px;
            background: #a6b1be;
            border-radius: 50%;
        }

        .td-1 {
            width: 8%;
        }
        .td-2 {
            width: 38%;
        }
        .td-3 {
            width: 30%;
        }
        .td-4 {
            width: 24%;
        }
        .preferred-job-td-2 {
            width: 38%;
        }
        .preferred-job-td-3 {
            width: 54%;
        }

    </style>

</head>

<body>
<br/>
<br/>
<br/>
<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <p class="Posthed">Personal Details</p>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Name</td>
                    <td class="td-3">{{$jobprofile->first_name}} {{$jobprofile->last_name}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Birth Date</td>
                    <td class="td-3">{{$jobprofile->jobseeker_dob}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Gender</td>
                    <td class="td-3">{{ucfirst($jobprofile->jobseeker_gender)}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Marital Sta</td>
                    <td class="td-3">{{ucfirst($jobprofile->jobseeker_maritalstatus)}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Current Location</td>
                    <td class="td-3">{{$jobprofile->jobseeker_current_location}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Nationality</td>
                    <td class="td-3">{{$jobprofile->jobseeker_nationality}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Visa Type</td>
                    <td class="td-3">{{$jobprofile->VISA_status}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Driving Lisence Issued From</td>
                    <td class="td-3">{{ucfirst($jobprofile->Driving_Licence)}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">NOC</td>
                    <td class="td-3">
                        @if($jobprofile->NOC)
                            Available
                        @else
                            Not Available
                        @endif
                    </td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Language</td>
                    <td class="td-3">{{$jobprofile->Languages}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
            <br/>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <hr>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <p class="Posthed">Contact Info</p>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Email Address</td>
                    <td class="td-3">{{Auth::guard('jobseeker')->user()->email}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="td-2">Phone Number</td>
                    <td class="td-3">{{$jobprofile->jobseeker_phone1}}</td>
                    <td class="td-4"></td>
                </tr>
            </table>
            <br/>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <hr>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <p class="Posthed">Preferred Job</p>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Target Job Title</td>
                    <td class="preferred-job-td-3">{{$jobprofile->target_title}} </td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Career Level</td>
                    <td class="preferred-job-td-3">{{$jobprofile->target_career_level}}</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Target Job Location</td>
                    <td class="preferred-job-td-3" style="text-align:justify;">{{$jobprofile->target_locations}}</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Cover Letter</td>
                    <td class="preferred-job-td-3">{{$jobprofile->target_objective}}</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Target Industry</td>
                    <td class="preferred-job-td-3">{{$jobprofile->target_industry}}.</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Employment Type</td>
                    <td class="preferred-job-td-3">{{$jobprofile->target_employment_type}}</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Expected Salary</td>
                    <td class="preferred-job-td-3">{{$jobprofile->target_salary}}</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td class="td-1"></td>
                    <td class="preferred-job-td-2">Notice Period</td>
                    <td class="preferred-job-td-3">{{$jobprofile->target_notice_period}}</td>
                </tr>
            </table>
            <br/>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <hr>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <p class="Posthed">Education</p>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            @foreach($jobprofile->educations as $edu)
                <table width="100%" style="margin-bottom: 10px;">
                    <tr>
                        <td width="8%"></td>
                        <td width="46%">{{ $enumDegrees[$edu->degree] }}, {{ $edu->major_stream }}</td>
                        <td width="16%">{{ $edu->grade }}</td>
                        <td width="26%" style="text-align: right;">
                            {{ $edu->university }}, {{ $edu->city }}, {{ $country[$edu->country]}}
                            <br>
                            {{date_format(DateTime::createFromFormat('d/m/Y', $edu->start_date), "F Y")}}-
                            {{date_format(DateTime::createFromFormat('d/m/Y', $edu->end_date), "F Y")}}
                        </td>
                        <td width="4%" class="right-dot-line">
                        </td>
                    </tr>
                </table>
            @endforeach
            <br/>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <hr>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <p class="Posthed">Work Experience</p>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            @foreach($jobprofile->experiences as $e)
                <table width="100%">
                    <tr>
                        <td width="8%"></td>
                        <td width="84%">
                            <table width="100%">
                                <tr>
                                    <td width="54%">
                                        {{$e->job_title}}
                                    </td>
                                    <td width="46%" style="text-align: right;">
                                        {{$e->location}}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="54%">
                                        {{$e->company_name}}, {{$e->website}}
                                    </td>
                                    <td width="46%" style="text-align: right;">
                                        {{date_format(DateTime::createFromFormat('d/m/Y', $e->start_date), "F Y")}}
                                        -
                                        @if($e->current_work)
                                            Current
                                        @else
                                            {{date_format(DateTime::createFromFormat('d/m/Y', $e->end_date), "F Y")}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <table width="100%">
                                <tr>
                                    <td width="100%">
                                        <h5 style="margin-top:0px;">
                                            {{strip_tags($e->job_description)}}
                                        </h5>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="8%" class="right-dot-line"></td>
                    </tr>
                </table>
            @endforeach
            <br>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <hr>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <p class="Posthed">Website</p>
        </td>
        <td width="10%"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="10%"></td>
        <td width="80%">
            <table width="100%">
                <tr>
                    <td width="8%"></td>
                    <td width="46%">
                        @if($jobprofile->ex_link1 != '')
                            {{$jobprofile->ex_link1_protocal}}{{$jobprofile->ex_link1}}
                        @endif
                    </td>
                    <td width="46%">
                        @if($jobprofile->ex_link2 != '')
                            {{$jobprofile->ex_link2_protocal}}{{$jobprofile->ex_link2}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>
</body>

</html>