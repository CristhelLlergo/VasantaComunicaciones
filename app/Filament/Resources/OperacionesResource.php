<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperacionesResource\Pages;
use App\Models\Operaciones;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;

class OperacionesResource extends Resource
{
    protected static ?string $model = Operaciones::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('site_name')
                ->label('Nombre del Sitio')
                ->required(),

            DatePicker::make('registration_timestamp')
                ->label('Fecha y Hora de Registro')
                ->required()
                ->default(now()),

            Select::make('event_type')
                ->label('Tipo de Evento')
                ->options([
                    'preventivo' => 'Mantenimiento Preventivo',
                    'correctivo' => 'Mantenimiento Correctivo',
                ])
                ->required(),

            Select::make('action')
                ->label('Acción')
                ->options([
                    'inspeccion_zapatas' => 'Inspección de zapatas para retenida',
                    'inspeccion_base' => 'Inspección de base para torre',
                    'inspeccion_torre' => 'Inspección de Torre de telecomunicaciones',
                   
                ])
                ->required(),

            Select::make('id_users')
                ->label('Usuario')
                ->relationship('user', 'name') 
                ->required(),

            Select::make('position')
                ->label('Puesto')
                ->options([
                    'coordinador_infraestructura' => 'Coordinador de Infraestructura',
                    'tecnico_infraestructura' => 'Técnico de Infraestructura',
                ])
                ->required(),

            DatePicker::make('opening_date')
                ->label('Fecha de Apertura del Evento')
                ->required(),

            DatePicker::make('closing_date')
                ->label('Fecha de Cierre del Evento')
                ->nullable(),

            Select::make('event_status')
                ->label('Estatus del Evento')
                ->options([
                    'abierto' => 'Abierto',
                    'cerrado' => 'Cerrado',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')
                    ->label('Nombre del Sitio')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('registration_timestamp')
                    ->label('Fecha y Hora de Registro')
                    ->sortable()
                    ->searchable()
                    ->date('d/m/Y H:i:s'),

                TextColumn::make('event_type')
                    ->label('Tipo de Evento')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'preventivo' => 'Mantenimiento Preventivo',
                        'correctivo' => 'Mantenimiento Correctivo',
                        default => 'Desconocido',
                    }),

                    TextColumn::make('action')
                    ->label('Acción')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'inspeccion_zapatas' => 'Inspección de zapatas para retenida',
                        'inspeccion_base' => 'Inspección de base para torre',
                        'inspeccion_torre' => 'Inspección de Torre de telecomunicaciones',
                        default => 'Desconocido',
                    }),
                TextColumn::make('position')
                    ->label('Puesto')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'coordinador_infraestructura' => 'Coordinador de Infraestructura',
                        'tecnico_infraestructura' => 'Técnico de Infraestructura',
                        default => 'Desconocido',
                    }),

                TextColumn::make('opening_date')
                    ->label('Fecha de Apertura del Evento')
                    ->sortable()
                    ->searchable()
                    ->date(),

                TextColumn::make('closing_date')
                    ->label('Fecha de Cierre del Evento')
                    ->sortable()
                    ->searchable()
                    ->date(),

                TextColumn::make('event_status') 
                    ->label('Estatus del Evento') 
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'abierto' => 'success', 
                        'cerrado' => 'danger', 
                        default => 'gray',
                    }),
            ])
            ->emptyStateHeading('No hay registros de operaciones disponibles')
            ->emptyStateDescription('Actualmente no hay datos operativos registrados. Por favor, agrega nuevas operaciones para empezar a gestionar la información.')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOperaciones::route('/'),
            'create' => Pages\CreateOperaciones::route('/create'),
            'edit' => Pages\EditOperaciones::route('/{record}/edit'),
        ];
    }
}
