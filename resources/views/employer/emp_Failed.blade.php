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
                <img class="successImage" src="{{url('img/chkfailed.png')}}" width="100" height="100" alt="">
                <h4>Your Purchase is Failed</h4>
                <div class=divBtnMessage>
                    @if(Auth::guard('jobseeker')->check())
                        <a class="btnBackPayment" href="{{url('/jobseeker')}}">Back to Home</a>
                    @elseif(Auth::guard('employer')->check())
                        <a class="btnBackPayment" href="{{url('/employer')}}">Back to Home</a>
                    @else
                        <a class="btnBackPayment" href="{{url('/')}}">Back to Home</a>
                    @endif
                    @if(Auth::guard('jobseeker')->check())
                        <a class="btnTryPayment" href="{{url('/checkout/')}}">TRY AGAIN</a>
                    @elseif(Auth::guard('employer')->check())
                        <a class="btnTryPayment" href="{{url('/checkout/'.$id)}}">TRY AGAIN</a>
                    @else
                        <a class="btnTryPayment" href="{{url('/')}}">TRY AGAIN</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extrascript')

@endsection