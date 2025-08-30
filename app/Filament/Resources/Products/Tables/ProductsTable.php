<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('cas_number')
                    ->searchable(),

                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('country.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('productClassifications.name')
                    ->numeric()
                    ->sortable(),
                    
                TextColumn::make('statements.name')
                    ->badge()
                    ->numeric()
                    ->sortable(),


                
                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
