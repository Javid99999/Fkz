<?php

namespace App\Filament\Resources\DeliveryMethods\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeliveryMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Incoterm (ornek : CIF, FOB)')
                    ->required(),
                TextInput::make('expansion')
                    ->label('Incoterm acilimi (ornek: Cost, Insurance and Freight)')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
