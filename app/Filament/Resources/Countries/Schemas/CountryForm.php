<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class CountryForm
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
                                ->label('Country Name (EN)')
                                ->required()
                            ]),
                        Tab::make('TR')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->label('Ulke Adi (TR)')
                                    ->required(),
                            ]),
                        ]),
                        TextInput::make('iso_code')
                        ->required(),
        ]);
    }
}