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
            <form method="post" action="{{url('/inspector/addadmin')}}">
                {{csrf_field()}}
                <div class="addcontent row addusercontent">
                    <div class="addallcontent">
                        <div class="addrolename">
                            <span>User Role Name</span>
                            <input name="userrole" style="display:block" class="addabsoulute"></input>
                        </div>
                    </div>
                <div class="addinputs col-sm-5 col-sm-offset-1">
                    <div class="row">
                        <span>Full Name</span>
                        <input placeholder="Full Name" class="col-sm-12" type="text" name="name">
                    </div>
                    <div class="row">
                        <span>Email</span>
                        <input placeholder="email@mail.com" class="col-sm-12" type="email" name="email">
                    </div>
                    <div class="row">
                        <span>Password</span>
                        <input placeholder="*******" class="col-sm-12" type="text" name="password">
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
                                <input type="checkbox" name="approve">
                                <span class="checkmark"></span>
                            </label>
                            <label class="row inputeach">
                                <span class="col-sm-10">Contact Form Acces</span>
                                <input type="checkbox" name="contactform">
                                <span class="checkmark"></span>
                            </label>
                            <label class="row inputeach">
                                <span class="col-sm-10">Billing</span>
                                <input type="checkbox" name="billing">
                                <span class="checkmark"></span>
                            </label>
                            <label class="row inputeach">
                                <span class="col-sm-10">Read Only</span>
                                <input type="checkbox" name="readonly">
                                <span class="checkmark"></span>
                            </label>
                            <label class="row inputeach">
                                <span class="col-sm-10">All</span>
                                <input type="checkbox" name="all">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <button class="btnadminadd pull-right">CREATE</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection