@extends('public.layout.public_layout')
@section('page_title')
    Checkout
@endsection
@section('style')

@endsection

@section('script')
    {{--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        @if($jobseekerdetails->completed==0)
        $( document ).ready(function() {

                   swal({
                title: "Your resume have not been completed!",
                icon: "error",
                buttons: ["Go Back"],
                dangerMode: true,
            });
        });
        @endif

    </script>
    <script>



        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }
        var alldate =[];
        var removedates=0;
        var test;
        @forelse($alldate as $d)
        test=new Date('{{$d}}'),
            alldate.push(test);
        @empty
        @endforelse

        $(document).ready(function(){
            $('#chkstartdate').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: moment(1, 'h'),
                disabledDates: [
                    @forelse($alldate as $d)
                    new Date('{{$d}}'),
                    @empty

                    @endforelse
                ]

            });
        });
        $(document).ready(function(){
            $('#chkenddate').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: moment(1, 'h'),
                disabledDates: [
                    @forelse($alldate as $d)
                    new Date('{{$d}}'),
                @empty

                @endforelse
                ]
            });
            $("label.divchkagree.chkagree").click(function(){
                if ($('.divchkagree input').is(':checked')) {
                    $("label.divchkagree.chkagree").removeClass("requireAgree");
                }else {
                    $("label.divchkagree.chkagree").addClass("requireAgree");
                }
            });
            $('#chkstartdate').on('dp.change', function(e){
                var start = $('#chkstartdateinput').val();
                var end = $('#chkenddateinput').val();

                var diff =  Math.floor(( Date.parse(end) - Date.parse(start) ) / 86400000);
                diff=diff+1;
                if (diff>0){
                    removedates=0;
                    alldate.forEach(function(element) {
                        if (formatDate(element)>=start & formatDate(element)<=end)
                        {
                            console.log(element);
                            removedates++;
                        }
                    });
                    $('#amountdays').text((diff-removedates)+" Days");
                    $('#totalPrice').text((diff-removedates)*10+".00 QAR");
                    $('#totalchkprice').text((diff-removedates)*10+".00 QAR");

                }

            })
            $('#chkenddate').on('dp.change', function(e){
                var start = $('#chkstartdateinput').val();
                var end = $('#chkenddateinput').val();

                var diff =  Math.floor(( Date.parse(end) - Date.parse(start) ) / 86400000);
                diff=diff+1;
                if (diff>0){
                    removedates=0;
                    alldate.forEach(function(element) {
                        if (formatDate(element)>=start & formatDate(element)<=end)
                        {
                            console.log(element);
                            removedates++;
                        }
                    });
                    $('#amountdays').text((diff-removedates)+" Days");
                    $('#totalPrice').text((diff-removedates)*10+".00 QAR");
                    $('#totalchkprice').text((diff-removedates)*10+".00 QAR");
                }
            })
        });

        /*
        $(document).ready(function() {
            $('#chkstartdate').datetimepicker({
                format: 'YYYY/MM/DD',

            });
            $('#chkenddate').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            $( ".databirth" ).on(function() {
                var start = new Date($('#chkstartdateinput').val());
                var end = new Date($('#chkenddateinput').val());

                var diff = new Date(end - start);
                var days = diff/1000/60/60/24;
                alert(days);
            });
        });
        */
    </script>

@endsection

