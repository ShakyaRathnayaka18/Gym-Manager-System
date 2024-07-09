<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'plan_name',
        'additional_services',
        'total_amount',
        'note',
        'payment_method',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_name', 'name');
    }

    public function additionalServices()
    {
        return $this->belongsTo(AdditionalServices::class, 'additional_services', 'name');
    }
}
