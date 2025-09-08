<?php

namespace App\Filament\Resources\ProductStatements\Pages;

use App\Filament\Resources\ProductStatements\ProductStatementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductStatements extends ListRecords
{
    protected static string $resource = ProductStatementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
