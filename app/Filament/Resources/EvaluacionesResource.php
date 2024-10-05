<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluacionesResource\Pages;
use App\Models\Evaluaciones;
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
                    ->required(),

                Select::make('id_users')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->required(),

                DatePicker::make('date')
                    ->label('Fecha del Evento')
                    ->required(),

                Select::make('event_type')
                    ->label('Tipo de Evento')
                    ->relationship('operaciones', 'event_type')
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
                    ->hint('Translatable')
                    ->hintColor('primary')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site.site_name')
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
                    ->limit(50) 
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEvaluaciones::route('/'),
            'create' => Pages\CreateEvaluaciones::route('/create'),
            'edit' => Pages\EditEvaluaciones::route('/{record}/edit'),
        ];
    }
}
