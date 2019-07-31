
@extends('jobseeker.ample.index')

@section('content')
@include('jobseeker.dashboard.partial.personalinformation')
@include('jobseeker.dashboard.partial.career')
{{-- @include('jobseeker.dashboard.partial.personal') --}}
@include('jobseeker.dashboard.partial.skill_insert')
@include('jobseeker.dashboard.partial.education')
@include('jobseeker.dashboard.partial.edit_edu_form')
@include('jobseeker.dashboard.partial.training')
@include('jobseeker.dashboard.partial.refference')
<style>
  .ico-03
  {
    border-radius: 3px #a6b1be;
  }
  </style>
</nav>
<section>
<div class="container">
 <div class="row">
<h1 class="getsta">Get Started with World Talent Jobs</h1>  

 </div>



<h3 class="personal" style="padding-bottom:5%">Personal Info</h3>
<p>Profile Picture</p>

<div class="profileicon" style="min-width: 150px !important; min-height: 150px !important;">
<div class="row">
  <div class="col-md-3">
<img src="img/profile-bg.png" style="    margin-left: auto;
    margin-right: auto;" width="250px;"></div>
<div class="col-md-9"></div>
</div>
    </div>
<div class="profilebtn">
  <div class="row" style="margin-top:2%">
  <div class="col-md-3">
<button type="button" style="  border: 1px solid #7889ff; color:#7889ff;" class=  "remove    btn-profile">Change</button>
<button type="button" style="  border: 1px solid #e86850; float:right; color:#e86850" class="remove    btn-profile">Remove</button>
</div>
<div class="col-md-9"></div>
</div>
</div>

<div class="row">

 <div class="col-md-6">

 <label>Full Name</label>
 <input class="ico-03" type="text" placeholder="Default input">
 


 
  </div>
  
  <div class="col-md-3">

 <label>Gender</label>
 
 
 <div class="form-check form-check-inline">
 <input  class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">Male
</div>
<div class="form-check form-check-inline">
 <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">Female
</div>

 
  </div>

 <div class="col-md-3">

 <p  class="fullname ">Status</p>
 
 
 <div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">Single
</div>
<div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">Married
</div>

 
  </div>
  
     </div>
   
   
   <div class="row">
   
    <div class='col-md-6'>
      <p  class="fullname ">Date of Birth</p>
           <div class="form-group">
               <div class='input-group date' id='datetimepicker1'>
                   <input type='date' style="    line-height: 50px;" class="ico-03" class="form-control" />
                   <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
               </div>
       </div>
       </div>
       
        <div class='col-md-3'>
        
          <p  class="fullname ">Nationality</p>
             <form>
 <div class="form-row align-items-center">
   <div class="ico-03" class="col-auto my-1">
     
     <select class="ico-03 natidropdo custom-select mr-sm-2" id="inlineFormCustomSelect">
       <option selected>Choose...</option>
      <option value="1"> Afaraf</option> 
<option value="2">Abkhaz </option>
<option option value="3">Avestan  </option> 
< option value="4">Afrikaans</option> 
< option value="5"> Akan</option> 
< option value="6”> Amharic </option>
< option value="7”> Aragonese </option>
<option value=”8”>Arabic ,العربية </option>
<option value=”9”>Assamese ,অসমীয়া </option>
 <option value=”10”>Avaric  </option>
<option value=”11”>Aymara </option>
 
<option value=”12”>Azerbaijani </option>

<option value=”13”>South Azerbaijani </option>

<option value=”14”>Bashkir   </option>


<option value=”15”>Belarusian </option>
<option value=”16”>Bulgarian </option>
<option value=”17”>Bihari </option>
 
<option value=”18”>Bislama ,Bislama </option>

     </select>
   </div>
        </div>
        </form>
        
        </div>
        
        <div class='col-md-3'>
        
          <p  class="fullname ">Residence Location</p>
        <form>
 <div class="form-row align-items-center">
   <div class="col-auto my-1">
     
     <select class="natidropdo custom-select mr-sm-2" id="inlineFormCustomSelect">
       <option selected>Choose...</option>
      
       <option></option>
