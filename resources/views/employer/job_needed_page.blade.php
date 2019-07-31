
@extends('public.layout.public_layout')

@section('page_title')
    Job Needed Page
@endsection

@section('content')
    <style>
        .remove
        {
            border: 1px solid #7889ff;
            color: #7889ff;

        }
        .btn-profile {

            font-size:10px !important;
        }
        .btn
        {
            font-size:12px !important;
        }


        @media (min-width: 768px) {
            .aconntmenu
            {
                margin-left:-7%;
            }
            .container
            {

            }
            .accondlondon
            {
                margin: -5% 0 15px 0;
                color:gray;
            }
            .leftcont
            {
                color:gray;
            }
            .current
            {
                color:#7889ff;

            }

            .current  .col-md-10
            {
                font-weight:bold;
                color:black;
            }
            .content
            {
                margin-left:-7%;border-right: thin solid lightgray;
            }

            .row {
                margin-bottom: 0px;
            }
        }

    </style>

    <section style="min-height: 900px">
        <div style="margin-top:2%;    " >
            <div class="row">
            <div class="col-md-2"></div>


                <div style="" class="col-md-6" >
                    <div class="">
                        @if(Auth::guard('jobseeker')->check())
                                <form class="searchform" action="/jobseeker/searchpage">
                        @else
                                <form class="searchform" action="/employer/searchpage">
                        @endif
                            <input class="needSearch" type="text" placeholder="Search.." name="search">
                            <button class="needSearchBtn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="header_listtop">
                        <ul>
                            <li><a href="/employer/jobneeded/">Job Needed Urgently ({{$all}})</a></li>
                        </ul>
                    </div>


                    @forelse($applicants as $j)
                        <div class="col-md-12" style="background:#fff;padding:15px;box-shadow:-7px 8px 55px -5px rgba(0,0,0,0.2);border-radius: 3px;margin-bottom:20px; margin-top:30px;">
                            <div class="row">

                                    <div class="col-md-2 col-sm-6">
                                        <div class="border-right" style="margin-left: 10px;">
                                            <h3 class="jobneededIndustry" >{{$j->target_title}}</h3>
    {{--                                        <p class="names"  jobid="{{$j->job_id}}" id="{{$j->aj}}">ScheduleSchedule Interview</p>--}}
                                            @if (file_exists(public_path($j->profile_img)))
                                            <img style="width: 100px; height: 100px;" src="{{url($j->profile_img)}}" alt="">
                                                @else
                                            <img style="width: 100px; height: 100px;" src="{{url('/storage/profile/FOLuvyTwnmWNya5RXpO4SCqJ5lzviVj1mEEk2y0o.jpeg')}}" alt="">
                                            @endif
                                        </div>
                                </div>

                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-12 pull-right messagediv" style="margin-bottom: 50px">
                                                @if(Auth::guard('employer')->check())
                                                <a href="/createConversation/{{$j->jobseeker_id}}">	<span class="message"> <i class="far fa-envelope"></i> Message </span></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                @if(Auth::guard('employer')->check())
                                                    <a href="{{url('/employer/jbsdeatil/'.$j->jobseeker_id)}}">
                                                 @else
                                                    <a href="{{url('/jobseeker/jbsdeatil/'.$j->jobseeker_id)}}">
                                                @endif    
                                                <h3 class="jobneededFirstname">{{$j->first_name}} {{$j->last_name}}</h3></a>
                                                    <p class="jobneededNationality">{{$j->jobseeker_nationality}}</p>
                                            </div>
                                            <div class="col-md-3 jobneededPulldown" style="padding-left: 0px; padding-right: 0px;">
                                                <div class="border-right">
                                                    <div class="col-md-5 jobneededTitle" style="padding: 0px;">Visa Type</div>
                                                    <div class="col-md-7 text-center jobneededAtrr">{{$j->VISA_status}}</div>
                                                    <br>
                                                    <div class="col-md-5 jobneededTitle">NOC</div>
                                                    @if($j->NOC==1)
                                                    <div class="col-md-7 text-center jobneededAtrr "><img src="/img/available.jpg" style="padding-top: 5px; float: left;"> Available</div>
                                                    @else
                                                        <div class="col-md-7 text-center jobneededAtrr"><img src="/img/close.jpg" style="padding-top: 5px; float: left;">not available</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-5 jobneededPulldown">
                                                <div class="col-md-7 jobneededTitle">Current Location</div>
                                                <div class="col-md-5 text-center jobneededAtrr">{{$j->jobseeker_current_location}}</div>
                                                <br>
                                                <div class="col-md-6 jobneededTitle">Expected Salary</div>
                                                <div class="col-md-6 text-center jobneededAtrr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$j->target_salary}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>


                    @empty
                        <p class="text-warning">No Candidates Found</p>

                    @endforelse
                    <div class="text-center"> {{$applicants->links()}}</div>

                </div>
                <div class="col-md-2">
                    @if(Auth::guard('jobseeker')->check())

                    <div class="specialboard">
                        <img src="/assets/img/Group 2.4.png"/>
                        List your Profile on our special board <a href="#">Job Needed</a> and get noticed by the employer faster!
                    </div>
                        @endif

                </div>

            </div>


    </section>



    <script>
        // $(".names").on("click",function(){
        //
        //     swal({
        //         title: "Schedule Interview",
        //         content: {
        //             element: "input",
        //             attributes: {
        //                 placeholder: "Type your password",
        //                 type: "datetime-local",
        //             },
        //         },
        //     }).then((time) => {
        //         if (time) {
        //             let jid=($(this).attr("id"))
        //             let jobid=($(this).attr("jobid"))
        //             window.location="/employer/changeCandidatestatus/"+jid+"/3?jobid="+jobid+"&time="+time;
        //         }
        //     });
        //
        // });
    </script>
@endsection