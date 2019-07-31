<?php
namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Billing;
use App\job;
use App\Employer;
use App\Jobseeker;
use App\empprofile;
use App\jbsdate;
use App\empdate;
use DB;
use App\personaldetails;
use Auth;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Input;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Constants\Constants;




//use PaypalPayment ;
//use anouar\paypalpayment\src\anouar\PaypalPayment\Facades;



class billingController extends Controller
{


    private  $_api_context;
    public function __construct()
    {
        $paypal_conf= \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret']
        ));
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function getjbsdetails($id)
    {

        $jobprofile=personaldetails::where('jobseeker_id',$id)->first();
        $jb = jobseeker::find($id);
        $email= $jb->email;
        $enumDegrees = Constants::$enumDegrees;
        $countryt=DB::table('country')->get();
        $country = [];
        foreach( $countryt as $cnt ){
            $country[$cnt->code] = $cnt->name;
        }
        return view('employer.jbs_resume',compact('jobprofile' ,'email','enumDegrees' ,'country'));

    }
    public function getJobNeeded()
    {
        $applicants =personaldetails::where('is_need',1)->orderby('date_need','desc')->paginate(10);
        $all =personaldetails::where('is_need',1)->count();
        return view('employer.job_needed_page',compact('applicants','all'));
    }


    public  function getSearchPage(Request $data)
    {
        $applicants =personaldetails::where('is_need','=',1)->Where('target_industry', 'like', '%' .$data->search  . '%')->orwhere('is_need','=',1)->Where('jobseeker_current_location', 'like', '%' .$data->search  . '%')->orderby('date_need','desc')->paginate(10);
        $all =personaldetails::where('is_need',1)->count();
        return view('employer.job_needed_page',compact('applicants','all'));
    }


    public function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    public function empcheckout($jobid)
    {
        $bill=Billing::where('job_id',$jobid)->where('status','=','Success')->get();
        $alldate=[];
        foreach ($bill as $b)
        {
            $period = self::date_range($b->startdate,$b->enddate,'+1 day','Y-m-d');
            $alldate = array_merge($alldate, $period);
        }
        $alldate = array_unique($alldate);


        return  view('employer.emp_checkout', compact('jobid','alldate'));
    }
    //check input date is valid or not
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public function getJobseekerCallback(Request $data)
    {
        if (!is_null($data->status) || !is_null($data->refID)|| !is_null($data->traID)|| !is_null($data->datetime)|| !is_null($data->amount))
        {
            if ($data->status=='success')
            {
                if (!is_null($data->referenceId))
                {
                    $bill = Billing::find($data->referenceId);
                    if (!is_null($bill))
                    {
                        if ($bill->status=="In Prograss")
                        {
                            $gatewayId = "017331242";
                            $secretKey = "2-5BpHk332zxi+jI";
                            $params = array('action' => 'Status','transactionId'=>$data->transactionId, 'gatewayId' => $gatewayId, 'secretKey' => $secretKey
                            ,  'amount' => $data->amount);
                            $client = new \GuzzleHttp\Client();
                            $res = $client->request('POST', 'https://qpayi.com:9100/api/gateway/v1.0', [
                                'form_params' => $params,
                            ]);
                            // echo $res->getBody()->getContents();

                            if ($res->getStatusCode() == 200) {
                                $jsonresult =json_decode($res->getBody(), true);
                                //echo  $jsonresult['status'];
                                if ($jsonresult['status']=='success')
                                {
                                    //var_dump($jsonresult);
                                    if ($jsonresult['transactionStatus']=='accepted')
                                    {
                                        $traSearch =Billing::where('traid',$jsonresult['transactionId']);
                                        if (!is_null($traSearch))
                                        {
                                            $bill->status="Success";
                                            $bill->traid =$jsonresult['transactionId'];
                                            //print_r($jsonresult['transactionId']);
                                            $bill->save();
                                            $pers = personaldetails::where('jobseeker_id','=',$bill->tpid)->get()->first();
                                            //$featureJob=job::find($bill->job_id);
                                            //var_dump($pers);
                                            if (!is_null($pers))
                                            {
                                                if (Carbon::parse($bill->startdate)->isToday()) {
                                                    $pers->date_need=Carbon::now();
                                                    $pers->is_need = 1;
                                                    $pers->save();

                                                }
                                                    $before = jbsdate::where('jbsid', Auth::guard('jobseeker')->user()->id)->where('start_date', '>', $bill->startdate)->where('end_date', '<', $bill->enddate)->get();
                                                if ($before->count()!=0) {
                                                        foreach ($before as $j) {
                                                            $j->start_date = $bill->startdate;
                                                            $j->end_date = $bill->enddate;
                                                            $j->save();
                                                        }

                                                } else {
                                                    $jbsdate = new JbsDate();
                                                    $jbsdate->jbsid=$bill->tpid;
                                                    $jbsdate->start_date = $bill->startdate;
                                                    $jbsdate->end_date = $bill->enddate;
                                                    $jbsdate->save();

                                                }
                                                $jbs1 =Jobseeker::find(Auth::guard('jobseeker')->user()->id);
                                                $jbs =personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->first();
                                                $email= $jbs1->email;
                                                $m=Mail::send('public.Invoice_employer', ['name'=>$jbs->first_name.$jbs->last_name,'date'=>$bill->created_at,'fname'=>'Job Needed Board Listing' ,'traid'=>$bill->traid,
                                                    'amount'=>$bill->cost,'startdate'=>$bill->startdate,'enddate'=>$bill->enddate ], function($message) use ($email)
                                                {

                                                    $message->to($email)->from("worldtalentjobs@gmail.com")->subject('Checkout');
                                                });
                                                return redirect(url('/jobseeker/success'));
                                            }else {
                                                $bill->status="Cant Find Jobseeker";
                                                $bill->save();
                                            }
                                        }else {
                                            return redirect(url('/jobseeker/failed'));
                                        }
                                    }else {
                                        return redirect(url('/jobseeker/failed'));
                                    }
                                }else {
                                    return redirect(url('/jobseeker/failed'));
                                }

                            }else {
                                echo "Somethigs Wrong Please Refresh the Page";
                            }
                        }else {
                            return redirect(url('/jobseeker/failed'));
                        }
                    }
                }
            }else {
                return redirect(url('/jobseeker/checkout'));
            }
        }else{
            return redirect(url('/jobseeker/failed'));
        }
    }
