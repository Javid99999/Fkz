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

                        Tab::make('Azerbaycan')
                            ->schema([
                                TextInput::make('name.az')
                                    ->label('Alt Kategori Adi (AZE)')
                                    ->required(),
                            ]),

                        Tab::make('Ru')
                            ->schema([
                                TextInput::make('name.ru')
                                    ->label('Alt Kategori Adi (RU)')
                                    ->required(),
                            ]),

                        Tab::make('Chine')
                            ->schema([
                                TextInput::make('name.zhcn')
                                    ->label('Alt Kategori Adi (CHIN)')
                                    ->required(),
                            ]),

                        Tab::make('Ibranice(Izrail)')
                            ->schema([
                                TextInput::make('name.he')
                                    ->label('Alt Kategori Adi (HE)')
                                    ->required(),
                            ]),
                            
                        Tab::make('Arapca')
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('Alt Kategori Adi (AR)')
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
