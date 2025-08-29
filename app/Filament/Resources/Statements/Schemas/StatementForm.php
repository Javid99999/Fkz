<?php

namespace App\Filament\Resources\Statements\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class StatementForm
{
    public static function configure(Schema $schema): Schema
    {
        // return $schema
        //     ->components([
        //         TextInput::make('name.en')
        //             ->required(),
        //     ]);

        return $schema
            ->schema([
                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Statement Name (En)')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Tab::make('Tr')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->label('Statement ismi (Tr)')
                                    ->required()
                                    ->maxLength(255)
                            ]),
                        ]),
                
                
            ]);
    }
}
