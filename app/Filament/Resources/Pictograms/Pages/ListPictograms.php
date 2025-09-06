<?php

namespace App\Filament\Resources\Pictograms\Pages;

use App\Filament\Resources\Pictograms\PictogramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPictograms extends ListRecords
{
    protected static string $resource = PictogramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
