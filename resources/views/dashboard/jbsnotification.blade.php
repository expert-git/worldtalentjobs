@extends('dashboard.layout.admin_layout')

@section('content')

    <div class="container row">
        <div class="notempallcontain col-sm-10">
            <div class="notempapproval row">
                <span class="col-sm-8 tile">{{$jbs->created_at}}</span>
                <div class="col-sm-4 pull-right">
                    <a href="{{url('/inspector/rejectjbs/'.$jbs->jobseeker_id)}}"><button class="btnreject" ><a href=""></a>Reject</button></a>
                    <a href="{{url('/inspector/approvejbs/'.$jbs->jobseeker_id)}}"><button class="btnapprove">Approve</button></a>
                </div>

            </div>
            <div class="notempinfo">
                <div class="col-sm-6">
                    <p class="tile">Employer Info</p>
                    <div class="noteinfoside">
                        <div class="notesame">
                            <span class="col-sm-12">First Name</span>
                            <span class="col-sm-12">last Name</span>
                            <span class="col-sm-12">Fathers Name</span>
                            <span class="col-sm-12">Date of Birth</span>
                            <span class="col-sm-12">Nationality</span>
                        </div>
                        <div class="notevalue">
                            <span class="col-sm-12">{{$jbs->companyname}}</span>

                            @if(empty($jbs->first_name))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{$jbs->first_name}}</span>
                            @endif
                            @if(empty($jbs->last_name))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{$jbs->last_name}}</span>
                            @endif
                            @if(empty($jbs->jobseeker_father_name))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{$jbs->jobseeker_father_name}}</span>
                            @endif
                            @if(empty($jbs->jobseeker_dob))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{$jbs->jobseeker_dob}}</span>
                            @endif
                            @if(empty($jbs->jobseeker_nationality))
                                 <span class="col-sm-12">Empty</span>
                            @else
                                 <span class="col-sm-12">{{$jbs->jobseeker_nationality}}</span>
                            @endif


                        </div>
                    </div>
                </div>
                <iv class="col-sm-6 pull-right">
                    <span class="pull-right tile" >Company Logo</span>
                    @if(file_exists($jbs->profile_img))
                        <img width="100" height="100" src="{{url($jbs->profile_img)}}" alt="">
                    @else
                        <img width="100px" height="100px" src="{{url('/storage/profile/FOLuvyTwnmWNya5RXpO4SCqJ5lzviVj1mEEk2y0o.jpeg')}}" alt="">
                @endif
            </div>
            <div class="notcontact">
                <div class="tile">Contact Info</div>
                <div class="notempaddress col-sm-6" >
                    <div class="col-sm-12">
                        <span class="col-sm-12">Email Address</span>
                        <span class="col-sm-12">Telephone</span>
                    </div>
                    <div class="col-sm-12">
                        <span class="col-sm-12">{{$jbs->email}}</span>
                        <span class="col-sm-12">{{$jbs->jobseeker_phone1}}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection