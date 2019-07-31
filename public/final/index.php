 <?php
 
  include 'header.php';

  
  
  ?>	
  
  
  
<div class="jumbotron text-center">
 
 <h1 class="findjobscen">FIND JOBS</h1>
 <div class="search-list">
<!--<input type="text" style="width:30%" placeholder="Job tittle, skill, etc..">
<select style="width:30%" >

<option>Place</option>
<option>India</option><option>US</option>Qatar</select>
  <input class="buttons" type="Submit" value="Search" style="width:10%">
  </div>
  -->
  
  
  <div class="row">
                		<div class="col-md-5">
                  		<div class="form-group">
                            <input type="text" class="form-control" name="name" autocomplete="off" id="Name" placeholder="Job tittle, skill, etc...">
                  		</div>
                  	</div>
                    	<div class="col-md-5">
                  		<div class="form-group">
<select class="form-control" >

<option>Place</option>
<option>Qatar</option><option>US</option> 

<option>AF|Afghanistan</option>
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
 





</select>                  		</div>
                  	</div>
                  	
                  	<div class="col-md-2">
                  		<div class="form-group">
                  		  <input class="buttons" type="Submit" value="Search" style="width:100%" class="form-control">

                  		</div>
                  	</div>
                  	</div>
		
  </div>
  </div>
  
  
  
   <div class="fircon1 container">
   <div class="postccv col-md-3">
   <h3 class="Posthed">Post Your Cv</h3>
    <p class="Postcont">In a few seconds </p>
	
	<button class="post-now" >Post Now</button> 
   </div>
   <div class="col-md-3">
   <img class="jobiconleft" src="img/Group 2.2.png" width="80%;">
   
   </div>
   
     <div class="col-md-6">
	<p class="badcon"> Stay Updated on the latest jobs in Qatar with World Talent Jobs.Post your CV and get noticed by recruiters in Qatar.</p>
	 
	 </div>
	 </div>
  
  
     
  <div class="fircon1 container">
      
   
     <div class="col-md-6">
	<p class="badconright"> Post your vacancies to World Talent Jobs and receive application from qualfied cadidates looking for jobs in Qatar.Register with us and get complimentary access to CV database</p>
	 
	 </div>
	 
	 <div class="col-md-3">
   <img class="joinconright" src="img/Group 2.3.png" width="80%;">
   
   </div>
	 
	 
	 <div class="postccvright col-md-3">
   <h3 class="Posthed">Employers</h3>
    <p class="Postcont">Post your job for free </p>
	
	<button class="post-now" >Join Now</button> 
   </div>
	 </div>
  
   <?php
 
  include 'footer.php';
  
  ?>
  
  
  

