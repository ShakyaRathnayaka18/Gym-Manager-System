<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\CustomersResource;
use Filament\Resources\Pages\Page;

class Announcments extends Page
{
    protected static string $resource = CustomersResource::class;

    protected static string $view = 'filament.resources.customers-resource.pages.announcments';
}
