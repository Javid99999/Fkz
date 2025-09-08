<?php

namespace App\Filament\Resources\ProductStatements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductStatementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('productStatement.product.name')
                    ->numeric()
                    ->sortable(),
                
                TextColumn::make('productStatement.statement.name')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('code')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('description')

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
