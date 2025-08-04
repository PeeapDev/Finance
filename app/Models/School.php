<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'student_count',
        'staff_count',
        'yearly_fee',
        'subscription_type',
        'subscription_start_date',
        'subscription_end_date',
        'status',
        'client_id',
        'logo_path',
    ];

    protected $casts = [
        'subscription_start_date' => 'date',
        'subscription_end_date' => 'date',
        'status' => 'boolean',
        'yearly_fee' => 'decimal:2'
    ];

    /**
     * Get the client associated with the school.
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    /**
     * Get the invoices for the school through the client.
     */
    public function invoices()
    {
        return $this->hasMany(\App\Models\Invoice::class, 'client_id', 'client_id');
    }

    /**
     * Get ID cards associated with this school.
     */
    public function idCards()
    {
        return $this->hasMany(\App\Models\IdCard::class, 'customer_name', 'name');
    }

    /**
     * Calculate total student count from ID card quantities.
     */
    public function calculateStudentCount()
    {
        return $this->idCards()->where('card_type', 'student')->sum('quantity');
    }

    /**
     * Calculate total staff count from ID card quantities.
     */
    public function calculateStaffCount()
    {
        return $this->idCards()->where('card_type', 'staff')->sum('quantity');
    }

    /**
     * Calculate total count (students + staff) from ID card quantities.
     */
    public function calculateTotalCount()
    {
        return $this->calculateStudentCount() + $this->calculateStaffCount();
    }

    /**
     * Get ID card orders for this school.
     */
    public function idCardOrders()
    {
        return $this->hasMany(IdCard::class, 'customer_name', 'name');
    }
}
