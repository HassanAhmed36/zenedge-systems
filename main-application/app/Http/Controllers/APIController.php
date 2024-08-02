<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function getInvoiceData(Request $request, $invoice_id)
    {
        $validator = Validator::make(['invoice_id' => $invoice_id], [
            'invoice_id' => 'required|exists:invoices,invoice_code',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invoice not found or invalid invoice ID.',
                'data' => null,
            ], 404);
        }

        try {
            $invoice = Invoice::with(['merchant', 'brand', 'service'])
                ->where('invoice_code', $invoice_id)
                ->first();

            if (!$invoice) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invoice not found.',
                    'data' => null,
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Invoice data retrieved successfully.',
                'data' => $invoice,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while retrieving invoice data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
