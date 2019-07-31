{{-- Header --}}
@extends('public.layout.public_layout')
@section('page_title')
HomePage
@endsection

@section('content')

<style>
    .remove
    {
        border: 1px solid #7889ff;
    color: #7889ff;

    }
    .btn-profile {
        
            font-size:10px !important;
        }
        .btn
        {
            font-size:12px !important;
        }
        
        
@media (min-width: 768px) {
    .aconntmenu
    {
        margin-left:-7%;
    }
    .container
    {
       
    }
   .accondlondon
   {
    margin: -5% 0 15px 0;
    color:gray;
   }
   .leftcont
   {
       color:gray;
   }
   .current
   {
       color:#7889ff;
      
   }

   .current  .col-md-10
       {
           font-weight:bold;
           color:black;
       }
       .content
       {
        margin-left:-7%;border-right: thin solid lightgray;
       }

       .row {
     margin-bottom: 0px; 
       }
}
    
}
</style>

<section>
    <div style="margin-top:2%;    " class="container">
    <div class="row">   
    <div class="col-md-2">
            <div class="applyjob1img">
                <div class="accounimgpro">
                <img style="width:170px;" src="https://d1fs8ljxwyzba6.cloudfront.net/assets/author/2018/02/15/henry-head-profile_512x512.jpg" >
                <h1 class="Posthed">Flenn Morales</h1>
                <p class="accondlondon">London</p>
            </div>

            <div class="row">
                <div class="acoonappnum">
                    <div class="col-md-5 col-xs-6">
                        <p class="Posthed" style="font-size:14px;" class="accontappl">Applied jobs</p>
                        <p class="Posthed">04<span style="font-size:14px;"> (total)</span></p>
                    </div>
                    <div class="col-md-7 col-xs-6">
                        <p class="Posthed" style="font-size:14px;">Jobs Accepted</p>
                        <p class="Posthed">01</p>
                    </div>
                </div>
            </div>
            <div class="aconntmenu">
                <h4 class="current"><div class="col-md-2"><i class="lefbaricon fas fa-list"></i> </div><div class="col-md-10"> Job</div></h2>
                <h4  class="leftcont"><div class="col-md-2"><i class="lefbaricon far fa-user"></i>  </div><div class="col-md-10"> Porfile </div></h2>
                <h4 class="leftcont"><div class="col-md-2"><i class="lefbaricon far fa-envelope"></i>  </div><div class="col-md-10"> Messages </div></h2>
                <h4  class="leftcont"><div class="col-md-2"><i class="lefbaricon fas fa-bell"></i> </div><div class="col-md-10">  Notication </div></h2>
                <h4  class="leftcont"><div class="col-md-2"><i class="lefbaricon fas fa-pencil-alt"></i> </div><div class="col-md-10">  Edit Profile </div></h2>
            </div>
        </div> 
    </div>

      
    <div style="" class="col-md-8" >
		<div class="header_listtop">
			<ul>
				<li><a href="#">All </a></li>
                <button type="" style="background-color:transparent " data-toggle="modal" data-target="#myModal"><img src="/img/filter_icon.jpg" /></button>

			</ul>
		</div>    

	@forelse($inv as $j)
		<div class="col-md-12" style="background:#fff;padding:15px;box-shadow:-7px 8px 55px -5px rgba(0,0,0,0.2);border-radius: 3px;margin-bottom:20px; margin-top:30px;">
			<div class="row canditate_list" >
				<div class="col-md-3 col-sm-6">
					<div class="border-right">
						<h3>{{$j->full_name}}</h3>
						<p>2 Years Experience</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<span class="border1">CA</span>
					<span class="border1">Tally</span>
				</div>
				<div class="col-md-6 pull-right">
					<a href="/employer/invite/{{$id}}/{{$j->jobseeker_id}}"><span class="message">INVITE </span></a>
					<span class="message"> <i class="far fa-envelope"></i> Message </span>
										
				</div>
			</div>
			
			
			<div class="row canditate_details">
				<div class="col-md-4">
					<h3> {{$j->jobseeker_nationality}}</h3>
					<p>Canadian</p>
				</div>
				<div class="col-md-3">
					<div class="border-right">
						<div class="col-md-7">Visa Type</div>
						<div class="col-md-5 text-center">Work</div>
						<div class="col-md-5">NOC</div>
						<div class="col-md-7 text-center"><img src="/img/available.jpg" style="padding-top: 10px; float: left;"> Available</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="col-md-7">Current locations</div>
						<div class="col-md-5 text-center">Qatar</div>
						<div class="col-md-6">Salary Range</div>
						<div class="col-md-6 text-center">7000 - 10000 Qr</div>
				</div>
			</div>
			
			
		</div>
		 
		@empty
              <p class="text-warning">No candidates Found</p>
              
              @endforelse
              <div class="text-center"> {{$inv->links()}}</div>
              

              
		
	
		


    </div>



      <div class="col-md-2">

