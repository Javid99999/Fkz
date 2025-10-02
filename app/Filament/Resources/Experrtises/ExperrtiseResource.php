<?php

namespace App\Filament\Resources\Experrtises;

use App\Filament\Resources\Experrtises\Pages\CreateExperrtise;
use App\Filament\Resources\Experrtises\Pages\EditExperrtise;
use App\Filament\Resources\Experrtises\Pages\ListExperrtises;
use App\Filament\Resources\Experrtises\Schemas\ExperrtiseForm;
use App\Filament\Resources\Experrtises\Tables\ExperrtisesTable;
use App\Models\Experrtise;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExperrtiseResource extends Resource
{
    protected static ?string $model = Experrtise::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ExperrtiseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExperrtisesTable::configure($table);
    }


    public static function getNavigationGroup(): string
    {
        return 'Sirket melumati';
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
            'index' => ListExperrtises::route('/'),
            'create' => CreateExperrtise::route('/create'),
            'edit' => EditExperrtise::route('/{record}/edit'),
        ];
    }
}
