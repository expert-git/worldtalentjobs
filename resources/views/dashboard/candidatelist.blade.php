@extends('dashboard.layout.admin_layout')
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
		<!--<div class="row">
			<div class="col-md-12 text-right">
				<span class="btn296"> <i class="fa fa-print" aria-hidden="true"></i> &nbsp; Print </span>
				<span class="btn296"> Fillter </span>
				
			</div>
		</div>-->	
		
		<div class="row" style="padding-top:30px; padding-bottom:60px;">
			<div class="col-md-12">
				<table id="candidate_list" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
             <tr>
                <th>Cadidate.ID</td>
                <th>Candidate Name</td>
                <th>Job Title</td>
                <th>Candidate Location</td>
                <th>Nationality</td>
                <th>Industry</td>
                <th>Gender</td>
                <th>Age</td>
            </tr>
		</thead>
		<tbody style="display: table-row-group;">		
            @forelse($data as $j)
            <tr>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->jobseeker_id}}</a></td>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->full_name}}</td>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->target_title}}</td>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->jobseeker_current_location}}</td>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->jobseeker_nationality}}</td>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->industrytypename}}</td>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->jobseeker_gender}}</td>
                <td><a href="/inspector/myresume/{{$j->jobseeker_id}}">{{$j->jobseeker_dob}}</td>

            </tr>
            @empty
			<tr>
              <td colspan="8"><p class="text-warning">No Data Found</p></td>
			</tr>  
            @endforelse
        </tbody>
        
    </table>
    {{--<div class="text-center"> {{$data->links()}}</div>--}}  

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


	