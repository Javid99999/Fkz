<?php

namespace App\Filament\Resources\RiskLevels\Pages;

use App\Filament\Resources\RiskLevels\RiskLevelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRiskLevels extends ListRecords
{
    protected static string $resource = RiskLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