<option>AL|Albania</option>
<option>DZ|Algeria</option>
<option>AS|American Samoa</option>
<option>AD|Andorra</option>
<option>AO|Angola</option>
<option>AI|Anguilla</option>
<option>AQ|Antarctica</option>
<option>AG|Antigua And Barbuda</option>
<option>AR|Argentina</option>
<option>AM|Armenia</option>
<option>AW|Aruba</option>
 
<option>AT|Austria</option>
<option>AZ|Azerbaijan</option>
<option>BS|Bahamas</option>
<option>BH|Bahrain</option>
<option>BD|Bangladesh</option>
<option>BB|Barbados</option>
<option>BY|Belarus</option>
<option>BE|Belgium</option>
<option>BZ|Belize</option>
<option>BJ|Benin</option>
<option>BM|Bermuda</option>
<option>BT|Bhutan</option>
<option>BO|Bolivia</option>
<option>BA|Bosnia And Herzegovina</option>
<option>BW|Botswana</option>
<option>BV|Bouvet Island</option>
<option>BR|Brazil</option>
<option>IO|British Indian Ocean Territory</option>
<option>BN|Brunei Darussalam</option>
<option>BG|Bulgaria</option>
<option>BF|Burkina Faso</option>
<option>BI|Burundi</option>
<option>KH|Cambodia</option>
<option>CM|Cameroon</option>
<option>CA|Canada</option>
<option>CV|Cape Verde</option>
<option>KY|Cayman Islands</option>
<option>CF|Central African Republic</option>
<option>TD|Chad</option>
<option>CL|Chile</option>
<option>CN|China</option>
<option>CX|Christmas Island</option>
<option>CC|Cocos (keeling) Islands</option>
<option>CO|Colombia</option>
<option>KM|Comoros</option>
<option>CG|Congo</option>
<option>CD|Congo, The Democratic Republic Of The</option>
<option>CK|Cook Islands</option>
<option>CR|Costa Rica</option>
<option>CI|Cote D'ivoire</option>
<option>HR|Croatia</option>
<option>CU|Cuba</option>
<option>CY|Cyprus</option>
<option>CZ|Czech Republic</option>
<option>DK|Denmark</option>
<option>DJ|Djibouti</option>
<option>DM|Dominica</option>
<option>DO|Dominican Republic</option>
<option>TP|East Timor</option>
<option>EC|Ecuador</option>
<option>EG|Egypt</option>
<option>SV|El Salvador</option>
<option>GQ|Equatorial Guinea</option>
<option>ER|Eritrea</option>
<option>EE|Estonia</option>
<option>ET|Ethiopia</option>
<option>FK|Falkland Islands (malvinas)</option>
<option>FO|Faroe Islands</option>
<option>FJ|Fiji</option>
<option>FI|Finland</option>
<option>FR|France</option>
<option>GF|French Guiana</option>
<option>PF|French Polynesia</option>
<option>TF|French Southern Territories</option>
<option>GA|Gabon</option>
<option>GM|Gambia</option>
<option>GE|Georgia</option>
<option>DE|Germany</option>
<option>GH|Ghana</option>
<option>GI|Gibraltar</option>
<option>GR|Greece</option>
<option>GL|Greenland</option>
<option>GD|Grenada</option>
<option>GP|Guadeloupe</option>
<option>GU|Guam</option>
<option>GT|Guatemala</option>
<option>GN|Guinea</option>
<option>GW|Guinea-bissau</option>
<option>GY|Guyana</option>
<option>HT|Haiti</option>
<option>HM|Heard Island And Mcdonald Islands</option>
<option>VA|Holy See (vatican City State)</option>
<option>HN|Honduras</option>
<option>HK|Hong Kong</option>
<option>HU|Hungary</option>
<option>IS|Iceland</option>
<option>IN|India</option>
<option>ID|Indonesia</option>
<option>IR|Iran, Islamic Republic Of</option>
<option>IQ|Iraq</option>
<option>IE|Ireland</option>
<option>IL|Israel</option>
<option>IT|Italy</option>
<option>JM|Jamaica</option>
<option>JP|Japan</option>
<option>JO|Jordan</option>
<option>KZ|Kazakstan</option>
<option>KE|Kenya</option>
<option>KI|Kiribati</option>
<option>KP|Korea, Democratic People's Republic Of</option>
<option>KR|Korea, Republic Of</option>
<option>KV|Kosovo</option>
<option>KW|Kuwait</option>
<option>KG|Kyrgyzstan</option>
<option>LA|Lao People's Democratic Republic</option>
<option>LV|Latvia</option>
<option>LB|Lebanon</option>
<option>LS|Lesotho</option>
<option>LR|Liberia</option>
<option>LY|Libyan Arab Jamahiriya</option>
<option>LI|Liechtenstein</option>
<option>LT|Lithuania</option>
<option>LU|Luxembourg</option>
<option>MO|Macau</option>
<option>MK|Macedonia, The Former Yugoslav Republic Of</option>
<option>MG|Madagascar</option>
<option>MW|Malawi</option>
<option>MY|Malaysia</option>
<option>MV|Maldives</option>
<option>ML|Mali</option>
<option>MT|Malta</option>
<option>MH|Marshall Islands</option>
<option>MQ|Martinique</option>
<option>MR|Mauritania</option>
<option>MU|Mauritius</option>
<option>YT|Mayotte</option>
<option>MX|Mexico</option>
<option>FM|Micronesia, Federated States Of</option>
<option>MD|Moldova, Republic Of</option>
<option>MC|Monaco</option>
<option>MN|Mongolia</option>
<option>MS|Montserrat</option>
<option>ME|Montenegro</option>
<option>MA|Morocco</option>
<option>MZ|Mozambique</option>
<option>MM|Myanmar</option>
<option>NA|Namibia</option>
<option>NR|Nauru</option>
<option>NP|Nepal</option>
<option>NL|Netherlands</option>
<option>AN|Netherlands Antilles</option>
<option>NC|New Caledonia</option>
<option>NZ|New Zealand</option>
<option>NI|Nicaragua</option>
<option>NE|Niger</option>
<option>NG|Nigeria</option>
<option>NU|Niue</option>
<option>NF|Norfolk Island</option>
<option>MP|Northern Mariana Islands</option>
<option>NO|Norway</option>
<option>OM|Oman</option>
<option>PK|Pakistan</option>
<option>PW|Palau</option>
<option>PS|Palestinian Territory, Occupied</option>
<option>PA|Panama</option>
<option>PG|Papua New Guinea</option>
<option>PY|Paraguay</option>
<option><option>PE|Peru</option>
<option>PH|Philippines</option>
<option>PN|Pitcairn</option>
<option>PL|Poland</option>
<option>PT|Portugal</option>
<option>PR|Puerto Rico</option>
<option>QA|Qatar</option>
<option>RE|Reunion</option>
<option>RO|Romania</option>
<option>RU|Russian Federation</option>
<option>RW|Rwanda</option>
<option>SH|Saint Helena</option>
<option>KN|Saint Kitts And Nevis</option>
<option>LC|Saint Lucia</option>
<option>PM|Saint Pierre And Miquelon</option>
<option>VC|Saint Vincent And The Grenadines</option>
<option>WS|Samoa</option>
<option>SM|San Marino</option>
<option>ST|Sao Tome And Principe</option>
<option>SA|Saudi Arabia</option>
<option>SN|Senegal</option>
<option>RS|Serbia</option>
<option>SC|Seychelles</option>
<option>SL|Sierra Leone</option>
<option>SG|Singapore</option>
<option>SK|Slovakia</option>
<option>SI|Slovenia</option>
<option>SB|Solomon Islands</option>
<option>SO|Somalia</option>
<option>ZA|South Africa</option>
<option>GS|South Georgia And The South Sandwich Islands</option>
<option>ES|Spain</option>
<option>LK|Sri Lanka</option>
<option>SD|Sudan</option>
<option>SR|Suriname</option>
<option>SJ|Svalbard And Jan Mayen</option>
<option>SZ|Swaziland</option>
<option>SE|Sweden</option>
<option>CH|Switzerland</option>
<option>SY|Syrian Arab Republic</option>
<option>TW|Taiwan, Province Of China</option>
<option>TJ|Tajikistan</option>
<option>TZ|Tanzania, United Republic Of</option>
<option>TH|Thailand</option>
<option>TG|Togo</option>
<option>TK|Tokelau</option>
<option>TO|Tonga</option>
<option>TT|Trinidad And Tobago</option>
<option>TN|Tunisia</option>
<option>TR|Turkey</option>
<option>TM|Turkmenistan</option>
<option>TC|Turks And Caicos Islands</option>
<option>TV|Tuvalu</option>
<option>UG|Uganda</option>
<option>UA|Ukraine</option>
<option>AE|United Arab Emirates</option>
<option>GB|United Kingdom</option>
<option>US|United States</option>
<option>UM|United States Minor Outlying Islands</option>
<option>UY|Uruguay</option>
<option>UZ|Uzbekistan</option>
<option>VU|Vanuatu</option>
<option>VE|Venezuela</option>
<option>VN|Viet Nam</option>
<option>VG|Virgin Islands, British</option>
<option>VI|Virgin Islands, U.s.</option>
<option>WF|Wallis And Futuna</option>
<option>EH|Western Sahara</option>
<option>YE|Yemen</option>
<option>ZM|Zambia</option>
<option>ZW|Zimbabwe</option>
     </select>
   </div>
        </div>
        </form>
