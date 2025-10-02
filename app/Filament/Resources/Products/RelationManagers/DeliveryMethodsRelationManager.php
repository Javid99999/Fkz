<?php

namespace App\Filament\Resources\Products\RelationManagers;

use App\Enum\AvailabilityType;
use App\Filament\Resources\DeliveryMethods\DeliveryMethodResource;
use App\Models\DeliveryMethod;
use Closure;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;

class DeliveryMethodsRelationManager extends RelationManager
{
    protected static string $relationship = 'deliveryMethods';
    protected static ?string $recordTitleAttribute = 'code';

    protected static ?string $relatedResource = DeliveryMethodResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->badge(),
                
                
                TextColumn::make('pivot.additional_cost')
                    ->label('Additional Cost')
                    ->money(fn ($record) => $record->pivot->currency ?? 'USD'),

                
                    
                TextColumn::make('pivot.estimated_days_min')
                    ->label('Est. Days')
                    ->formatStateUsing(function ($record) {
                        $min = $record->pivot->estimated_days_min;
                        $max = $record->pivot->estimated_days_max;
                        if ($min && $max) return "{$min}-{$max} days";
                        if ($min) return "{$min}+ days";
                        if ($max) return "up to {$max} days";
                        return '-';
                    }),
                
            ])
            ->headerActions([
                AttachAction::make()
                // ->mutateFormDataUsing(function (array $data) {
                //     if (isset($data['custom_notes']) && is_array($data['custom_notes'])) {
                //         $data['custom_notes'] = json_encode($data['custom_notes']);
                //     }
                //     if (isset($data['custom_attributes']) && is_array($data['custom_attributes'])) {
                //         $data['custom_attributes'] = json_encode($data['custom_attributes']);
                //     }
                //     if (isset($data['location_name']) && is_array($data['location_name'])) {
                //         $data['location_name'] = json_encode($data['location_name']);
                //     }
                //     // if (isset($data['location_name']) && is_array($data['custom_attributes'])) {
                //     //     $data['custom_attributes'] = json_encode($data['custom_attributes']);
                //     // }
                //     return $data;
                // })
                ->form([
                    Select::make('recordId') // Manuel record seçimi
                        ->label('Delivery Method')
                        ->options(DeliveryMethod::pluck('code', 'id'))
                        ->required()
                        ->searchable(),

                    Grid::make(2)
                        ->schema([

                            Select::make('availability_type')
                                ->label('Availability Type')
                                ->options(
                                    collect(AvailabilityType::cases())
                                        ->mapWithKeys(fn ($case) => [
                                            $case->value => $case->label(app()->getLocale())
                                        ])
                                        ->toArray()
                                )
                                ->nullable()
                                ->required(fn ($get) => filled($get('location_code'))),
                            Tabs::make('language_tabs')
                                ->tabs([
                                    Tab::make('En')
                                        ->schema([
                                            TextInput::make('location_name.en')
                                            ->label('Departure Point (EN)')
                                            ->nullable()
                                            ->required(fn ($get) => filled($get('location_name.tr')) && filled($get('availability_type')))

                                        ]),
                                    Tab::make('Tr')
                                    ->schema([
                                        TextInput::make('location_name.tr')
                                        ->label('Yola Çıkış Noktası  (TR)')
                                        ->nullable()
                                        ->required(fn ($get) => filled($get('location_name.en')) && filled($get('availability_type')))

                                        
                                    ])
                                ]),


                            Tabs::make('language_tabs')
                                ->tabs([
                                    Tab::make('En')
                                        ->schema([
                                            TextInput::make('specific_details.en')
                                            ->label('Available for (EN)')
                                            ->nullable()
                                            ->required(fn ($get) => filled($get('specific_details.tr')) && filled($get('availability_type')))

                                        ]),
                                    Tab::make('Tr')
                                    ->schema([
                                        TextInput::make('specific_details.tr')
                                        ->label('Nerelere uygun (TR)')
                                        ->nullable()
                                        ->required(fn ($get) => filled($get('specific_details.en')) && filled($get('availability_type')))

                                        
                                    ])
                                ]),

                            // TextInput::make('location_code')
                            //     ->nullable()
                            //     ->required(fn ($get) => filled($get('availability_type'))),
                        
                    


                        
                        ]),
                    


                    // TextInput::make('additional_cost')->default(0),
                    // Select::make('currency')->options(['USD'=>'USD','EUR'=>'EUR','TRY'=>'TRY']),
                    // TextInput::make('estimated_days_min')->numeric(),
                    // TextInput::make('estimated_days_max')->numeric(),

                   Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                TextInput::make('custom_notes.en')
                                ->label('Delivery Note (EN)')
                                ->nullable()
                                ->required(fn ($get) => filled($get('custom_notes.tr')))

                            ]),
                        Tab::make('Tr')
                        ->schema([
                            TextInput::make('custom_notes.tr')
                            ->label('Tesliman Notu (TR)')
                            ->nullable()
                            ->required(fn ($get) => filled($get('custom_notes.en')))

                            
                        ])
                    ]),
                    Tabs::make('language_tabs')
                    ->tabs([
                        Tab::make('En')
                            ->schema([
                                TextInput::make('custom_attributes.en')
                                ->label('Order not (EN)')
                                ->nullable()
                                ->required(fn ($get) => filled($get('custom_attributes.tr')))
                            ]),
                        Tab::make('Tr')
                        ->schema([
                            TextInput::make('custom_attributes.tr')
                            ->label('Siparis notu (TR)')
                            ->nullable()
                            ->required(fn ($get) => filled($get('custom_attributes.en')))
                            ])
                    ])
                    
                ])
            ])
            ->actions([
            




                EditAction::make(),
                DetachAction::make(),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->columns([
            Select::make('delivery_method_id')
                ->label('Delivery Method')
                ->options(DeliveryMethod::active()->get()->mapWithKeys(function ($method) {
                        return [$method->id => $method->code . ' - ' . $method->getTranslation('name', 'en')];
                    }))
                ->relationship('code', 'code')
                ->required(),
        ]);
    }
}


