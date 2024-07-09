<?php

namespace App\Filament\Resources\AdditionalExpensesResource\Pages;

use App\Filament\Resources\AdditionalExpensesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdditionalExpenses extends ListRecords
{
    protected static string $resource = AdditionalExpensesResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->disableCreateAnother(),
           
        ];
    }
}
