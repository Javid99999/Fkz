<?php

namespace App\Filament\Resources\DeliveryResponsibilities;

use App\Filament\Resources\DeliveryResponsibilities\Pages\CreateDeliveryResponsibility;
use App\Filament\Resources\DeliveryResponsibilities\Pages\EditDeliveryResponsibility;
use App\Filament\Resources\DeliveryResponsibilities\Pages\ListDeliveryResponsibilities;
use App\Filament\Resources\DeliveryResponsibilities\Schemas\DeliveryResponsibilityForm;
use App\Filament\Resources\DeliveryResponsibilities\Tables\DeliveryResponsibilitiesTable;
use App\Models\DeliveryResponsibility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DeliveryResponsibilityResource extends Resource
{
    protected static ?string $model = DeliveryResponsibility::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DeliveryResponsibilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeliveryResponsibilitiesTable::configure($table);
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
            'index' => ListDeliveryResponsibilities::route('/'),
            'create' => CreateDeliveryResponsibility::route('/create'),
            'edit' => EditDeliveryResponsibility::route('/{record}/edit'),
        ];
    }
}
