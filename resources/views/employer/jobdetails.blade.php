@extends('public.layout.public_layout')
@section('page_title')
Search
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
@section('script')
{{--asset('js/managejob.js')--}}
{!!Html::script('js/managejob.js')!!}
@endsection
@section('content')
<section style="">
    <div style="margin-top:2%;width:90%;" class="container">
        <div class="row">
            @include('employer.partial._sidebar')
            <div style="" class="col-md-10">
                @include('employer.joboverview1', ['j' => $job, 'myprofile' => $myprofile])

                <h4>Applicants</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-12 message_userlist">
                        @foreach($applicants as $a)
                        <a href="/employer/jobdetails/{{$id}}/{{$a->jobseeker_id}}">
                            <div class="row candbox @if($a->pi == $jobprofile->id) candbox-select @endif">
                                <div class="col-md-4 logobox">
                                    <span class="logo2">
                                        <img src="/{{$a->profile_img}}">
                                    </span>
                                </div>
                                <div class="col-md-8 appinfobox">
                                    <p style="margin-top:5px;"><b> {{$a->first_name}} {{$a->last_name}}</b></p>
                                    <p>{{$a->jobseeker_current_location}}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="col-md-9 resumepanel" id="resumepanel">
                        @include('jobseeker.resume1', ['jobprofile' => $jobprofile])                
                    </div>

                </div>

            </div>
            <p style="margin-top:10%;color: #E86850;"> Please note: Any information you change in "My Account" will
                also be changed in your Resume. </p>
        </div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="actiondialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="height:300px;">
        <div class="modal-body">
            <div class="container" style="width:90%;margin-right:10px;margin-left:auto;">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="Posthed">Other Actions</h2>
                    </div>
                    <div class="col-md-4 text-right" style="padding-top:20px;">
                        <a href="#" data-dismiss="modal" style="font-size:12px;">
                            <img src="/img/close.jpg">  CLOSE
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-bottom:30px;">
                    <div class="col-md-4">
                        <div class="checkbox checkbox-primary">
                            <input id="action_shortlist" name="action_shortlist" type="checkbox" checked/>
                            <label for="action_shortlist">
                                Shortlist
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="checkbox checkbox-primary">
                            <input id="action_schedule" name="action_schedule" type="checkbox"/>
                            <label for="action_schedule">
                                Schedule For Interview
                            </label>
                        </div>
                        <div class="arrow_popup" id="popup_schedule" style="left:-391px;">
                            <div class="arrow_box1" style="width:450px;height:350px;padding:5px;" id="schtimepicker">
                                <div class="container" style="width: 80%;margin:auto;margin-top: 30px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            DATE
                                        </div>
                                        <div class="col-md-4">
                                            TIME
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 0;font-size: 12px;opacity: 0.5;line-height:1;">
                                        <div class="col-md-2 text-center" id="prevday">
                                            10
                                        </div>
                                        <div class="col-md-2 text-center" id="prevmonth">
                                            10
                                        </div>
                                        <div class="col-md-2 text-center"  id="prevyear">
                                            2018
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2 text-center" id="prevhour">
                                            11:00
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 0px;font-size: 20px;font-weight: bold;">
                                        <div class="col-md-2 text-center" id="curday">
                                            11
                                        </div>
                                        <div class="col-md-2 text-center" id="curmonth">
                                            11
                                        </div>
                                        <div class="col-md-2 text-center"  id="curyear">
                                            2019
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2 text-center" id="curhour">
                                            12:00
                                        </div>
                                        <div class="col-md-2 text-center" id="curhalf">
                                            PM
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 0;font-size: 12px;opacity: 0.5;line-height:1;">
                                        <div class="col-md-2 text-center" id="nextday">
                                            12
                                        </div>
                                        <div class="col-md-2 text-center" id="nextmonth">
                                            12
                                        </div>
                                        <div class="col-md-2 text-center"  id="nextyear">
                                            2020
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2 text-center" id="nexthour">
                                            01:00
                                        </div>
                                        <div class="col-md-2 text-center" id="nexthalf">
                                            AM
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 30px;">
                                        <div class="col-md-12">
                                            SCHEDULE ON
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 30px;">
                                        <div class="col-md-12">
                                            <span class="datetimevaluebox" id="day">
                                                11
                                            </span>
                                            <span class="datetimevaluebox" id="month">
                                                11
                                            </span>
                                            <span class="datetimevaluebox" id="year">
                                                2018
                                            </span>
                                            <span class="datetimevaluebox" style="margin-left:20px;" id="time">
                                                12:00
                                            </span>
                                            <span class="datetimevaluebox" id="half">
                                                PM
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:30px;">
                                        <div class="col-md-12 text-right">
                                            <button class="acceptbtn" style="margin-right:10px;" id="donebtn">DONE</button>        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom:30px;">
                    <div class="col-md-12 text-right">
                        <button class="acceptbtn" style="margin-right:10px;" id="proceedbtn">PROCEED</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

  <input type="hidden" id="url" value="1">
