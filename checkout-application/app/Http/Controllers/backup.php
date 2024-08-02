<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; // Ensure you have a Payment model and migration
use PayPal\Api\Amount;
use PayPal\Api\Currency;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payment as PaypalPayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Payer; // Add this line
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http; // Add this line for HTTP requests

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        // $this->apiContext = new ApiContext(
        //     new OAuthTokenCredential(
        //         env('PAYPAL_CLIENT_ID'),
        //         env('PAYPAL_SECRET')
        //     )
        // );
        // $this->apiContext->setConfig([
        //     'mode' => env('PAYPAL_MODE', 'sandbox'),
        //     'log.LogEnabled' => true,
        //     'log.FileName' => storage_path('logs/paypal.log'),
        //     'log.LogLevel' => 'INFO',
        // ]);

        // Initialize Stripe
        $this->initializeStripe();
    }

    private function initializeStripe()
    {
        $apiData = session('api_data');
        if (isset($apiData['data']['merchant']['payment_gateway_credentials'])) {
            $credentials = json_decode($apiData['data']['merchant']['payment_gateway_credentials'], true);

            if (isset($credentials['secret_key'])) {
                Stripe::setApiKey($credentials['secret_key']);
            } else {
                throw new \Exception('Stripe secret key not found in payment gateway credentials.');
            }
        } else {
            throw new \Exception('Stripe credentials not found in session data.');
        }
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        $data = $request->only([
            'name', 'email', 'phone', 'address', 'country', 'cardNumber', 'cvv', 'expiry'
        ]);


        if ($paymentMethod == 1) {
            return $this->createPaypalPayment($data, $request);
        } elseif ($paymentMethod == 2) {
            return $this->createStripePayment($data, $request);
        }

        return back()->with('error', 'Invalid payment method.');
    }

    private function createPaypalPayment($data)
    {
        // Instantiate the necessary PayPal classes
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($data['amount'])
            ->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription('Payment description');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.status'))
            ->setCancelUrl(route('payment.cancel'));

        $payment = new PaypalPayment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);
            session()->put('payment_data', $data);
            return redirect($payment->getApprovalLink());
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return back()->with('error', 'PayPal payment error: ' . $ex->getMessage());
        }
    }

    private function createStripePayment($data, $request)
    {
        try {

            $customer = Customer::create([
                'email' => $request->input('email'),
                'source' => $request->input('stripeToken'),
            ]);

            $charge = Charge::create([
                'amount' => $request->input('amount') * 100,
                'currency' => 'usd',
                'customer' => $customer->id,
                'description' => 'Payment description',
            ]);

            session()->put('payment_data', $data);
            return redirect()->route('success')->with('success', 'Payment successful.');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('error')->with('error', 'Payment failed.');
        }
    }


    public function getPaymentStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $payment = PaypalPayment::get($paymentId, $this->apiContext);

        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($payerId);

        try {
            $payment->execute($paymentExecution, $this->apiContext);

            $data = session()->get('payment_data');
            $this->storePaymentInfo($data, 'paypal');

            return redirect()->route('success')->with('success', 'Payment successful.');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('error')->with('error', 'Payment failed.');
        }
    }

    private function storePaymentInfo($data, $paymentMethod)
    {
        $id = session()->get('api_data')['data']['id'];

        try {
            $response = Http::put("https://zenedgesystems.guinnesspress.org/update-invoice/{$id}", [
                'status' => true
            ]);
            if ($response->successful()) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
