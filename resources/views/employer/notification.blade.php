

{{-- Header --}}
@extends('public.layout.public_layout')
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

    @media screen and (max-width: 500px) {
        .photo1 {
            float: left;
            margin: 0;
            padding: 7px 20px 103px 0;
        }

        .send_msg {
            float: left;
            margin: 10px 0 0 3px;
            padding: 3px 4px;
            border: 1px solid #101010;
            color: #101010;
            border-radius: 5px;
            font-size: 14px;
        }

        .delete_button {
            top: 0px;
        }
    }
</style>
@endsection

@section('content')
<section class="minheight">
    <div style="margin-top:2%;width:90%;" class="container">
        <div class="row">
            @include('employer.partial._sidebar')
            <div class="col-md-8">
                <?php $nowdt=""; ?>
                @forelse($notif as $j)
                    @if($nowdt != $dt[$j->id])
                    <?php $nowdt=$dt[$j->id]; ?>
                    <h4 style="color:gray">{{$nowdt}}</h4>
                    @endif
                    
                    <div class="row notificationrow"
                        style="box-shadow: -7px 8px 55px -5px rgba(0,0,0,0.35); margin-bottom:2%;padding-top:2%">
                        <img style="width: 80px;height:80px;float:left;" src="/{{$j->jobseeker->personaldetails->profile_img}}">
                        
                        <div class="notificaonthaed" style="margin-left:100px">
                            <div class="row">
                                <div class="col-md-9">
                                    <p>{{$j->jobseeker->personaldetails->first_name}} {{$j->jobseeker->personaldetails->last_name}}</p>
                                    <p>
                                        @if($j->message=="Applied for job")
                                            {!! 'Applied for your job ' . $j->job->jobtitle !!}
                                        @else
                                            {!! $j->message !!}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-3 text-right">
                                    @if($dt[$j->id]=="Today" || $dt[$j->id]=="Yesterday")
                                        {{App\Utils\Utils::ago_from_str($j->created_at)}}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <p style="margin-bottom:0;">
                                        <a href="/employer/jobdetails/{{$j->job_id}}/{{$j->jobseeker_id}}">
                                            <button class="viewbtn3" style="margin-right:20px;">View Profile </button>
                                        </a>
                                        <a href="/createConversation/{{$j->jobseeker_id}}">
                                            <button class="viewbtn4" style="">Send Message</button>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="/employer/deleteNotification/{{$j->id}}" style="color:#e86850">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                <div style="text-align:center;">
                    <p style="color:#a6b1be;margin-top:200px;font-size:30px;">No New Notifications</p>
                    <br>
                    <br>
                    <a href="/employer/getAllCandidates"><button class="profile-btn" style="float:none;">FIND CANDIDATES</button></a>
                </div>
                @endforelse
                <div class="row text-right">
                    {{$notif->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

	
	