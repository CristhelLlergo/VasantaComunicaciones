<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinanzasResource\Pages;
use App\Filament\Resources\FinanzasResource\RelationManagers\MovimientosRelationManager;
use App\Models\Finanzas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinanzasResource extends Resource
{
    protected static ?string $model = Finanzas::class;
    // protected static ?string $navigationGroup = 'Administración Financiera'; 
    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('id_site')
                ->label('Nombre del Sitio')
                ->relationship('operaciones', 'site_name')  // Asegúrate de que la relación 'operacion' esté bien definida en el modelo
                ->required(),
            

            DatePicker::make('date')
                ->label('Fecha')
                ->default(now()->subDay()->startOfDay())
                ->required(),

            Select::make('movement')
                ->label('Movimiento')
                ->options([
                    'ingreso' => 'Ingreso',
                    'egreso' => 'Egreso',
                ])
                ->required(),

            Select::make('movement_type')
                ->label('Tipo de Movimiento')
                ->options([
                    'comparticion_infraestructura' => 'Compartición de Infraestructura (Altán)',
                    'renta_espacio_torre_cfe' => 'Renta de espacio en torre (CFE-TEIT)',
                    'pago_energia_electrica' => 'Pago de energía eléctrica',
                    'pago_renta_terreno' => 'Pago de renta de terreno',
                    'pago_renta_espacio_torre' => 'Pago de renta de espacio en torre',
                    'pago_transmision_datos' => 'Pago de transmisión de datos (Satelital)',
                    'pago_software_altan' => 'Pago anual de software (Altán)',
                    'pago_penalizaciones' => 'Pago de penalizaciones (Altán o CFE-TEIT)',
                    'pago_viaticos' => 'Pago de viáticos',
                    'insumos_mantenimiento' => 'Insumos para Mantenimientos Preventivos y/o Correctivos',
                ])
                ->required(),

            TextInput::make('amount')
                ->label('Monto')
                ->numeric()
                ->required(),

            DatePicker::make('date_of_movement')
                ->label('Fecha de Movimiento')
                ->required(),
            DatePicker::make('expiration_date')
                ->label('Fecha de Expiración')
                ->required()
                ->after('date_of_movement') 
                ->required()
                ->rules(['after_or_equal:date_of_movement']),

            Select::make('status')
                ->label('Estado')
                ->options([
                    'pagado' => 'Pagado',
                    'no pagado' => 'No Pagado',
                ])
                ->required(),
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        
            ->columns([

            TextColumn::make('operaciones.site_name')  
                ->label('Nombre del Sitio')
                ->sortable()
                ->searchable(),
            TextColumn::make('date')
                ->label('Fecha')
                ->sortable()
                ->searchable()
                ->date(),

            TextColumn::make('movement')
                ->label('Movimiento')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'ingreso' => 'Ingreso',
                    'egreso' => 'Egreso',
                    default => 'Desconocido',
                }),

            TextColumn::make('movement_type')
                ->label('Tipo de Movimiento')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'comparticion_infraestructura' => 'Compartición de Infraestructura (Altán)',
                    'renta_espacio_torre_cfe' => 'Renta de espacio en torre (CFE-TEIT)',
                    'pago_energia_electrica' => 'Pago de energía eléctrica',
                    'pago_renta_terreno' => 'Pago de renta de terreno',
                    'pago_renta_espacio_torre' => 'Pago de renta de espacio en torre',
                    'pago_transmision_datos' => 'Pago de transmisión de datos (Satelital)',
                    'pago_software_altan' => 'Pago anual de software (Altán)',
                    'pago_penalizaciones' => 'Pago de penalizaciones (Altán o CFE-TEIT)',
                    'pago_viaticos' => 'Pago de viáticos',
                    'insumos_mantenimiento' => 'Insumos para Mantenimientos Preventivos y/o Correctivos',
                    default => 'Desconocido',
                }),

            TextColumn::make('amount')
                ->label('Monto')
                ->sortable()
                ->searchable()
                ->money('MXN'),

            TextColumn::make('date_of_movement')
                ->label('Fecha de Movimiento')
                ->sortable()
                ->searchable()
                ->date(),

            TextColumn::make('expiration_date')
                ->label('Fecha de Expiración')
                ->sortable()
                ->searchable()
                ->date(),

            TextColumn::make('status')
                ->label('Estado')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pagado' => 'success',
                    'no pagado' => 'danger',
                    default => 'gray',
                    
                }),
                
            ])
            ->emptyStateHeading('No hay registros financieros disponibles')
            ->emptyStateDescription('Actualmente no hay datos de finanzas registrados. Por favor, agrega nuevos movimientos financieros para empezar a gestionar la información.')

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
            'index' => Pages\ListFinanzas::route('/'),
            'create' => Pages\CreateFinanzas::route('/create'),
            'edit' => Pages\EditFinanzas::route('/{record}/edit'),
        ];
    }
}
