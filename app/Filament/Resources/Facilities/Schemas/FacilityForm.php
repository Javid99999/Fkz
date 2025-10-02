<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),

                SpatieMediaLibraryFileUpload::make('facility')
                        ->label('Fotoğraflar')
                        ->collection('facility')
                        ->image()
                        ->multiple()
                        ->preserveFilenames()
                        ->disk('public')
                        ->visibility('public'),   
            ]);
    }
}
