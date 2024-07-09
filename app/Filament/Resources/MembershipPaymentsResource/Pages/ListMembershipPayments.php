<?php

namespace App\Filament\Resources\MembershipPaymentsResource\Pages;

use App\Filament\Resources\MembershipPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembershipPayments extends ListRecords
{
    protected static string $resource = MembershipPaymentsResource::class;
    
    
    protected function getHeaderActions(): array
    {
        return [

            Actions\CreateAction::make(),
        ];
    }
}
