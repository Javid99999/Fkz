<?php

namespace App\Filament\Resources\DeliveryResponsibilities\Schemas;

use App\Enum\ResponsibleType;
use App\Models\DeliveryMethod;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeliveryResponsibilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('delivery_method_id')
                    ->options(DeliveryMethod::pluck('code', 'id'))
                    ->required(),

                Select::make('responsibility_type')
                    ->options(ResponsibleType::class)
                    ->required(),

                TextInput::make('responsibility_value.en')
                    ->required(),
                    
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