</div>
</div>

 <div class="row">

<div class="col-md-6">

 <label>Visa Status</label>
 <input class="ico-03" class="form-control" type="text" placeholder="">
 
  </div>
  
  <div class="col-md-6">
  <div class="checkbox">
 <label>Driving License Issued From
 
 <label style="float:right" class="chelisence"><input  type="checkbox" value="">I have License</label>
</label>
 <input class="ico-03" class="form-control" type="text" placeholder="">
 </div>
  </div>


</div>

<div class="row">

<div class="col-md-6">

 <label>Languages</label>
 <input class="ico-03" class="form-control" type="text" placeholder="">
 
  </div>
  
   <div class="col-md-5">

 <p  class="fullname ">NOC</p>
 
 
 <p>
   <div class="col-sm-12 col-md-6">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
 <label class="form-check-label" for="inlineCheckbox1">Available</label>
</div>
<div class="col-sm-12 col-md-6">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
 <label class="form-check-label" for="inlineCheckbox2">Non-Available</label>
</div>
</p>

 
  </div>


</div>
</section>

<section>
<div class="container">
<h3 class="personal">Contact Info</h3>

<div class="row">
<div class="col-md-6">

 <label>Email Address</label>
 <input class="ico-03" class="form-control" type="text" placeholder="">
 
  </div>
  
  
