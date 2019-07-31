{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
HomePage
@endsection

@section('content')

<style>
.select2 {
    margin-top: 0px !important; 
}
   .select2-container--classic .select2-selection--single .select2-selection__arrow
   {
       height:40px;
   }
.select2-selection 
{
   height:40px !important;
}

.select2-selection__rendered
{
   padding-top:8px;
}

.select2 .select2-container .select2-container--classic
{
   margin-top:0% !important
}
   </style>

<div style="min-height:100%" class="container">







   <div style="margin-top:10%;" class="contactpage row">
   <div class="conhead">
<h1 class="contact">CONTACT US</h1></div>    
   <form role="form" id="contact-form" class="contact-form">
       <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                             <label>Name *</label>
                             <input  type="text" class="ico-03" placeholder="Name" value=""/>
                         </div>
                     </div>
                       <div class="col-md-6">
                         <div class="form-group">
                         <label>Email *</label>
                             <input  type="text" class="ico-03"  value=""/>
                         </div>
                     </div>
                     </div>
       
       
                   <div class="row">
                   <div class="col-md-6">
                         <div class="form-group">
                         <label>Contact Number *</label>
                         <input  type="text" class="ico-03"  value=""/>  
                       </div>  
                       </div>
                       <div class="col-md-6">
                         <div class="form-group" style="overflow:hidden">
                         <label>Type Of Enquiry *</label>
                         <select style="width:100%;  background-color: #fcfcfc !important;  box-shadow: -7px 8px 55px -5px rgb(255, 255, 255); " placeholder="Place" class="ico-02 js-example-basic-single" name="states[]" >
       <option value="BS" selected> Business</option>
       <option value="AL">Support</option>
       <option value="WY" >Help</option>
       <option value="">Feedback</option>
       <option value="AL">Issues</option>
       <option value="WY" >Other</option>


       </select>
                         </div>
                     </div>
                       
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                         <div class="form-group">

                         <label>Comments *</label>
                           <textarea class="ico-03" rows="3" name="Message" id="Message" placeholder="Type something here"></textarea>
                         </div>
                     </div>
                   </div>
                   <div class="row">
                    <div class="col-sm-12 col-md-6">
                    <label>Attachment *</label>

                 <button type="submit" class="dotted uplaoad main-btn pull-left">UPLOAD NEW</button>
                 </div>
                   <div class="col-sm-12 col-md-6">
                   <label>*</label>

<button type="submit" style="    float: right !important;" class="loginbtn">Send </button>
                 </div>
                 </div>
               </form>
   </div>





</div >






<style>
.select2-container--default .select2-selection--single
{
   border: 1px solid #e0e0e0 !important;
}

</style>
</body>
<script>

$('#contact-form').bootstrapValidator({
//        live: 'disabled',
       message: 'This value is not valid',
       feedbackIcons: {
           valid: 'glyphicon glyphicon-ok',
           invalid: 'glyphicon glyphicon-remove',
           validating: 'glyphicon glyphicon-refresh'
       },
       fields: {
           Name: {
               validators: {
                   notEmpty: {
                       message: 'The Name is required and cannot be empty'
                   }
               }
           },
           email: {
               validators: {
                   notEmpty: {
                       message: 'The email address is required'
                   },
                   emailAddress: {
                       message: 'The email address is not valid'
                   }
               }
           },
           Message: {
               validators: {
                   notEmpty: {
                       message: 'The Message is required and cannot be empty'
                   }
               }
           }
       }
   });
</script>


</html>
@endsection