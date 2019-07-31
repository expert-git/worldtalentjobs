@extends('dashboard.layout.admin_layout')
@section('content')
<div style="height: 1000px">
    @foreach($emp2 as $e)
        <div>{{$e->id}}</div>
    @endforeach
    {{$emp2->links()}}
</div>
@endsection