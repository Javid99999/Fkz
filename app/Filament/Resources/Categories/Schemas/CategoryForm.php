<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
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
                                ->label('Category Name (EN)')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            ]),

                        Tab::make('TR')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->label('Kategori Adi (TR)')
                                    ->required(),
                            ]),

                        Tab::make('Azerbaycan')
                            ->schema([
                                TextInput::make('name.az')
                                    ->label('Category Name (Aze)')
                                    ->required(),
                            ]),

                        Tab::make('Ru')
                            ->schema([
                                TextInput::make('name.ru')
                                    ->label('Category Name (Ru)')
                                    ->required(),
                            ]),

                        Tab::make('Chine')
                            ->schema([
                                TextInput::make('name.zhcn')
                                    ->label('Category Name (Chine)')
                                    ->required(),
                            ]),

                        Tab::make('Ibranice(Izrail)')
                            ->schema([
                                TextInput::make('name.he')
                                    ->label('Category Name (Ibranice)')
                                    ->required(),
                            ]),
                            
                        Tab::make('Arapca')
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('Category Name (Arapca)')
                                    ->required(),
                            ]),

                        ]),
                        TextInput::make('slug')
                            ->unique(\App\Models\Category::class, 'slug')
                            ->required(),
            ]);
    }
}
