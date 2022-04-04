<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PaypalPayoutsSDK\Core\PayPalHttpClient as CorePayPalHttpClient;
use PaypalPayoutsSDK\Core\SandboxEnvironment as CoreSandboxEnvironment;
use Sample\PayPalClient;
use PaypalPayoutsSDK\Payouts\PayoutsPostRequest;
use PayPalCheckoutSdk\Orders\OrdersAuthorizeRequest;

class PaypalController extends Controller
{
  public function getCheckout()
  {
    $clientID = env('PAYPAL_CLIENT_ID');
    $clientSecret = env('PAYPAL_CLIENT_SECRET');

    $environment = new CoreSandboxEnvironment($clientID, $clientSecret);
    $client = new CorePayPalHttpClient($environment);

    $order = Order::findOrFail(session()->get('order_id'));
    //dd($order);
    $amount = $order->total_amount;

    $request = new OrdersCreateRequest();

    $body = json_decode(
      '{
        "sender_batch_header": {
          "sender_batch_id": "2014021801",
          "recipient_type": "EMAIL",
          "email_subject": "You have money!",
          "email_message": "You received a payment. Thanks for using our service!"
        },
        "items": [
          {
            "amount": {
              "value": "9.87",
              "currency": "USD"
            },
            "sender_item_id": "201403140001",
            "recipient_wallet": "PAYPAL",
            "receiver": "<receiver@example.com>"
          },
          {
            "amount": {
              "value": "112.34",
              "currency": "USD"
            },
            "sender_item_id": "201403140002",
            "recipient_wallet": "PAYPAL",
            "receiver": "<receiver2@example.com>"
          },
          {
            "recipient_type": "PHONE",
            "amount": {
              "value": "5.32",
              "currency": "USD"
            },
            "note": "Thanks for using our service!",
            "sender_item_id": "201403140003",
            "recipient_wallet": "VENMO",
            "receiver": "<408-234-1234>"
          }
        ]
      }',
      true
    );
    $request->body = $body;
    $client = PayPalClient::client();
    // dd($client);
    $response = $client->execute($request);
    // dd($response);
    print "Status Code: {$response->statusCode}\n";
    print "Status: {$response->result->batch_header->batch_status}\n";
    print "Batch ID: {$response->result->batch_header->payout_batch_id}\n";
    print "Links:\n";
    foreach ($response->result->links as $link) {
      print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
    }
    echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
  }


  public function getCancel(Request $request)
  {
    $request->session()->forget('order_id');
    return redirect()->route('index')->with('error', 'Sorry Payment Cancelled');
  }

  public function getDone(Request $request)
  {
    $clientID = env('PAYPAL_CLIENT_ID');
    $clientSecret = env('PAYPAL_CLIENT_SECRET');

    $environment = new SandboxEnvironment($clientID, $clientSecret);
    $client = new PayPalHttpClient($environment);

    $orderCaptureRequest = new OrderCaptureRequest($request->token);
    $orderCaptureRequest->prefer('return=representation');

    try {
      $response = $client->execute($orderCaptureRequest);
      $orderController = new OrderController;
      return $orderController->checkout_done($request->session()->get('order_id'), json_encode($response));
    } catch (HttpException $ex) {
      dd($ex);
    }
  }
}
