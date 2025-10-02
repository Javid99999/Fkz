<?php

namespace App\Filament\Resources\Requirements\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class RequirementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('description.en')
                                ->label('Aciklama (EN)')
                                ->required()
                            ]),
                        Tab::make('Turkce')
                            ->schema([
                                TextInput::make('description.tr')
                                    ->label('Kategori Adi (TR)')
                                    ->required(),
                            ]),
                        Tab::make('Azerbaycan dili')
                            ->schema([
                                TextInput::make('description.az')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Russian')
                            ->schema([
                                TextInput::make('description.ru')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Chinese')
                            ->schema([
                                TextInput::make('description.zhcn')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Hebrew')
                            ->schema([
                                TextInput::make('description.he')
                                    ->label('')
                                    ->required(),
                            ]),
                        Tab::make('Arabic')
                            ->schema([
                                TextInput::make('description.ar')
                                    ->label('')
                                    ->required(),
                            ]),

                        ]),
            ]);
    }
}
