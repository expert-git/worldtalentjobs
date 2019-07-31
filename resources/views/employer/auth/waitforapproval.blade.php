
{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
Verify email address
@endsection

@section('content')
<section class="minheight">

<div style="margin-top:5%;" class="container"> 

    <div class="row" style="text-align: center;margin-top: 20%;"> 
        <h1> 
            Your registration has been successful. You will receive a notification once your profile is approved by our administrator.
        </h1>
    </div> 	

    <div class="row" style="text-align: center;">
        <button class="ico-03 color-green1" id="signup" type="button" onclick="window.location='{{ url('/employer/register') }}'">GO BACK</button>
    </div>

</div>
</section>
<script>
</script>
@endsection

