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
            ->label('Tipo de evento')
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
                'inspeccion_registro_cableado' => 'Inspección de Registro para cableado eléctrico y fibra óptica',
                'inspeccion_linea_vida' => 'Inspección de Línea de vida',
                'inspeccion_registro_pararrayos' => 'Inspección de Registro para sistema para aparta rayos',
                'inspeccion_registro_tierras' => 'Inspección de Registro para sistema de tierras físicas para protección de equipos de telecomunicaciones',
                'inspeccion_pintura_torre' => 'Inspección de Pintura de tramos de torre',
                'reporte_cfe' => 'Reporte a CFE por falla de luz',
                'reporte_noc_altan' => 'Reporte al NOC de Altán por falla en nodo agregador',
                'reporte_infraestructura' => 'Reporte a Infraestructura por falla de enlace de MO',
                'reporte_proveedor_satelital' => 'Reporte a proveedor satelital por falla de enlace',
                'reporte_noc_estado_tiempo' => 'Reporte al NOC de Altán el estado del tiempo',
                'colocacion_planta_emergencia' => 'Colocación de planta de emergencia',
                'instalacion_tierras' => 'Instalación de sistema de tierras',
                'instalacion_pararrayos' => 'Instalación de sistema de pararrayos',
                'instalacion_microondas' => 'Instalación de enlace de microondas',
                'instalacion_luces_obstruccion' => 'Instalación de sistema de luces de obstrucción',
                'reparacion_cimentacion' => 'Reparación de cimentación de dado de anclaje',
                'reparacion_retenidas' => 'Reparación de retenidas',
                 ])
            ->required(),
           
        Select::make('id_users')
            ->label('Usuario')
            ->relationship('usuario', 'name') 
            ->required(),
   
        

        Select::make('position')
            ->label('Puesto')
            ->options([
                'coordinador_infraestructura' => 'Coordinador de Infraestructura',
                'tecnico_infraestructura' => 'Técnico de Infraestructura',
            ])
            ->required(),

        DatePicker::make('opening_date')
            ->label('Fecha de apertura del evento')
            ->required(),

        DatePicker::make('closing_date')
            ->label('Fecha de cierre del evento'),

        Select::make('event_status')
            ->label('Estatus del evento')
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
                ->label('Tipo de evento')
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
                    'inspeccion_registro_cableado' => 'Inspección de Registro para cableado eléctrico y fibra óptica',
                    'inspeccion_linea_vida' => 'Inspección de Línea de vida',
                    'inspeccion_registro_pararrayos' => 'Inspección de Registro para sistema para aparta rayos',
                    'inspeccion_registro_tierras' => 'Inspección de Registro para sistema de tierras físicas para protección de equipos de telecomunicaciones',
                    'inspeccion_pintura_torre' => 'Inspección de Pintura de tramos de torre',
                    'reporte_cfe' => 'Reporte a CFE por falla de luz',
                    'reporte_noc_altan' => 'Reporte al NOC de Altán por falla en nodo agregador',
                    'reporte_infraestructura' => 'Reporte a Infraestructura por falla de enlace de MO',
                    'reporte_proveedor_satelital' => 'Reporte a proveedor satelital por falla de enlace',
                    'reporte_noc_estado_tiempo' => 'Reporte al NOC de Altán el estado del tiempo',
                    'colocacion_planta_emergencia' => 'Colocación de planta de emergencia',
                    'instalacion_tierras' => 'Instalación de sistema de tierras',
                    'instalacion_pararrayos' => 'Instalación de sistema de pararrayos',
                    'instalacion_microondas' => 'Instalación de enlace de microondas',
                    'instalacion_luces_obstruccion' => 'Instalación de sistema de luces de obstrucción',
                    'reparacion_cimentacion' => 'Reparación de cimentación de dado de anclaje',
                    'reparacion_retenidas' => 'Reparación de retenidas',
                    default => 'Desconocido',
                }),

                TextColumn::make('users.name')
                ->label('Usuario'),

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
                ->label('Fecha de apertura del evento')
                ->sortable()
                ->searchable()
                ->date(),

            TextColumn::make('closing_date')
                ->label('Fecha de cierre del evento')
                ->sortable()
                ->searchable()
                ->date(),

            TextColumn::make('event_status') 
                ->label('Estatus del evento') 
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'abierto' => 'success', 
                    'cerrado' => 'danger', 
                    default => 'gray',
                }),
            ])
            ->emptyStateHeading('No hay registros de operaciones disponibles')
            ->emptyStateDescription('Actualmente no hay datos operativos registrados. Por favor, agrega nuevas operaciones para empezar a gestionar la información.')
            ->filters([
                
            ])
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
        return [
            
        ];
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
