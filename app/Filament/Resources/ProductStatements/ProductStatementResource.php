<?php

namespace App\Filament\Resources\ProductStatements;

use App\Filament\Resources\ProductStatements\Pages\CreateProductStatement;
use App\Filament\Resources\ProductStatements\Pages\EditProductStatement;
use App\Filament\Resources\ProductStatements\Pages\ListProductStatements;
use App\Filament\Resources\ProductStatements\Schemas\ProductStatementForm;
use App\Filament\Resources\ProductStatements\Tables\ProductStatementsTable;
use App\Models\ProductStatement;
use App\Models\Securecode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductStatementResource extends Resource
{
    protected static ?string $model = Securecode::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductStatementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductStatementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductStatements::route('/'),
            'create' => CreateProductStatement::route('/create'),
            'edit' => EditProductStatement::route('/{record}/edit'),
        ];
    }
}
