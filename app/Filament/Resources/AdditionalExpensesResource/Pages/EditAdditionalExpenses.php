<?php

namespace App\Filament\Resources\AdditionalExpensesResource\Pages;

use App\Filament\Resources\AdditionalExpensesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdditionalExpenses extends EditRecord
{
    protected static string $resource = AdditionalExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
