@extends('layouts.master')
@section('main_section')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title fs-4 fw-semibold">All Invoices</h3>
                        <div>
                            <a href="{{ route('invoice.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i>Create Invoice
                            </a>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Merchant</th>
                                <th>Brand</th>
                                <th>Service</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Remaining Amount</th>
                                <th>Tax</th>
     
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ optional($invoice->merchant)->name }}</td>
                                    <td>{{ optional($invoice->brand)->name }}</td>
                                    <td>{{ optional($invoice->service)->name }}</td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->remaining_amount }}</td>
                                    <td>{{ $invoice->tax }}</td>
                               
                                    <td>{{ $invoice->created_at->format('d-M-Y H:i:s') }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                            onclick="copyToClipboard('{{ $invoice->invoice_url }}')">
                                            Copy URL
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(url) {
            const textarea = document.createElement('textarea');
            textarea.value = url;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('URL copied to clipboard');
        }
    </script>
@endsection
