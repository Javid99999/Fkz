<?php

namespace App\Filament\Resources\RiskLevels;

use App\Filament\Resources\RiskLevels\Pages\CreateRiskLevel;
use App\Filament\Resources\RiskLevels\Pages\EditRiskLevel;
use App\Filament\Resources\RiskLevels\Pages\ListRiskLevels;
use App\Filament\Resources\RiskLevels\Schemas\RiskLevelForm;
use App\Filament\Resources\RiskLevels\Tables\RiskLevelsTable;
use App\Models\RiskLevel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RiskLevelResource extends Resource
{
    protected static ?string $model = RiskLevel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RiskLevelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RiskLevelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-exclamation-triangle'; 
    }

    public static function getNavigationGroup(): string
    {
        return 'Guvenlik standartlari (SDS)';
    }

    public static function getNavigationLabel(): string
    {
        return 'Risk seviyesi olustur';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRiskLevels::route('/'),
            'create' => CreateRiskLevel::route('/create'),
            'edit' => EditRiskLevel::route('/{record}/edit'),
        ];
    }
}
