{{-- Header --}}
@extends('public.layout.public_layout')
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
    <div style="width:90%;margin:auto;margin-top:20px;margin-bottom:100px;" class="container">

        <div class="row">
            @include('employer.partial._sidebar')
            @if($curconv)
            <div class="col-md-3 col-sm-12 message_userlist">
                @forelse($conv as $c)
                <a href="/employer/message/{{$c->id}}">
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
            <div class="col-md-7 col-sm-12 chartbox">
                <div class="row" style="padding-top:10px;padding-bottom:10px;">
                    <div class="col-md-12">
                        <img src="/{{$curconv->jobseeker_->personaldetails->profile_img}}" style="width:50px;height:50px;">
                    </div>
                </div>
                <div id="context" class="row" style="height: 800px;overflow-y: auto;border-bottom:2px solid #a6b1be;border-top:2px solid #a6b1be;">
                    @each('public.message', $curconv->messages, 'msg')
                </div>
                <div class="row" style="padding-top:10px;padding-bottom:10px;">
                    <div class="col-md-12 crystalinput">
                        <input id="message" class="crystalinput" type="text" placeholder="Write a message ...">
                        <a href="#" id="send"><i class="fas fa-paper-plane"></i></a>
                        {{csrf_field()}}
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-10">
                <div style="text-align:center;">
                    <p style="color:#a6b1be;margin-top:200px;font-size:30px;">No new messages</p>
                    <br>
                    <br>
                    <a href="/employer/getAllCandidates"><button class="profile-btn" style="float:none;">FIND CANDIDATES</button></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
@section('extrascript')
<script>
    $('#context').scrollTop($('#context').prop("scrollHeight"));

    function sendmsg(){
        var msg = $('#message').val();
        if(msg=='') return;

        var con_id = 0;
        var js=null;
        var emp=null;
        @if($curconv)
            con_id = "{{$curconv->id}}";
            js = "{{$curconv->jobseeker}}";
            emp = "{{$curconv->employer}}";
        @endif
        
        
        var sender = 1;

        var data = {
            con_id: con_id,
            message: msg,
            sender: sender,
            js: js,
            emp: emp
        };

        $.ajax({
            url: "/addMessage",
            method: "GET",
            data: data,
            success: function(res){
                data["id"] = res.id;
                $('#context').html($('#context').html() + res.html);
                $('#context').scrollTop($('#context').prop("scrollHeight"));
                $('#message').val('');

                $.ajax({
                    url: "/broadcastMessage",
                    data: data,
                });
            }
        });
    }
    
    $('#message').keypress(function (event) {
        if (event.which == 13) {
            sendmsg();        
        }
    });

    $('#send').on("click", function () {
        sendmsg();        
    });

    var channel = pusher.subscribe('message');
    channel.bind('fromjobseeker.arrived.{{ Auth::guard("employer")->user()->id }}', function(data) {
        var user = data[0];
        var msg = data[1];

        var curconvid = 0;
        @if($curconv)
            curconvid = {{$curconv->id}};
        @endif

        if(curconvid == parseInt(msg.con_id)){
            $.ajax({
                url: "/getMessage/"+msg.id,
                method: "GET",
                success: function(html){
                    $('#context').html($('#context').html() + html);
                    $('#context').scrollTop($('#context').prop("scrollHeight"));
                    $('html').scrollTop($('html').prop("scrollHeight"));
                }
            });
        }
        else{
            var curval = $('#unreadcnt_'+msg.con_id).text().trim();
            if(curval==""){
                curval = 0;
            }
            else{
                curval = parseInt(curval);
            }
            curval++;
            $('#unreadcnt_'+msg.con_id).show();
            $('#unreadcnt_'+msg.con_id).text(curval);
        }
    });

</script>

@endsection