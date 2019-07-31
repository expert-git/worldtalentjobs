
{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
Verify email address
@endsection

@section('content')
 
<div style="margin-top:5%; min-height:730px;" class="container"> 

    <div class="row" style="text-align: center;margin-top: 20%;"> 
        <h1> 
            Please complete your profile
        </h1>
    </div> 	

    <div class="row" style="text-align: center;">
        <button class="ico-03 color-green1" id="signup" type="button" onclick="window.location='{{ url('/jobseeker') }}'">GO</button>
    </div>

</div>

<script>
</script>
@endsection