<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use App\Models\Classification;
use App\Models\Country;
use App\Models\RiskLevel;
use Filament\Forms\Components\Select;
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
                    ->multiple()
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

                















                // Select::make('productClassifications')
                //     ->label('Classification')
                //     ->options(Classification::all()->pluck('name', 'id')) // çok dil desteği için JSON’dan EN alıyoruz
                //      ->afterStateHydrated(function ($component, $state, $record) {
                //         if ($record) {
                //             // Pivot üzerinden ilk safety kaydını alıyoruz
                //             $prclass = $record->productClassifications()->first();
                //             if ($prclass) {
                //                 $component->state($prclass->id);
                //             }
                //         }
                //     })
                //     ->relationship('productClassifications', 'name', function ($query) {
                //         return $query->whereNotNull('name');
                //     })
                //     ->required(),



                // Select::make('risk_level_id')
                //     ->label('Risk Level')
                //     ->options(RiskLevel::all()->pluck('risk.en', 'id'))
                //     ->afterStateHydrated(function ($component, $state, $record) {
                //         if ($record) {
                //             // Pivot üzerinden ilk safety kaydını alıyoruz
                //             $prclass = $record->productClassifications()->first();
                //             if ($prclass) {
                //                 $component->state($prclass->risk_level_id);
                //             }
                //         }
                //     })
                //     ->required(),


            ]);
    }
}




// TextInput::make('name')
//                     ->required(),



                    
//                 TextInput::make('cas_number')
//                     ->required(),
//                 TextInput::make('description')
//                     ->required(),
//                 TextInput::make('packaging'),
//                 TextInput::make('country_id')
//                     ->required()
//                     ->numeric(),
//                 TextInput::make('category_id')
//                     ->required()
//                     ->numeric(),