<?php

namespace App\Filament\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_tr')
                    ->label('Attibute ismi(Tr)'),
                TextColumn::make('name_en')
                    ->label('Attribute Name (En)'),
               TextColumn::make('categories.name')
                    ->label('Iliskili alt kategoriler')
                    ->badge() // her category için badge çıkarır
                    ->separator(', '),

                TextColumn::make('property_type')->label('Type'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Delete Property')
                    ->modalDescription('Are you sure you would like to delete this property? This cannot be undone.')
                    ->modalSubmitActionLabel('Yes, delete it')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('The property deleted')
                            ->body('The property value has been deleted successfully.')
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
