<?php

namespace App\Filament\Resources\Pictograms;

use App\Filament\Resources\Pictograms\Pages\CreatePictogram;
use App\Filament\Resources\Pictograms\Pages\EditPictogram;
use App\Filament\Resources\Pictograms\Pages\ListPictograms;
use App\Filament\Resources\Pictograms\Schemas\PictogramForm;
use App\Filament\Resources\Pictograms\Tables\PictogramsTable;
use App\Models\Pictogram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PictogramResource extends Resource
{
    protected static ?string $model = Pictogram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PictogramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PictogramsTable::configure($table);
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
            'index' => ListPictograms::route('/'),
            'create' => CreatePictogram::route('/create'),
            'edit' => EditPictogram::route('/{record}/edit'),
        ];
    }
}
