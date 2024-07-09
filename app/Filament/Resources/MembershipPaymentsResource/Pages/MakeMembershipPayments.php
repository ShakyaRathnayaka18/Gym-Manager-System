<?php

namespace App\Filament\Resources\MembershipPaymentsResource\Pages;

use App\Filament\Resources\MembershipPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class MakeMembershipPayments extends CreateRecord
{
    protected static string $resource = MembershipPaymentsResource::class;

    protected function getFooterActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-banknotes')
                ->label('Make Pay'),
        ];
    }
    
    public function handleCustomAction()
    {
        
    }
    
}
