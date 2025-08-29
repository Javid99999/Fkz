<?php

namespace App\Filament\Resources\RiskLevels\Pages;

use App\Filament\Resources\RiskLevels\RiskLevelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRiskLevel extends EditRecord
{
    protected static string $resource = RiskLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
