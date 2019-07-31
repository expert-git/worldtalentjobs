@extends('dashboard.layout.admin_layout')

@section('content')

    <div class="container">
        <div class="empty">

        </div>
        <div class="contactmain">
            <div class="col-sm-1"></div>
            <div class="col-sm-8">
                <h3>Contact Form Messages</h3>
                <div class="contactcon ">
                    @forelse($contacts as $c)
                        <div class="contacteach col-sm-12" >
                            <div class="row">
                                <div class="col-sm-8 conmessage" onclick="openForm({{$c->id}})">
                                    <h5>{{$c->name}}</h5>
                                    <div><p>{{$c->message}}</p></div>
                                </div>
                                <div class="col-sm-2">
                                    <span class="contype">{{$c->type}}</span>
                                </div>
                                <div class="col-sm-2 condatedel">
                                    <div class="diffforhome">{{\Carbon\Carbon::parse($c->created_at)->diffForHumans()}}</div>
                                </div>
                            </div>
                            <div class="row"><a class="condelete" href="{{url('/inspector/deletecontactform/'.$c->id)}}">Delete</a></div>
                        </div>
                        <div class="popupmessage" id="show{{$c->id}}">
                            <div class="container">
                                <div><h3>{{$c->name}}</h3></div>
                                <div>Email:{{$c->email}}</div>
                                <div>Phone:{{$c->phone}}</div>
                                <div>type:{{$c->type}}</div>
                                <div><p>Message <br>{{$c->message}}</p></div>
                               @if(file_exists($c->file))
                                <div><a download href="/{{$c->file}}"> Download Attachment</a></div>
                                @endif
                            </div>
                            <button class="conclose" style="margin: auto;" onclick="closeForm({{$c->id}})">close</button>
                        </div>

                    @empty
                        <p>Contact form is empty</p>
                    @endforelse
                    {{$contacts->links()}}
                </div>
            </div>
            <div class="col-sm-3">te</div>
        </div>
    </div>


    <script>
        function openForm(id) {
            var mainid = "show";
            mainid =mainid.concat(id);
            document.getElementById(mainid).style.display = "block";
        }

        function closeForm(id) {
            var mainid = "show";
            mainid =mainid.concat(id);
            document.getElementById(mainid).style.display = "none";
        }
    </script>

@endsection