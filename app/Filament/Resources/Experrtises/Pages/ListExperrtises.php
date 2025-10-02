<?php

namespace App\Filament\Resources\Experrtises\Pages;

use App\Filament\Resources\Experrtises\ExperrtiseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExperrtises extends ListRecords
{
    protected static string $resource = ExperrtiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
