<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'customer_name',
        'order_date',
        'product_code',
        'item_name',
        'quantity',
        'total',
        'status',
        'customer_address',
        'customer_phone',
        'customer_email',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
