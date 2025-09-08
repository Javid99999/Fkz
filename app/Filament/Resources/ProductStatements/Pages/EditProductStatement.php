<?php

namespace App\Filament\Resources\ProductStatements\Pages;

use App\Filament\Resources\ProductStatements\ProductStatementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductStatement extends EditRecord
{
    protected static string $resource = ProductStatementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
