@extends('layouts.master')
@section('main_section')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fs-4 mb-3">Create Invoice</h4>
                    <hr>
                    <form action="{{ route('invoice.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="merchant" class="form-label">Merchant</label>
                                    <select class="form-select" name="merchant_id" id="merchant" required>
                                        <option value="" selected>Select Merchant</option>
                                        @foreach ($merchants as $m)
                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <select class="form-select" name="brand_id" id="brand" required>
                                        <option value="" selected>Select Brand</option>
                                        @foreach ($brands as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="service" class="form-label">Service</label>
                                    <select class="form-select" name="service_id" id="service" required>
                                        <option value="" selected>Select Service</option>
                                        @foreach ($services as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        placeholder="Enter Customer Name" value="{{ old('customer_name') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="source" class="form-label">Select Source</label>
                                    <select class="form-select" name="source" id="source" required>
                                        <option value="" selected>Select Source</option>
                                        <option value="1">PPC</option>
                                        <option value="2">Social Media Marketing</option>
                                        <option value="3">Email Marketing</option>
                                        <option value="4">SEO Marketing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Select Type</label>
                                    <select class="form-select" name="type" id="type" required>
                                        <option value="" selected>Select Type</option>
                                        <option value="1">Front</option>
                                        <option value="2">Up Sell</option>
                                        <option value="3">Remaining</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                        placeholder="Enter Amount" value="{{ old('amount') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="remaining_amount" class="form-label">Remaining Amount</label>
                                    <input type="number" class="form-control" id="remaining_amount" name="remaining_amount"
                                        placeholder="Enter Remaining Amount" value="{{ old('remaining_amount') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tax" class="form-label">Enter Tax (%)</label>
                                    <input type="number" class="form-control" id="tax" name="tax"
                                        placeholder="Enter Tax in %" value="{{ old('tax') }}" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
