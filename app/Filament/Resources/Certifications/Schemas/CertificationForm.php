<?php

namespace App\Filament\Resources\Certifications\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class CertificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('name_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('name.en')
                                ->label('Certification (EN)')
                                ->required(),
                        ]),
                    Tab::make('TR')
                        ->schema([
                            TextInput::make('name.tr')
                                ->label('Sertifikasyon (TR)')
                                ->required(),
                        ]),
                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('name.az')
                                ->label('Certification (AZ)')
                                ->required(),
                        ]),
                    Tab::make('RU')
                        ->schema([
                            TextInput::make('name.ru')
                                ->label('Certification (RU)')
                                ->required(),
                        ]),
                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('name.zhcn')
                                ->label('Certification (ZH)')
                                ->required(),
                        ]),
                    Tab::make('HE')
                        ->schema([
                            TextInput::make('name.he')
                                ->label('Certification (HE)')
                                ->required(),
                        ]),
                    Tab::make('AR')
                        ->schema([
                            TextInput::make('name.ar')
                                ->label('Certification (AR)')
                                ->required(),
                        ]),
                    ]),

                Tabs::make('description_tabs')
                ->tabs([
                    Tab::make('EN')
                        ->schema([
                            TextInput::make('description.en')
                                ->label('Description (EN)')
                                ->required(),
                        ]),
                    Tab::make('TR')
                        ->schema([
                            TextInput::make('description.tr')
                                ->label('Açıklama (TR)')
                                ->required(),
                        ]),
                    Tab::make('AZ')
                        ->schema([
                            TextInput::make('description.az')
                                ->label('Description (AZ)')
                                ->required(),
                        ]),
                    Tab::make('RU')
                        ->schema([
                            TextInput::make('description.ru')
                                ->label('Description (RU)')
                                ->required(),
                        ]),
                    Tab::make('ZH')
                        ->schema([
                            TextInput::make('description.zhcn')
                                ->label('Description (ZH)')
                                ->required(),
                        ]),
                    Tab::make('HE')
                        ->schema([
                            TextInput::make('description.he')
                                ->label('Description (HE)')
                                ->required(),
                        ]),
                    Tab::make('AR')
                        ->schema([
                            TextInput::make('description.ar')
                                ->label('Description (AR)')
                                ->required(),
                        ]),
                    ]),


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
