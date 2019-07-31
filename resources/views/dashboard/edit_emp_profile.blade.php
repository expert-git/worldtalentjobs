@extends('dashboard.layout.admin_layout')

@section('content')
<section>
    <div class="nav-header" >
        <nav>
            <ul class="top-nav detail">
                <li class="activeul" ><a href="{{url('/inspector/employerdetail/'.$myprofile->id)}}">Profile</a></li>
                <li ><a href="{{url('/inspector/jobposts/'.$myprofile->id)}}">Job Posts</a></li>
                <li  ><a href="{{url('/inspector/getAllCandidates/'.$myprofile->id)}}">Candidates</a></li>
                <li class="lastlicl "><a href="{{url('/inspector/emp/message/'.$myprofile->id.'/0')}}">Messages</a></li>
            </ul>
        </nav>
    </div>
    <div style="margin-top:2%;width:90%" class="container nav-in">
        <div  class="col-md-8">
            <h4 class="Posthed " style=""> Company Details</h4>
            <form action="{{url('/inspector/savedetails')}}" method="POST" id="profileform">
                {{csrf_field()}}
                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$emp->id}}">
                    <div class="col-md-6">
                        <label>Company name<span class="mustbeoption">*</span></label>
                        <input name="companyname" value="{{$emp->companyname}}" type="text" class="ico-03" value="" />
                    </div>
                    <div class="col-md-6">
                        <label>Website(optional)</label>
                        <div class="websiteurl">
                            <select value="{{$emp->proto}}" name="proto" id="proto">
                                <option value="http:" @if($emp->proto=="http:") selected @endif>http://</option>
                                <option value="https:" @if($emp->proto=="https:") selected @endif>https://</option>
                            </select>
                            <input name="websiteaddress" value="{{$emp->websiteaddress}}" type="text" class="ico-03"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>City<span class="mustbeoption">*</span></label>
                        <select id="location" name="location" class="natidropdo custom-select mr-sm-2" required>
                            <option value="">Choose...</option>
                            @foreach($cityareas as $city)
                                @if($city->parent_id==0)
                                    <option value="{{$city->id}}" @if($city->id==$emp->city) selected @endif>{{$city->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Area / Location<span class="mustbeoption">*</span></label>
                        <select value="{{$emp->area}}" name="area" id="area" class="natidropdo custom-select mr-sm-2" required>
                            <option value="">Choose...</option>
                            @foreach($cityareas as $area)
                                @if($area->parent_id==$emp->city)
                                    <option @if($area->id==$emp->area) selected @endif value="{{$area->id}}">
                                        {{$area->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Email Address<span class="mustbeoption">*</span></label>
                        <input name="ContactEmail" disabled value="{{$emp->ContactEmail}}" type="text" class="ico-03" name="ContactEmail" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="companyname">Industry<span class="mustbeoption">*</span></label>
                        <select required name="industry" class="ico-03" id="industry" value="{{$emp->industrytype}}">
                            <option value="">Choose..</option>
                            @foreach($industries as $ind)
                                <option value="{{$ind->id}}" @if($emp->industrytype==$ind->id) selected @endif>{{$ind->industrytypename}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="companyname">Employer Type<span class="mustbeoption">*</span></label>
                        <select required name="employertype" class="ico-03" id="employertype" value="{{$emp->employertype}}">
                            <option value="" hidden>Choose..</option>
                            <option value="Private" @if($emp->employertype=='Private') selected @endif>Private</option>
                            <option value="Government" @if($emp->employertype=='Government') selected @endif>Government</option>
                            <option value="Semi-Government" @if($emp->employertype=='Semi-Government') selected @endif>Semi-Government</option>
                            <option value="Non-profit" @if($emp->employertype=='Non-profit') selected @endif>Non-profit</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="fname">First Name<span class="mustbeoption">*</span></label>
                        <input required name="fname" class="ico-03" type="text" id="fname" placeholder="" value="{{$emp->fname}}">
                    </div>
                    <div class="col-md-6">
                        <label for="lname">Last Name<span class="mustbeoption">*</span></label>
                        <input required name="lname" class="ico-03" type="text" id="lname" placeholder="" value="{{$emp->lname}}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="position">Position<span class="mustbeoption">*</span></label>
                        <input required name="position" class="ico-03" type="text" id="position" placeholder="" value="{{$emp->position}}">
                    </div>
                    <div class="col-md-6">
                        <label for="ContactPhone1">Contact Number<span class="mustbeoption">*</span></label>
                        <input required class="ico-03" type="text" id="ContactPhone1" name="ContactPhone1" type="tel" required placeholder="" value="{{$emp->ContactPhone}}">
                        <input type="hidden" id="ContactPhone" name="ContactPhone">
                    </div>
                </div>

                <h4 class="Posthed " style=""> Social Media Links</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Facebook</label>
                            <div class="websiteurl">
                                <select value="{{$emp->protofb}}" name="protofb" id="protofb">
                                    <option value="http:" @if($emp->protofb=="http:") selected @endif>http://</option>
                                    <option value="https:" @if($emp->protofb=="https:") selected @endif>https://</option>
                                </select>
                                <input name="fb" value="{{$emp->fb}}" type="text" class="ico-03"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Twitter</label>
                            <div class="websiteurl">
                                <select value="{{$emp->prototwitter}}" name="prototwitter" id="prototwitter">
                                    <option value="http:" @if($emp->prototwitter=="http:") selected @endif>http://</option>
                                    <option value="https:" @if($emp->prototwitter=="https:") selected @endif>https://</option>
                                </select>
                                <input name="twitter" value="{{$emp->twitter}}" type="text" class="ico-03"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Linkedin</label>
                            <div class="websiteurl">
                                <select value="{{$emp->protolinkedin}}" name="protolinkedin" id="protolinkedin">
                                    <option value="http:" @if($emp->protolinkedin=="http:") selected @endif>http://</option>
                                    <option value="https:" @if($emp->protolinkedin=="https:") selected @endif>https://</option>
                                </select>
                                <input name="linkedin" value="{{$emp->linkedin}}" type="text" class="ico-03"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <button class="loginbtn" style="background-color:#28c294;">UPDATE PROFILE</button>
            </form>

            <form action="{{url('/inspector/changeemail')}}" method="POST">
                <hr>
                <h4 class="Posthed " style="font-size:18px">Change Email</h4>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{$emp->id}}"/>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>New Email</label>
                            <input name="newemail" value="{{$emp->ContactEmail}}" type="text" class="ico-03"/>
                        </div>
                    </div>
                    <div class="col-md-8">

                    </div>
                </div>
                <button class="loginbtn">CHANGE EMAIL</button>
            </form>
            <hr>
            <div class="row">
                <div class="col-md-12" style="color: #E86850;">
                    <a href="{{url('/inspector/deleteaccount')}}/{{$emp->id}}">
                        <h4 class="Posthed " style="font-size:18px">Delete Account</h4>
                    </a>
                </div>
                <div class="col-md-12" style="color: #E86850;">
                    <small style="font-weight:bold;">Warning! <span class="hint" style="color:black;">You will not be able to reactivate your account or retrieve any of the
            content or information you have added.</span></small>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection