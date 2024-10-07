<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluacionesResource\Pages;
use App\Models\Evaluaciones;
use App\Models\Operaciones; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;

class EvaluacionesResource extends Resource
{
    protected static ?string $model = Evaluaciones::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Select::make('id_site')
                ->label('Nombre del Sitio')
                ->relationship('operacion', 'site_name')
                ->required()
                ->reactive() 
                ->afterStateUpdated(function ($state, callable $set) {
                    $operacion = Operaciones::find($state);
                    if ($operacion) {
                        
                        $set('event_type', $operacion->event_type);
                        $set('opening_date', $operacion->opening_date);
                        $set('event_status', $operacion->event_status);
                    }
                }),

            Select::make('id_users')
                ->label('Usuario')
                ->relationship('user', 'name')
                ->required(),

                DatePicker::make('date')
                ->label('Fecha')
                ->default(now()) 
                ->required(),
            
            Select::make('event_type')
                ->label('Tipo de Evento')
                ->options([
                    'preventivo' => 'Mantenimiento Preventivo',
                    'correctivo' => 'Mantenimiento Correctivo',
                ])
                ->required(),

            DatePicker::make('opening_date')
                ->label('Fecha de Apertura del Evento')
                ->required(),

            Select::make('event_status')
                ->label('Estatus del Evento')
                ->options([
                    'abierto' => 'Abierto',
                    'cerrado' => 'Cerrado',
                ])
                ->required(),

            RichEditor::make('observations')
                ->label('Observaciones')
                ->required()
                ->columnSpanFull(),
        ]);
}
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('operacion.site_name') 
                    ->label('Nombre del Sitio')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date')
                    ->label('Fecha')
                    ->sortable()
                    ->searchable()
                    ->date('d/m/Y'),

                TextColumn::make('event_type')
                    ->label('Tipo de Evento')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'preventivo' => 'Mantenimiento Preventivo',
                        'correctivo' => 'Mantenimiento Correctivo',
                        default => 'Desconocido',
                    }),

                TextColumn::make('opening_date')
                    ->label('Fecha de Apertura del Evento')
                    ->sortable()
                    ->searchable()
                    ->date('d/m/Y'),

                TextColumn::make('event_status')
                    ->label('Estatus del Evento')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'abierto' => 'success',
                        'cerrado' => 'danger',
                        default => 'gray',
                    }),

                    TextColumn::make('observations')
                    ->label('Observaciones')
                    ->sortable()
                    ->searchable()
                    ->limit(50)
                    ->html(),
                
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvaluaciones::route('/'),
            'create' => Pages\CreateEvaluaciones::route('/create'),
            'edit' => Pages\EditEvaluaciones::route('/{record}/edit'),
        ];
    }
}
