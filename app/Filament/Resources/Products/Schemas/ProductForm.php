<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enum\ValueParseType;
use App\Models\Category;
use App\Models\Classification;
use App\Models\Country;
use App\Models\Property;
use App\Models\RiskLevel;
use App\Models\Unit;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductForm
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
                                    ->label('Enter a Product name')
                                    ->required()
                                    ->maxLength('20')
                            ]),
                        Tab::make('Tr')
                                ->schema([
                                    TextInput::make('name.tr')
                                        ->label('Urun ismini giriniz')
                                        ->required()
                                        ->maxLength('20')
                                ])
                            
                    ]),
                TextInput::make('cas_number')
                    ->required(),

                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                Textarea::make('description.en')
                                    ->label('Description')
                                    ->rows(5)
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Tr')
                            ->schema([
                                Textarea::make('description.tr')
                                    ->label('Aciklama')
                                    ->rows(5)
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        ]),
                Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                Textarea::make('packaging.en')
                                    ->label('Packaging')
                                    ->rows(5)
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Tr')
                            ->schema([
                                Textarea::make('packaging.tr')
                                    ->label('Paketleme')
                                    ->rows(5)
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        ]),
                Select::make('category_id')
                    ->label('Select Category')
                    ->options(function () {
                            return Category::whereNotNull('parent_id')
                                ->pluck('name', 'id');
                        })
                    ->required()
                    ->reactive(),

                Select::make('country_id')
                    ->label('Select Country')
                    ->options(Country::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive(),




                Select::make('productClassifications')
                    ->label('Classifications')
                    ->relationship('productClassifications', 'name', function ($query) {
                        return $query->whereNotNull('name');
                    })
                    ->preload()
                    ->pivotData(function ($get) {
                        return [
                            'risk_level_id' => $get('risk_level_id'),
                        ];
                    })
                    ->required(),
                Select::make('risk_level_id')
                    ->label('Risk Level')
                    ->options(function () {
                        $locale = app()->getLocale();
                        return RiskLevel::all()->pluck("risk.{$locale}", 'id');
                    })
                    ->required()
                    ->afterStateHydrated(function ($component, $state, $record) {
                        if ($record) {
                            // İlk sınıflandırmanın risk_level_id'sini al
                            $classification = $record->productClassifications()->first();
                            if ($classification && $classification->pivot->risk_level_id) {
                                $component->state($classification->pivot->risk_level_id);
                            }
                        }
                    })
                    ->reactive(),

                
                Select::make('statements')
                    ->label('Statement ekle')
                    ->relationship('statements', 'name', function ($query) {
                        return $query->whereNotNull('name');
                    })
                    ->multiple()
                    ->preload()
                    ->required(),

                Select::make('pictograms')
                    ->label('Pictogram Ekle')
                    ->relationship('productPictogram', 'name', function ($query){
                        return $query->whereNotNull('name');
                    })
                    ->multiple()
                    ->preload()
                    ->required(),


                Repeater::make('properties')
                    ->label('Product Properties')
                    ->relationship('productPropertyValuess')
                    ->schema([
                        Select::make('property_id')
                            ->options(function (callable $get){
                                $categoryId = $get('../../category_id');

                                if(!$categoryId) return [];

                                return Property::whereRelation('categories', 'category_id', $categoryId)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->reactive()
                            ->required(),
                        Select::make('value_parse_type')
                            ->label('Value Type')
                            ->options(collect(ValueParseType::cases())
                                ->mapWithKeys(fn($case) => [$case->value => $case->name])
                            )
                            ->reactive()
                            ->afterStateHydrated(function ($component, $state, $record, $set){
                                $set('text_visible', $state === 'text');
                                $set('numeric_visible', $state === 'numeric');
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                $set('text_visible', $state === 'text');
                                $set('numeric_visible', $state === 'numeric');
                                
                                if ($state === 'text') {
                                        $set('numeric', null);
                                    }
                                    // Eğer numeric seçildiyse text alanını null yap
                                    if ($state === 'numeric') {
                                        $set('value', null);
                                    }
                            })
                            ->required(),

                            TextInput::make('value.en')
                            ->label('Text Value')
                            ->visible(fn($get) => $get('text_visible'))
                            ->required(fn($get) => $get('text_visible')),

                            TextInput::make('numeric')
                                ->label('Numeric Value')
                                ->visible(fn($get) => $get('numeric_visible'))
                                ->required(fn($get) => $get('numeric_visible')),


                            Select::make('unit_id')
                                ->label('Unit')
                                ->options(Unit::all()->pluck('unit', 'id'))
                                ->nullable(),
                    ])
                    ->defaultItems(1) // Varsayılan olarak 1 item ile başlatır
                    ->grid(4),


                    SpatieMediaLibraryFileUpload::make('vitrin_image')
                            ->label('Vitrin Resmi')
                            ->collection('vitrin') // tekil olsa bile gerekli
                            ->preserveFilenames()
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->default(fn ($record) => $record?->getFirstMediaUrl('vitrin', 'thumb')),
                    
                    SpatieMediaLibraryFileUpload::make('detailfoto')
                            ->label('Detay Fotoğraflar')
                            ->collection('detailfoto') // bu grup adıyla media kaydedilir
                            ->preserveFilenames()
                            ->image()
                            ->multiple() // çoklu yükleme için şart
                            ->disk('public')
                            ->visibility('public')
                            ->default(fn ($record) => $record?->getMedia('detailfoto')->map(fn ($media) => $media->getUrl('detail'))->toArray())











            ]);
    }
}