@section('content')
    <div class="container-fluid checkoutpage" style="min-height: 850px">
        <form method="post" action="{{url('/jobseeker/checkout')}}">
            {{csrf_field() }}
            <div class="row">
                <div class="chktinfo col-md-7">
                    <h2 class="checkouttitle">Checkout</h2>
                    <br>
                    <br>
                    <div>
                        <img class="checkoutslideimage" src="{{url('/img/jbscheckoutimage.png')}}" alt="Check out">
                    </div>
                    <div>
                        <br><br>
                        <p>Just for QAR 10.00 per day list your Profile on our special board Job Needed and get noticed by the employers faster!</p>
                    </div>
                    <div>
                        {{--                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>--}}
                    </div>
                    <div class="">
                        <h4 class="chkchose">Choose Dates</h4>
                        <div class="col-md-3">
                            <h4>Start Date</h4>
                            <div class='input-group date' id='chkstartdate' style="    width: 100%;">
                                <input id="chkstartdateinput" required class="databirth" type='text'  name="chkstartdate" value=""
                                       style="height:40px; border-right:none;" placeholder="yyyy/mm/dd"/>
                                <!-- <small class="help_text">Date of Birth required..</small>-->
                                <span id="chkstartdate"  class="input-group-addon input-group-addon1">
                                    <img src="/icon-img/calendar.svg" style="width:30px;height:30px;">
                                </span>
                                <br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h4>End Date</h4>
                            <div class='input-group date' id='chkenddate' style="    width: 100%;">
                                <input id="chkenddateinput" required class="databirth" type='text'  name="chkenddate" value=""
                                       style="height:40px; border-right:none;" placeholder="yyyy-mm-dd"/>
                                <!-- <small class="help_text">Date of Birth required..</small>-->
                                <span id="chkenddate" class="input-group-addon input-group-addon1">
                                    <img src="/icon-img/calendar.svg" style="width:30px;height:30px;">
                                </span>
                                <br>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    @if ($errors->hasBag('emptyid'))
                        <br>
                        <div class="row" id="passworderrorbag">
                            <div class="col-md-12 ">
                                <div class="alert alert-danger" style="text-align:center;">
                                    <ul>
                                        @foreach ($errors->emptyid->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class=" col-md-3 summerycheck">
                    <div class="chkmain">
                        <div class="summerydiv">
                            <h4 class="paysummery">Payment Status</h4>
                        </div>
                        <div class="chkdaysdiv">
                            <h6 style="margin-bottom: 20px" class="chkchoose">Number of Days</h6>
                            <span id="amountdays">0 Days</span>
                        </div>

                        <div class="chkchosediv">
                            <h5 class="chkchoose">Choose Payment Type</h5>
                            <label class="rdcontainer chkdeftext">Card
                                <input type="radio" checked="checked" value="card" name="payment">
                                <span class="checkmark"></span>&nbsp;
                                <img width="50" src="{{url('/img/card.png')}}" alt="Card">
                            </label>
                            <label class="rdcontainer chkdeftext">
                                <input type="radio" value="mobile" name="payment">
                                <span class="checkmark"></span>&nbsp;
                                <img style="height: 20px;" src="{{url('/img/paypal.png')}}" alt="Mobile">
                            </label>
                        </div>
                        <div class="chkcaldate">
                            <div class="row">
                                <span class="col-md-6 chkdeftext" >Rate Per Day</span><span class=" col-md-5 chkdeftext pull-right"> 10.00 QAR</span>
                            </div>
                            <div class="row">
                                <span class="col-md-6 chkdeftext" >Sub Total</span><span id="totalPrice" class="col-md-5 chkdeftext pull-right"> 00.00 QAR</span>
                            </div>
                        </div>
                        <div class="btndiv">
                            <div class="row chktotaldiv">
                                <span class="col-md-4 chktoatltext">Total</span>
                                <span id="totalchkprice" class="col-md-8 pull-right chkendprice">00.00 QAR</span>
                            </div>
                            <label class="divchkagree chkagree requireAgree">I Agree to the Terms & Conditions
                                <input type="checkbox" name="agree">
                                <span class="checkmark"></span>
                            </label>
                            {{--                        <label class="rdcontainer chkdeftext chkagree"> I Agree to the Terms & Conditions--}}
                            {{--                            <input type="radio" checked="checked" name="agree">--}}
                            {{--                            <span class="checkmark"></span>--}}
                            {{--                        </label>--}}
                            @if($jobseekerdetails->completed==1)
                            <input class="chkbtn" type="submit" value="Proceed To Pay">
                            @else
                            <input id="btnnotcomplete" type="submit" class="chkbtn"  value="Proceed To Pay" disabled>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>


@endsection


@section('extrascript')

@endsection
