<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'number',
        'amount',
        'note',
        'date',
    ];
}
