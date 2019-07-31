

{{-- Header --}}
@extends('dashboard.layout.admin_layout')
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
    <div style="margin-top:80px;" class="container">
		
		
		<div class="row" style="padding-top:30px">
			<div class="col-md-12">
				     <div class="row">   
  

      
    <div style="" class="col-md-12" >
        <div class="row dashbord">
            <div class="col-md-9 col-sm-12">
                <h2>{{$data[0]->jobtitle}}</h2>
                <div class="left_content">
                    <h3>{{$data[0]->companyname}}</h3>
                    <p>{{$data[0]->created_at}}</p>
                </div>               
                
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="action_buttons">
                    <span class="edit_button"><a href="#">EDIT</a></span>
                    <span class="more_icon"><a href="#">...</a></span>
                    <div class="actions_buttons2" style="display:none;">
                        <img class="top_arrow" src="/img/arrowtop.jpg">                      
                        <div class="editicons23">
                            <div><a href="#"><img src="/img/close.jpg" style="padding-top: 10px; padding-right: 10px; float: left;"> Close</a></div>
                            <div><a href="#"><img src="/img/delete.jpg" style="padding-top: 10px; padding-right: 10px; float: left;"> Delete</a></div>
                            <br clear="all">
                        </div>
                        <br clear="all"><br clear="all"><br clear="all"><br clear="all">
                    </div>
                </div>
            
                <div class="row" style="padding-top:10px;">
                    <div class="col-md-7 col-xs-7">Status</div>
                    <div class="col-md-5 col-xs-5 text-right"><img src="/img/available.jpg" style="padding-top: 10px; float: left;">  Available</div>
                    <div class="col-md-7 col-xs-7">Expire in</div>
                    <div class="col-md-5 col-xs-5 text-right">  {{$data[0]->deadline}}</div>
                    <div class="col-md-7 col-xs-7">Status</div> 
                    <div class="col-md-5 col-xs-5 text-right"> Available</div>
                </div>
            </div>
            <br clear="all" />
        </div>
        
        <div class="row">
            
            <div class="col-md-12">
                <div>
                    
                    
                    <hr style="margin-bottom:0px;" />
                    <div class="row padding_row">
                        <div class="col-md-12"><h3 class="headh3">Job Post Info</h3></div>
                            
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Post Id</div>
                            <div class="col-md-7 col-xs-6">#{{$data[0]->id}}</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Employer Name</div>
                            <div class="col-md-7 col-xs-6">{{$data[0]->companyname}}</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Employer Id</div>
                            <div class="col-md-7 col-xs-6">#{{$data[0]->employer_id}}</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Country</div>
                            <div class="col-md-7">Qatar</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Location / Area</div>
                            <div class="col-md-7">{{$data[0]->name}}</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Company Type</div>
                            <div class="col-md-7">{{$data[0]->industrytype}} </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Date Posted</div>
                            <div class="col-md-7">{{$data[0]->created_at}}</div>
                        </div>
                        
                    </div>
                    
                    <hr style="margin-bottom:0px;" />
                    <div class="row padding_row">
                        <div class="col-md-12"><h3 class="headh3">Job Details</h3></div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Post Id</div>
                            <div class="col-md-7 col-xs-6">#{{$data[0]->id}}</div>
                        </div>    
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Email Address:</div>
                            <div class="col-md-7 col-xs-6">{{$data[0]->ContactEmail}}.</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Job Location</div>
                            <div class="col-md-7">{{$data[0]->name}}</div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue">Company Industry</div>
                            <div class="col-md-7">{{$data[0]->industrytype}}.</div>
                        </div>
                        
                       

                    
                    </div>
                    
                    <hr style="margin-bottom:0px;" />
                    <div class="row padding_row">
                        <div class="col-md-12"><h3 class="headh3">Preferred Job</h3></div>
                            
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Target Job Title:</div>
                            <div class="col-md-7 col-xs-6">{{$data[0]->jobtitle}}</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Job Role:</div>
                            <div class="col-md-7 col-xs-6">{{$data[0]->designation}}.</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Career Level:</div>
                            <div class="col-md-7 col-xs-6">Mid Career</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Target Job Location:</div>
                            <div class="col-md-7 col-xs-6">Qatar</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Career Objective:</div>
                            <div class="col-md-7 col-xs-6"> {{$data[0]->job_responsibilities}}</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Target Industry:</div>
                            <div class="col-md-7 col-xs-6">{{$data[0]->industrytypename}}</div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Employment Type:</div>
                            <div class="col-md-7 col-xs-6">Full Time Employee, Freelancer</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 col-md-offset-1 colorblue col-xs-6">Expected Salary:</div>
                            <div class="col-md-7 col-xs-6">{{$data[0]->salaryrange}}</div>
                        </div>
                        
                    </div>
                    
                    
                          
                    
                    <hr style="margin-bottom:0px;" />
                    <div class="row padding_row">
                        <div class="col-md-12"><h3 class="headh3">Experience</h3></div>
                            
                        <div class="form-row">
                             
                            <div class="col-md-11  col-md-offset-1"><p>{{$data[0]->educational_qualification}}</p></div>
                            
                              </div>
                    
                    </div>
                    <hr style="margin-bottom:0px;" />
                    
                    
                    
                  
                    
                </div>
            </div>
            
            
            
            
            
            
        
        </div>
        
        
        
        
        
        
        
    </div>



      
</div>
			
			</div>
		</div>
		
	</div>


</section>
 




	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
<script>
$(document).ready(function(){
  $(".more_icon").click(function(){
    $(".actions_buttons2").toggle();
  });
});
</script>   
    
    <style>
        .row{
            clear:both;
        }
        
        @media screen and (max-width: 500px) {
            .border-right{
                border-right: none;
                overflow: auto;
            }
            .border1 {
                margin: 0 2px;
                padding: 1px 0px;
                display: block;
                border: 1px solid #868686;
                float: left;
                font-size: 12px;
            }
            
            .action_buttons {
                float: left;
                border: 1px solid #a0a0a0;
                border-radius: 5px;
                position: relative;
                z-index: 10;
                clear: both;
                margin-top: 10px;
            }
            
        }
        
        
        
        
    </style>
    
    

    
    <style>
        
        
    .btn {
        width: 100% !important;
    border: 1px solid #e0e0e0;
    padding: 10px 8px;
        background:#FFF !important;
}
    
    .btn2{
        border: 2px dashed #cccaca;
        padding: 7px 26px;
        background: #f5f5f5;
    }
    
    .ico-03{
        float:right;
    }
    .pasuser3{
    float: left;
    width: 249px;
    padding: 30px 0 10px 0;
    color: #7889ff;
    }
    
    .bootstrap-select{
        width:100% !important;
    }
    
    .dropdown-toggle{
        width:100% !important;
    }
    
    select{
        padding:11px 18px;
    }
    
    .fr-box.fr-basic.fr-top .fr-wrapper{
        border-bottom: 1px solid #ccc;
    }
        
        
    .bootstrap-select .dropdown-menu{
        min-width: 100% !important;
    }
    
     @media (min-width: 200px) and (max-width: 480px) {
         #btnToggle{
             margin-top: -54px;
         }
         
         .ico-03{
            float:none;
        }
    } 
        
        
    </style>

	

	
  @endsection