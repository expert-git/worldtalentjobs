<?php
namespace App\Http\Controllers;
//use PaypalPayment ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
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



//use anouar\paypalpayment\src\anouar\PaypalPayment\Facades;


class PaypalPaymentController extends Controller {

    /*
    * Process payment using credit card
    */

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

    public function paywithCreditCard()
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($details);


        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(4);

        //$baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Url::to('/status'))
            ->setCancelUrl(Url::to('/status'));


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

    public function getPaymentStatus(Request $data)
    {
        /** Get the payment ID before session clear **/
        $payment_id = $data->token;

        /** clear the session payment ID **/
        //Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            //\Session::put('error', 'Payment failed');
           // return Redirect::to('/');

        }
        if (empty($data->PayerID) || empty($data->token))
        {
            return redirect(url('/employer/failed'));
        }

        echo $payment_id;
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($payment_id);

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        echo '<pre>';
        var_dump($result);
        echo '<pre>';
        if ($result->getState() == 'approved') {

            //\Session::put('success', 'Payment success');
            //return Redirect::to('/');

        }

        //\Session::put('error', 'Payment failed');
        //return Redirect::to('/');

    }

}