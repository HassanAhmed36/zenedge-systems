<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'brand_id',
        'service_id',
        'customer_name',
        'amount',
        'remaining_amount',
        'source',
        'type',
        'tax',
        'invoice_code',
        'invoice_url',
    ];


    public function merchant()
    {
        return $this->belongsTo(Merchants::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }


    public function service()
    {
        return $this->belongsTo(Services::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
