@extends('public.layout.public_layout')
@section('page_title')
    Jobseeker Details
@endsection
@section('style')
    {!!Html::style('css/singleJob.css')!!}
    <style>
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

            .container {
                /* width: 1600px !important;*/
            }

            .accondlondon {
                margin: -5% 0 15px 0;
                color: gray;
                font-size: 20px;
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

        hr {
            border: 1px solid black;
            margin-top: 10px;
        }
    </style>
@endsection
@section('script')
    {{--asset('js/managejob.js')--}}
    {!!Html::script('js/managejob.js')!!}
@endsection
@section('content')

    <section id="allresume">
        <div style="margin-top:2%;width:90%;" class="container">
            <div class="row">
                <div class="col-md-2">
                    @if($jobprofile->profile_img)
                        <img style="width:170px;" src="/{{$jobprofile->profile_img}}" >
                    @else
                        <img src="/img/profile.png" style="width:170px;">
                    @endif
                </div>
                <div style="" class="col-md-8" id="mainresumediv">
                    <div id="resumebtns">
                        <h1 class="Posthed col-md-4" style="padding:0px">Personal Details </h1>
                        <h4 class="Posthed col-md-6">
                            <a href='javascript:print1(1)' style="float:right;">
                                <button class="cvbut"><i class="fa fa-file-pdf-o"></i>Download CV</button>
                            </a>
                        </h4>
                        <h4 class="Posthed col-md-2">
                            <a href="/jobseeker" style="float:right;">
                                @if(Auth::guard('employer')->check())
                                    <a href="/createConversation/{{$jobprofile->jobseeker_id}}">	<span class="message"> <i class="far fa-envelope"></i> Message </span></a>
                                @endif
                            </a>
                        </h4>
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8" style="margin-bottom: 30px;">

                            <div class="col-md-7">
                                Birth Date
                            </div>
                            <div class="col-md-5 fw-900">
                                {{$jobprofile->jobseeker_dob}}
                            </div>


                            <div class="col-md-7">
                                Gender
                            </div>
                            <div class="col-md-5 fw-900">
                                {{ucfirst($jobprofile->jobseeker_gender)}}
                            </div>

                            <div class="col-md-7">
                                Marital Status
                            </div>
                            <div class="col-md-5 fw-900">
                                {{ucfirst($jobprofile->jobseeker_maritalstatus)}}
                            </div>

                            <div class="col-md-7">
                                Current Location
                            </div>
                            <div class="col-md-5 fw-900">
                                {{$jobprofile->jobseeker_current_location}}
                            </div>

                            <div class="col-md-7">
                                Nationality
                            </div>
                            <div class="col-md-5 fw-900">
                                {{$jobprofile->jobseeker_nationality}}
                            </div>

                            <div class="col-md-7">
                                Visa Type
                            </div>
                            <div class="col-md-5 fw-900">
                                {{$jobprofile->VISA_status}}
                            </div>

                            <div class="col-md-7">
                                Driving License Issued From
                            </div>
                            <div class="col-md-5 fw-900">
                                {{ucfirst($jobprofile->Driving_Licence)}}
                            </div>

                            <div class="col-md-7">
                                NOC
                            </div>
                            <div class="col-md-5 fw-900">
                                @if($jobprofile->NOC)
                                    Available
                                @else
                                    Not Available
                                @endif
                            </div>

                            <div class="col-md-7">
                                Languages
                            </div>
                            <div class="col-md-5 fw-900">
                                {{$jobprofile->Languages}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h1 class="Posthed">Contact Info</h1>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8" style="margin-bottom: 30px;">

                            <div class="col-md-7">
                                Email Address
                            </div>
                            <div class="col-md-5 fw-900">
                                {{$email}}
                            </div>

                            <div class="col-md-7">
                                Phone Number
                            </div>
                            <div class="col-md-5 fw-900">
                                {{$jobprofile->jobseeker_phone1}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h1 class="Posthed">Preferred Job</h1>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-11">

                            <div class="col-md-5">
                                Target Job Title
                            </div>
                            <div class="col-md-7 fw-900">
                                {{$jobprofile->target_title}}
                            </div>

                            <div class="col-md-5">
                                Career Level
                            </div>
                            <div class="col-md-7 fw-900">
                                {{$jobprofile->target_career_level}}
                            </div>

                            <div class="col-md-5">
                                Target Job Location
                            </div>
                            <div class="col-md-7 fw-900" style="text-align:justify;">
                                {{$jobprofile->target_locations}}
                            </div>

                            <div class="col-md-5">
                                Career Objective
                            </div>
                            <div class="col-md-7 fw-900">
                                {{$jobprofile->target_objective}}
                            </div>

                            <div class="col-md-5">
                                Target Industry
                            </div>
                            <div class="col-md-7 fw-900">
                                {{$jobprofile->target_industry}}
                            </div>

                            <div class="col-md-5">
                                Employment Type
                            </div>
                            <div class="col-md-7 fw-900">
                                {{$jobprofile->target_employment_type}}
                            </div>

                            <div class="col-md-5">
                                Expected Salary
                            </div>
                            <div class="col-md-7 fw-900">
                                {{$jobprofile->target_salary}}
                            </div>

                            <div class="col-md-5">
                                Notice Period
                            </div>
                            <div class="col-md-7 fw-900">
                                {{$jobprofile->target_notice_period}}
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h1 class="Posthed">Education</h1>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            @foreach($jobprofile->educations as $edu)
                                <div class="col-md-12 right-dot-line">
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
                    <h1 class="Posthed">Work Experience</h1>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-11">
                            @foreach($jobprofile->experiences as $e)
                                <div class="col-md-12 right-dot-line">
                                    <div class="row">
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
                                            <hr style="margin-bottom: 10px;">
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
                    <h1 class="Posthed">Skills</h1>
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
                        <h1 class="Posthed">Resume Attachments</h1>
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

                    <h1 class="Posthed">Website</h1>
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
                            <br>
                            <br>
                            <p style="margin-top:10%;color: #E86850;" id="alarm"> Please note: Any information you change in "My
                                Account" will also be changed in your Resume. </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extrascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
            integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
    </script>
    <script src="/js/html2canvas.js"></script>
    <script src="/js/html2pdf/html2pdf.bundle.min.js"></script>
    <script>


        function print1() {
            const filename  = 'myresume.pdf';

            var div = $('#allresume').clone();
            div.find('#jobstatediv').remove();
            div.find('.aconntmenu').remove();
            div.find('.certpart').remove();
            div.find('#resumebtns').css('display', 'none');
            div.find('#rightsidebardiv').remove();
            div.find('#resumeatt').remove();
            div.find('#alarm').remove();

            var resumediv = document.createElement("div");
            resumediv.innerHTML = div.html();

            document.body.appendChild(resumediv);

            html2canvas(resumediv,
                {scale: 1}
            ).then(canvas => {

                resumediv.remove();

                let pdf;

                var width = canvas.width;
                var height = canvas.height;

                if(width>height) {
                    width = parseInt(width * 297 / height);
                    height = 297;
                }
                else{
                    height = parseInt(height * 210 / width);
                    width = 210;
                }
                pdf = new jsPDF('p', 'mm', [width*2.83, (height+30)*2.83]);

                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 15, width, height);
                pdf.save(filename);
            });

            // var opt = {
            //     margin:       [20, 0],
            //     filename:     'myresume.pdf',
            //     image:        { type: 'jpeg', quality: 1 },
            //     pagebreak: {mode:['avoid-all']}
            // };
            // var worker = html2pdf().set(opt).from(resumediv).save();

        }
    </script>
@endsection