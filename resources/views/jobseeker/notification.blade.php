@extends('public.layout.public_layout')
@section('title')
Manage Jobs
@endsection
@section('script')
{{--asset('js/managejob.js')--}}
{!!Html::script('js/managejob.js')!!}
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
</style>
@endsection

@section('content')
<section class="minheight">
    <div style="margin-top:20px;width:90%;" class="container">
        <div class="row">
            @include('jobseeker.partial._sidebar')
            <div class="col-md-8">
                <?php $nowdt=""; ?>
                @if ($notif_count == 0)
                    <div style="text-align:center;">
                        <p style="color:#a6b1be;margin-top:200px;font-size:30px;">No new notifications</p>
                        <br>
                        <br>
                        <a href="/jobseeker/managejobs/0"><button class="profile-btn" style="float:none;">FIND JOBS</button></a>
                    </div>
                    <div class="row text-right">
                        {{$notif->links()}}
                    </div>
                @else
                    @foreach($notif as $j)
                        @if($j->job != null)
                            @if($nowdt != $dt[$j->id])
                            <?php $nowdt=$dt[$j->id]; ?>
                            <h4 style="color:gray">{{$nowdt}}</h4>
                            @endif

                            <div class="row notificationrow"
                                style="box-shadow: -7px 8px 55px -5px rgba(0,0,0,0.35); margin-bottom:2%;padding-top:2%">
                                <img style="width: 80px;height:80px;float:left;" src="/{{$j->job->employer->empprofile->companylogo}}">

                                <div class="notificaonthaed" style="margin-left:100px">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <p>{{$j->job->employer->empprofile->fname}} {{$j->job->employer->empprofile->lname}}</p>
                                            <p>{!! $j->message !!}</p>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            @if($dt[$j->id]=="Today" || $dt[$j->id]=="Yesterday")
                                                {{App\Utils\Utils::ago_from_str($j->created_at)}}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <p style="margin-bottom:0;"><a href="/showdetails/{{$j->job_id}}"><button
                                                class="viewbtn3" style="">View Job </button></a></p>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <a href="/jobseeker/deleteNotification/{{$j->id}}" style="color:#e86850">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection