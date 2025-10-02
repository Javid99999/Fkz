<?php

namespace App\Filament\Resources\DeliveryResponsibilities\Pages;

use App\Filament\Resources\DeliveryResponsibilities\DeliveryResponsibilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryResponsibility extends EditRecord
{
    protected static string $resource = DeliveryResponsibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
