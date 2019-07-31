{{-- Header --}}
@extends('dashboard.layout.admin_layout')
@section('page_title')
HomePage
@endsection

@section('content')



<div style="margin-top:5%" class="container">
<section>
<div class="row">   
	
	
	
	
	
	

<div class="col-md-3 col-sm-12 message_userlist">
	<ul>
    @foreach($conv as $c)
		<li class="msgs" id="{{$c->id}}" jobseeker="{{$c->jobseeker}}" employer_name="{{$c->employer_name}}" employer="{{$c->employer}}">                                        
			<a href="#">
			<span class="logo1">
				<img src="/jsimage/{{$c->jobseeker}}" />
			</span>
			<span class="whatsdesc">
				<h3>{{$c->employer_name}}</h3>
			<!--	<p><i class="fas fa-arrow-down"></i> Is this job full time or part ...</p>-->
				</span>
			</a>
		</li>
		@endforeach
		
	
		
		
		
	</ul>
</div>



<div class="col-md-7 col-sm-12" >

<div id="scroller" style="max-height: 500px;overflow: scroll;">
	<div class="message_column" style="box-shadow: -7px 8px 55px -5px rgba(0,0,0,0.35); padding: 10px 0; line-height: 3; overflow:auto;">
		<div class="title_msg" >
			<span class="logo1">
				<img id="currnt" src="/img/utc.jpg" />
			</span>
			<span class="whatsdesc">
				<h3 id="crnt">Jobseeker</h3>
				<!--<p><i class="fas fa-arrow-down"></i> Hello thank you for</p>-->
			</span>
		</div>
		
		
			

        <div id="chatss">
		
		
     
	</div>

     
</div>

 
</div>

 <div class="col-8">


<input id="message" type="text">
{{csrf_field()}}
</div>
<div class="col-4">
<button id="send">Send</button>
</div>

</section>
</div>



  <script>
$(document).ready(function() {
    
var con_id=$( ".msgs" ).first().attr('id');;
var js=$( ".msgs" ).first().attr('jobseeker');;
var emp=$( ".msgs" ).first().attr('employer');;
var sender=1;
$("#currnt").attr("src","/jsimage/"+js);

$("#crnt").text($( ".msgs" ).first().attr("employer_name"));
    $(".msgs").on("click",function(e){
         con_id=$(this).attr('id');
   //  sender=$(this).attr('jobseeker');
    js=$(this).attr('jobseeker');
     emp=$(this).attr('employer'); 
     $("#crnt").text($( this ).attr("employer_name"));
    });
    var cnv={!! json_encode($conv) !!}

    console.log(cnv );
   
    $('#send').on("click",function(){
        var data={

           _token:  $("input[name='_token']").val(),
            con_id:con_id,
            message:$("#message").val(),
            sender:sender,
            js:js,
            emp:emp

        };
        console.log(data);
        $.ajax({
            url:"/addMessage",
            method :"POST",
            
            data:data,
           });
       console.log($('#message').val(""));
    });
    $('.js-example-basic-multiple').select2({
		placeholder: "Place	",
		allowClear: true

	});


    setInterval(function()
{ 
   // alert(emp);
    $.ajax({
      type:"get",
      url:"/getMessage/"+con_id,
     
      success:function(data)
      {
          data=JSON.parse(data);
          var msg='';
          for(var i=0;i<data.length;i++)
          {
             
              if(data[i].sender==0)
              {
                msg+=' <div class="incoming_msg"><span class="logo1"><img src="/jsimage/'+js+'" /></span><div class="msg_desc"><span class="arrowl"><img src="/img/arrowl.jpg" /></span><p>'+data[i].message+'</p></div><div class="date_left">'+data[i].created_at+'</div></div>';

              }
              else
              {
                msg+='<div class="incoming_msg"><span class="logo1 logo1_right"><img src="/empimage/'+emp+'" /></span><div class="msg_desc msg_desc_right"><span class="arrowr"><img src="/img/arrowr.jpg" /></span><p>'+data[i].message+'</p></div><div class="date_right">'+data[i].created_at+'</div></div></div>';

              }
          }
          $("#chatss").html(msg);
          var mydiv = $("#scroller");
mydiv.scrollTop(mydiv.prop("scrollHeight"));
          $('#scroller').scrollTop($('#scroller').scrollHeight);
          console.log(data[0]);
          //do something with response data
      }
    });
}, 2000);//time in milliseconds 

});
    </script>
  
 
<style>
	
 @media (min-width: 200px) and (max-width: 480px) {
	 .message_userlist{
		clear:both;
	}
	 
	.msg_desc{
		width:150px;
	 }
}
	
	
	
	
	

</style>



</body>
</html>

@endsection