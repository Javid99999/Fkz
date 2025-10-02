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
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('name.en')
                                ->label('Classification (EN)')
                                ->required(),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('name.tr')
                                ->label('Sınıflandırma (TR)')
                                ->required(),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('name.az')
                                ->label('Classification (AZ)')
                                ->required(),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('name.ru')
                                ->label('Classification (RU)')
                                ->required(),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('name.zhcn')
                                ->label('Classification (ZH)')
                                ->required(),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('name.he')
                                ->label('Classification (HE)')
                                ->required(),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('name.ar')
                                ->label('Classification (AR)')
                                ->required(),
                        ]),
                ])

            ]);


    }
}