<div class="col-md-6">

 <label>Mobile</label>
 <input class="ico-03" class="form-control" type="text" placeholder="">
 
  </div>
</div>

  <div class="row">
<div class="col-md-2" ></div>
<div class="col-md-8 col-sm-12" style="margin-top:5%">
  <button class="ico-03 profile-btn" style="float:right" type="submit">UPDATE</button>
 </div>
 <div class="col-md-2"></div> 
</div>
</div>

</section>


<section>

<div class="container">

<h3 class="personal">Target Job</h3>

<div class="form-group">
   <label for="exampleFormControlTextarea1">Job Target Tags (Comma separate tags, such as required skills or technologies, for this job minimum of 2)</label>
   <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>
 </div>


<div class="col-md-6">

 <div class="row">
<div class="form-group">
   <label for="exampleFormControlInput1">Job Title</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div>
 
 <div class="form-group">
   <label for="exampleFormControlInput1">Job Location</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div>
 
 <div class="form-group">
   <label for="exampleFormControlInput1">Monthly Salary</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div>
</div>
</div>


<div class="col-md-6"> 

  <div class="form-group">
   <label for="exampleFormControlSelect1">Job Industry</label>
   <select class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
     <option>Accounts</option>
     <option>Web design</option>
     <option>Web devaloper</option>
     <option>4</option>
     <option>5</option>
   </select>
 </div>
 
 <div class="form-group">
   <label for="exampleFormControlSelect1">Career Level</label>
   <select class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
     <option>Mid Carrer</option>
     <option>Web design</option>
  
     <option>4</option>
     <option>5</option>
   </select>
 </div>


 <div class="form-group">
   <label for="exampleFormControlSelect1">Notice Period</label>
   <select class="ico-03 natidropdo custom-select mr-sm-2" id="exampleFormControlSelect1">
     <option>2 Month</option>
     <option>5 Month</option>
     
   </select>
 </div>


  </div>
 
 
