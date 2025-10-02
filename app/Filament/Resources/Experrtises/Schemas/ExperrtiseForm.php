<?php

namespace App\Filament\Resources\Experrtises\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExperrtiseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),




                SpatieMediaLibraryFileUpload::make('expertise')
                        ->label('Fotoğraflar')
                        ->collection('expertise')
                        ->image()
                        ->multiple()
                        ->preserveFilenames()
                        ->disk('public')
                        ->visibility('public'),    
            ]);
    }
}
