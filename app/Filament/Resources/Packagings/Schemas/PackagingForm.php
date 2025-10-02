<?php

namespace App\Filament\Resources\Packagings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PackagingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('packaging')
                    ->required(),
            ]);
    }
}
