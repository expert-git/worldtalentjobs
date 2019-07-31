<div class="row dashbord">
    <div class="col-md-7 col-sm-12">
        <h2 style="font-weight:bold;margin-top:0px;">{{ $j->jobtitle }}</h2>
        <div class="border-right left_content" style="max-width:200px;margin-right: 10px;">
            <h3 style="font-weight:bold;color:#5861a2;font-size:14px;margin-top:0px;margin-bottom:0px;">{{ $myprofile->companyname }}</h3>
            <p>{{ $j->create_ago() }}</p>
        </div>

        @foreach(explode(',',$j->skills) as $skill)
            <div class="skilldiv">{{$skill}}</div>
        @endforeach
    </div>
    <div class="col-md-2 col-sm-12 text-right">

    </div>

    <div class="col-md-3 col-sm-12">
        <div class="action_buttons">
            <span class="edit_button"><a href="{{url('/inspector/editajob/'.$j->id)}}" style="color: #d8d8d8;">EDIT</a></span>
            <span class="more_icon" data-id="{{$j->id}}"
                  style="cursor:pointer;font-size: 76px; line-height: 8px;margin: -3px 0 0 0;padding: 0 10px;width:30%;"><i class="fas fa-ellipsis-h" style="font-size: 20px;"></i>
            </span>

            @if( $j->status != 2)
                <div style="position: absolute;z-index: 10;right: 0;top: 30px;display:none;" id="popupsmenu_{{$j->id}}">
                    <div class="arrow_box" style="width:80px;height:60px;padding:5px;">
                        <div class="editicons23">
                            @if( $j->status == 0)
                                <div style="font-size:12px;"><a href="/inspector/pausestatus/{{$j->id}}"><img src="/img/close.jpg"
                                                                                                              style="padding-top: 10px; padding-right: 10px; float: left;"> PAUSE</a></div>
                            @else
                                <div style="font-size:12px;"><a href="/inspector/activestatus/{{$j->id}}"><img src="/img/available.jpg"
                                                                                                               style="padding-top: 10px; padding-right: 10px; float: left;"> ACTIVE</a></div>
                            @endif
                            <div style="font-size:12px;"><a href="/inspector/closestatus/{{$j->id}}"><img src="/img/delete.jpg"
                                                                                                          style="padding-top: 10px; padding-right: 10px; float: left;"> CLOSE</a></div>
                            <br clear="all" />
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div style="width:100%;">
            <div class="row" style="padding-top:10px;font-size:14px; margin-top:0px;margin-bottom:0px;">
                <div class="dot-div"></div>
                <div class="col-md-6 col-xs-6" style="color:#a0a0a0;"><span style="background: #fcfcfc;padding-right: 5px;">Status</span></div>
                <div class="col-md-6 col-xs-6 text-right">
                    <div style="background: #fcfcfc;padding-left: 5px;">
                        <img
                                @if( $j->status == 0 ) src="/img/available.jpg"
                                @elseif( $j->status == 0 ) src="/img/close.jpg"
                                @else( $j->status == 0 ) src="/img/delete.jpg"
                                @endif
                                style="padding-top: 10px; float: left;">
                        <span>
                            @if( $j->status == 0 ) Active
                            @elseif( $j->status == 0 ) Pause
                            @else( $j->status == 0 ) Close
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="row" style="font-size:14px; margin-top:0px;margin-bottom:0px;">
                <div class="dot-div"></div>
                <div class="col-md-6 col-xs-6" style="color:#a0a0a0;"><span style="background: #fcfcfc;padding-right: 5px;">Expire in</span></div>
                <div class="col-md-6 col-xs-6 text-right"><span style="background: #fcfcfc;padding-left: 5px;"> {{$j->expire_after()}}</span></div>
            </div>
            <div class="row" style="font-size:14px; margin-top:0px;margin-bottom:0px;">
                <div class="dot-div"></div>
                <div class="col-md-6 col-xs-6" style="color:#a0a0a0;"><span style="background: #fcfcfc;padding-right: 5px;">Total Views</span></div>
                <div class="col-md-6 col-xs-6 text-right"><span style="background: #fcfcfc;padding-left: 5px;"> {{$j->totalviews}}</span></div>
            </div>
        </div>
    </div>
</div>
