<?php

namespace App\Filament\Resources\DeliveryInfos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class DeliveryInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('delivery.en')
                                ->label('Delivery (EN)')
                                ->required()
                            ]),
                        Tab::make('Turkce')
                            ->schema([
                                TextInput::make('delivery.tr')
                                    ->label('Ulasim (TR)')
                                    ->required(),
                            ]),
                        Tab::make('Azerbaycan dili')
                            ->schema([
                                TextInput::make('delivery.az')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Russian')
                            ->schema([
                                TextInput::make('delivery.ru')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Chinese')
                            ->schema([
                                TextInput::make('delivery.zhcn')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Hebrew')
                            ->schema([
                                TextInput::make('delivery.he')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Arabic')
                            ->schema([
                                TextInput::make('delivery.ar')
                                    ->label('')
                                    ->required(),
                            ]),

                        ]),
                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('loading.en')
                                ->label('Loading (EN)')
                                ->required()
                            ]),
                        Tab::make('Turkce')
                            ->schema([
                                TextInput::make('loading.tr')
                                    ->label('Nakliyat (TR)')
                                    ->required(),
                            ]),
                        Tab::make('Azerbaycan dili')
                            ->schema([
                                TextInput::make('loading.az')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Russian')
                            ->schema([
                                TextInput::make('loading.ru')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Chinese')
                            ->schema([
                                TextInput::make('loading.zhcn')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Hebrew')
                            ->schema([
                                TextInput::make('loading.he')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Arabic')
                            ->schema([
                                TextInput::make('loading.ar')
                                    ->label('')
                                    ->required(),
                            ]),

                        ]),




            ]);
    }
}