<div class="form-group">
   <label >Career Objective</label>
   <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>
 </div>

<div class="col-md-6"> 
<div class="row">
 <div class="form-group">
   <label for="exampleFormControlSelect1">Employment Type  </label>
   <select class="ico-03" id="exampleFormControlSelect1">
     <option>Full-time</option>
     <option>Part-time</option>
     
   </select>
 </div>
</div>
</div>
<div class="col-md-6">

<div class="col-md-2" ></div>
<div class="col-md-8 col-sm-12" style="margin-top:5%">
  <button class="ico-03 profile-btn" style="float:right" type="submit">UPDATE</button>
 </div>
 <div class="col-md-2"></div> 
 </div>
</div>

</section>


<section>
<br><br>
<div class="container">

<h3 class="personal">Education</h3>

<p>Degree</p>
<div class="col-md-12"> 
 <div class="row"> 
<div class="col-md-2"> 
<div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
 <label class="form-check-label" for="inlineCheckbox1">High school </label>
</div>

<div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
 <label class="form-check-label" for="inlineCheckbox1">Diploma</label>
</div>
</div>


<div class="col-md-2"> 
<div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
 <label class="form-check-label" for="inlineCheckbox1">Bachelor's degree</label>
</div>

<div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
 <label class="form-check-label" for="inlineCheckbox1">Higher diploma</label>
</div>
</div>

<div class="col-md-2"> 
<div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
 <label class="form-check-label" for="inlineCheckbox1">Master degree</label>
</div>

<div class="form-check form-check-inline">
 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
 <label class="form-check-label" for="inlineCheckbox1">Doctorate</label>
</div>
</div>



</div></div>

<div class="Ceritificatesinfot"> 
<p class="Ceritificatesinfot">Ceritificates </p>
<div class="form-group">


<button type="file" id="exampleFormControlFile1" class="dergpdf form-control-file" btn btn-default">Degree.pdf</button>


<button type="file" id="exampleFormControlFile1" class="dergpdf1 form-control-file" btn btn-default">UPLOAD NEW</button>

</div> </div>



<div class="row">
<div class="col-md-6">

<div class="form-group">
   <label for="exampleFormControlInput1">Major / Stream</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div></div>
 
  <div class="col-md-3">
<div class="form-group">
   <label for="exampleFormControlInput1">Start Date</label>
      <div class='input-group date' id='datetimepicker1'>
                   <input type='date' style="    line-height: 50px;" class="ico-03" class="form-control" />
                   <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
               </div>
 </div></div>
 
 
  <div class="col-md-3">
