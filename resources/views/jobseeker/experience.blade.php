<div id="expdiv{{$exp->id}}" @if($exp->id==0) class="collapse" @endif>
<form action="/jobseeker/updateExperience" method="POST" id="experience_form_{{$exp->id}}" data-id="{{$exp->id}}">
    {{ csrf_field() }}
    
    <input type="hidden" id="{{$exp->id}}exp_id" name="exp_id" value="{{$exp->id}}"/>
    
        <div class="row">
            <div class="col-md-12" style="float:right;">
            @if( $exp->id != 0)
                <button class="removepanelbtn" type="button" onclick="removeexppanel({{$exp->id}})">Remove</button>
                <button class="editpanelbtn" type="button" onclick="editexppanel({{$exp->id}})">Edit</button>
            @endif        
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="{{$exp->id}}companyname">Company Name<span class="mustbeoption">*</span></label>
                    <input required type="text" name="companyname" value="{{$exp->company_name}}"
                            id="{{$exp->id}}companyname" placeholder="Example Company"/>
                    <small class="help_text">Company required..</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="{{$exp->id}}website_protocal">Website (optional)
                    </label>
                    <div class="websiteurl">
                        <select value="{{$exp->website_protocal}}" name="website_protocal" id="{{$exp->id}}website_protocal">
                            <option value="http://" @if($exp->website_protocal=="http://") selected @endif>http://</option>
                            <option value="https://" @if($exp->website_protocal=="https://") selected @endif>https://</option>
                        </select>
                        <input type='text' value="{{$exp->website}}" name="website" id="{{$exp->id}}website"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 0px;">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="{{$exp->id}}exp_country">Country<span class="mustbeoption">*</span></label>
                    <select required value="{{$exp->country}}" name="exp_country" class="ico-03" id="{{$exp->id}}exp_country">
                        <option value="" hidden>Choose...</option>
                        @foreach($country as $cnt )
                            <option @if($cnt->code==$exp->country) selected @endif value="{{$cnt->code}}"> {{$cnt->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="{{$exp->id}}location">City<span class="mustbeoption">*</span></label>
                    <input required type="text" name="location" value="{{$exp->location}}" class="ico-03"
                            id="{{$exp->id}}location" placeholder="Example City">
                    <small class="help_text">Location required..</small>
                </div>
            </div>
            

            <div class="col-md-3">
                <div class="form-group">
                    <label>Start Date<span class="mustbeoption">*</span></label>
                    <div class='input-group date' id='{{$exp->id}}exp_start_date_picker'>
                        <input required type='text' id="{{$exp->id}}exp_start_date" name="exp_start_date" value="{{$exp->start_date}}"
                            style="height:40px; border-right:none;" placeholder="dd/mm/yyyy"/>
                        <small class="help_text">Start Date required..</small>
                        <span class="input-group-addon">
                            <img src="/icon-img/calendar.svg"  style="width:30px;height:30px;">
                        </span>
                        <br>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>End Date<span class="mustbeoption">*</span></label>
                    <div class='input-group date' id='{{$exp->id}}exp_end_date_picker'>
                        <input required type='text' id="{{$exp->id}}exp_end_date" name="exp_end_date" value="{{$exp->end_date}}"
                            style="height:40px; border-right:none;" placeholder="dd/mm/yyyy"/>
                        <small class="help_text">End Date required..</small>
                        <span class="input-group-addon">
                            <img src="/icon-img/calendar.svg"  style="width:30px;height:30px;">                        
                        </span>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="float:right; padding-right: 15px;">
                <div class="checkbox checkbox-success" style="float:right; margin:0px">
                    <input type="checkbox" name="current" id="x{{$exp->id}}current" @if($exp->current_work) checked @endif/>
                    <label for="x{{$exp->id}}current">
                        I currently Work Here
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="{{$exp->id}}job_title">Job Title<span class="mustbeoption">*</span></label>
                    <input required type='text' value="{{$exp->job_title}}" name="job_title" id="{{$exp->id}}job_title" placeholder="Example Title"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="{{$exp->id}}job_description">Job Description<span class="mustbeoption">*</span></label>
                <textarea required id="{{$exp->id}}job_description" name="job_description">{{$exp->job_description}}</textarea>
            </div>
        </div>
        @if ($errors->hasBag('experience'))
            
            <div class="row">
                <div class="col-md-12 ">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->experience->all() as $error)
                                @if ($error != $exp->id)
                                <li>{{ $error }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
        @endif
        <div class="row">
            <div class="col-md-12 ">
                <div class="alert alert-danger" id="experrbag{{$exp->id}}" style="text-align:center;display:none;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="float:right; margin-top:20px; margin-bottom:100px;">
                <button class="ico-03 profile-btn" style="float:right" type="submit">
                        @if( $exp->id == 0)
                            ADD
                        @else
                            UPDATE
                        @endif
                </button>
            </div>
        </div>
</form>
</div>


@push('scripts')
<script>

    $('#{{$exp->id}}job_description').richText();

    $('#{{$exp->id}}exp_start_date_picker').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#{{$exp->id}}exp_end_date_picker').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#experience_form_{{$exp->id}}').submit(function(e){

        var destxt = $("<div>").html($('#{{$exp->id}}job_description').val()).text();

        var errdiv = $('#experrbag{{$exp->id}}');
        if(destxt==""){
            errdiv.css("display", "block");
            errdiv.html("Job Description is required!");
            e.preventDefault();
        }

        if($('#{{$exp->id}}exp_end_date').val() < $('#{{$exp->id}}exp_start_date').val()){
            errdiv.css("display", "block");
            errdiv.html("Start date is before than End date!");
            e.preventDefault();
        }
    });
</script>
@endpush