@endsection

@section('extrascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
    integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
</script>
<script src="/js/html2canvas.js"></script>
<script src="/js/html2pdf/html2pdf.bundle.min.js"></script>
<script>
    $('.more_icon').click(function () {
		var id = $(this).data("id");
		$('div[id^="popupsmenu_"]').css("display", "none");
		$('#popupsmenu_'+id).css("display", "block");
		event.stopPropagation();
    });
    $('html').click(function () {
        $('div[id^="popupsmenu_"]').css("display", "none");
        $('div[id^="popup_"]').css("display", "none");
    });

    $('#acceptbtn').click( function () {
        $('#actiondialog').modal();
    });

    $('#action_shortlist').click( function () {
        $(this).prop("checked", true);
        $('#action_schedule').prop("checked", false);
        $('#url').val("1");
    });

    $('#action_schedule').click( function () {
        $(this).prop("checked", true);
        $('#action_shortlist').prop("checked", false);
        $('#popup_schedule').show();
        $('#url').val("3?time="+getDateStr(getTime()));
        event.stopPropagation();
    });

    $('#schtimepicker').click( function() {
        event.stopPropagation();
    });

    function getDateStr(d){
        return d.getFullYear()+"-"+(d.getMonth()+1<10?("0"+(d.getMonth()+1)):(d.getMonth()+1))+"-"+(d.getDate()<10?("0"+d.getDate()):d.getDate())+" "+(d.getHours()<10?("0"+d.getHours()):d.getHours())+":00:00";
    }

    var now = new Date();

    function setDate(now){
        var prevday = new Date(now);
        prevday.setDate(prevday.getDate()-1);
        var nextday = new Date(now);
        nextday.setDate(nextday.getDate()+1);
        var prevmonth = new Date(now);
        prevmonth.setMonth(prevmonth.getMonth()-1);
        var nextmonth = new Date(now);
        nextmonth.setMonth(nextmonth.getMonth()+1);
        var prevyear = new Date(now);
        prevyear.setFullYear(prevyear.getFullYear()-1);
        var nextyear = new Date(now);
        nextyear.setFullYear(nextyear.getFullYear()+1);

        $('#prevday').html(prevday.getDate());
        $('#nextday').html(nextday.getDate());
        $('#prevmonth').html(prevmonth.getMonth()+1);
        $('#nextmonth').html(nextmonth.getMonth()+1);
        $('#prevyear').html(prevyear.getFullYear());
        $('#nextyear').html(nextyear.getFullYear());
        $('#curyear').html(now.getFullYear());
        $('#curmonth').html(now.getMonth()+1);
        $('#curday').html(now.getDate());

        $('#day').html($('#curday').text());
        $('#month').html($('#curmonth').text());
        $('#year').html($('#curyear').text());
    }
    
    function setTime(now){
        var hour = now.getHours();
        if(hour == 0){
            hour = 24;
        }
        var half="AM";
        if(hour>12){
            half = "PM";
            hour -= 12;
        }
        
        $('#curhour').html(hour+":00");
        $('#curhalf').html(half);

        var prev = new Date(now);
        prev.setHours(prev.getHours()-1);
        
        hour = prev.getHours();
        if(hour == 0){
            hour = 24;
        }
        half="AM";
        if(hour>12){
            half = "PM";
            hour -= 12;
        }
        
        $('#prevhour').html(hour+":00");

        var next = new Date(now);
        next.setHours(next.getHours()+1);
        
        hour = next.getHours();
        if(hour == 0){
            hour = 24;
        }
        
        if(hour>12){
            hour -= 12;
        }
        
        $('#nexthour').html(hour+":00");
        if(half=='PM'){
            $('#nexthalf').html("AM");  
        }
        else{
            $('#nexthalf').html("PM");
        }

        $('#time').html($('#curhour').text());
        $('#half').html($('#curhalf').text());
    }

    function getTime(){
        var hourtxt = $('#curhour').text();
        var hour = parseInt(hourtxt.split(":")[0]);
        var half = $('#curhalf').text();
        
        if(half == "PM"){
            hour += 12;
            if(hour==24){
                hour = 0;
            }
        }

        var d = new Date(parseInt($('#curyear').text()), parseInt($('#curmonth').text())-1, parseInt($('#curday').text()), hour);
        return d;
    }

    setDate(now);
    var pretime = new Date(now);
    pretime.setHours(pretime.getHours()+1);
    setTime(pretime);
    function getDate(){
        var d = new Date(parseInt($('#curyear').text()), parseInt($('#curmonth').text())-1, parseInt($('#curday').text()));
        return d;
    }

    $('#prevday').click( function() {
        var d = getDate();
        d.setDate(d.getDate()-1);
        setDate(d);
    });

    $('#nextday').click( function() {
        var d = getDate();
        d.setDate(d.getDate()+1);
        setDate(d);
    });

    $('#prevmonth').click( function() {
        var d = getDate();
        d.setMonth(d.getMonth()-1);
        setDate(d);
    });

    $('#nextmonth').click( function() {
        var d = getDate();
        d.setMonth(d.getMonth()+1);
        setDate(d);
    });

    $('#prevyear').click( function() {
        var d = getDate();
        d.setFullYear(d.getFullYear()-1);
        setDate(d);
    });

    $('#nextyear').click( function() {
        var d = getDate();
        d.setFullYear(d.getFullYear()+1);
        setDate(d);
    });

    $('#prevhour').click( function() {
        var d = getTime();
        d.setHours(d.getHours()-1);
        setTime(d);
    });

    $('#nexthour').click( function() {
        var d = getTime();
        d.setHours(d.getHours()+1);
        setTime(d);
    });

    $('#nexthalf').click( function() {
        var txt = $('#curhalf').text();
        $('#curhalf').text($('#nexthalf').text());
        $('#nexthalf').text(txt);
    });

    $('#rejectbtn').click( function () {
        window.location="/employer/changeCandidatestatus/{{$ajid}}/2";
    });

    $('#donebtn').click( function() {
        $('#url').val("3?time="+getDateStr(getTime()));
        $('div[id^="popup_"]').css("display", "none");
    });

    $('#proceedbtn').click( function() {
        window.location="/employer/changeCandidatestatus/{{$ajid}}/"+$('#url').val();
    });

    function print1() {
        const filename  = 'myresume.pdf';
        
        var div = $('#resumepanel').clone();
        div.find('.certpart').remove();
        div.find('#btnrow').hide();
        div.find('#btnrow1').hide();
        div.find('#resumeatt').remove();
        
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
    }
</script>
@endsection