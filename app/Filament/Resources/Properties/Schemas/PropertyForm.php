<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Enum\PropertyType;
use App\Models\Category;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('language_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('name.en')
                                ->label('Property Name (EN)')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('name.tr')
                                ->label('Özellik İsmi (TR)')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('name.az')
                                ->label('Xüsusiyyət Adı (AZ)')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('name.ru')
                                ->label('Название свойства (RU)')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('name.zhcn')
                                ->label('属性名称 (ZH)')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('name.he')
                                ->label('שם המאפיין (HE)')
                                ->required()
                                ->maxLength(255),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('name.ar')
                                ->label('اسم الخاصية (AR)')
                                ->required()
                                ->maxLength(255),
                        ]),
                ]),
                MultiSelect::make('categories')
                        ->label('Category')
                        ->relationship('categories', 'name')
                        ->options(function () {
                            return Category::whereNotNull('parent_id')
                                ->pluck('name', 'id');
                        })
                        ->required(),
                Select::make('property_type')
                    ->options(PropertyType::class)
                    ->required(),
                
            ]);
    }
}
