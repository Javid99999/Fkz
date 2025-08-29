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
                        ]),
                        TextInput::make('slug')
                            ->unique(\App\Models\Category::class, 'slug')
                            ->required(),
            ]);
    }
}