//    public function getJbsCallback(Request  $data)
//    {
//        if (!is_null($data->status) || !is_null($data->refID)|| !is_null($data->traID)|| !is_null($data->datetime)|| !is_null($data->amount))
//        {
//            if ($data->status=='success')
//            {
//                if (!is_null($data->referenceId))
//                {
//                    $bill = Billing::find($data->referenceId);
//                    if (!is_null($bill))
//                    {
//                        if ($bill->status=="In Prograss")
//                        {
//                            $gatewayId = "017331242";
//                            $secretKey = "2-5BpHk332zxi+jI";
//                            $params = array('action' => 'Status','transactionId'=>$data->transactionId, 'gatewayId' => $gatewayId, 'secretKey' => $secretKey
//                            ,  'amount' => $data->amount);
//                            $client = new \GuzzleHttp\Client();
//                            $res = $client->request('POST', 'https://demopaymentapi.qpayi.com/api/gateway/v1.0', [
//                                'form_params' => $params,
//                            ]);
//                            // echo $res->getBody()->getContents();
//
//                            if ($res->getStatusCode() == 200) {
//                                $jsonresult =json_decode($res->getBody(), true);
//                                echo  $jsonresult['status'];
//                                if ($jsonresult['status']=='success')
//                                {
//                                    if ($jsonresult['transactionStatus']=='accepted')
//                                    {
//                                        $traSearch =Billing::where('traid',$jsonresult['transactionId']);
//                                        if (!is_null($traSearch))
//                                        {
//                                                $bill->status="Success";
//                                                $bill->traid =$jsonresult['transactionId'];
//                                                //print_r($jsonresult['transactionId']);
//                                                $bill->save();
//                                                $featureJob=job::find($bill->job_id);
//                                                if (!is_null($featureJob))
//                                                {
//                                                    $featureJob->featured =1;
//                                                    $featureJob->startdate =$bill->startdate;
//                                                    $featureJob->enddate =$bill->enddate;
//                                                    $featureJob->save();
//                                                return redirect(url('/employer/success'));
//                                            }else {
//                                                $bill->status="Cant Find Job";
//                                            }
//                                        }else {
//                                            return redirect(url('/employer/failed'));
//                                        }
//                                    }else {
//                                        return redirect(url('/employer/failed'));
//                                    }
//                                }else {
//                                    return redirect(url('/employer/failed'));
//                                }
//
//                            }else {
//                                echo "Somethigs Wrong Please Refresh the Page";
//                            }
//                        }else {
//                            return redirect(url('/employer/failed'));
//                        }
//                    }
//                }
//            }else {
//                return redirect(url('/employer/failed'));
//            }
//        }else{
//            return redirect(url('/employer/failed'));
//        }
//    }


    public function getPaypalEmployerCallback(Request $data)
    {

        if (empty($data->PayerID) || empty($data->token))
        {
            return redirect(url('/employer/failed'));
        }
        $payment_id = $data->token;

        echo $payment_id;
        echo $data->PayerID;
        $payment = Payment::get($data->paymentId, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($data->PayerID);


        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        echo '<pre>';
        //var_dump($result);
        echo '<pre>';
        $x =$result->getTransactions();
        if ($result->getState() == 'approved') {
            $bill = Billing::find($x[0]->invoice_number);
            $bill->status="Success";
            $bill->save();
            $featureJob=job::find($bill->job_id);
            if (!is_null($featureJob))
            {
                if (Carbon::parse($bill->startdate)->isToday()) {
                    $featureJob->data_featured=Carbon::now();
                    $featureJob->featured = 1;
                    $featureJob->save();
                }

                $before = empdate::where('empid',$bill->job_id)->where('start_date', '>', $bill->startdate)->where('end_date', '<', $bill->enddate)->get();
                //var_dump($before);

                if ($before->count()!=0) {
                    echo "ok";
                    foreach ($before as $j)
                    {
                        //var_dump($j);
                        $j->start_date = $bill->startdate;
                        $j->end_date = $bill->enddate;
                        $j->save();
                    }

                } else {
                    echo"new";
                    $jbsdate = new empdate();
                    $jbsdate->empid=$bill->job_id;
                    $jbsdate->start_date = $bill->startdate;
                    $jbsdate->end_date = $bill->enddate;
                    $jbsdate->save();
                }

                $jbs1 =Employer::find(Auth::guard('employer')->user()->id);
                $jbs =empprofile::where('employer_id',Auth::guard('employer')->user()->id)->first();
                $email= $jbs1->email;
                $m=Mail::send('public.Invoice_employer', ['name'=>$jbs->fname.$jbs->lname,'date'=>$bill->created_at,'fname'=>'Featured Job' ,'traid'=>$bill->traid,
                    'amount'=>$bill->cost,'startdate'=>$bill->startdate,'enddate'=>$bill->enddate ], function($message) use ($email)
                {

                    $message->to($email)->from("worldtalentjobs@gmail.com")->subject('Checkout');
                });
                return redirect(url('/employer/success'));
            }else {
                $bill->status="Cant Find Job";
            }



            //\Session::put('success', 'Payment success');
            //return Redirect::to('/');

        }
    }

    public function getEmployerCallback (Request $data)
    {
        if (!is_null($data->status) || !is_null($data->refID)|| !is_null($data->traID)|| !is_null($data->datetime)|| !is_null($data->amount))
        {
            if ($data->status=='success')
            {
                if (!is_null($data->referenceId))
                {
                    $bill = Billing::find($data->referenceId);
                    if (!is_null($bill))
                    {
                        if ($bill->status=="In Prograss")
                        {
                            $gatewayId = "017331242";
                            $secretKey = "2-5BpHk332zxi+jI";
                            $params = array('action' => 'Status','transactionId'=>$data->transactionId, 'gatewayId' => $gatewayId, 'secretKey' => $secretKey
                            ,  'amount' => $data->amount);
                            $client = new \GuzzleHttp\Client();
                            $res = $client->request('POST', 'https://qpayi.com:9100/api/gateway/v1.0', [
                                'form_params' => $params,
                                ]);
                           // echo $res->getBody()->getContents();

                            if ($res->getStatusCode() == 200) {
                                $jsonresult =json_decode($res->getBody(), true);
                                echo  $jsonresult['status'];
                                if ($jsonresult['status']=='success')
                                {
                                    if ($jsonresult['transactionStatus']=='accepted')
                                    {
                                        $traSearch =Billing::where('traid',$jsonresult['transactionId']);

                                        if (!is_null($traSearch))
                                        {
                                            $bill->status="Success";
                                            $bill->traid =$jsonresult['transactionId'];
                                            print_r($jsonresult['transactionId']);
                                            $bill->save();
                                            //$featureJob=DB::table('jobs')->where('id',$data->jobid)->first();
                                            $featureJob=job::find($bill->job_id);
                                            //var_dump($featureJob);
                                            if (!is_null($featureJob))
                                            {
                                                if (Carbon::parse($bill->startdate)->isToday()) {
                                                    $featureJob->data_featured=Carbon::now();
                                                    $featureJob->featured = 1;
                                                    $featureJob->save();
                                                }

                                                $before = empdate::where('empid',$bill->job_id)->where('start_date', '>', $bill->startdate)->where('end_date', '<', $bill->enddate)->get();
                                                //var_dump($before);

                                                if ($before->count()!=0) {
                                                    echo "ok";
                                                    foreach ($before as $j)
                                                    {
                                                        //var_dump($j);
                                                        $j->start_date = $bill->startdate;
                                                        $j->end_date = $bill->enddate;
                                                        $j->save();
                                                    }

                                                } else {
                                                    echo"new";
                                                    $jbsdate = new empdate();
                                                    $jbsdate->empid=$bill->job_id;
                                                    $jbsdate->start_date = $bill->startdate;
                                                    $jbsdate->end_date = $bill->enddate;
                                                    $jbsdate->save();
                                                }

                                                $jbs1 =Employer::find(Auth::guard('employer')->user()->id);
                                                $jbs =empprofile::where('employer_id',Auth::guard('employer')->user()->id)->first();
                                                $email= $jbs1->email;
                                                $m=Mail::send('public.Invoice_employer', ['name'=>$jbs->fname.$jbs->lname,'date'=>$bill->created_at,'fname'=>'Featured Job' ,'traid'=>$bill->traid,
                                                    'amount'=>$bill->cost,'startdate'=>$bill->startdate,'enddate'=>$bill->enddate ], function($message) use ($email)
                                                {

                                                    $message->to($email)->from("worldtalentjobs@gmail.com")->subject('Checkout');
                                                });
                                                return redirect(url('/employer/success'));
                                            }else {
                                                $bill->status="Cant Find Job";
                                            }
                                        }else {
                                           return redirect(url('/employer/failed'));
                                        }
                                    }else {
                                        return redirect(url('/employer/failed'));
                                    }
                                }else {
                                    return redirect(url('/employer/failed'));
                                }

                            }else {
                                echo "Somethigs Wrong Please Refresh the Page";
                            }
                        }else {
                            return redirect(url('/employer/failed'));
                        }
                    }
                }
            }else {
                return redirect(url('/employer/failed'));
            }
        }else{
            return redirect(url('/employer/failed'));
        }
    }

    public function  getSuccess()
    {
        return view('employer.emp_success');
    }

    public function getFailed($id=0) {
        return view('employer.emp_Failed',compact('id'));
    }

    public function getPaypalJobseekerCallback(Request $data)
    {
        if (empty($data->PayerID) || empty($data->token)) {
            return redirect(url('/jobseeker/failed'));
        }
        $payment_id = $data->token;

        echo $payment_id;
        echo $data->PayerID;
        $payment = Payment::get($data->paymentId, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($data->PayerID);


        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        echo '<pre>';
        //var_dump($result);
        echo '<pre>';
        $x =$result->getTransactions();
        if ($result->getState() == 'approved') {
            $bill = Billing::find($x[0]->invoice_number);
            var_dump($bill);
            $bill->status="Success";
            $bill->save();
            $pers = personaldetails::where('jobseeker_id','=',$bill->tpid)->get()->first();
            //$featureJob=job::find($bill->job_id);
            //var_dump($pers);
            if (!is_null($pers))
            {
                if (Carbon::parse($bill->startdate)->isToday()) {
                    $pers->date_need=Carbon::now();
                    $pers->is_need = 1;
                    $pers->save();

                }
                $before = jbsdate::where('jbsid', Auth::guard('jobseeker')->user()->id)->where('start_date', '>', $bill->startdate)->where('end_date', '<', $bill->enddate)->get();
                if ($before->count()!=0) {
                    foreach ($before as $j) {
                        $j->start_date = $bill->startdate;
                        $j->end_date = $bill->enddate;
                        $j->save();
                    }

                } else {
                    $jbsdate = new JbsDate();
                    $jbsdate->jbsid=$bill->tpid;
                    $jbsdate->start_date = $bill->startdate;
                    $jbsdate->end_date = $bill->enddate;
                    $jbsdate->save();
                }
                $jbs1 =Jobseeker::find(Auth::guard('jobseeker')->user()->id);
                $jbs =personaldetails::where('jobseeker_id',Auth::guard('jobseeker')->user()->id)->first();
                $email= $jbs1->email;
                $m=Mail::send('public.Invoice_employer', ['name'=>$jbs->first_name.$jbs->last_name,'date'=>$bill->created_at,'fname'=>'Job Needed Board Listing' ,'traid'=>$bill->traid,
                    'amount'=>$bill->amount,'startdate'=>$bill->startdate,'enddate'=>$bill->enddate ], function($message) use ($email)
                {

                    $message->to($email)->from("worldtalentjobs@gmail.com")->subject('Checkout');
                });
                return redirect(url('/jobseeker/success'));


            }else {
                $bill->status="Cant Find Jobseeker";
                $bill->save();
            }

        }
    }

    public function postJbscheckout(Request $data)
    {
        if ($data->agree=='on')
        {
            if (!empty($data->chkstartdate) || !empty($data->chkenddate) )
            {
                if (self::validateDate($data->chkstartdate,'Y-m-d') ||self::validateDate($data->chkenddate,'Y-m-d') ) {
                    $chkstartdate = Carbon::parse($data->chkstartdate);
                    $chkenddate = Carbon::parse($data->chkenddate)->addHour(23);



                    if ($chkstartdate <= $chkenddate) {

                        $jbs=Jobseeker::find(Auth::guard('jobseeker')->user()->id);
                        $jbsProfile=personaldetails::where('jobseeker_id','=',Auth::guard('jobseeker')->user()->id)->get()->first();
                        $costpay =($chkstartdate->diffInDays($chkenddate)+1) * 10;
                        $costusdpay =($chkstartdate->diffInDays($chkenddate)+1) * 2.75;
                        $before = jbsdate::where('jbsid', Auth::guard('jobseeker')->user()->id)->where('start_date', '>', $chkstartdate)->where('end_date', '<', $chkenddate)->get();
                        if (!is_null($before)) {
                            echo "ok";
                            foreach ($before as $b)
                            {
                               $s = Carbon::parse($b->start_date);
                                $n =Carbon::parse($b->end_date);
                                $un =($s->diffInDays($n)+1)*10;
                                $uq =($s->diffInDays($n)+1)*2.75;
                                $costpay = $costpay-$un;
                                $costusdpay =$costusdpay -$uq;
                            }
                        }
                        if ($data->payment=='card')
                        {
                            $bill = new Billing();
                            $bill->usertype = 'Jobseeker';
                            $bill->typeservice = 'Job Needed';
                            $bill->tpid = $jbs->id;
                            $bill->cost = $costpay;
                            $bill->email = $jbs->email;
                            $bill->paymenttype = "Card";
                            $bill->status = "In Prograss";
                            $bill->startdate=$chkstartdate;
                            $bill->enddate=$chkenddate;
                            $bill->save();


                            $apiurl = "https://qpayi.com:9100/api/gateway/v1.0";
                            $amount = $costpay;
                            $gatewayId = "017331242";
                            $secretKey = "2-5BpHk332zxi+jI";
                            $ReferenceId = $bill->id;
                            $mode = "test";
                            $name = $jbsProfile->first_name.' '.$jbsProfile->last_name ;
                            $address = "Address";
                            $city = "Doha";
                            $state = "Doha";
                            if (!is_null($jbsProfile->jobseeker_phone1))
                            {
                                $phone = $jbsProfile->jobseeker_phone1;
                            }else {
                                $phone="123456";
                            }
                            $Email = $jbs->email;
                            $currency = "QAR";
                            $country = "QA";
                            $returnurl = url('/jobseeker/callback');
                            $description = "Job Needed";

                            $params = array('action' => 'capture', 'gatewayId' => $gatewayId, 'secretKey' => $secretKey, 'ReferenceId' => $ReferenceId, 'Mode' => $mode
                            , 'name' => $name, 'email' => $Email, 'address' => $address, 'city' => $city, 'state' => $state, 'phone' => $phone, 'currency' => $currency, 'returnUrl' => $returnurl, 'country' => $country,
                                'amount' => $amount, 'description' => $description, 'allow_redirects' => false);


                            $client = new \GuzzleHttp\Client();
                            $res = $client->request('POST', 'https://qpayi.com:9100/api/gateway/v1.0', [
                                'form_params' => $params,
                                'allow_redirects' => false
                            ]);


                            if ($res->getStatusCode() == 303) {
                                return redirect($res->getHeader('Location')[0]);
                            }


                            //var_dump($res->getHeaders('Content-Type')); // 200
                            echo $res->getBody()->getContents();
                        }else {
                            $bill = new Billing();
                            $bill->usertype = 'Jobseeker';
                            $bill->typeservice = 'Job Needed';
                            $bill->tpid = $jbs->id;
                            $bill->cost = $costpay;
                            $bill->email = $jbs->email;
                            $bill->paymenttype = "Paypal";
                            $bill->status = "In Prograss";
                            $bill->startdate=$chkstartdate;
                            $bill->enddate=$chkenddate;
                            $bill->save();

                            $payer = new Payer();
                            $payer->setPaymentMethod("paypal");


                            $item2 = new Item();
                            $item2->setName('Job Needed')
                                ->setCurrency('USD')
                                ->setQuantity(1)
                                ->setSku("321321") // Similar to `item_number` in Classic API
                                ->setPrice($costusdpay);

                            $itemList = new ItemList();
                            $itemList->setItems(array( $item2));

                            $details = new Details();
                            $details
                                ->setSubtotal($costusdpay);

                            $amount = new Amount();
                            $amount->setCurrency("USD")
                                ->setTotal($costusdpay)
                                ->setDetails($details);


                            $transaction = new Transaction();
                            $transaction->setAmount($amount)
                                ->setItemList($itemList)
                                ->setDescription("Payment description")
                                ->setInvoiceNumber($bill->id);

                            //$baseUrl = getBaseUrl();
                            $redirectUrls = new RedirectUrls();
                            $redirectUrls->setReturnUrl(Url::to('/jobseeker/status'))
                                ->setCancelUrl(Url::to('/jobseeker/status'));


                            $payment = new Payment();
                            $payment->setIntent("sale")
                                ->setPayer($payer)
                                ->setRedirectUrls($redirectUrls)
                                ->setTransactions(array($transaction));


                            $request = clone $payment;


                            try {
                                $payment->create($this->_api_context);
                            } catch (Exception $ex) {

                                ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
                                exit(1);
                            }


                            $approvalUrl = $payment->getApprovalLink();
                            return redirect($approvalUrl);

                            var_dump($approvalUrl);
                            echo '<pre>';
                            var_dump($payment);
                            echo '<pre>';
                            var_dump($payment->getId());
                            ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

                            return $payment;
                        }
                    } else {
                        return back()->withErrors('End Date Should be  ', 'Date');
                    }
                }

            }else {
                return back()->withErrors('You have to fill all data', 'empty');
            }
        }else {
            return back()->withErrors('Yo have To Agree term and Conditions', 'agreement');
        }
    }

    public function jbsCheckout()
    {
        $bill=Billing::where('usertype','Jobseeker')->where('tpid',Auth::guard('jobseeker')->user()->id)->where('status','=','Success')->get();
        $alldate=[];
        foreach ($bill as $b)
        {
            $period = self::date_range($b->startdate,$b->enddate,'+1 day','Y-m-d');
            $alldate = array_merge($alldate, $period);
        }
        $jobseekerdetails=personaldetails::where('jobseeker_id', Auth::guard('jobseeker')->user()->id)->get();
        $jobseekerdetails=$jobseekerdetails[0];
        return  view('jobseeker.jbs_checkout',compact('alldate','jobseekerdetails'));
    }

    public function postempCheckout(Request $data)
    {
        if ($data->agree=='on')
        {
            if (!empty($data->chkstartdate) || !empty($data->chkenddate) )
            {
                if (self::validateDate($data->chkstartdate,'Y-m-d') ||self::validateDate($data->chkenddate,'Y-m-d') ) {
                    $chkstartdate = Carbon::parse($data->chkstartdate);
                    $chkenddate = Carbon::parse($data->chkenddate)->addHours(23);



                    if ($chkstartdate <= $chkenddate) {

                        $job = job::find($data->jobid);

                        if (is_null($job))
                        {
                            return back()->withErrors('Cant find Employer ID', 'emptyid');
                        }
                        $emp=Employer::find(Auth::guard('employer')->user()->id);
                        $employerProfile=empprofile::find(Auth::guard('employer')->user()->id);
                        $costpay =($chkstartdate->diffInDays($chkenddate)+1) * 10;
                        $costusdpay =($chkstartdate->diffInDays($chkenddate)+1) * 2.75;


                        $before = empdate::where('empid', $data->jobid)->where('start_date', '>=', $chkstartdate)->where('end_date', '<=', $chkenddate)->get();
                        var_dump($before);
                        if (!is_null($before)) {
                            //echo "ok";
                            foreach ($before as $b)
                            {
                                $s = Carbon::parse($b->start_date);
                                $n =Carbon::parse($b->end_date);
                                $un =($s->diffInDays($n)+1)*10;
                                $uq =($s->diffInDays($n)+1)*2.75;
                                echo "<br>";
                                echo $un;
                                $costpay = $costpay-$un;
                                $costusdpay =$costusdpay -$uq;
                            }
                        }
                        if ($data->payment=='card')
                        {
                            $bill = new Billing();
                            $bill->usertype = 'Employer';
                            $bill->typeservice = 'Featured Job';
                            $bill->tpid = $data->jobid;
                            $bill->cost = $costpay;
                            $bill->email = $emp->email;
                            $bill->paymenttype = "Card";
                            $bill->status = "In Prograss";
                            $bill->startdate=$chkstartdate;
                            $bill->enddate=$chkenddate;
                            $bill->job_id=$data->jobid;
                            $bill->save();


                            $apiurl = "https://qpayi.com:9100/api/gateway/v1.0";
                            $amount = $costpay;
                            $gatewayId = "017331242";
                            $secretKey = "2-5BpHk332zxi+jI";
                            $ReferenceId = $bill->id;
                            $mode = "live";
                            $name = $employerProfile->fname.' '.$employerProfile->lname ;
                            $address = "Address";
                            $city = "Doha";
                            $state = "Doha";
                            if (!is_null($emp->ContactPhone))
                            {
                                $phone = $emp->ContactPhone;
                            }else {
                                $phone="123456";
                            }
                            $Email = $emp->email;
                            $currency = "QAR";
                            $country = "QA";
                            $returnurl = url('/employer/callback');
                            $description = "Lift Job";

                            $params = array('action' => 'capture', 'gatewayId' => $gatewayId, 'secretKey' => $secretKey, 'ReferenceId' => $ReferenceId, 'Mode' => $mode
                            , 'name' => $name, 'email' => $Email, 'address' => $address, 'city' => $city, 'state' => $state, 'phone' => $phone, 'currency' => $currency, 'returnUrl' => $returnurl, 'country' => $country,
                                'amount' => $amount, 'description' => $description, 'allow_redirects' => false);


                            $client = new \GuzzleHttp\Client();
                            $res = $client->request('POST', 'https://qpayi.com:9100/api/gateway/v1.0', [
                                'form_params' => $params,
                                'allow_redirects' => false
                            ]);


                            if ($res->getStatusCode() == 303) {
                                return redirect($res->getHeader('Location')[0]);
                            }


                            //var_dump($res->getHeaders('Content-Type')); // 200
                            echo $res->getBody()->getContents();
                        } else {

                            $bill = new Billing();
                            $bill->usertype = 'Employer';
                            $bill->typeservice = 'Featured Job';
                            $bill->tpid = $data->jobid;
                            $bill->cost = $costpay;
                            $bill->email = $emp->email;
                            $bill->paymenttype = "Card";
                            $bill->status = "In Prograss";
                            $bill->startdate=$chkstartdate;
                            $bill->enddate=$chkenddate;
                            $bill->job_id=$data->jobid;
                            $bill->save();


                            $payer = new Payer();
                            $payer->setPaymentMethod("paypal");


                            $item2 = new Item();
                            $item2->setName('Lift job')
                                ->setCurrency('USD')
                                ->setQuantity(1)
                                ->setSku("321321") // Similar to `item_number` in Classic API
                                ->setPrice($costusdpay);

                            $itemList = new ItemList();
                            $itemList->setItems(array( $item2));

                            $details = new Details();
                            $details
                                ->setSubtotal($costusdpay);

                            $amount = new Amount();
                            $amount->setCurrency("USD")
                                ->setTotal($costusdpay)
                                ->setDetails($details);
                            var_dump($costpay);


                            $transaction = new Transaction();
                            $transaction->setAmount($amount)
                                ->setItemList($itemList)
                                ->setDescription("Payment description")
                                ->setInvoiceNumber($bill->id);

                            //$baseUrl = getBaseUrl();
                            $redirectUrls = new RedirectUrls();
                            $redirectUrls->setReturnUrl(Url::to('/employer/status'))
                                ->setCancelUrl(Url::to('/employer/status'.$data->jobid));


                            $payment = new Payment();
                            $payment->setIntent("sale")
                                ->setPayer($payer)
                                ->setRedirectUrls($redirectUrls)
                                ->setTransactions(array($transaction));


                            $request = clone $payment;


                            try {
                                $payment->create($this->_api_context);
                            } catch (Exception $ex) {

                                ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
                                exit(1);
                            }


                            $approvalUrl = $payment->getApprovalLink();
                            return redirect($approvalUrl);

                            var_dump($approvalUrl);
                            echo '<pre>';
                            var_dump($payment);
                            echo '<pre>';
                            var_dump($payment->getId());
                            ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

                            return $payment;
                        }
                    } else {
                        return back()->withErrors('End Date Should be  ', 'Date');
                    }
                }

            }else {
                return back()->withErrors('You have to fill all data', 'empty');
            }
        }else {
            return back()->withErrors('Yo have To Agree term and Conditions', 'agreement');
        }
    }

}