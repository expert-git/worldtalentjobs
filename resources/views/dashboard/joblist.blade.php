@extends('dashboard.layout.admin_layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('theme/css/newstyle.css') }}">
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

        .row {
            clear: both;
        }

        @media screen and (max-width: 500px) {
            .border-right {
                border-right: none;
                overflow: auto;
            }

            .border1 {
                margin: 0 2px;
                padding: 1px 0px;
                display: block;
                border: 1px solid #868686;
                float: left;
                font-size: 12px;
            }

            .action_buttons {
                float: left;
                border: 1px solid #a0a0a0;
                border-radius: 5px;
                position: relative;
                z-index: 10;
                clear: both;
                margin-top: 10px;
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
            /* width: 50%; */
            /* border-bottom: 4px solid #A6B1BE; */
        }

        .tabbable-line>.nav-tabs>li>a {
            border: 0;
            margin-right: 0;
            color: #808d9c;
            font-family: 'Quantico';
            font-size: 18px;
            margin-bottom: 20px;
        }

        .tabbable-line>.nav-tabs>li>a>i {
            color: #a6a6a6;
        }

        .tabbable-line>.nav-tabs>li.open,
        .tabbable-line>.nav-tabs>li:hover {
            border-bottom: 4px solid rgba(0, 0, 0, .5);
        }

        .tabbable-line>.nav-tabs>li.open>a,
        .tabbable-line>.nav-tabs>li:hover>a {
            border: 0;
            background: none !important;
            color: #5861a2;
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
            border-bottom: 4px solid black;
            position: relative;
        }

        .tabbable-line>.nav-tabs>li.active>a {
            border: 0;
            color: #5861a2;
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

        /* dotline */
        .dot-div {
            position:absolute;
            border-bottom: dotted #e1e1e1;
            width: 80%;
            height: 14px;
            left: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="nav-header" >
        <nav>
            <ul class="top-nav detail">
                <li ><a href="{{url('/inspector/employerdetail/'.$myprofile->id)}}">Profile</a></li>
                <li class="activeul"><a href="{{url('/inspector/jobposts/'.$myprofile->id)}}">Job Posts</a></li>
                <li><a href="{{url('/inspector/getAllCandidates/'.$myprofile->id)}}">Candidates</a></li>
                <li class="lastlicl"><a href="{{url('/inspector/emp/message/'.$myprofile->id.'/0')}}">Messages</a></li>
            </ul>
        </nav>
    </div>
    <section class="minheight">
        <div style="padding-top:2%;width:90%;" class="container">
            <div class="row">
                <div style="" class="col-md-8">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active" >
                                    <a href="#tab_part_1" data-toggle="tab" id="activetab">
                                        Active Jobs ({{ $activejob->count()<10?'0'.$activejob->count():$activejob->count() }}) </a>
                                </li>
                                <li>
                                    <a href="#tab_part_2" data-toggle="tab" id="pausedtab">
                                        Paused ({{ $pausedjob->count()<10?'0'.$pausedjob->count():$pausedjob->count() }}) </a>
                                </li>
                                <li>
                                    <a href="#tab_part_3" data-toggle="tab" id="closedtab">
                                        Closed ({{ $closedjob->count()<10?'0'.$closedjob->count():$closedjob->count() }}) </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_part_1">
                                    @foreach($activejob as $j)
                                        @include('dashboard.joboverview', ['j' => $j, 'myprofile' => $myprofile, 'applied2' => $applied2])
                                    @endforeach
                                    @if($active>10)
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                {{ $activejob->links() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="tab_part_2">
                                    @foreach($pausedjob as $j)
                                        @include('dashboard.joboverview', ['j' => $j, 'myprofile' => $myprofile, 'applied2' => $applied2])
                                    @endforeach
                                    @if($paused>10)
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                {{ $pausedjob->links() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="tab_part_3">
                                    @foreach($closedjob as $j)
                                        @include('dashboard.joboverview', ['j' => $j, 'myprofile' => $myprofile, 'applied2' => $applied2])
                                    @endforeach
                                    @if($closed>10)
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                {{ $closedjob->links() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            </script>

    </section>
@endsection

@section('extrascript')

@endsection