<div class="form-group">
   <label for="exampleFormControlInput1">End Date</label>
     <div class='input-group date' id='datetimepicker1'>
                   <input type='date' style="    line-height: 50px;" class="ico-03" class="form-control" />
                   <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
               </div>


 <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="" value="option1"> I currently Study Here
 </div></div>
</div>
 






<div class="row">
<div class="col-md-6">

<div class="form-group">
<label for="exampleFormControlSelect1">Country  </label>
   <select class="ico-03" id="exampleFormControlSelect1">
     <option>India</option>
     <option>US</option>   
   </select>
 </div></div>
 
  <div class="col-md-6">
<div class="form-group">
   <label for="exampleFormControlInput1">City</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div></div>
 
 
 
</div>


<div class="row">
<div class="col-md-6">

<div class="form-group">
<label for="exampleFormControlSelect1">Country  </label>
   <select class="ico-03" id="exampleFormControlSelect1">
     <option>India</option>
     <option>US</option>   
   </select>
 </div></div>
 
  <div class="col-md-6">
<div class="form-group">
   <label for="exampleFormControlInput1">City</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div></div>
 
 
 
</div>




<div class="row">
 <div class="col-md-12">
<div class="form-group">
   <label for="exampleFormControlTextarea1">Description</label>
   <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>
   
 </div>
    <div class="row">
<div class="col-md-2" ></div>
<div class="col-md-8 col-sm-12" style="margin-top:5%">
  <button class="ico-03 profile-btn" style="float:right" type="submit">UPDATE</button>
 </div>
 <div class="col-md-2"></div> 
</div>
 
 </div>
</div>
</div>
</section>

<section>

<div class="container">
<h3 class="personal">Work Experience</h3>
<div class="row">
 <div class="col-md-12">
<div class="form-group">
   <label for="bio">Bio</label>
   <textarea class="ico-03" id="bio" rows="3"></textarea>
   
 </div>
</div>
 
  <div class="col-md-6">

<div class="form-group">
   <label for="exampleFormControlInput1">Location</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div></div>
 
 <div class="col-md-3">
<div class="form-group">
   <label for="exampleFormControlInput1">Start Date</label>
      <div class='input-group date' id='datetimepicker1'>
                   <input type='date' style="    line-height: 50px;" class="ico-03" class="form-control" />
                   <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
               </div>
 </div></div>
 
 
  <div class="col-md-3">
<div class="form-group">
   <label for="exampleFormControlInput1">End Date</label>
     <div class='input-group date' id='datetimepicker1'>
                   <input type='date' style="    line-height: 50px;" class="ico-03" class="form-control" />
                   <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                   </span>
               </div>
               </div></div>
 
  <div class="col-md-12">
  
   <div class="form-group">
   <label for="exampleFormControlTextarea1">Description</label>
   <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>
   
 </div>
  
  <p style="text-align:center; padding:20px;color:#000; font-weight:600; " class="dotted">ADD NEW EXPERIENCE  </p>

<p>Skills</p>
</div>
  <div class="col-md-12">
<div class="form-group">

   <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>
   
 </div>
   
   
 </div>
 
 
 <div class="col-md-12">
<div class="form-group">

   <textarea class="ico-03" id="exampleFormControlTextarea1" rows="3"></textarea>
   
 </div>
   
   <p style="text-align:center; padding:20px; color:#000; font-weight:600; " class="dotted">ADD NEW SKILL SET</p>
   <p>External link</p>
 </div>
 
 
 
   <div class="col-md-6">

<div class="form-group">
   <label for="exampleFormControlInput1">URL</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div></div>
 
   <div class="col-md-6">

