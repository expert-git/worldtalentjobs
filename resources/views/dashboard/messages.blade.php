{{-- Header --}}
@extends('dashboard.layout.admin_layout')
@section('page_title')
HomePage
@endsection

@section('style')
    <style>
        .help_text {
            color: red;
            display: none;
        }

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

        @media (min-width: 200px) and (max-width: 480px) {
            .message_userlist{
                clear:both;
            }

            .msg_desc{
                width:150px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="minheight">
        <div class="nav-header" >
            <nav>
                <ul class="top-nav detail">
                    <li ><a href="{{url('/inspector/employerdetail/'.$myprofile->id)}}">Profile</a></li>
                    <li ><a href="{{url('/inspector/jobposts/'.$myprofile->id)}}">Job Posts</a></li>
                    <li  ><a href="{{url('/inspector/getAllCandidates/'.$myprofile->id)}}">Candidates</a></li>
                    <li class="lastlicl activeul"><a href="{{url('/inspector/emp/message/'.$myprofile->id.'/0')}}">Messages</a></li>
                </ul>
            </nav>
        </div>
        <div style="width:90%;margin:auto;margin-top:100px;margin-bottom:100px;" class="container nav-in">

            <div class="row">
                @if($curconv)
                    <div class="col-md-3 col-sm-12 message_userlist">
                        @forelse($conv as $c)
                            <a href="/inspector/message/{{$empid}}/{{$c->id}}">
                                <div class="row candbox @if($c->id == $curconv->id) candbox-select @endif" style="margin-bottom:20px;position:relative;">
                                    <div class="logobox" style="width:70px;float:left;">
                            <span class="logo2">
                                <img src="/{{$c->jobseeker_->personaldetails->profile_img}}" style="width:50px;">
                            </span>
                                    </div>
                                    <div class="appinfobox" style="margin-left:75px;margin-right:50px;">
                                        <p style="margin-top:5px;"><b> {{$c->jobseeker_->personaldetails->first_name}} {{$c->jobseeker_->personaldetails->last_name}}</b></p>
                                        <p>
                                            @if($c->messages->count()>0)
                                                @if($c->messages->last()->sender == 1)
                                                    <i class="fas fa-arrow-up"></i>
                                                @else
                                                    <i class="fas fa-arrow-down"></i>
                                                @endif
                                                {{$c->messages->last()->message}}
                                            @endif
                                        </p>
                                    </div>
                                    <div style="position: absolute;right: 11px;top: 21px;">
                                        <div class="unreadcnt" id="unreadcnt_{{$c->id}}" @if(!isset($unreadcnt[$c->id])) style="display:none;" @endif>
                                            @isset($unreadcnt[$c->id])
                                                {{$unreadcnt[$c->id]}}
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <span class="text-warning">No Messages yet</span>
                        @endforelse
                    </div>
                    <div class="col-md-7 col-sm-12 chartbox adminpanel">
                        <div class="row" style="padding-top:10px;padding-bottom:10px;">
                            <div class="col-md-12">
                                <img src="/{{$curconv->jobseeker_->personaldetails->profile_img}}" style="width:50px;height:50px;">
                            </div>
                        </div>
                        <div id="context" class="row" style="height: 800px;overflow-y: auto;border-bottom:2px solid #a6b1be;border-top:2px solid #a6b1be;">
                            @each('public.message', $curconv->messages, 'msg')
                        </div>
                        <div class="row" style="padding-top:10px;padding-bottom:10px;">
                        </div>
                    </div>
                @else
                    <div class="col-md-10">
                        <div style="text-align:center;">
                            <p style="color:#a6b1be;margin-top:200px;font-size:30px;">No new messages</p>
                            <br>
                            <br>
                            <a href="/inspector/getAllCandidates"><button class="profile-btn" style="float:none;">FIND CANDIDATES</button></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection