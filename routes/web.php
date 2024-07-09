<?php


use App\Filament\Resources\MembershipPaymentsResource\Pages\EditCustomerContact;
use Illuminate\Support\Facades\Route;
use app\Filament\Resources\CustomersResource\Pages\MembershipPayments;



Route::get('/', function () {
    return view('welcome');
});
