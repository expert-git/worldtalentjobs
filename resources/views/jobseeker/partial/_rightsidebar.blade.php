
<div class="col-md-2" id="rightsidebardiv">
    <div class="specialboard">
        <img src="/assets/img/Group 2.4.png"/>
        List your Profile on our special board <a href="#">Job Needed</a> and get noticed by the employer faster!
    </div>
    <br>
    <br>
    <div class="recentnot">
        <h5 style="text-align: center;font-weight:bold;margin-bottom:20px;">RECENT NOTIFICATIONS</h5>
    </div>
    @foreach($notifications as $notif)
        @if($notif->job != null)
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="">
                    <img style="width:60px;height:60px;" src="/{{$notif->job->employer->empprofile->companylogo}}">
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <p class="croshour" style="font-size:12px;font-weight:bold;color:#7889FF;">{{$notif->job->employer->empprofile->fname}} {{$notif->job->employer->empprofile->lname}}<br>
                    <span style="font-size:12px;color:grey;">{{App\Utils\Utils::ago_from_str($notif->created_at)}} </span>
                </p>
            </div>
        </div>
        <h5 style="font-size:14px;">{{$notif->message}} </h5>
        <hr style="max-width:400px; border:1px solid #999; text-align:left; margin-top:20px;">
        @endif
    @endforeach
    <a href="/jobseeker/notifications"><span class="viewall_right textright">View all</span></a>

</div>