<div class="form-group">
   <label for="exampleFormControlInput1">URL</label>
   <input type="email" class="ico-03" id="exampleFormControlInput1" placeholder="">
 </div></div>
 
 
 
   <div class="col-md-8">
   
   <p style="margin-top:50px;">Please note: Any information you change in "My Account" will also be changed in your CVs.</p>
   
   </div>
 <div class="col-md-3">
 <div class="row">
<div class="col-md-2" ></div>
<div class="col-md-8 col-sm-12" style="margin-top:5%">
  <button class="ico-03 profile-btn" style="float:right" type="submit">UPDATE</button>
 </div>
 <div class="col-md-2"></div> 
</div>
 
 </div>	
 
 
 


</div>

</section>

<section>
<div class="container">
<h3 class="personal">Contact Info</h3>

<p style="margin-top:20px;">Attachments</p>

<div class="form-group">


<button  type="file" id="exampleFormControlFile1" class="dergpdf form-control-file" btn btn-default">Resume.pdf</button>
<button  type="file" id="exampleFormControlFile1" class="dergpdf form-control-file" btn btn-default">Resume.doc</button>

<button type="file" id="exampleFormControlFile1" class="dergpdf1 form-control-file" btn btn-default">UPLOAD NEW</button>

</div


</div>

</section>


<div class="row">
<div class="col-md-2" ></div>
<div class="col-md-8 col-sm-12" style="margin-top:5%">
  <button class="ico-03 " style="background-color:#28C294;float:right" type="submit">SUBMIT</button>
 </div>
 <div class="col-md-2"></div> 
</div>



{{-- 	@include('jobseeker.dashboard.partial.careerandobjective')
	--}}





</body>


<style>
 select
 {
   height: 38px;
   -ms-box-sizing:content-box;
-moz-box-sizing:content-box;
-webkit-box-sizing:content-box; 
box-sizing:content-box;
 }

 .fake-input, input[type="text"], input[type="password"], input[type="email"], input[type="number"], textarea, select {
   background-color:white; 
}
 </style>

  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>

 $( document ).ready(function() {
   console.log( "ready!" );
  
});


</script>	
<!--	<div class="containersd">
		<div class="row">
			<div class="col-md-12" id="jobseeker_details_primary">
				<div>{{--Tab menu start--}}
					<div class="stats-tab">
						<div class="btn-group " role="group" aria-label="">
							<ul class="nav nav-tabs">
								<li class="active refresh"><a href="#personal-tab" data-toggle="tab">Personal</a></li>
								<li class="refresh"><a data-toggle="tab" href="#education-tab">Education</a></li>
								<li class="refresh"> <a data-toggle="tab" href="#career-tab">Career & Objective</a></li>
								<li class="refresh"><a data-toggle="tab" href="#other-tab">Other Information</a></li>
								<li class="refresh"><a data-toggle="tab" href="#refference-tab">Refference Information</a></li>
								<li class="refresh"><a data-toggle="tab" href="#photo-tab">Photo</a></li>
								<li class="refresh"><a data-toggle="tab" href="#cv-tab">cv</a></li>
							</ul>
						</div>
					</div>

					<div class="tab-content" id="refresh">
						<div id="personal-tab" class="tab-pane fade in active">
							@include('jobseeker.dashboard.partial.personal_tab_info')
						</div>
						<div id="education-tab" class="tab-pane fade ">

		
							@include('jobseeker.dashboard.partial.education_view')
						</div>
						<div id="career-tab" class="tab-pane fade ">
							@include('jobseeker.dashboard.partial.careerandobjective')
						</div>
						<div id="other-tab" class="tab-pane fade ">
							@include('jobseeker.dashboard.partial.other_view')

						</div>
						<div id="refference-tab" class="tab-pane fade ">
							@include('jobseeker.dashboard.partial.refference_view')

						</div>
						<div id="photo-tab" class="tab-pane fade ">
							@include('jobseeker.dashboard.partial.profile_pic')
						</div>
						<div id="cv-tab" class="tab-pane fade ">
							@include('jobseeker.dashboard.partial.cv')
						</div>
					</div>


				</div> {{--Tab menu end--}}
				






			</div>
		</div>
	</div>

	-->
