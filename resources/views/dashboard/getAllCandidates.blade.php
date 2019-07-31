

{{-- Header --}}
@extends('dashboard.layout.admin_layout')
@section('page_title')
HomePage
@endsection
@section('style')
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

        .filter-panel {
            height: 380px;
            overflow-y: hidden;
            overflow-x: hidden;
            display: none;
        }

        .filter-box {
            height: 278px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .locationlist li{
            margin-top:5px;
            margin-bottom:5px;
            line-height:28px;
        }
    </style>
@endsection

@section('content')


    <section  class="minheight">

        <div class="nav-header" >
            <nav>
                <ul class="top-nav detail">
                    <li ><a href="{{url('/inspector/employerdetail/'.$myprofile->id)}}">Profile</a></li>
                    <li ><a href="{{url('/inspector/jobposts/'.$myprofile->id)}}">Job Posts</a></li>
                    <li class="activeul" ><a href="{{url('/inspector/getAllCandidates/'.$myprofile->id)}}">Candidates</a></li>
                    <li class="lastlicl"><a href="{{url('/inspector/emp/message/'.$myprofile->id.'/0')}}">Messages</a></li>
                </ul>
            </nav>
        </div>
        <div style="padding-top:80px;width:90%;" class="container nav-in">
            <div class="row">
                <div style="" class="col-md-8">
                    <div class="header_listtop" style="margin-bottom:20px;">
                        <ul>
                            <li><a id="slink0" href="/inspector/getAllCandidates/{{$id}}/0">All ({{ $all<10?'0'.$all:$all }}) </a></li>
                            <li><a id="slink1" href="/inspector/getAllCandidates/{{$id}}/1">Shortlisted ({{ $shortlisted<10?'0'.$shortlisted:$shortlisted }}) </a></li>
                            <li><a id="slink2" href="/inspector/getAllCandidates/{{$id}}/2">Rejected ({{ $rejected<10?'0'.$rejected:$rejected }})</a></li>
                            <li><a id="slink3" href="/inspector/getAllCandidates/{{$id}}/3">Scheduled for interview ({{ $scheduled<10?'0'.$scheduled:$scheduled }})</a></li>
                            <li><a id="slink4" href="/inspector/getAllCandidates/{{$id}}/4">Spams ({{ $spam<10?'0'.$spam:$spam }})</a></li>
                        </ul>
                    </div>




                    @forelse($applicants as $j)
                        <div class="col-md-12"
                             style="background:#fff;padding:30px 20px;box-shadow:-7px 8px 55px -5px rgba(0,0,0,0.2);border-radius: 4px;margin-bottom:20px; margin-top:30px;">
                            <div class="row canditate_list">
                                <div class="col-md-3 col-sm-6">
                                    <h3 style="margin:0;">{{$j->jobtitle}}</h3>
                                    <p style="font-weight:bold;">{{$j->experience}} Years Experience</p>
                                    <img src="/{{$j->profile_img}}" style="height:150px;width:150px;">
                                    {{-- <p class="names" jobid="{{$j->job_id}}" id="{{$j->aj}}">Schedule Interview</p> --}}
                                </div>
                                <div class="col-md-9 col-sm-6">
                                    <div class="row border-left">
                                        <div class="col-md-6 col-sm-6">
                                            @foreach(App\personaldetails::find($j->pi)->skillsets as $skill)
                                                <span class="skilldiv1">{{$skill->title}}</span>
                                            @endforeach

                                        </div>
                                        <div class="col-md-6 pull-right">

                                            <a href="/inspector/changeCandidatestatus/{{$j->aj}}/4"> <span class="markspan">Mark as
                                            Spam</span> </a>
                                        </div>
                                    </div>
                                    <div class="row canditate_details" style="margin-top:40px;">
                                        <div class="col-md-3">
                                            <a href="/employer/jobdetails/{{$j->job_id}}/{{$j->jobseeker_id}}">
                                                <h3 style="margin:0;color:black;font-weight:bold;font-size:18px;">{{$j->first_name." ".$j->last_name}}</h3>
                                                <p style="font-size:16px;">{{$j->jobseeker_nationality}}</p>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="border-left">
                                                <div class="col-md-7" style="font-size:14px;">Visa Type</div>
                                                <div class="col-md-5 text-center" style="font-size:14px;">Work</div>
                                                <div class="col-md-5" style="font-size:14px;">NOC</div>
                                                <div class="col-md-7 text-center" style="font-size:14px;"><img src="/img/available.jpg"
                                                                                                               style="padding-top: 10px;float:left;"> Available</div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 border-left">
                                            <div class="col-md-7" style="font-size:14px; padding:0;">Current location</div>
                                            <div class="col-md-5 text-center" style="font-size:14px;padding:0;">{{$j->jobseeker_current_location}}</div>
                                            <div class="col-md-6" style="font-size:14px;padding:0;">Salary Range</div>
                                            <div class="col-md-6 text-center" style="font-size:14px;padding:0;">{{$j->expected_salary}}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @empty
                        <p class="text-warning">No Candidates Found</p>

                    @endforelse
                    <div class="text-right"> {{$applicants->links()}}</div>
                </div>



                {{-- @include('employer.partial._right_sidebar') --}}
            </div>


    </section>
    <div class="modal" tabindex="-1" role="dialog" id="actiondialog">
        <div class="modal-dialog" role="document" style="width:90%;height:90%;">
            <div class="modal-content" style="height:100%;width:100%;overflow-y:auto;">
                <div class="modal-body">
                    @include('employer.candidatesfilter')
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#slink{{$status}}').addClass("active");
        $(".names").on("click", function () {

            swal({
                title: "Schedule Interview",
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Type your password",
                        type: "datetime-local",
                    },
                },
            }).then((time) => {
                if (time) {
                    let jid = ($(this).attr("id"))
                    let jobid = ($(this).attr("jobid"))
                    window.location = "/employer/changeCandidatestatus/" + jid + "/3?jobid=" + jobid + "&time=" + time;
                }
            });

        });

        $(".chk_btn1").click(function () {
            if($(this).hasClass('chk_btn1_checked')){
                $(this).removeClass('chk_btn1_checked');
                var a = "panel_" + $(this).attr("id");
                $("#" + a).hide();
            }
            else{
                $(this).addClass('chk_btn1_checked');
                var a = "panel_" + $(this).attr("id");
                $("#" + a).show();
            }
        });

        $('.showmore').click( function () {
            var id = $(this).data("id");
            if(id == 'city'){
                $('ul[id^="collapse_city"]').addClass("in");
            }
            else{
                $('.additional_'+id).show();
            }
            $(this).hide();
        });

        $('input[id^="city_area"]').click( function () {
            if($(this).data('type') == 'city') {
                var id = $(this).data('id');
                if($(this).prop("checked")) {
                    $('input[data-type="area"][data-parid="' + id + '"]:enabled').prop("checked", true);
                }
                else{
                    $('#all_city_area').prop("checked", false);
                    $('input[data-type="area"][data-parid="' + id + '"]:enabled').prop("checked", false);
                }
            }
            else if($(this).data('type') == 'area') {
                var id = $(this).data('parid');
                if($(this).prop("checked")) {
                    $('input[data-type="city"][data-id="' + id + '"]:enabled').prop("checked", true);
                }
                else{
                    $('#all_city_area').prop("checked", false);
                }
            }
        });

        $('#all_city_area').click( function () {
            if(!$(this).prop("checked")){
                $('input[data-type="area"]:enabled').prop("checked", false);
                $('input[data-type="city"]:enabled').prop("checked", false);
            }
            else{
                $('input[data-type="area"]:enabled').prop("checked", true);
                $('input[data-type="city"]:enabled').prop("checked", true);
            }
        });

        $('#all_job_category').click( function () {
            if(!$(this).prop("checked")){
                $('input[type="checkbox"][id^="category_"]:enabled').prop("checked", false);
            }
            else{
                $('input[type="checkbox"][id^="category_"]:enabled').prop("checked", true);
            }
        });

        $('input[type="checkbox"][id^="category_"]:enabled').click( function () {
            if(!$(this).prop("checked")){
                $('#all_job_category').prop("checked", false);
            }
        });

        $('#all_job_type').click( function () {
            if(!$(this).prop("checked")){
                $('input[type="checkbox"][id^="jobtype_"]:enabled').prop("checked", false);
            }
            else{
                $('input[type="checkbox"][id^="jobtype_"]:enabled').prop("checked", true);
            }
        });

        $('input[type="checkbox"][id^="jobtype_"]:enabled').click( function () {
            if(!$(this).prop("checked")){
                $('#all_job_type').prop("checked", false);
            }
        });

        $('#all_job_industry').click( function () {
            if(!$(this).prop("checked")){
                $('input[type="checkbox"][id^="industry_"]:enabled').prop("checked", false);
            }
            else{
                $('input[type="checkbox"][id^="industry_"]:enabled').prop("checked", true);
            }
        });

        $('input[type="checkbox"][id^="industry_"]:enabled').click( function () {
            if(!$(this).prop("checked")){
                $('#all_job_industry').prop("checked", false);
            }
        });

        $('#all_visa_type').click( function () {
            if(!$(this).prop("checked")){
                $('input[type="checkbox"][id^="visatype_"]:enabled').prop("checked", false);
            }
            else{
                $('input[type="checkbox"][id^="visatype_"]:enabled').prop("checked", true);
            }
        });

        $('input[type="checkbox"][id^="visatype_"]:enabled').click( function () {
            if(!$(this).prop("checked")){
                $('#all_visa_type').prop("checked", false);
            }
        });

        $('#all_nationality').click( function () {
            if(!$(this).prop("checked")){
                $('input[type="checkbox"][id^="nation_"]:enabled').prop("checked", false);
            }
            else{
                $('input[type="checkbox"][id^="nation_"]:enabled').prop("checked", true);
            }
        });

        $('input[type="checkbox"][id^="nation_"]:enabled').click( function () {
            if(!$(this).prop("checked")){
                $('#all_nationality').prop("checked", false);
            }
        });

        function resetfilter(){
            $('input[type="checkbox"]').prop('checked', false);
            $('#keyword').val('');
        }

        @if(!empty($minsalary) && $minsalary>=0)
        $('#salary').trigger('click');
        @endif

        @if(!empty($minexperience) && $minexperience>=0)
        $('#experience').trigger('click');
        @endif

        @if(!empty($visatype_select) && count($visatype_select)>=0)
        $('#visatype').trigger('click');
        @endif

        @if(!empty($location_select) && count($location_select)>=0)
        $('#location').trigger('click');
        @endif

        @if(!empty($industry_select) && count($industry_select)>=0)
        $('#industry').trigger('click');
        @endif

        @if(!empty($noc_select) && count($noc_select)>=0)
        $('#noc').trigger('click');
        @endif

        @if(!empty($nation_select) && count($nation_select)>=0)
        $('#nationality').trigger('click');
        @endif

        @if(!empty($jobtype_select) && count($jobtype_select)>=0)
        $('#jobtype').trigger('click');
        @endif

        @if(!empty($category_select) && count($category_select)>=0)
        $('#jobtitle').trigger('click');
        @endif

        @if(!empty($gender_select) && count($gender_select)>=0)
        $('#gender').trigger('click');
        @endif
    </script>
@endsection
@section('extrascript')

@endsection