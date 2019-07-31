@extends('public.layout.public_layout')
@section('page_title')
Search
@endsection
@section('style')
{!!Html::style('css/singleJob.css')!!}
@endsection
@section('script')
{{--asset('js/managejob.js')--}}
{!!Html::script('js/managejob.js')!!}
@endsection
@section('style')
<style>
   .select2 {
      margin-top: 0px !important;
   }

   .select2-container--classic .select2-selection--single .select2-selection__arrow {
      height: 40px;
   }

   .select2-selection {
      height: 40px !important;
   }

   .select2-selection__rendered {
      padding-top: 8px;
   }

   .select2 .select2-container .select2-container--classic {
      margin-top: 0% !important
   }

   .loginbtn {
      background: #28C294;
   }

   .select2-container--default .select2-selection--single {
      border: 1px solid #e0e0e0 !important;
   }
</style>
@section('content')
<div style="min-height:100%" class="container">

   <div style="margin-top:10%;" class="contactpage row">
      <div class="conhead">
         <h1 class="Posthed" style="font-size:36px;margin-bottom:10%">Applying for {{$jobs->jobtitle}} Vacancy in Qatar
         </h1>
      </div>
      <form method="POST" role="form" action="{{url('jobseeker/apply')}}" id="contact-form" class="contact-form" >
         {{ csrf_field() }}
         <div class="row">
            <div class="col-md-6">


               <label>Are currently based on Qatar ?</label>


               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox1" name="location" checked
                     value="1">Yes
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox2" name="location" value="0">No
               </div>



            </div>
            <div class="col-md-6">


               <label>Do you have Driving Lisence ?</label>


               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="license" id="inlineCheckbox1" value="1">Yes
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="license" id="inlineCheckbox2" checked value="0">No
               </div>



            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
               <div class="form-group" style="overflow:hidden">
                  <label>How Many Years Experience Do You Have in Relevant Criteria? *</label>
                  <select
                     style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
                     placeholder="Place" class="ico-02 js-example-basic-single" name="experience">
                     <option value="1" selected> 0-1 Years</option>
                     <option value="2">1-2 years</option>
                     <option value="3">2-3 years</option>
                     <option value="4">4-5 years</option>
                     <option value="5">5+ years</option>


                  </select>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group" style="overflow:hidden">
                  <label>What is Your Minimum Expected Salary *</label>
                  <select name="salary"
                     style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
                     placeholder="Place" class="ico-02 js-example-basic-single" name="expected_sallary">
                     <option value="1" selected> 5000-7000 QAR</option>
                     <option value="2">7000-12000 QAR</option>
                     <option value="3">12000-15000 QAR</option>
                     <option value="4">15000-20000 QAR</option>
                     <option value="5">20000-30000 QAR</option>


                  </select>
               </div>
            </div>

         </div>

         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label>What Language Do You Speak ? *</label>
                  <input name="language" type="text" class="ico-03" value="" />
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group" style="overflow:hidden">
                  <label>What is your Education Level ? *</label>
                  <select
                     style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
                     placeholder="Place" class="ico-02 js-example-basic-single" name="education">
                     <option value="1" selected> Primary</option>
                     <option value="2">Secondary</option>
                     <option value="3">Graduate</option>
                     <option value="4">Diploma</option>
                     <option value="5">Master</option>
                     <option value="6">Doctorate</option>


                  </select>
               </div>
            </div>

         </div>

         @if ($errors->any())
            <div class="alert alert-danger">
               <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
         @endif

         <div class="row">
            <div class="col-sm-12 col-md-6">

            </div>
            <div class="col-sm-12 col-md-6">
               <label>*</label>
               <input type="hidden" value="{{$jobs->id}}" name="jobid">


               <button id="apply" type="submit" style="    float: right !important;" class="loginbtn">Apply </button>
            </div>
         </div>
      </form>

      <p style="color: #E86850;">
         Important Fraud Warning
         Never send checks, payments, or money transfers to employers for visas or other purposes to secure a job posted
         online. Please report suspected fraud and learn how to apply for jobs safely online.
      </p>
   </div>
</div>
@endsection
@section('extrascript')
<script>
$(document).ready(function(){
	checkUserError();
	function checkUserError(){
		var user_p_e = $('#user_profile_error').val();
		if(user_p_e == 1){
			swal("Please! Update your profile before appying for this job!", {
			  icon: "warning",
			});
			return false;
		}else{
			return true;
		}
	}
	$("#apply").on("click",function(e){
		e.preventDefault();
		if(checkUserError()){
            $("#contact-form").submit();
		}
	})
})


</script>

@endsection