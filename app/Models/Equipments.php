<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_type',
        'description',
        'vendor',
        'quantity',
        'amount',
        'purchased_date',
        'telephone_number',
    ];
}
