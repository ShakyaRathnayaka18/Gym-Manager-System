<?php

namespace App\Filament\Resources\RetailProductsResource\Pages;

use App\Filament\Resources\RetailProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRetailProducts extends ManageRecords
{
    protected static string $resource = RetailProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
