<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }


    // protected function handleRecordUpdate(Model $record, array $data): Model
    // {
    //     if ($data['value_parse_type'] === 'text') {
    //         $data['numeric'] = null;
    //     }

    //     if ($data['value_parse_type'] === 'numeric') {
    //         $data['value'] = null;
    //     }

    //     $record->update($data);

    //     return $record;
    // }
}
