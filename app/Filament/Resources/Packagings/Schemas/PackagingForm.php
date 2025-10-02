<?php

namespace App\Filament\Resources\Packagings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PackagingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('packaging_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('packaging.en')
                                ->label('Packaging (EN)')
                                ->required(),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('packaging.tr')
                                ->label('Ambalaj (TR)')
                                ->required(),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('packaging.az')
                                ->label('Qablaşdırma (AZ)')
                                ->required(),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('packaging.ru')
                                ->label('Упаковка (RU)')
                                ->required(),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('packaging.zhcn')
                                ->label('包装 (ZH)')
                                ->required(),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('packaging.he')
                                ->label('אריזה (HE)')
                                ->required(),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('packaging.ar')
                                ->label('التعبئة (AR)')
                                ->required(),
                        ]),
                    ]),
            ]);
    }
}
