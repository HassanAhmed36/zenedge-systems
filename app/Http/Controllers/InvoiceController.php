<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Invoice;
use App\Models\Merchants;
use App\Models\Services;
use Illuminate\Http\Request;


use App\Models\Merchant;

use Illuminate\Support\Str;
use Exception;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with(['brand', 'service'])->get();
        return view('Invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brands::all();
        $services = Services::all();
        $merchants = Merchants::all();
        return view('Invoice.create', compact('brands', 'services', 'merchants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'brand_id' => 'required|exists:brands,id',
            'service_id' => 'required|exists:services,id',
            'customer_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'remaining_amount' => 'required|numeric|min:0',
            'source' => 'required|integer',
            'type' => 'required|integer',
            'tax' => 'required|numeric|min:0',
        ]);

        try {

            $merchant = Merchants::findOrFail($request->input('merchant_id'));
            $invoiceCode = Str::upper(Str::random(12));
            $invoiceUrl = $merchant->payment_gateway_link . '/' . $invoiceCode;
            $invoice = Invoice::create([
                'merchant_id' => $request->input('merchant_id'),
                'brand_id' => $request->input('brand_id'),
                'service_id' => $request->input('service_id'),
                'customer_name' => $request->input('customer_name'),
                'amount' => $request->input('amount'),
                'remaining_amount' => $request->input('remaining_amount'),
                'source' => $request->input('source'),
                'type' => $request->input('type'),
                'tax' => $request->input('tax'),
                'invoice_code' => $invoiceCode,
                'invoice_url' => $invoiceUrl,
            ]);

            return redirect()->route('invoice.index')->with('success', 'Invoice created successfully.');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
