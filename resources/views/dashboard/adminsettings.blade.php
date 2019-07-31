@extends('dashboard.layout.admin_layout')

@section('content')
    <div class="container settings row">
        <div class="col-sm-11 ">
            <div class="row settingsnav">
                <h5 class="col-sm-2">SETTINGS</h5>
                <a href="{{url('/inspector/addadmin')}}"><span class="col-sm-2 pull-right addadmin">+ Add new User</span></a>
            </div>
            <div class="row settingsmain">
                <div class="col-sm-3 adminroles">
                    <h4>User Roles</h4>
                    <p style="font-size: 10px">ADD,Remove,Update, Inspectors</p>
                </div>
                <div class="col-sm-8 allsettings">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($inspectors as $ins)
                        <tr class="inadmin">

                            <th scope="row"><a href="{{url('/inspector/editadmin/'.$ins->id)}}">{{$ins->name}}</a></th>
                            <td> <a href="{{url('/inspector/editadmin/'.$ins->id)}}">{{$ins->email}}</a></td>
                            <td>{{$ins->user_role}}</td>
                            <td><a href="{{url('/inspector/deleteadmins/'.$ins->id)}}"><img width="10" height="15" src="{{url('/img/delete.png')}}" alt=""></a></td>
                        </tr>
                         @empty
                            Nothing found
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

@endsection