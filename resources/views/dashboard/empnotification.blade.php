@extends('dashboard.layout.admin_layout')

@section('content')

    <div class="container row">
        <div class="notempallcontain col-sm-10">
            <div class="notempapproval row">
                <span class="col-sm-8 tile">{{$emp->created_at}}</span>
                <div class="col-sm-4 pull-right">
                    <a href="{{url('/inspector/rejectemp/'.$emp->id)}}"><button class="btnreject" ><a href=""></a>Reject</button></a>
                    <a href="{{url('/inspector/approveemp/'.$emp->id)}}"><button class="btnapprove">Approve</button></a>
                </div>

            </div>
            <div class="notempinfo">
                <div class="col-sm-6">
                    <p class="tile">Employer Info</p>
                    <div class="noteinfoside">
                        <div class="notesame">
                            <span class="col-sm-12">Company Name</span>
                            <span class="col-sm-12">Industry</span>
                            <span class="col-sm-12">First Name</span>
                            <span class="col-sm-12">last Name</span>
                            <span class="col-sm-12">Location/City</span>
                            <span class="col-sm-12">Area/Zone</span>
                        </div>
                        <div class="notevalue">
                            <span class="col-sm-12">{{$emp->companyname}}</span>
                            @if(empty(\App\industrytype::find($emp->industrytype)->industrytypename))
                                <span class="col-sm-12">Empty</span>
                            @else
                            <span class="col-sm-12">{{\App\industrytype::find($emp->industrytype)->industrytypename}}</span>
                            @endif
                            @if(empty($emp->fname))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{$emp->fname}}</span>
                            @endif
                            @if(empty($emp->lname))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{$emp->lname}}</span>
                            @endif
                            @if(empty(\App\CityArea::find($emp->city)->name))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{\App\CityArea::find($emp->city)->name}}</span>
                            @endif

                            @if(empty(\App\area::find($emp->area)->name))
                                <span class="col-sm-12">Empty</span>
                            @else
                                <span class="col-sm-12">{{\App\area::find($emp->area)->name}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <iv class="col-sm-6 pull-right">
                    <span class="pull-right tile" >Company Logo</span>
                    @if(file_exists($emp->companylogo))
                        <img width="100" height="100" src="{{url($emp->companylogo)}}" alt="">
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
                        <span class="col-sm-12">{{$emp->ContactEmail}}</span>
                        <span class="col-sm-12">{{$emp->ContactPhone}}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection