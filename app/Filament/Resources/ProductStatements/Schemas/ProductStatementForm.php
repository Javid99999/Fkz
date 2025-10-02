<?php

namespace App\Filament\Resources\ProductStatements\Schemas;

use App\Models\Product;
use App\Models\ProductStatement;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductStatementForm
{
    public static function configure(Schema $schema): Schema
    {


        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Product')
                    ->options(Product::all()->pluck('name','id'))
                    ->dehydrated(false) // Sadece UI için
                    ->reactive()
                    ->required()
                    ->afterStateHydrated(function ($state, callable $set, $get, $record) {
                        if ($record && $record->productStatement) {
                            $set('product_id', $record->productStatement->product_id);
                        }
                    }),

                Select::make('product_statement_id')
                    ->label('Statement')
                    ->options(fn ($get) => ProductStatement::where('product_id', $get('product_id'))
                    ->with('statement')
                    ->get()
                    ->pluck('statement.name', 'id'))
                    ->required()
                    ->afterStateHydrated(function ($state, callable $set, $get, $record) {
                        if ($record && !$state) {
                            $set('product_statement_id', $record->product_statement_id);
                        }
                    }),

                TextInput::make('code')
                    ->label('Secure Code')
                    ->required(),

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
            ]);
        
    }
}









// return $schema
        //     ->components([
        //         // Dummy field - kaydetmeyelim
        //         Hidden::make('id')->default(1),
                
        //         Select::make('product_id')
        //             ->label('Product')
        //             ->options(Product::all()->pluck('name','id'))
        //             ->dehydrated(false)
        //             ->reactive()
        //             ->required(),

        //         Repeater::make('securecodes')
        //             ->label('Statements / Codes')
        //             ->relationship()
        //             ->schema([
        //                 Select::make('product_statement_id')
        //                         ->label('Statement')
        //                         ->options(fn ($get) => ProductStatement::where('product_id', $get('../../product_id'))
        //                         ->with('statement')
        //                         ->get()
        //                         ->pluck('statement.name', 'id'))
        //                         ->required(),
        //                 TextInput::make('code')
        //                     ->label('Secure Code')
        //                     ->required(),
        //                 Tabs::make('language')
        //                     ->tabs([
        //                         Tab::make('En')
        //                             ->schema([
        //                                 Textarea::make('description.en')
        //                                     ->label('Description')
        //                                     ->required()
        //                             ]),
        //                         Tab::make('Tr')
        //                             ->schema([
        //                                 Textarea::make('description.tr')
        //                                     ->label('Aciqlama')
        //                                     ->required()
        //                             ])
        //                     ]),
        //             ])
        //     ]);