{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
Register
@endsection

@section('style')
<style>
	.toggle {
	  background: none;
	  border: none;
	  color: #a6b1be;
	  /* display: none; */
	  /* font-size: .9em; */
	  font-weight: 600;
	  padding: 1.0 em;
	  position: absolute;
	  right: .75em;
	  margin-top: -9%;
	  /* top: 2.25em; */
	  z-index: 9;
	}

	.help_text {
	  color: red;
	  display: none;
	}

	.btn {
	  background: white !important;
	  background: #FFFFFF;
	  opacity: 0.8;
	  box-shadow: 0px 3px 49px rgba(0, 0, 0, 0.2);
	  border-radius: 1px;
	}

	.ico-03 {
	  float: right;
	}

	.pasuser2 {
	  float: left;
	  width: 200px;
	  padding: 12px 0;
	  color: #339966;
	}

	.bootstrap-select {
	  width: 100% !important;
	}

	.dropdown-toggle {
	  width: 100% !important;
	}

	select {
	  padding: 11px 18px;
	}

	@media (min-width: 200px) and (max-width: 480px) {
	  #btnToggle {
	    margin-top: -54px;
	  }

	  .ico-03 {
	    float: none;
	  }
	}

</style>
@endsection

@section('content')
<div style="margin-top:5%; min-height:550px;margin-bottom:50px;padding-bottom:20px;" class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h1 class="Posthed" style="padding:0 25px;">Register</h1>
    </div>
  </div>
  <form class="registerform" id="mangage_form" role="form" method="POST" action="{{ url('/employer/register') }}">
    {{ csrf_field() }}
    <div class="col-md-12">
      <div class="form-row">
        <div class="form-group">
          <div class="col-md-4 col-md-offset-1">
            <label for="companyname">Company Name<span class="mustbeoption">*</span></label>
            <input required id="companyname" type="text" name="companyname" class="ico-03" type="text" placeholder="">
            <small class="help_text">Company name required..</small>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label for="position">Position<span class="mustbeoption">*</span></label>
            <input required name="position" class="ico-03" type="text" id="position" placeholder="">
            <small class="help_text">Positions required..</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-row">
        <div class="col-md-4 col-md-offset-1">
          <label for="password">Password<span class="mustbeoption">*</span></label>
          <input required name="password" class="ico-03" type="password" id="password" placeholder="">
          <small class="help_text">Password required..</small>
        </div>
        <div class="col-md-4 col-md-offset-1">
          <label for="email">Email Address<span class="mustbeoption">*</span></label>
          <input required class="ico-03" name="email" type="text" id="email" placeholder="">
          <small class="help_text">Email Address required..</small>
        </div>
        <div class="form-group">
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-row">
        <div class="form-group">
          <div class="col-md-4 col-md-offset-1">
            <label for="password_confirmation">Confirm Password<span class="mustbeoption">*</span></label>
            <input required name="password_confirmation" class="ico-03" type="password" id="password_confirmation" placeholder="">
            <small class="help_text">Confirm Password should be same as password..</small>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label for="ContactPhone1">Contact Number<span class="mustbeoption">*</span></label>
            <input required class="ico-03" type="text" id="ContactPhone1" name="ContactPhone1" type="tel" required placeholder="">
            <input type="hidden" id="ContactPhone" name="ContactPhone">
            <small class="help_text">Contact number required..</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-row">
        <div class="form-group">
          <div class="col-md-4 col-md-offset-1">
            <label for="fname">First Name<span class="mustbeoption">*</span></label>
            <input required name="fname" class="ico-03" type="text" id="fname" placeholder="">
            <small class="help_text">First name required..</small>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label for="location">Location/City<span class="mustbeoption">*</span></label>
            <div class="form-row align-items-center">
              <div class="col-auto my-1">
                <select required name="location" id="location" style="" class="selectpicker">
                  <option value="">Choose..</option>
                  @foreach($cityareas as $city)
                  @if($city->parent_id==0)
                  <option value="{{$city->id}}">{{$city->name}}</option>
                  @endif
                  @endforeach
                </select>
                <small class="help_text">Location Required..</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-row">
        <div class="form-group">
          <div class="col-md-4 col-md-offset-1">
            <label for="lname">Last Name<span class="mustbeoption">*</span></label>
            <input required name="lname" class="ico-03" type="text" id="lname" placeholder="">
            <small class="help_text">Last name required..</small>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label for="area">Area/Zone<span class="mustbeoption">*</span></label>
            <div class="form-row align-items-center">
              <div class="col-auto my-1">
                <select required name="area" id="area" style="" class="selectpicker">
                </select>
                <small class="help_text">Area Required..</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-row">
        <div class="form-group">
          <div class="col-md-4 col-md-offset-1">
            <label for="industry">Industry<span class="mustbeoption">*</span></label>
            <select required name="industry" class="ico-03" id="industry">
              <option value="">Choose..</option>
              @foreach($industries as $ind)
              <option value="{{$ind->id}}">{{$ind->industrytypename}}</option>
              @endforeach
            </select>
            <small class="help_text">Industry required..</small>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <p style="margin-bottom:10px;">Company Logo<span class="hint" id="logofile">(200x200.png,.jpg)</span></p>
            <div class="form-group">
              <input type="hidden" id="company_logo" name="company_logo">
              <span class="btn-logoupload dotted" id="btn_logoupload">
                  UPLOAD
                  <input type="file" id="photos" name="photos[]" data-url="/jobseeker/uploaddoc">
              </span>
              <small class="help_text">Logo Required..</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-row">
        <div class="form-group">
          <div class="col-md-4 col-md-offset-1">
            <p style="color:#7889FF;">Do you have an account? <a href="/employer" style="color:#7889FF;"><b style="font-weight: bold !important;">Sign In!</b></a></p>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label for="companyname"></label>
            <div class="form-group">
              <button class="ico-03 " id="registerbtn" style="background-color:#28C294; width:35%;" type="submit">REGISTER</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <div class="col-md-12 " style="margin-top:30px;">
      @if ($errors->any())

          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
  </div>
</div>
@endsection

@section('extrascript')
<script>
  var input = document.querySelector("#ContactPhone1");
  var iti = window.intlTelInput(input, {
    separateDialCode: true,
    utilsScript: "/js/countrydiallist/js/utils.js",
  });

  $('#mangage_form').submit( function () {
    $('#ContactPhone').val(iti.getNumber());
  });

  $('#photos').fileupload({
    dataType: 'json',
    add: function (e, data) {
      data.submit();
    },
    done: function (e, data) {
      $.each(data.result.files, function (index, file) {           
        $('#company_logo').val(file.path);
        // $('#logofile').html(file.path);
      });
    }
  });

  $("#location").on("change",function(){
    var locs = {!! json_encode($cityareas) !!};
    $('#area').empty();
    $('#area').append('<option value="">Choose..</option>');
    for(var i=0;i<locs.length;i++){
        if(locs[i].parent_id==$("#location").val()){
           $('#area').append('<option value='+locs[i]["id"]+'>'+locs[i]["name"]+'</option>');
        }
    }
})
</script>
@endsection

