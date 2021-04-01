<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InrDepositOrder;


use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;


class PaypalController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    function create(Request $request){
         $json = file_get_contents('php://input');
        $data = json_decode($json);
        // Creating an environment
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_SECRET');
        
        $environment = new ProductionEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);
        
        // Construct a request object and set desired parameters
        // Here, OrdersCreateRequest() creates a POST request to /v2/checkout/orders
        
        
        $request_order = new OrdersCreateRequest();
        $request_order->prefer('return=representation');
        $request_order->body = [
          "intent" => "CAPTURE",
          "purchase_units" => [[
            "reference_id" => "test_ref_id1",
            "amount" => [
              "value" => $data->amount,
              "currency_code" => "INR"
            ]
          ]],
          "application_context" => [
            "cancel_url" => env('APP_URL')."/wallet",
            "return_url" => env('APP_URL')."/paypal/return"
          ]
        ];
        
        try {
          // Call API with your client and get a response for your call
          $response = $client->execute($request_order);
        
          // If call returns body in response, you can get the deserialized version from the result attribute of the response
          print_r(json_encode($response));
        } catch (HttpException $ex) {
          echo $ex->statusCode;
          print_r($ex->getMessage());
        }
    }
    function capture(Request $request){
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_SECRET');
        
        $environment = new ProductionEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);
        
        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $request_order = new OrdersCaptureRequest($data->order->id);
        $request_order->prefer('return=representation');
        try {
          // Call API with your client and get a response for your call
          $response = $client->execute($request_order);
          
            $inr_deposit_order = new InrDepositOrder();

            $inr_deposit_order->user_id = Auth::id();
            $inr_deposit_order->order_id = $response->result->id;
            $inr_deposit_order->order_amount = $response->result->purchase_units[0]->amount->value;
            $inr_deposit_order->order_currency = $response->result->purchase_units[0]->amount->currency_code;
            $inr_deposit_order->customer_name = $response->result->payer->email_address;
            $inr_deposit_order->customer_email = $response->result->payer->name->given_name.' '.$response->result->payer->name->surname;
            $inr_deposit_order->details = 'self';
            $inr_deposit_order->status = 'paid';
    
            $inr_deposit_order->save();
        
          // If call returns body in response, you can get the deserialized version from the result attribute of the response
          print_r(json_encode($response));
        } catch (HttpException $ex) {
          echo $ex->statusCode;
          print_r($ex->getMessage());
        }
    }
    function return(Request $request){
        dd($request->all());
    }
 
}
