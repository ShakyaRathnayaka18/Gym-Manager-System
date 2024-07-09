<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'Full Name',
        'RFID Code',
        'Email',
        'Designation',
        'Address',
        'Contact',
        'Date of Registration',
        'Last Paid',
        'Notes',
    ]; 
}
