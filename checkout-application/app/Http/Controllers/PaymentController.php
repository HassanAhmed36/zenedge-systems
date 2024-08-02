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
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        
        $data = session()->get('api_data');
        $main_data = $data['data']['merchant']['payment_gateway_credentials'];
        $publishableKey = $main_data['stripe_publish'];
        $secretKey = $main_data['stripe_secret'];

        Stripe::setApiKey($secretKey);

        $amount = str_replace(',', '', $request->input('amount')); // Remove commas from amount
        $amount = (float)$amount; // Convert to float

         try {
            $customer = Customer::create([
                'email' => $request->input('email'),
                'source' => $request->input('stripeToken'),
            ]);
    
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $amount * 100, 
                'currency' => 'usd',
                'description' => 'Payment',
            ]);
            
            
             $data = [
                'invoice_id' => session()->get('api_data')['data']['id'],
                'pay_date' => now(),
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'customer_number' => $request->number,
                'customer_country' => $request->country,
                'customer_address' => $request->address,
                'amount' => $amount,
                'status' => true,
            ];
            
            try{
                
              $response =  Http::post('https://secured2pay.com/api/update-invoice', $data);
                
                
                if (!$response->successful()) {
                   
                    return response()->json([
                        'error' => $response
                    ]);
                }
                   
                session()->forget('api_key');
               
                return response()->json(['success' => 'Payment processed successfully', 'charge' => $charge]);
                
            }catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            }
            
            
         } catch (\Exception $e) {
                return back()->withErrors('Error! ' . $e->getMessage());
         }
        
    }
}
