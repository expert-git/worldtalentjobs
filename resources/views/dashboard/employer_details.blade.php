@extends('dashboard.layout.admin_layout')


@section('content')
<section>
   <div style="" class="container-in">

      <div class="infourl"></div>
      <div class="nav-header" >
         <nav>
            <ul class="top-nav detail">
               <li class="activeul"><a href="{{url('/inspector/employerdetail/'.$emp->id)}}">Profile</a></li>
               <li><a href="{{url('/inspector/jobposts/'.$emp->id)}}">Job Posts</a></li>
               <li><a href="{{url('/inspector/getAllCandidates/'.$emp->id)}}">Candidates</a></li>
               <li class="lastlicl"><a href="{{url('/inspector/emp/message/'.$emp->id.'/0')}}">Messages</a></li>
            </ul>
         </nav>
      </div>
      @if (empty($myprofile))
         <h2>Nothink found</h2>
      @else
         <div class="contain-in" id="printdiv">
            <div class="bodercross">
               <div class="crossover">
                  <h4>{{$myprofile->companyname}}</h4>
                  <div >Total Job Posts &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp    <b>{{$jobcount}}</b> </div>
                  <div>Total Active Posts&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp    <b>{{$activejobcount}}</b> </div>
               </div>
               <div class="print-div" onclick="printDiv('printdiv')" >
                  <div id="print"><img width="30px" height="30px" src="{{url('/img/print.png')}}" alt=""> Print </div>
               </div>
            </div>


            <div class="emp-info">
               <div>
                  <div class="tile">Employer Info</div>
                  <div class="empdivinside">
                     <div class="leftin">
                        <div>Employer  ID</div>
                        <div>Employer  Name</div>
                        <div>Location/City</div>
                        <div>Area/Zone</div>
                        <div>Company Industry</div>
                        <div>Registration Date</div>
                     </div>
                     <div class="rightin">
                        <div>{{$myprofile->id}}</div>
                        @if( $myprofile->fname != null)
                           <div> {{$myprofile->fname}} {{$myprofile->lname}}
                        </div>
                        @else
                           <div><br></div>
                        @endif

                           @if($city[0]->name!=null)<div>{{$city[0]->name }}</div>@else <div><br></div>@endif
                        @if($area1)<div>{{$area1}}</div>@else <div><br></div>@endif
                        @if($ind !=null)<div>{{$ind}}</div> @else <div><br></div>@endif
                        @if( $emp->created_at != null)
                           <div>{{$emp->created_at->format('Y/m/d')}}</div>
                           @else
                           <div><br></div>
                        @endif

                     </div>
                  </div>

               </div>
               <div>
                  <a href="{{url('/inspector/editempsettings/'.$emp->id)}}" class="editbtn">Edit</a>
               </div>
            </div>





         <div class="emp-info">

            <div>
               <div class="tile">Account Info</div>
               <div class="empdivinside">
                  <div class="leftin">
                     <div>Email Address</div>
                     <div>Mobile Phone</div>
                     <div>Website</div>
                     <div>Password</div>
                     <div>Facebook</div>
                     <div>Twiter</div>
                     <div>Linkedin</div>
                  </div>
                  <div class="rightin">
                     <div>{{$emp->ContactEmail}}</div>
                      @if( $emp->ContactPhone != null)
                        <div>
                           {{$emp->ContactPhone}}
                        </div>
                     @else
                        <div><br></div>
                     @endif
                        @if($emp->websiteaddress!=null)<div>{{$emp->websiteaddress}}</div>@else <div><br></div>@endif
                     <div>********</div>
                     @if($emp->fb)<div>{{$emp->fb}}</div>@else <div><br></div>@endif
                    @if($emp->twitter !=null) <div>{{$emp->twitter}}</div> @else <div><br></div>@endif
                     @if( $emp->linkedin != null)
                        <div>{{$emp->linkedin}}</div>
                     @else
                        <div><br></div>
                     @endif

                  </div>
               </div>

            </div>
            <div>
               <a href="{{url('/inspector/editempsettings/'.$emp->id)}}" class="editbtn">Edit</a>
            </div>
         </div>
             <div class="status-info">
               <div class="tile">Current Status</div>
                 <div class="mainstatus">
                     <div>status</div>
                     <div> Inactive
                         <label class="switch" onclick="changestatus()">
                             @if($mainemp->status==1)
                             <input type="checkbox" checked>
                                 @else
                                 <input type="checkbox">
                             @endif
                             <span class="slider round"></span>
                         </label>
                        Active
                     </div>
                     <div class="delete"><a href="{{url('/inspector/deleteaccount/'.$emp->id)}}">Delete Employer</a></div>
                 </div>
             </div>

         </div>
      @endif

   </div>


   <script>
      
      function changestatus() {
         window.location = "{{url('/inspector/changestatus/'.$emp->id)}}";

      }
      function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
      }
   </script>

</section>
@endsection


