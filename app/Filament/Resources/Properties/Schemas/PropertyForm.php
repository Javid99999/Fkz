<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Enum\PropertyType;
use App\Models\Category;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Property Name (En)')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Tab::make('Tr')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->label('Ozellik ismi (Tr)')
                                    ->required()
                                    ->maxLength(255)
                            ]),
                        ]),
                MultiSelect::make('categories')
                        ->label('Category')
                        ->relationship('categories', 'name')
                        ->options(function () {
                            return Category::whereNotNull('parent_id')
                                ->pluck('name', 'id');
                        })
                        ->required(),
                Select::make('property_type')
                    ->options(PropertyType::class)
                    ->required(),
                
            ]);
    }
}
