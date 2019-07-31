

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
    <div style="margin-top:80px;" class="container">
		<div class="row">
			<div class="col-md-12 text-right">
				<span class="btn296"> <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Print </span>
				<span class="btn296"> Fillter </span>
				
			</div>
		</div>	
		
		<div class="row" style="padding-top:30px">
			<div class="col-md-12">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
        
        <tbody>
             <tr>
                <td width="12%"><b>Canditate ID</b></td>
                <td width="12%"><b>Name</b></td>
                <td width="12%"><b>Job Title</b></td>
                <td width="12%"><b>Current Location</b></td>
                <td width="12%"><b>Nationality</b></td>
                <td width="12%"><b>industry</b></td>
                <td width="12%"><b>Gender</b></td>
                <td width="12%"><b>Age</b></td>
            </tr>
            @foreach($jobseekers as $js)
            <tr>
                <td>{{$js->jobseeker_id}}</td>
                <td>{{$js->full_name}}</td>
                <td>{{$js->target_title}}</td>
                <td>{{$js->jobseeker_current_location}}</td>
                <td>{{$js->jobseeker_nationality}}</td>
                <td>{{$js->target_industry}}</td>
                <td>{{$js->jobseeker_gender}}</td>
                <td>{{$js->jobseeker_dob}}</td>
            </tr>
            @endforeach


            </tr>
        </tbody>
        
    </table>
			
			</div>
		</div>
		
	</div>


</section>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css">





	<style>
		.table-bordered>tbody>tr>td{
			color:#000;
		}
		.row{
			clear:both;
		}
		
		.textcenter img{
			height: auto;
    display: inline-block;
    text-align: center;
		}
		
		.btn296{
			margin: 0 10px 0 10px;
    padding: 3px 10px;
    border: 1px solid #000;
    color: #000;
    border-radius: 5px;
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


	@endsection