<h4 class="sidenotifi">Recent Notifiations</h4>


<div class="row" style="margin-top:20%">
<div class="col-md-4">
<div class=""><img width="80px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png"></div>
</div>
<div class="col-md-8">
<h6>Spree Commerce </h6>
<h6 class="croshour">18 hours</h6>
<br>
</div>
</div>
<h5 class="text-align:center;">"Laravel Developer"</h5>
<hr style="max-width:400px; border:1px solid #999; text-align:left; margin-top:20px;">
		  <div class="row" style="margin-top:20%">
<div class="col-md-4">
<div class=""><img width="80px;" src="https://cdn.evbuc.com/images/47868275/182167339224/2/logo.png"></div>
</div>
<div class="col-md-8">
<h6>Spree Commerce </h6>
<h6 class="croshour">18 hours</h6>
<br>
</div>
</div>
<h5 class="text-align:center;">"Laravel Developer"</h5>
<hr style="max-width:400px; border:1px solid #999; text-align:left; margin-top:20px;">
<span class="viewall_right textright">view all</span>		  
		  
		  
</div>
</div>


		

<!-- Modal -->
<div id="myModal" class="modal fade"  role="dialog">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content" style="width: 200%;margin-left: -50%;">
      
      <div class="modal-body">
      <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                        <form>
                            <div class="col-md-4 col-xs-12 popup_screen">
                                <h3>Job Category</h3>
                                <div class="overflow_y">
                                @foreach($catagorys[0] as $cat)
                                    <p><input name="category[]" type="checkbox" value="{{$cat->id}}"> {{$cat->catagoryname}}</p>
                                    @endforeach
                                    
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 popup_screen">
                                <h3>Job Type</h3>
                                <div class="overflow_y">
                             @foreach($get_ind as $ind)

<p><input type="checkbox" name="industry[]" value="{{$ind->id}}" > {{$ind->industrytypename}}  </p>

                                                             
                                     @endforeach
                                </div>
                            </div>
                           
                            <div class="col-md-4 col-xs-12 popup_screen">
                                <h3>Locations</h3>
                                <div class="overflow_y">
                                @foreach($division as $div)
                                <p><input type="checkbox" name="division[]" value="{{$div->id}}" > {{$div->name}}  </p>

                                                             
                                     @endforeach
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="row" style="padding-top:10px;">
                            <div class="col-md-6"><img src="/img/filter_icon.jpg" /></div>
                            <div class="col-md-6 text-right">Filter</div>
                        </div>
                        
                        <div class="row">
                            <input type="text" class="search_box" />
                            <i class="fa fa-search search_icons2"></i>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Sallery</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Experience</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Visa Type</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Locations</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Job Roll</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">NOC</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Nationality</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Job Type</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Job Title</button>
                            </div>
                            <div class="col-md-4">
                                <button class="postjob_button" type="submit">Gender</button>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="row submit_row">
                            <button style="background-color:#28C294;" type="submit">APPLY FILTER</button>
    <button style="background-color:#e85819;" type="submit">Clear</button>	
    </form>							
                        </div>
            
      </div>
      
    </div>

  </div>
</div>	
		
       
    
    
    
    
        
</section>
 
@endsection