<script>
	$(document).ready(function(){
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
		});
		// $('.acs,.ags,.bas').hide();
		// $('#add-district-box').hide();
		// $('input:radio[name="bd"]').change(function(){
		// 	//alert(5);
		// 	$('#add-district-box').toggle();
		// })

	
		// $('#ac').click(function(){
		// 	$('.acs').toggle();
		// })
		// $('#ag').click(function(){
		// 	$('.ags').toggle();
		// })
		// $('#ba').click(function(){
		// 	$('.bas').toggle();
		// })

		// $('.acs').click(function(){
		// 	$(this).hide();
		// 	$('#ac').prop('checked',false)
		// })

		// $('.ags').click(function(){
		// 	$(this).hide();
		// 	$('#ag').prop('checked',false)
		// })

		// $('.bas').click(function(){
		// 	$(this).hide();
		// 	$('#ba').prop('checked',false)
		// })


		// update by ajax
// 		$('#pinfoupdate').on('submit',function(e) {
//         e.preventDefault();

// 		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// 		var data=$(this).serialize();

// 		//alert(data);

// $.ajax({
//     url: '/jobseeker/infoupdate',
//     type: 'post',
//     data: {_token: CSRF_TOKEN,
//     		data:data},
//     dataType: 'JSON',
//     success: function (data) {
//         console.log(data);
//     },
    
// });
$(document).on('submit','.careerupdate',function(e){
  e.preventDefault();
  var type=$(this).attr('method');
  var url=$(this).attr('action');
  // if ($('#lavelofeducation_id').val() !== "-1" && $('#exam_title_id').val() !=="-1" && $('#groupormajor_id').val() !=="-1") {
  $.ajax({
    type:'put',
    url:url,
    data:$(this).serialize(),
    success:function(d){
    	//return(d);
      console.log(d);
    alert(d);
    $('.modal').modal('hide');
     // $('#employer_industrytype').load(location.href+ ' #employer_industrytype');
     // $('#company_primary_inf').load(location.href+ ' #company_primary_inf');
     // getdata();carrer_table
     $('#carrer_table').load(location.href+ ' #carrer_table');

		
    
    }
  })
// }else {
// 	$('#lavelofeducation_id').val()==('-1')?$('#lavelofeducation_id').addClass('text-danger'):'True';
// 	$('#exam_title_id').val()==('-1')?$('#exam_title_id').addClass('has-warning'):'True';
// 	$('#groupormajor_id').val()==('-1')?$('#groupormajor_id').addClass('text-danger'):'True';
// 	alert('Dont Left Blank');
// }

})

// personal data update

$(document).on('submit','.pinfoupdate',function(e){
  e.preventDefault();
  var type=$(this).attr('method');
  var url=$(this).attr('action');
  $.ajax({
    type:'put',
    url:url,
    data:$(this).serialize(),
    success:function(d){
    	//return(d);
      console.log(d);
    alert(d);
    $('.modal').modal('hide');
     // $('#employer_industrytype').load(location.href+ ' #employer_industrytype');
     // $('#company_primary_inf').load(location.href+ ' #company_primary_inf');
     // getdata();carrer_table
     $('#carrer_table').load(location.href+ ' #carrer_table');

		
    
    }
  })

})

//end personal data


$(document).on('submit','#profile_pic',function(e){
  e.preventDefault();
  var urlw=$(this).attr('action');
  var img=$("#profile_image").val();
  //alert(img);

$.ajax({

    url: urlw,  
    method:"post",  
    data:new FormData(this),
    contentType:false,
    processData:false,
     success:function(d){
    console.log(d);
     }

})

})



	});
</script>
@endsection
