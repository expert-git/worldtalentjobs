@extends('dashboard.layout.admin_layout')

@section('content')
<div class="container row">

    <div id="printjobdiv" class="jobcontent col-sm-10">
        <div class="backdiv">
            <span><a href="{{url('/inspector/joblist')}}">Back</a></span><br><br>
            <table class="table table-striped">
                <th>
                        <td>{{$job->id}}</td>
                        <td>{{$emp->companyname}}</td>
                        <td>{{$job->jobtitle}}</td>
                        <td>{{$emp->ContactEmail}}</td>
                        <td>{{$emp->ContactPhone}}</td>
                </th>
            </table>
        </div>
        <div class="joball">
            <div class="jobem">
                @include('dashboard.joboverview', ['j' => $job, 'myprofile' => $emp])
            </div>
            <div class="jobinfo">
                <h1 class="PosthedSmall">Job Info</h1>
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 30px;">

                        <div class="col-md-7 fieldcolor">
                            Post ID
                        </div>
                        <div class="col-md-5 fw-900">
                            #{{$job->id}}
                        </div>


                        <div class="col-md-7 fieldcolor">
                            Employer Name
                        </div>
                        <div class="col-md-5 fw-900">
                            {{$emp->fname}}  {{$emp->lname}}
                        </div>

                        <div class="col-md-7 fieldcolor">
                            Employer ID
                        </div>
                        <div class="col-md-5 fw-900">
                            # {{$emp->id}}
                        </div>

                        <div class="col-md-7 fieldcolor">
                            Area/Zone
                        </div>
                        <div class="col-md-5 fw-900">
                            {{$area->name}}
                        </div>

                        <div class="col-md-7 fieldcolor">
                            Date & Time
                        </div>
                        <div class="col-md-5 fw-900">
                            {{$job->created_at}}
                        </div>

                        <div class="col-md-7 fieldcolor">
                            Company Industry
                        </div>
                        <div class="col-md-5 fw-900">
                            {{$ind->industrytypename}}
                        </div>

                        <div class="col-md-7 fieldcolor">
                            Employment Type
                        </div>
                        <div class="col-md-5 fw-900">
                            {{$job->employment_type}}
                        </div>

                        <div class="col-md-7 fieldcolor">
                            Monthly Salary Range
                        </div>
                        <div class="col-md-5 fw-900">
                            {{$job->salaryrange}}
                        </div>

                        <div class="col-md-7 fieldcolor">
                            Vacancies
                        </div>
                        <div class="col-md-5 fw-900">
                            {{$job->vacancies}}
                        </div>
                    </div>

                </div>
            </div>
            <div class="jobdescriptiom">
                <h1 class="PosthedSmall row">Job Description</h1>
                <div class="col-md-12" style="margin-bottom: 30px;">

                    <?php
                        echo $job->job_description; ?>

                </div>

            </div>
        </div>


    </div>

</div>

@endsection

@section('script')
    <script>
        $('.more_icon').click(function () {
            var id = $(this).data("id");
            $('div[id^="popupsmenu_"]').css("display", "none");
            $('#popupsmenu_'+id).css("display", "block");
            event.stopPropagation();
        });
        $('html').click(function () {
            $('div[id^="popupsmenu_"]').css("display", "none");
        });

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;


            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

@endsection