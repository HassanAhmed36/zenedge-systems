<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function index($invoice_id)
    {
        if(request()->fullUrl() == "https://secured2pay.com/success"){
            return redirect()->route('success');
        }
        $response = Http::get("https://secured2pay.com/get-invoice-data/{$invoice_id}");
        $statusCode = $response->status();

        if ($statusCode === 404 || $statusCode === 500) {
            abort(403);
        }

        if ($statusCode === 200) {
            $data = $response->json();

            
           if ($data['data']['status'] == 1) {
                abort(403,'Link Expire');
            }

            session()->put('api_data', $data);
            return view('welcome', compact('data'));
        }

        abort(403);
    }
}
