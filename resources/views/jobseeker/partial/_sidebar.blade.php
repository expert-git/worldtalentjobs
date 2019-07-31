<div class="col-md-2 navsidebar">

    <div class="applyjob1img">
        <div class="accounimgpro">

            @if($jobprofile->profile_img)
            <img style="width:170px;" src="/{{$jobprofile->profile_img}}" >
            @else
            <img src="/img/profile.png" style="width:170px;">
            @endif
            <h1 class="Posthed" style="margin-bottom: 6px;">{{$jobprofile->first_name}} {{$jobprofile->last_name}}</h1>
            <p class="accondlondon">{{$jobprofile->jobseeker_current_location}}</p>
        </div>

        <div class="row" id="jobstatediv">
            <div class="acoonappnum">
                <div class="col-md-5 col-xs-6 mr-0">
                    <p class="Posthed" style="font-size:14px;" class="accontappl">Jobs<br>Applied</p>
                    <h1 class="Posthed">{{$applied}}<span style="font-size:10px;"> (total)</span></h1>
                </div>
                <div class="col-md-7 col-xs-6 ml-0">
                    <p class="Posthed" style="font-size:14px;">Applications<br>Accepted</p>
                    <h1 class="Posthed">{{$accepted}}</h1>
                </div>
            </div>
        </div>
        <div class="aconntmenu">
            <a href="/jobseeker/managejobs/0"> <h4 @if($pageno==1) class="current" @else class="leftcont" @endif><div class="col-md-2"><i class="lefbaricon fas fa-list" @if($pageno==1) style="color:blue;" @endif></i> </div><div class="col-md-10"> Jobs</div></h2></a>
            <a href="/jobseeker/myresume"> <h4 @if($pageno==2) class="current" @else class="leftcont" @endif><div class="col-md-2"><i class="lefbaricon far fa-user" @if($pageno==2) style="color:blue;" @endif></i>  </div><div class="col-md-10"> Profile </div></h2></a>
            <a href="/jobseeker/message/0"> <h4 @if($pageno==3) class="current" @else class="leftcont" @endif><div class="col-md-2"><i class="lefbaricon far fa-envelope" @if($pageno==3) style="color:blue;" @endif></i>  </div><div class="col-md-10"> Messages </div></h2></a>
            <a href="/jobseeker/notifications"> <h4 @if($pageno==4) class="current" @else class="leftcont" @endif><div class="col-md-2"><i class="lefbaricon fas fa-bell"  @if($pageno==4) style="color:blue;" @endif></i> </div><div class="col-md-10">  Notifications </div></h2></a>
            <a href="/jobseeker/editprofile"> <h4 @if($pageno==5) class="current" @else class="leftcont" @endif><div class="col-md-2"><i class="lefbaricon fas fa-pencil-alt"  @if($pageno==5) style="color:blue;" @endif></i> </div><div class="col-md-10">  Edit Profile </div></h2></a>
        </div>
    </div> 
</div>
