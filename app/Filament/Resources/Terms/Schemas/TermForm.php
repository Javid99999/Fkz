<?php

namespace App\Filament\Resources\Terms\Schemas;

use App\Enum\ColorEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use function Pest\Laravel\options;

class TermForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                Select::make('color')
                    ->options(array_column(ColorEnum::cases(), 'name', 'value'))
                    ->enum(ColorEnum::class)
                    ->required(),
                // Select::make('responsibility_type')
                //     ->options(ResponsibleType::class)
                //     ->required(),
            ]);
    }
}
