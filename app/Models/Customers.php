<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'full_name',
        'registration_number',
        'rfid_code',
        'email',
        'date_of_birth',
        'date_of_register',
        'contact',
        'gender',
        'plan',
        'other_services' ,
        'height',
        'status',
        // This is a comma-separated list of service IDs
    ];

    public function plan()
{
    return $this->belongsTo(Plans::class, 'id'); // Use 'plan_id' as foreign key
}

    public function additionalServices()
    {
        return $this->belongsToMany(AdditionalServices::class, 'customer_additional_services', 'customer_id', 'additional_service_id');
    }
}
