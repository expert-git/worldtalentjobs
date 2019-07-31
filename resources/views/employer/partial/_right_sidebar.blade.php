<div class="col-md-2">
    <div class="specialboard1">
        <img src="/assets/img/Group 2.7.png" />
        <!-- <span>List <a href="#">Job Needed</a> to get more visibility!</span> -->
        <span>Lift your jobs for more visibility!</span>
    </div>

    <br>
    <br>
    <div class="recentnot">
            <h5 style="text-align: center;font-weight:bold;margin-bottom:20px;">RECENT NOTIFICATIONS</h5>
        </div>
        @foreach($notif as $n)
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="">
                        <img style="width:60px;height:60px;" src="/{{$n->jobseeker->personaldetails->profile_img}}">
                    </div>
                </div>
    
                <div class="col-md-12 col-lg-6">
                    <p class="croshour" style="font-size:12px;font-weight:bold;color:#7889FF;">{{$n->jobseeker->personaldetails->first_name}} {{$n->jobseeker->personaldetails->last_name}}<br>
                        <span style="font-size:12px;color:grey;">{{App\Utils\Utils::ago_from_str($n->created_at)}} </span>
                    </p>
                </div>
            </div>
            <h5 style="font-size:14px;">{!! $n->message !!} </h5>
            <hr style="max-width:400px; border:1px solid #999; text-align:left; margin-top:20px;">

        @endforeach

        <a href="/employer/notifications"><span class="viewall_right textright">View all</span></a>
</div>