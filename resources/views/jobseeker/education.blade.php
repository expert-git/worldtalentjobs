<div id="edudiv{{$edu->id}}" @if($edu->id==0) class="collapse" @endif>
<form method="POST" id="education_form_{{$edu->id}}" action="/jobseeker/updateEducation" data-id="{{$edu->id}}">
    {{ csrf_field() }}

    <input type="hidden" id="{{$edu->id}}edu_id" name="edu_id" value="{{$edu->id}}"/>
    <input type="hidden" id="{{$edu->id}}cert_ids" name="cert_ids"/>
    <input type="hidden" id="{{$edu->id}}cert_id" name="cert_id"/>


    <!-- degree start -->
    <div class="row">
        <div class="col-md-8">
            <p>Degree<span class="mustbeoption">*</span></p>
        </div>
        <div class="col-md-4" style="float:right;">
        @if( $edu->id != 0)
            <button class="removepanelbtn" type="button" onclick="removeedupanel({{$edu->id}})">Remove</button>
            <button class="editpanelbtn" type="button" onclick="editedupanel({{$edu->id}})">Edit</button>
        @endif        
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="row" id="education_detail_{{$edu->id}}">
                <div class="col-md-4">
                    <div class="checkbox checkbox-primary">
                        <input id="{{$edu->id}}edu_degree_high" name="edu_degree_high" type="checkbox"  data-degree="high" @if($edu->degree=="high") checked @endif/>
                        <label for="{{$edu->id}}edu_degree_high">
                            High school or equivalent
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary">
                        <input id="{{$edu->id}}edu_degree_diploma" name="edu_degree_diploma" type="checkbox"  data-degree="diploma" @if($edu->degree=="diploma") checked @endif/>
                        <label for="{{$edu->id}}edu_degree_diploma">
                            Diploma
                        </label>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="checkbox checkbox-primary">
                        <input id="{{$edu->id}}edu_degree_bachelor" name="edu_degree_bachelor" type="checkbox" data-degree="bachelor" @if($edu->degree=="bachelor") checked @endif/>
                        <label for="{{$edu->id}}edu_degree_bachelor">
                            Bachelor's degree
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary">
                        <input id="{{$edu->id}}edu_degree_higherdiploma" name="edu_degree_higherdiploma" type="checkbox" data-degree="higherdiploma" @if($edu->degree=="higherdiploma") checked @endif/>
                        <label for="{{$edu->id}}edu_degree_higherdiploma">
                            Higher diploma
                        </label>
                    </div>
                    <input required type="hidden" id="edu_degree{{$edu->id}}" name="edu_degree">
                </div>

                <div class="col-md-4">
                    <div class="checkbox checkbox-primary">
                        <input id="{{$edu->id}}edu_degree_master" name="edu_degree_master" type="checkbox" data-degree="master" @if($edu->degree=="master") checked @endif/>
                        <label for="{{$edu->id}}edu_degree_master">
                            Master's degree
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary">
                        <input id="{{$edu->id}}edu_degree_doctorate" name="edu_degree_doctorate" type="checkbox" data-degree="doctorate" @if($edu->degree=="doctorate") checked @endif/>
                        <label for="{{$edu->id}}edu_degree_doctorate">
                            Doctorate
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- degree end -->

    <!-- certificates start -->
    <div class="row">
        <div class="col-md-12">
            <p>Ceritificates</p>
            <div class="form-group">
                @foreach($edu->certificates as $cert)
                    <div class="certfileinfo" id="cert_{{$cert->id}}">
                        @include('jobseeker.certificate', ['cert' => $cert])
                    </div>
                @endforeach
                <span class="btn-certfileupload dotted" id="btn_certupload_{{$edu->id}}">
                    UPLOAD FILE
                    <input type="file" id="certfileupload_{{$edu->id}}" name="certfile">
                </span>
            </div>
        </div>
    </div>
    <!-- certificates end -->

    <div class="row" style="margin-bottom: 0px;">
        <div class="col-md-6">
            <div class="form-group">
                <label for="{{$edu->id}}major_stream">Major / Stream<span class="mustbeoption">*</span></label>
                <input required type="text" name="major_stream" value="{{$edu->major_stream}}" class="ico-03"
                        id="{{$edu->id}}major_stream" placeholder="Example Stream">

                <small class="help_text">Major/ Stream required..</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Start Date<span class="mustbeoption">*</span></label>
                <div class='input-group date' id='{{$edu->id}}edu_start_date_picker'>
                    <input required type='text' id="{{$edu->id}}edu_start_date" name="edu_start_date" value="{{$edu->start_date}}"
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
                <div class='input-group date' id='{{$edu->id}}edu_end_date_picker'>
                    <input required type='text' id="{{$edu->id}}edu_end_date" name="edu_end_date" value="{{$edu->end_date}}"
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
                <input type="checkbox" name="current" id="{{$edu->id}}current" @if($edu->current_study) checked @endif/>
                <label for="{{$edu->id}}current">
                    I currently Study Here
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="{{$edu->id}}edu_country">Country<span class="mustbeoption">*</span></label>
                <select required value="{{$edu->country}}" name="edu_country" class="ico-03" id="{{$edu->id}}edu_country">
                    <option value="" hidden>Choose...</option>
                    @foreach($country as $cnt )
                        <option @if($cnt->code==$edu->country) selected @endif value="{{$cnt->code}}"> {{$cnt->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="{{$edu->id}}edu_city">City<span class="mustbeoption">*</span></label>
                <input required type="text" class="ico-03" value="{{$edu->city}}" name="edu_city" id="{{$edu->id}}edu_city" placeholder="Example City">
                <small class="help_text">City required..</small>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="{{$edu->id}}edu_university">University/College<span class="mustbeoption">*</span></label>
                <input required type="text" class="ico-03" value="{{$edu->university}}" name="edu_university" id="{{$edu->id}}edu_university" placeholder="Example University">
                <small class="help_text">University/College required..</small>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <label for="{{$edu->id}}grading_system">Select Grading System<span class="mustbeoption">*</span> </label>
                <select required class="ico-03" value="{{$edu->grading_system}}" name="grading_system"
                        id="{{$edu->id}}grading_system">
                    <option value="" hidden>Choose...</option>
                    <option value="1" @if($edu->grading_system == 1) selected
                                @endif>4-Point GPA</option>
                    <option value="2" @if($edu->grading_system == 2) selected
                                @endif>5-Point GPA</option>
                    <option value="3" @if($edu->grading_system == 3) selected
                                @endif>20-Point GPA</option>
                    <option value="4" @if($edu->grading_system == 4) selected
                                @endif>Percentage (out of 100)</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="{{$edu->id}}grade">Grade<span class="mustbeoption">*</span></label>
                <input required type="text" class="ico-03" value="{{$edu->grade}}" name="grade"
                        id="{{$edu->id}}grade" placeholder="Example Grade">
                <small class="help_text">Grade required..</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="{{$edu->id}}description">Description<span class="mustbeoption">*</span></label>
                <textarea required name="description" class="ico-03" id="{{$edu->id}}description"
                            rows="3">{{$edu->description}}</textarea>

                <small class="help_text">Description required..</small>

            </div>
        </div>
    </div>
    @if ($errors->hasBag('education'.$edu->id))
        <div class="row">
            <div class="col-md-12 ">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->{'education'.$edu->id}->all() as $error)
                            @if ($error != $edu->id)
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
            <div class="alert alert-danger" id="eduerrbag{{$edu->id}}" style="text-align:center;display:none;">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="float:right; margin-top:20px; margin-bottom:100px;">
            <button class="ico-03 profile-btn" style="float:right"
                    type="submit">
                    @if( $edu->id == 0)
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

    $('input[id^="{{$edu->id}}edu_degree_"]').click(function () {
        $('input[id^="{{$edu->id}}edu_degree_"]').each(function (index) {
            $(this).prop("checked", false);
        });
        $(this).prop("checked", true);
    });


    // cert file upload start

    $('#certfileupload_{{$edu->id}}').fileupload({
        url: '/jobseeker/addcertfile',
        add: function (e, data) {
            if(data.files[0].size > 4*1000*1000) {
                // e.preventDefault();
            }
            else{
                data.submit();
            }
        },
        done: function (e, data) {
            var html = '<div class="certfileinfo" id="cert_' + data.result.cert_id + '">' + data.result.viewdata + '</div>';
            $(html).insertBefore( $('#btn_certupload_{{$edu->id}}') );
        }
    });

    $('input[id^="certfile_"]').fileupload({
        url: '/jobseeker/updatecertfile',
        dataType: 'json',
        add: function (e, data) {
            $('#{{$edu->id}}cert_id').val($(this).data('id'));
            if(data.files[0].size > 4*1000*1000) {
                // e.preventDefault();
            }
            else{
                data.submit();
            }
        },
        done: function (e, data) {
            $('#cert_'+data.result.cert_id).html(data.result.viewdata);
        }
    });

    function removecert(id) {
        // send ajax get request
        $.ajax({
            url: "/jobseeker/removecertfile",
            data: {'cert_id':id},
            dataType: "json",
            success: function (res) {
                $('#cert_'+res.id).remove();
            }
        });
    }

    // datepicker
    
    $('#{{$edu->id}}edu_start_date_picker').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#{{$edu->id}}edu_end_date_picker').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    $('#education_form_{{$edu->id}}').submit(function(e){
        $('input[id^="{{$edu->id}}edu_degree_"]').each(function (index) {
            if($(this).prop('checked')) {
                $('#edu_degree{{$edu->id}}').val($(this).data("degree"));
            }
        });

        var ids = "";
        $('div[id^="cert_"').each( function(index) {
            var id = $(this).prop('id');
            id = id.substring(5, id.length);
            ids = ids + id + ",";
        });
        $('#{{$edu->id}}cert_ids').val(ids);

        var errdiv = $('#eduerrbag{{$edu->id}}')
        if($('#edu_degree{{$edu->id}}').val() == ""){
            errdiv.css("display", "block");
            errdiv.html("Degree is required!");
            e.preventDefault();
        }

        if($('#{{$edu->id}}edu_end_date').val() < $('#{{$edu->id}}edu_start_date').val()){
            errdiv.css("display", "block");
            errdiv.html("Start date is before than End date!");
            e.preventDefault();
        }
    });
</script>
@endpush