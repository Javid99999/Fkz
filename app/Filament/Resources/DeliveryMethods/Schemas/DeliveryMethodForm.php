<?php

namespace App\Filament\Resources\DeliveryMethods\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
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
                Tabs::make('description_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('description.en')
                                ->label('Description (EN)')
                                ->required(),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('description.tr')
                                ->label('Açıklama (TR)')
                                ->required(),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('description.az')
                                ->label('Description (AZ)')
                                ->required(),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('description.ru')
                                ->label('Description (RU)')
                                ->required(),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('description.zhcn')
                                ->label('Description (ZH)')
                                ->required(),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('description.he')
                                ->label('Description (HE)')
                                ->required(),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('description.ar')
                                ->label('Description (AR)')
                                ->required(),
                        ]),
                    ]),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
