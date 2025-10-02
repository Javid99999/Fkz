<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enum\ValueParseType;
use App\Models\Category;
use App\Models\Classification;
use App\Models\Country;
use App\Models\DeliveryInfo;
use App\Models\Property;
use App\Models\RiskLevel;
use App\Models\Unit;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Console\View\Components\Secret;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Grid::make(2)
                    ->schema([
                        Tabs::make('language_tabs')
                        ->tabs([
                            Tab::make('EN')
                                ->schema([
                                    TextInput::make('name.en')
                                        ->label('Enter a Product Name (EN)')
                                        ->required()
                                        ->maxLength(20),
                                ]),

                            Tab::make('TR')
                                ->schema([
                                    TextInput::make('name.tr')
                                        ->label('Ürün İsmini Giriniz (TR)')
                                        ->required()
                                        ->maxLength(20),
                                ]),

                            Tab::make('AZ')
                                ->schema([
                                    TextInput::make('name.az')
                                        ->label('Məhsul Adını Daxil Edin (AZ)')
                                        ->required()
                                        ->maxLength(20),
                                ]),

                            Tab::make('RU')
                                ->schema([
                                    TextInput::make('name.ru')
                                        ->label('Введите название продукта (RU)')
                                        ->required()
                                        ->maxLength(20),
                                ]),

                            Tab::make('ZH')
                                ->schema([
                                    TextInput::make('name.zhcn')
                                        ->label('输入产品名称 (ZH)')
                                        ->required()
                                        ->maxLength(20),
                                ]),

                            Tab::make('HE')
                                ->schema([
                                    TextInput::make('name.he')
                                        ->label('הזן שם מוצר (HE)')
                                        ->required()
                                        ->maxLength(20),
                                ]),

                            Tab::make('AR')
                                ->schema([
                                    TextInput::make('name.ar')
                                        ->label('أدخل اسم المنتج (AR)')
                                        ->required()
                                        ->maxLength(20),
                                ]),
                            ]),
                        TextInput::make('cas_number')
                            ->required(),
                        

                        Select::make('country_id')
                            ->label('Select Country')
                            ->options(Country::all()->pluck('name', 'id'))
                            ->required()
                            ->reactive(),

                        Select::make('category_id')
                            ->label('Select Category')
                            ->options(function () {
                                    return Category::whereNotNull('parent_id')
                                        ->pluck('name', 'id');
                                })
                            ->required()
                            ->reactive(),

                    ]),



                // Tabs::make('language_tabs')
                //     ->tabs([
                //         Tab::make('En')
                //             ->schema([
                //                 TextInput::make('name.en')
                //                     ->label('Enter a Product name')
                //                     ->required()
                //                     ->maxLength('20')
                //             ]),
                //         Tab::make('Tr')
                //                 ->schema([
                //                     TextInput::make('name.tr')
                //                         ->label('Urun ismini giriniz')
                //                         ->required()
                //                         ->maxLength('20')
                //                 ])
                            
                //     ]),
                // TextInput::make('cas_number')
                //     ->required(),

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

                Tabs::make('packaging_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('packaging.en')
                                ->label('Packaging (EN)')
                                ->required(),
                        ]),

                    Tab::make('TR')
                        ->schema([
                            TextInput::make('packaging.tr')
                                ->label('Ambalaj (TR)')
                                ->required(),
                        ]),

                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('packaging.az')
                                ->label('Qablaşdırma (AZ)')
                                ->required(),
                        ]),

                    Tab::make('RU')
                        ->schema([
                            TextInput::make('packaging.ru')
                                ->label('Упаковка (RU)')
                                ->required(),
                        ]),

                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('packaging.zhcn')
                                ->label('包装 (ZH)')
                                ->required(),
                        ]),

                    Tab::make('HE')
                        ->schema([
                            TextInput::make('packaging.he')
                                ->label('אריזה (HE)')
                                ->required(),
                        ]),

                    Tab::make('AR')
                        ->schema([
                            TextInput::make('packaging.ar')
                                ->label('التعبئة (AR)')
                                ->required(),
                        ]),
                ]),
                // Select::make('category_id')
                //     ->label('Select Category')
                //     ->options(function () {
                //             return Category::whereNotNull('parent_id')
                //                 ->pluck('name', 'id');
                //         })
                //     ->required()
                //     ->reactive(),

                // Select::make('country_id')
                //     ->label('Select Country')
                //     ->options(Country::all()->pluck('name', 'id'))
                //     ->required()
                //     ->reactive(),


                Grid::make(2)
                    ->schema([
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

                        Select::make('productCountryShipment')
                            ->label('Satisin uygun oldgu ulkeler')
                            ->relationship('productCountryShipment', 'name', function ($query) {
                                return $query->whereNotNull('name');
                            })
                            ->multiple()
                            ->preload()
                            ->required(),

                        
                        Select::make('productTerms')
                            ->label('Ticaret Kurallari ekle')
                            ->relationship('productTerms', 'name',function ($query) {
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

                        Select::make('requireDoc')
                            ->label('Talep edilen belgeler')
                            ->relationship('requireDoc', 'name', function ($query) {
                                return $query->whereNotNull('name');
                            })
                            ->multiple()
                            ->preload()
                            ->required(),

                        // Select::make('deliverInfo')
                        //     ->label('Teslimat Bilgisi')
                        //     ->options(DeliveryInfo::all()->mapWithKeys(function ($item) {
                        //         return [$item->id => $item->delivery ?: $item->loading];
                        // })->toArray())

                        
                        Select::make('delivery_info_id')
                            ->label('Delivery Info')
                            ->options(DeliveryInfo::all()->pluck('delivery', 'id'))
                            ->required()
                            ->reactive(),

                        Select::make('productPackaging')
                            ->label('Ticaret Kurallari ekle')
                            ->relationship('productPackaging', 'packaging',function ($query) {
                                return $query;
                            })
                            ->multiple()
                            ->preload()
                            ->required(),
            
                    ]),


                // Select::make('productClassifications')
                //     ->label('Classifications')
                //     ->relationship('productClassifications', 'name', function ($query) {
                //         return $query->whereNotNull('name');
                //     })
                //     ->preload()
                //     ->pivotData(function ($get) {
                //         return [
                //             'risk_level_id' => $get('risk_level_id'),
                //         ];
                //     })
                //     ->required(),
                // Select::make('risk_level_id')
                //     ->label('Risk Level')
                //     ->options(function () {
                //         $locale = app()->getLocale();
                //         return RiskLevel::all()->pluck("risk.{$locale}", 'id');
                //     })
                //     ->required()
                //     ->afterStateHydrated(function ($component, $state, $record) {
                //         if ($record) {
                //             // İlk sınıflandırmanın risk_level_id'sini al
                //             $classification = $record->productClassifications()->first();
                //             if ($classification && $classification->pivot->risk_level_id) {
                //                 $component->state($classification->pivot->risk_level_id);
                //             }
                //         }
                //     })
                //     ->reactive(),

                
                // Select::make('statements')
                //     ->label('Statement ekle')
                //     ->relationship('statements', 'name', function ($query) {
                //         return $query->whereNotNull('name');
                //     })
                //     ->multiple()
                //     ->preload()
                //     ->required(),

                // Select::make('pictograms')
                //     ->label('Pictogram Ekle')
                //     ->relationship('productPictogram', 'name', function ($query){
                //         return $query->whereNotNull('name');
                //     })
                //     ->multiple()
                //     ->preload()
                //     ->required(),


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



                    SpatieMediaLibraryFileUpload::make('detailfoto')
                        ->label('Fotoğraflar')
                        ->collection('detailfoto')
                        ->image()
                        ->multiple()
                        ->preserveFilenames()
                        ->disk('public')
                        ->visibility('public'),

                    
                    SpatieMediaLibraryFileUpload::make('pdfs')
                        ->label('PDF Dosyaları')
                        ->collection('pdfs')
                        ->acceptedFileTypes(['application/pdf']) // image() yerine bu
                        ->multiple() // Birden fazla PDF için
                        ->preserveFilenames()
                        ->disk('public')
                        ->visibility('public')
                        ->downloadable() // PDF'ler için önemli
                        ->openable() // PDF'i tarayıcıda açmak için
                        ->maxSize(10240) // 10MB limit
                        ->maxFiles(5), // Maksimum dosya sayısı (opsiyonel)
                    




            ]);
    }
}















// SpatieMediaLibraryFileUpload::make('vitrin_image')
                    //         ->label('Vitrin Resmi')
                    //         ->collection('vitrin') // tekil olsa bile gerekli
                    //         ->preserveFilenames()
                    //         ->image()
                    //         ->disk('public')
                    //         ->visibility('public')
                    //         ->default(fn ($record) => $record?->getFirstMediaUrl('vitrin', 'thumb')),
                    
                    // SpatieMediaLibraryFileUpload::make('detailfoto')
                    //         ->label('Detay Fotoğraflar')
                    //         ->collection('detailfoto') // bu grup adıyla media kaydedilir
                    //         ->preserveFilenames()
                    //         ->image()
                    //         ->multiple() // çoklu yükleme için şart
                    //         ->disk('public')
                    //         ->visibility('public')
                    //         ->default(fn ($record) => $record?->getMedia('detailfoto')->map(fn ($media) => $media->getUrl('detail'))->toArray())
                    