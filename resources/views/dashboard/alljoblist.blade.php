@extends('dashboard.layout.admin_layout')
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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


</style>
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


@section('content')
<section>
    <div style="margin-top:80px; margin-left: 50px;margin-right: 50px;" class="">


        <div class="row" style="padding-top:30px">
            <div class="col-md-12">
                <div style="float: right">
                    <button onclick="exportTableToExcel('maintable', 'data')" class="btnde btnexcel"><img width="30px" height="30px" src="{{url('/img/excel.png')}}" alt="">&nbsp Excel</button>
                    <button id="pdfbtn" class="btnde btnpdf"><img width="30px" height="30px" src="{{url('/img/redpdf.png')}}" alt="">&nbsp Pdf</button>
                    <button onclick="PrintElem('#maintable')" class="btnde btnprint"><img width="30px" height="30px" src="{{url('/img/print.png')}}" alt="">&nbsp Print</button>
                    <div class="dpkdiv"><span>From</span><input type="text" class="datepicker datepicker1 dpk1"></div>
                    <div class="dpkdiv"><span>To</span><input type="text" class="datepicker datepicker1 dpk2"></div>
                </div>
                <div id="datachange">
                    <table id="maintable"  cellpadding="20" id="postlist" class="table table-striped" style="width:100%">
                        <thead>
                        <tr class="firstrow">
                            <th width="12%"><b>Employer.ID</b></th>
                            <th width="12%"><b>Employer</b></th>
                            <th width="12%"><b>Job Title</b></th>
                            <th width="14%"><b>Email</b></th>
                            <th width="12%"><b>Phone Number</b></th>
                            <th width="12%"><b>Registration Date</b></th>
                            <th width="12%"><b>Expiry Date</b></th>
                            <th width="12%"><b>Status</b></th>
                        </tr>
                        </thead>

                        <tbody style="display: table-row-group;">
                        @forelse($data as $j)
                            <?php if($j->published==1)
                            {
                                $j->published="Active";
                            }
                            else
                            {
                                $j->published="Inactive";
                            }
                            ?>
                            <tr>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->id}}</a></td>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->companyname}}</td>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->jobtitle}}</td>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->ContactEmail}}</td>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->ContactPhone}}</td>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->created_at}}</td>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->deadline}}</td>
                                <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->published}}</td>
                            </tr>



                        @empty
                            <p class="text-warning">No Job Found</p>

                        @endforelse

                        </tbody>

                    </table>

                    <div class="text-center"> {{$data->links()}}</div>
                </div>
            </div>
        </div>

    </div>


</section>



@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                language: 'en',
                format: 'yyyy-MM-dd'
            });
            $('.dpk2').datepicker("setDate" , 'today')
            $('.dpk1').datepicker("setDate" , "-1d")

            $('.dpk1').change(function() {
                //var s = $('.dpk1').datepicker('getDate');
               // var e = $('.dpk2').datepicker('getDate');
                var dates = $('.dpk1').datepicker('getDate'),
                    day  = dates.getDate(),
                    month = dates.getMonth() + 1,
                    year =  dates.getFullYear();
                sdate=year + '-' + month + '-' + day;
                var daten = $('.dpk2').datepicker('getDate'),
                    day  = daten.getDate(),
                    month = daten.getMonth() + 1,
                    year =  daten.getFullYear();
                ndate=year + '-' + month + '-' + day;
                window.location.replace("{{url('/inspector/joblist')}}"+"/"+sdate+"/"+ndate);


            });
            $('.dpk2').change(function() {
                //var s = $('.dpk1').datepicker('getDate');
                // var e = $('.dpk2').datepicker('getDate');
                var dates = $('.dpk1').datepicker('getDate'),
                    day  = dates.getDate(),
                    month = dates.getMonth() + 1,
                    year =  dates.getFullYear();
                sdate=year + '-' + month + '-' + day;
                var daten = $('.dpk2').datepicker('getDate'),
                    day  = daten.getDate(),
                    month = daten.getMonth() + 1,
                    year =  daten.getFullYear();
                ndate=year + '-' + month + '-' + day;
                window.location.replace("{{url('/inspector/joblist')}}"+"/"+sdate+"/"+ndate);


            });


        });

        $("body").on("click", "#pdfbtn", function () {
            html2canvas($('#maintable')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
        function printData()
        {
            var divToPrint=document.getElementById("maintable");
            newWin= window.open("");
            newWin.document.write("<style>\n" +
                "    table tr {\n" +
                "        border: 1px solid black;\n" +
                "    }\n" +
                "</style>"+divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

        function PrintElem(elem)
        {
            Popup($('<div/>').append($(elem).clone()).html());
        }

        function Popup(data)
        {
            var mywindow = window.open('', 'my div', 'height=400,width=600');
            mywindow.document.write('<html><head><title>Print</title>');
            mywindow.document.write('<style> table{border-collapse: collapse; font-size: 14px;} tr { border: 1px solid rgb(128, 128, 128); padding: 50px; line-height: 25px;' +
                ';} a { color: black; text-decoration: none;}</style>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');

            mywindow.print();
            mywindow.close();

            return true;
        }


        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    </script>
@endsection


	