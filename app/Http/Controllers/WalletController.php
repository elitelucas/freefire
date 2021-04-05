<?php

namespace App\Http\Controllers;

use App\Models\InrDepositLimit;
use App\Models\InrDepositOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Redirect;

class WalletController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function index()
    {
        $inr_deposit_limit = InrDepositLimit::all()[0];
        return view('wallet', ['inr_deposit_limit' => $inr_deposit_limit]);
    }
    function checkout(Request $request)
    {
        $deposit_amount = $request->input('deposit_amount');
        $inr_deposit_limit = InrDepositLimit::all()[0];
        if ($deposit_amount < $inr_deposit_limit->inr_deposit_limit_min) {
            return redirect()->back()->with('amount-error', 'Deposit amount is less than minimum amount!');
        }
        if ($deposit_amount > $inr_deposit_limit->inr_deposit_limit_max) {
            return redirect()->back()->with('amount-error', 'Deposit amount is larger than maximum amount!');
        }

        return view('wallet-checkout', [
            'deposit_amount' => $deposit_amount,
        ]);
    }
    function checkoutRequest(Request $request)
    {
        $mode = "PROD"; //<------------ Change to TEST for test server, PROD for production
        extract($_POST);
        $secretKey = env('CASHFREE_SECRET_KEY');

        $inr_deposit_order = new InrDepositOrder();

        $inr_deposit_order->user_id = Auth::id();
        $inr_deposit_order->order_amount = $orderAmount;
        $inr_deposit_order->order_currency = $orderCurrency;
        $inr_deposit_order->customer_name = $customerName;
        $inr_deposit_order->customer_phone = $customerPhone;
        $inr_deposit_order->customer_email = $customerEmail;
        $inr_deposit_order->details = 'self';
        $inr_deposit_order->status = 'pending';

        $inr_deposit_order->save();

        $postData = array(
            "appId" => $appId,
            "orderId" => $inr_deposit_order->id,
            "orderAmount" => $orderAmount,
            "orderCurrency" => $orderCurrency,
            "orderNote" => $orderNote,
            "customerName" => $customerName,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => $returnUrl,
            "notifyUrl" => $notifyUrl,
        );
        ksort($postData);
        $signatureData = "";
        foreach ($postData as $key => $value) {
            $signatureData .= $key . $value;
        }
        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
        $signature = base64_encode($signature);

        if ($mode == "PROD") {
            $url = "https://www.cashfree.com/checkout/post/submit";
        } else {
            $url = "https://test.cashfree.com/billpay/checkout/post/submit";
        }


        return view('wallet-request-submit', [
            "appId" => $appId,
            "orderId" => $inr_deposit_order->id,
            "orderAmount" => $orderAmount,
            "orderCurrency" => $orderCurrency,
            "orderNote" => $orderNote,
            "customerName" => $customerName,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => $returnUrl,
            "notifyUrl" => $notifyUrl,
            "signature" => $signature,
            "url" => $url,
        ]);
    }
    function checkoutSuccess(Request $request)
    {
        $secretkey =  env('CASHFREE_SECRET_KEY');
        $orderId = $_POST["orderId"];
        $orderAmount = $_POST["orderAmount"];
        $referenceId = $_POST["referenceId"];
        $txStatus = $_POST["txStatus"];
        $paymentMode = $_POST["paymentMode"];
        $txMsg = $_POST["txMsg"];
        $txTime = $_POST["txTime"];
        $signature = $_POST["signature"];
        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
        $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
        $computedSignature = base64_encode($hash_hmac);
        if ($txStatus == "SUCCESS") {
            InrDepositOrder::where('id', $orderId)->update([
                'status' => 'paid',
                'order_id' => $orderId,
            ]);
            User::where('id', Auth::id())->increment('inr', intVal($orderAmount));
            return redirect()->route('wallet');
        } else {
            InrDepositOrder::where('id', $orderId)->update([
                'status' => 'fail',
            ]);
            return redirect()->route('wallet');
        }
    }

    public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));


        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            } catch (\Exception $e) {
                return  $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
       function transaction()
    {
        $transaction_history = InrDepositOrder::where('user_id', Auth::id())->get();
        return view('wallet-transaction', ['transaction_history' => $transaction_history]);
    }
}
