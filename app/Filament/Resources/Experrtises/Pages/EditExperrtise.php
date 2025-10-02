<?php

namespace App\Filament\Resources\Experrtises\Pages;

use App\Filament\Resources\Experrtises\ExperrtiseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExperrtise extends EditRecord
{
    protected static string $resource = ExperrtiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
