<?php

namespace App\Filament\Resources\DeliveryResponsibilities\Schemas;

use App\Enum\ResponsibleType;
use App\Models\DeliveryMethod;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class DeliveryResponsibilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('delivery_method_id')
                    ->options(DeliveryMethod::pluck('code', 'id'))
                    ->required(),

                Select::make('responsibility_type')
                    ->options(ResponsibleType::class)
                    ->required(),

                Tabs::make('responsibility_value_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('responsibility_value.en')
                                ->label('Responsibility Value (EN)')
                                ->required(),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('responsibility_value.tr')
                                ->label('Sorumluluk Değeri (TR)')
                                ->required(),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('responsibility_value.az')
                                ->label('Responsibility Value (AZ)')
                                ->required(),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('responsibility_value.ru')
                                ->label('Responsibility Value (RU)')
                                ->required(),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('responsibility_value.zhcn')
                                ->label('Responsibility Value (ZH)')
                                ->required(),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('responsibility_value.he')
                                ->label('Responsibility Value (HE)')
                                ->required(),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('responsibility_value.ar')
                                ->label('Responsibility Value (AR)')
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
