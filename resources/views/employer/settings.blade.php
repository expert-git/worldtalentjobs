@extends('public.layout.public_layout')
@section('page_title')
Settings
@endsection
@section('style')
{!!Html::style('css/singleJob.css')!!}
<style>
    .postjoin {
        margin-top: 0% !important;
    }

    .remove {
        border: 1px solid #7889ff;
        color: #7889ff;

    }

    .btn-profile {
        width: auto;
        font-size: 10px !important;
    }

    .btn {
        font-size: 12px !important;
    }


    @media (min-width: 768px) {
        .aconntmenu {
            margin-left: -7%;
        }

        .container {
            /* width: 1600px !important;*/
        }

        .accondlondon {
            margin: -5% 0 15px 0;
            color: gray;
        }

        .leftcont {
            color: gray;
        }

        .current {
            color: #7889ff;

        }

        .current .col-md-10 {
            font-weight: bold;
            color: black;
        }

        .content {
            margin-left: -7%;
            border-right: thin solid lightgray;
        }

    }
</style>
@endsection
@section('script')
{{--asset('js/managejob.js')--}}
{!!Html::script('js/managejob.js')!!}
@endsection
@section('content')
<section>
  <div style="margin-top:2%;width:90%" class="container">
    @include('employer.partial._sidebar')
    <div style="column-gap: 20px;" class="col-md-8">
      <h4 class="Posthed " style="font-size:18px"> Company Details</h4>
      <form action="/employer/savesettings" method="POST" id="profileform">
        {{csrf_field()}}
        <div class="row">
          <input type="hidden" id="id" name="id" value="{{$emp->id}}">
          <div class="col-md-6">
            <label>Company name<span class="mustbeoption">*</span></label>
            <input name="companyname" value="{{$emp->companyname}}" type="text" class="ico-03" value="" />
          </div>
          <div class="col-md-6">
            <label>Website(optional)</label>
            <div class="websiteurl">
              <select value="{{$emp->proto}}" name="proto" id="proto">
                  <option value="http:" @if($emp->proto=="http:") selected @endif>http://</option>
                  <option value="https:" @if($emp->proto=="https:") selected @endif>https://</option>
              </select>
              <input name="websiteaddress" value="{{$emp->websiteaddress}}" type="text" class="ico-03"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label>City<span class="mustbeoption">*</span></label>
            <select id="location" name="location" class="natidropdo custom-select mr-sm-2" required>
              <option value="">Choose...</option>
              @foreach($cityareas as $city)
              @if($city->parent_id==0)
              <option value="{{$city->id}}" @if($city->id==$emp->city) selected @endif>{{$city->name}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>Area / Location<span class="mustbeoption">*</span></label>
            <select value="{{$emp->area}}" name="area" id="area" class="natidropdo custom-select mr-sm-2" required>
              <option value="">Choose...</option>
              @foreach($cityareas as $area)
              @if($area->parent_id==$emp->city)
              <option @if($area->id==$emp->area) selected @endif value="{{$area->id}}">
                {{$area->name}}</option>
              @endif
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label>Email Address<span class="mustbeoption">*</span></label>
            <input name="ContactEmail" disabled value="{{$emp->ContactEmail}}" type="text" class="ico-03" name="ContactEmail" />
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="companyname">Industry<span class="mustbeoption">*</span></label>
            <select required name="industry" class="ico-03" id="industry" value="{{$emp->industrytype}}">
              <option value="">Choose..</option>
              @foreach($industries as $ind)
              <option value="{{$ind->id}}" @if($emp->industrytype==$ind->id) selected @endif>{{$ind->industrytypename}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="companyname">Employer Type<span class="mustbeoption">*</span></label>
            <select required name="employertype" class="ico-03" id="employertype" value="{{$emp->employertype}}">
              <option value="" hidden>Choose..</option>
              <option value="Private" @if($emp->employertype=='Private') selected @endif>Private</option>
              <option value="Government" @if($emp->employertype=='Government') selected @endif>Government</option>
              <option value="Semi-Government" @if($emp->employertype=='Semi-Government') selected @endif>Semi-Government</option>
              <option value="Non-profit" @if($emp->employertype=='Non-profit') selected @endif>Non-profit</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="fname">First Name<span class="mustbeoption">*</span></label>
            <input required name="fname" class="ico-03" type="text" id="fname" placeholder="" value="{{$emp->fname}}">
          </div>
          <div class="col-md-6">
            <label for="lname">Last Name<span class="mustbeoption">*</span></label>
            <input required name="lname" class="ico-03" type="text" id="lname" placeholder="" value="{{$emp->lname}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="position">Position<span class="mustbeoption">*</span></label>
            <input required name="position" class="ico-03" type="text" id="position" placeholder="" value="{{$emp->position}}">
          </div>
          <div class="col-md-6">
            <label for="ContactPhone1">Contact Number<span class="mustbeoption">*</span></label>
            <input required class="ico-03" type="text" id="ContactPhone1" name="ContactPhone1" type="tel" required placeholder="" value="{{$emp->ContactPhone}}">
            <input type="hidden" id="ContactPhone" name="ContactPhone">
          </div>
        </div>

        <h4 class="Posthed " style="font-size:18px"> Social Media Links</h4>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Facebook</label>
              <div class="websiteurl">
                <select value="{{$emp->protofb}}" name="protofb" id="protofb">
                    <option value="http:" @if($emp->protofb=="http:") selected @endif>http://</option>
                    <option value="https:" @if($emp->protofb=="https:") selected @endif>https://</option>
                </select>
                <input name="fb" value="{{$emp->fb}}" type="text" class="ico-03"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Twitter</label>
              <div class="websiteurl">
                <select value="{{$emp->prototwitter}}" name="prototwitter" id="prototwitter">
                    <option value="http:" @if($emp->prototwitter=="http:") selected @endif>http://</option>
                    <option value="https:" @if($emp->prototwitter=="https:") selected @endif>https://</option>
                </select>
                <input name="twitter" value="{{$emp->twitter}}" type="text" class="ico-03"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Linkedin</label>
              <div class="websiteurl">
                <select value="{{$emp->protolinkedin}}" name="protolinkedin" id="protolinkedin">
                    <option value="http:" @if($emp->protolinkedin=="http:") selected @endif>http://</option>
                    <option value="https:" @if($emp->protolinkedin=="https:") selected @endif>https://</option>
                </select>
                <input name="linkedin" value="{{$emp->linkedin}}" type="text" class="ico-03"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
              
          </div>
        </div>
        <button class="loginbtn" style="background-color:#28c294;">UPDATE PROFILE</button>
      </form>

      <form action="/employer/email/resetmanually" method="POST">
        {{ csrf_field() }}
        <hr>
        <h4 class="Posthed " style="font-size:18px">Change Email</h4>
        <input type="hidden" name="id" value="{{$emp->id}}"/>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>New Email</label>
              <input name="email" value="{{Auth::guard('employer')->user()->email}}" type="text" class="ico-03"/>
            </div>
          </div>
          <div class="col-md-8">

          </div>
        </div>
          @if ($errors->hasBag('email'))
              <div class="row" id="emailerrorbag">
                  <div class="col-md-12 ">
                      <div class="alert alert-danger" style="text-align:center;">
                          <ul>
                              @foreach ($errors->email->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
          @endif
        <button class="loginbtn">CHANGE EMAIL</button>
      </form>
      <form action="/employer/password/resetmanually" method="POST">
        {{ csrf_field() }}
        <hr>

        <h4 class="Posthed " style="font-size:18px">Change Password</h4>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Current Password</label>
              <input name="old" id="old" type="password" class="ico-03" value="" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>New Password</label>
              <input name="password" id="password" type="password" class="ico-03" value="" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Retype New Password</label>
              <input name="password_confirmation" id="password_confirmation" type="password" class="ico-03" value="" />
            </div>
          </div>
        </div>
        @if ($errors->hasBag('password'))
        <div class="row" id="passworderrorbag">
          <div class="col-md-12 ">
            <div class="alert alert-danger" style="text-align:center;">
              <ul>
                @foreach ($errors->password->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        @endif
        <button class="loginbtn">CHANGE PASSWORD</button>
      </form>
      <hr>
      <div class="row">
        <div class="col-md-12" style="color: #E86850;">
          <a href="/employer/changeAccountStatus">
            <h4 class="Posthed " style="font-size:18px">Delete Account</h4>
          </a>
        </div>
        <div class="col-md-12" style="color: #E86850;">
          <small style="font-weight:bold;">Warning! <span class="hint" style="color:black;">You will not be able to reactivate your account or retrieve any of the
            content or information you have added.</span></small>
        </div>
      </div>
    </div>

    <div class="col-md-2" style="padding-left:3%;">      
      <form method="GET" enctype="multipart/form-data" action="/employer/updateimage">
        {{ csrf_field() }}
        <div class="row" style="margin-top:30%;">
          <div class="applyjob1img">
            <h4 class="Posthed " style="font-size:18px">Logo</h4>
            @if(file_exists($emp->companylogo))
            <img style="width:200px;height:200px;" src="/{{$emp->companylogo}}" id="companylogo" data-chk="1">
            @else
            <img style="width:200px;height:200px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png" id="companylogo" data-chk="0">
            @endif
          </div>
        </div>
        <br>
        <div class="row" style="margin-top:2%;">
          <div style=" margin-left: 3px; margin-right: 3px; width:196px;">
            <span class="btn-profileimage" style="position: relative;">
              Change
              <input required type="file" id="avatar" accept="image/png,image/jpeg" name="avatar" style="width:100%;height:100%;"/>
            </span>
            <a id="removeAvatar" style="margin-left: 10px;">
              <span class="btn-profileimage" style="position: relative;">
                Remove
              </span>
            </a>
          </div>
        </div>
      </form>
    </div>
</section>
@endsection
@section('extrascript')
<script>
var input = document.querySelector("#ContactPhone1");
var iti = window.intlTelInput(input, {
  separateDialCode: true,
  utilsScript: "/js/countrydiallist/js/utils.js",
});

// logo image upload start

$('#avatar').fileupload({
  dataType: 'json',
  add: function(e, data) {
      if(data.files[0].size > 4*1000*1000) {
          // e.preventDefault();
      }
      else{
          data.submit();
      }
  },
  done: function (e, data) {
      if(data.result.path) {
          $('#companylogo').prop('src', "/"+data.result.path);
          $('#companylogo').data("chk",1);
          $('.accounimgpro img').prop('src', "/"+data.result.path);
      }            
      else {
          $('#companylogo').prop('src', "https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png");
          $('#companylogo').data("chk",0);
          $('.accounimgpro img').prop('src', "https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png");
      }
  },
  progressall: function (e, data) {
      
  }
});
// logo image upload end

$('#removeAvatar').on("click", function () {
    console.log('2323');
    $.ajax({
        url: '/employer/removeimage',
        type: 'GET',
        data: {
            ajax: 'AJAX',
            action: 'employer'
        },
        success: function (data) {
            console.log(data);
            $('#companylogo').prop('src', "https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png");
            $('#companylogo').data("chk",0);
            $('.accounimgpro img').prop('src', "https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png");
        }
    });
});

$("#location").on("change", function () {
  //alert("a");
  var locs = {!!json_encode($cityareas)!!};
  $('#area').empty();
  $('#area').append('<option value="">Choose..</option>');
  for (var i = 0; i < locs.length; i++) {
    if (locs[i].parent_id == $("#location").val()) {
      $('#area').append('<option value=' + locs[i]["id"] + '>' + locs[i]["name"] + '</option>');
    }
  }
});

$('#profileform').submit( function () {
  $('#ContactPhone').val(iti.getNumber());
});

function success() {
  swal({
    title: "Profile Updated Successfully",
    text: "Profile updated successfully",
    icon: "success",
    button: "Go Back",
  });
}

function error(e) {
  swal({
    title: "Passwords do not match",
    text: "Password is different" + JSON.stringify(e),
    icon: "error",
    button: "Go Back",
  });
}
</script>
@endsection