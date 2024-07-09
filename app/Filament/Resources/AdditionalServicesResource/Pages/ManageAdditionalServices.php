<?php

namespace App\Filament\Resources\AdditionalServicesResource\Pages;

use App\Filament\Resources\AdditionalServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAdditionalServices extends ManageRecords
{
    protected static string $resource = AdditionalServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->disableCreateAnother(),
        ];
    }
}
