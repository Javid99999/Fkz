<?php

namespace App\Filament\Resources\Pictograms\Pages;

use App\Filament\Resources\Pictograms\PictogramResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPictogram extends EditRecord
{
    protected static string $resource = PictogramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
