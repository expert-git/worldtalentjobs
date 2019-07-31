@extends('public.layout.public_layout')
@section('page_title')
    Checkout
@endsection
@section('style')

@endsection

@section('script')
@endsection

@section('content')
<div class="row" style="min-height: 1024px">
    <div class="col-md-3 successMain">
        <h3>Payment Summary</h3>
    </div>
    <div class="col-md-4 successMessage">
        <div class="divinmessage">
            <img class="successImage" src="{{url('/img/chksuccess.png')}}" width="100" height="100" alt="">
            <h4>Your Purchase is Successful</h4>
            @if(Auth::guard('jobseeker')->check())
                <a class="seccessBack" href="{{url('/jobseeker')}}">Back to Home</a>
            @elseif(Auth::guard('employer')->check())
                <a class="seccessBack" href="{{url('/employer')}}">Back to Home</a>
            @else
                <a class="seccessBack" href="{{url('/')}}">Back to Home</a>
            @endif
        </div>
    </div>
</div>

@endsection

@section('extrascript')

@endsection