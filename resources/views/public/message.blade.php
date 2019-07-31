<div class="message-time col-md-12 text-center" data-id="{{$msg->id}}">
    <p style="color:#b1b1b1;font-size:12px;margin-top:10px;">{{App\Utils\Utils::cdateformat2($msg->created_at)}}</p>
</div>
@if($msg->sender==1)
<div class="col-md-12 text-right">
    <div class="arrow_box2" style="margin-right:10px;">
        {{$msg->message}}
    </div>
    @if($msg->conversation->employer_->empprofile->companylogo)
        <img src="/{{$msg->conversation->employer_->empprofile->companylogo}}" style="width:50px;height:50px;">
    @else
        <img src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png" style="width:50px;height:50px;">
    @endif
</div>
<div class="col-md-12 text-right">
    <p style="color:#b1b1b1;font-size:12px;margin-bottom:10px;margin-right:50px;">{{App\Utils\Utils::ctimeformat($msg->created_at)}}</p>
</div>
@else
<div class="col-md-12 text-left">
    <img src="/{{$msg->conversation->jobseeker_->personaldetails->profile_img}}" style="width:50px;height:50px;">    
    <div class="arrow_box3" style="margin-left:10px;">
        {{$msg->message}}
    </div>
</div>
<div class="col-md-12 text-left padding-top:20px;padding-bottom:20px;">
    <p style="color:#b1b1b1;font-size:12px;margin-bottom:10px;margin-left:50px;">{{App\Utils\Utils::ctimeformat($msg->created_at)}}</p>
</div>
@endif