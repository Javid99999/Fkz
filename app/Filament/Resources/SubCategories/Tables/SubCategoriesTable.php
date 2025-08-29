<?php

namespace App\Filament\Resources\SubCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Alt Kategori')
                    ->getStateUsing(fn ($record) => $record->getTranslation('name', 'en'))
                    ->searchable(
                        query: fn ($query, $search) => $query->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.en'))) LIKE ?", ["%{$search}%"])
                    ),
                TextColumn::make('parent.name')->label('Üst Kategori'),
                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Alt Kategori Silme Basvurusu')
                    ->modalDescription('Bu Alt Kategory-i silmek istedigine emin misin?')
                    ->modalSubmitActionLabel('Evet, Eminim')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Kateogri deyeri silindi')
                            ->body('Kategori basari ile silindi :/')
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
