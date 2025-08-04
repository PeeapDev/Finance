<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'card_type',
        'quantity',
        'unit_price',
        'total_amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'order_date',
        'delivery_date',
        'status'
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the school associated with this ID card order.
     */
    public function school()
    {
        return $this->belongsTo(School::class, 'customer_name', 'name');
    }

    /**
     * Get invoices related to this ID card order.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'note', 'order_number');
    }
}
