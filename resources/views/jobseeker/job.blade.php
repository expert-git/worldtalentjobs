@extends('public.layout.public_layout')
@section('title')
Jobs
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
.minheight {
    min-height:calc(100vh - 78px - 45px);
    padding: 0.1px 0;
}
.specialboard::before {
    onclick:"window.location = 'http://www.htmlcodes.ws/;";

}
</style>
@endsection
@section('content')
<section class="minheight">
    <div style="margin-top:2%;width:90%;" class="container">
        <div class="row">

            @include('jobseeker.partial._sidebar')

            <div style="" class="col-md-8">
                <a href="/jobseeker/managejobs/0" style="@if($id==0) color:#7889FF; @endif font-size:18px;">
                    Jobs Applied ({{$applied}})
                </a> 
                <a href="/jobseeker/managejobs/3" style="@if($id==3) color:#7889FF;@endif font-size:18px;margin-left:100px;">
                    Scheduled for Interview ({{$scheduled}})
                </a>

                <br>
                <br>
                @if(isset($job))
                @forelse($job as $j)
                <div class="row" style="margin-top:20px;">
                    <div class="col-md-2 col-sm-12">
                        @if(file_exists($j->companylogo))
                            <img style="margin:auto;width: 100px;" src="/{{$j->companylogo}}">
                        @else
                            <img style="margin:auto;width: 100px;"
                                src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png">
                        @endif
                    </div>
                    <div class="col-md-8 notificaonthaed">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{'/showdetails/'.$j->job_id}}" style="vertical-align: top; font-size:22px;font-weight:bold;">
                                    {{$j->jobtitle}}
                                </a>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-4">
                                <span style="vertical-align: middle;font-size:16px;color:#7889ff;"> {{$j->companyname}} </span>
                                <br>
                                <span style="vertical-align: bottom;font-size:16px;color:grey;"> {{App\Utils\Utils::ago_from_str($j->created_at)}} </span>
                            </div>
                            <div class="col-md-8 border-left">
                                @if($id==3)
                                    <br>
                                    <span style="color:#7889FF;margin-right:10px;">Interview On</span> <b>{{App\Utils\Utils::cdateformat2($j->scheduled_time)}} {{App\Utils\Utils::ctimeformat($j->scheduled_time)}}</b>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        @if($id==0)
                        <span class="appliedbox">APPLIED</span>
                        @elseif($id==3)
                        <span class="appliedbox" style="background:#28c294;">SCHEDULED</span>
                        @endif
                    </div>
                </div>

                <hr class="line" style="margin-top:20px; margin-bottom:30px;">
                @empty
                <p class="text-warning">No Job Found</p>

                @endforelse
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{isset($job)?($job->links()):NULL}}
                    </div>
                </div>
                @endif
            </div>

            @include('jobseeker.partial._rightsidebar')

        </div>

    </div>
</section>
@endsection