@extends('dashboard.layout.admin_layout')

@section('content')
    <div class="container">
        <div class="settingins"><p>Settings</p></div>
        <div class="row">
            <div class="col-sm-2 adminroles addroletop">
                <h5>User Roles</h5>
                <p>Add new admin</p>
            </div>
            <div class="col-sm-9 addroletop">
                <div class="define">
                    <h4>Define User Role</h4>

                </div>
                <form method="post" action="{{url('/inspector/editadmin')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$ins->id}}">
                    <div class="addcontent row addusercontent">
                        <div class="addallcontent">
                            <div class="addrolename">
                                <span>User Role Name</span>
                                <input style="display: block" value="{{$ins->user_role}}" name="rolename" class="addabsoulute"></input>
                            </div>
                        </div>
                        <div class="addinputs col-sm-5 col-sm-offset-1">
                            <div class="row">
                                <span>Full Name</span>
                                <input placeholder="Full Name" class="col-sm-12" type="text" name="name" value="{{$ins->name}}">
                            </div>
                            <div class="row">
                                <span>Email</span>
                                <input placeholder="email@mail.com" class="col-sm-12" type="email" name="email" value="{{$ins->email}}">
                            </div>
                            <div class="row">
                                <span>Password</span>
                                <input placeholder="*******" class="col-sm-12" type="text" name="password" value="">
                            </div>
                            <div>
                                @if ($errors->getBag('pass')->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->getBag('pass')->first('password') }}</strong>
                            </span>
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-sm-12 addprm">
                                    <h5>Permission Levels</h5>
                                    <label class="row inputeach">
                                        <span class="col-sm-10">Approve Employer Registration</span>
                                        <input type="checkbox" name="approve" @if(is_null($ins->Privilege()->get()->find(1)))@else checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="row inputeach">
                                        <span class="col-sm-10">Contact Form Access</span>
                                        <input type="checkbox" name="contactform" @if(is_null($ins->Privilege()->get()->find(2)))@else checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="row inputeach">
                                        <span class="col-sm-10">Billing</span>
                                        <input type="checkbox" name="billing" @if(is_null($ins->Privilege()->get()->find(3)))@else checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="row inputeach">
                                        <span class="col-sm-10">Read Only</span>
                                        <input type="checkbox" name="readonly" @if(is_null($ins->Privilege()->get()->find(4)))@else checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="row inputeach">
                                        <span class="col-sm-10">All</span>
                                        <input type="checkbox" name="all" @if(is_null($ins->Privilege()->get()->find(5)))@else checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <button class="btnadminadd pull-right">UPDATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection