<?php

namespace App\Filament\Resources\Statements;

use App\Filament\Resources\Statements\Pages\CreateStatement;
use App\Filament\Resources\Statements\Pages\EditStatement;
use App\Filament\Resources\Statements\Pages\ListStatements;
use App\Filament\Resources\Statements\Schemas\StatementForm;
use App\Filament\Resources\Statements\Tables\StatementsTable;
use App\Models\Statement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StatementResource extends Resource
{
    protected static ?string $model = Statement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return StatementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StatementsTable::configure($table);
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-shield-check'; 
    }

    public static function getNavigationGroup(): string
    {
        return 'Guvenlik standartlari (SDS)';
    }

    public static function getNavigationLabel(): string
    {
        return 'Statement yarat';
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
            'index' => ListStatements::route('/'),
            'create' => CreateStatement::route('/create'),
            'edit' => EditStatement::route('/{record}/edit'),
        ];
    }
}
