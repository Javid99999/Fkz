<?php

namespace App\Filament\Resources\Terms\Schemas;

use App\Enum\ColorEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use function Pest\Laravel\options;

class TermForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('name_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('name.en')
                                ->label('Name (EN)')
                                ->required(),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('name.tr')
                                ->label('Ad (TR)')
                                ->required(),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('name.az')
                                ->label('Ad (AZ)')
                                ->required(),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('name.ru')
                                ->label('Имя (RU)')
                                ->required(),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('name.zhcn')
                                ->label('名称 (ZH)')
                                ->required(),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('name.he')
                                ->label('שם (HE)')
                                ->required(),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('name.ar')
                                ->label('الاسم (AR)')
                                ->required(),
                        ]),
                ]),
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
                Select::make('color')
                    ->options(array_column(ColorEnum::cases(), 'name', 'value'))
                    ->enum(ColorEnum::class)
                    ->required(),
                // Select::make('responsibility_type')
                //     ->options(ResponsibleType::class)
                //     ->required(),
            ]);
    }
}
