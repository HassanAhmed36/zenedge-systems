<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'payment_gateway_type',
        'payment_gateway_link',
        'payment_gateway_credentials',
    ];

    protected $casts = [
        'payment_gateway_credentials' => 'array',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
