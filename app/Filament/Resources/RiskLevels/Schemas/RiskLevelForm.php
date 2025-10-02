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
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('risk.en')
                                ->label('Enter a Risk Level (EN)')
                                ->required()
                                ->maxLength(20),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('risk.tr')
                                ->label('Risk Seviyesi Giriniz (TR)')
                                ->required()
                                ->maxLength(20),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('risk.az')
                                ->label('Risk Səviyyəsini Daxil Edin (AZ)')
                                ->required()
                                ->maxLength(20),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('risk.ru')
                                ->label('Введите уровень риска (RU)')
                                ->required()
                                ->maxLength(20),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('risk.zhcn')
                                ->label('输入风险等级 (ZH)')
                                ->required()
                                ->maxLength(20),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('risk.he')
                                ->label('הזן רמת סיכון (HE)')
                                ->required()
                                ->maxLength(20),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('risk.ar')
                                ->label('أدخل مستوى المخاطر (AR)')
                                ->required()
                                ->maxLength(20),
                        ]),
                    ]),
            ]);
    }
}
