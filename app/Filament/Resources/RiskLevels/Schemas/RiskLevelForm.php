<?php

namespace App\Filament\Resources\RiskLevels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class RiskLevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                TextInput::make('risk.en')
                                    ->label('Enter a Risk lvl')
                                    ->required()
                                    ->maxLength('20')
                            ]),
                        Tab::make('Tr')
                                ->schema([
                                    TextInput::make('risk.tr')
                                        ->label('Risk seviyesi giriniz')
                                        ->required()
                                        ->maxLength('20')
                                ])
                            
                    ])
            ]);
    }
}
