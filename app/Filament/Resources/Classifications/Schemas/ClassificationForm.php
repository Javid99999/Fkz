<?php

namespace App\Filament\Resources\Classifications\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ClassificationForm
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
                                    ->label('Classification (En)')
                                    ->required()
                            ]),
                    ])
            ]);


    }
}
