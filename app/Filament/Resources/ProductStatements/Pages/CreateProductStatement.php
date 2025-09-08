<?php

namespace App\Filament\Resources\ProductStatements\Pages;

use App\Filament\Resources\ProductStatements\ProductStatementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductStatement extends CreateRecord
{
    protected static string $resource = ProductStatementResource::class;
}
