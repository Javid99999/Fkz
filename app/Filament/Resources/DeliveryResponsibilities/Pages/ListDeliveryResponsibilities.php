<?php

namespace App\Filament\Resources\DeliveryResponsibilities\Pages;

use App\Filament\Resources\DeliveryResponsibilities\DeliveryResponsibilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeliveryResponsibilities extends ListRecords
{
    protected static string $resource = DeliveryResponsibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
