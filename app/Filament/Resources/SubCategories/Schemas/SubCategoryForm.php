<?php

namespace App\Filament\Resources\SubCategories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SubCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('EN')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Alt Kategori Adi (EN)')
                                    ->minLength(2)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->required(),
                            ]),
                        Tab::make('TR')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->label('Alt Kategori Adi (TR)')
                                    ->required(),
                            ]),
                    ]),

                TextInput::make('slug')
                    ->unique(Category::class, 'slug')
                    ->required(),

                Select::make('parent_id')
                    ->searchable()
                    ->required()
                    ->options(
                        Category::whereNull('parent_id')
                            ->get()
                            ->filter(fn($cat) => $cat->getTranslation('name', 'en') !== null)
                            ->mapWithKeys(fn ($cat) => [
                                $cat->id => $cat->getTranslation('name', 'en'),
                            ])
                    ),
            ]);
    }
}
