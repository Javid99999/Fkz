<?php

namespace App\Filament\Resources\Certifications\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CertificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),


                SpatieMediaLibraryFileUpload::make('certification')
                        ->label('Fotoğraflar')
                        ->collection('certification')
                        ->image()
                        ->multiple()
                        ->preserveFilenames()
                        ->disk('public')
                        ->visibility('certification'),

            ]);
    }
}
