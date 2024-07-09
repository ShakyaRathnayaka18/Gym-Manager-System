<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Pages\PaymentProcess;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomersResource::class;
    
  

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->disableCreateAnother(),
        ];
    }

}
