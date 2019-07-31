{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
HomePage
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

.select2-container--default .select2-selection--single {
    border: 1px solid #e0e0e0 !important;
}

/* #footer {
    bottom: 0;
    position: fixed !important;
    width: 100%;
} */
.minheight {
    min-height:calc(100vh - 78px - 45px);
    padding: 0.1px 0;
}
</style>
@endsection

@section('content')
<div class="container minheight">

    <div style="margin-top:10%;" class="contactpage row">
        <div class="conhead">
            <h1 class="contact">CONTACT US</h1>
        </div>
        <form role="form" id="contact-form" method="POST" enctype="multipart/form-data" action="/contact"
            class="contact-form">

            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name<span class="mustbeoption">*</span></label>
                        <input required type="text" name="name" class="ico-03" placeholder="Name" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email <span class="mustbeoption">*</span></label>
                        <input required type="text" name="email" class="ico-03" value="" />
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Contact Number <span class="mustbeoption">*</span></label>
                        <input required name="contact" type="text" class="ico-03" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="overflow:hidden">
                        <label>Type Of Enquiry <span class="mustbeoption">*</span></label>
                        <select name="type" required
                            style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); "
                            placeholder="Place" class="ico-02 js-example-basic-single">
                            <option value="" hidden>Choose...</option>
                            <option value="BILLING">BILLING</option>
                            <option value="SUPPORT">SUPPORT</option>
                            <option value="FEEDBACK">FEEDBACK</option>
                            <option value="COMMERCIAL">COMMERCIAL</option>
                            <option value="OTHER">OTHER</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">

                        <label>Comments <span class="mustbeoption">*</span></label>
                        <textarea required name="comment" class="ico-03" rows="3" name="Message" id="Message"
                            placeholder="Type Something Here" style="height:140px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <label>Attachment <span class="mustbeoption">*</span></label>
                    <span class="btn-certfileupload dotted" id="btn_cvupload">
                        UPLOAD FILE
                        <input type="file" id="avatar" name="avatar">
                    </span>
                </div>
                <div class="col-sm-12 col-md-6">
                    <button class="ico-03 profile-btn target_job" data-form-id="personal_target_form"
                        style="float:right;margin-top:43px;" type="submit" id="contactsubmit">
                        SEND
                    </button>
                </div>
            </div>
            @if ($errors->any())
                <div class="row" id="allerrorbag">
                    <div class="col-md-12 ">
                        <div class="alert alert-danger" style="text-align:center;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection

@section('extrascript')
<script>
// var a = 0;
// $(".contact-form").on("submit", function(e) {
//     if (a == 1) {
//         return;
//     }
//     e.preventDefault(); //stop submit event
//     swal({
//         title: "Thank you!",
//         text: "We have received your comment we will get back to you soon",
//         icon: "success",
//         button: "Ok!",
//     }).then(() => {
//         a = 1;
//         $("#contact-form").submit();
//     });
// });

// $('#avatar').fileupload({
//     url: '#contact-form',
//     autoUpload: false,
//     add: function(e, data) {
//         $('#btn_cvupload').attr('title', data.files[0].name);
//     }
// });
</script>
@endsection