<?php

namespace App\Filament\Resources\Pictograms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PictogramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                TextInput::make('name.en')
                                    ->required(),
                            ]),
                        Tab::make('Tr')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->required(),
                            ])
                    ]),
                TextInput::make('code')
                    ->required(),
                TextInput::make('symbol'),
            
            ]);
    }
}

