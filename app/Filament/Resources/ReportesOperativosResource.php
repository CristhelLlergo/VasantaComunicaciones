<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportesOperativosResource\Pages;
use App\Filament\Resources\ReportesOperativosResource\RelationManagers;
use App\Models\ReportesOperativos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportesOperativosResource extends Resource
{
    protected static ?string $model = ReportesOperativos::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            Select::make('id_users')
                ->label('Usuario')
                ->relationship('users', 'name')
                ->required()
                ->searchable(),

            Select::make('id_site')
                ->label('Sitio')
                ->relationship('site', 'name')
                ->required()
                ->searchable(),

            Select::make('event_type')
                ->label('Tipo de Evento')
                ->options([
                    'preventivo' => 'Mantenimiento Preventivo',
                    'correctivo' => 'Mantenimiento Correctivo',
                ])
                ->required(),

            DatePicker::make('date')
                ->label('Fecha del Evento')
                ->required(),
                
                FileUpload::make('pdf_document')
                ->label('Documento PDF')
                ->acceptedFileTypes(['application/pdf'])
                ->directory('documento') 
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                
                TextColumn::make('users.name')
                ->label('Usuario'),
              
                TextColumn::make('site.name')
                ->label('Usuario'),
                
                TextColumn::make('event_type')
                ->label('Tipo de Evento')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'preventivo' => 'Mantenimiento Preventivo',
                    'correctivo' => 'Mantenimiento Correctivo',
                    default => 'Desconocido',
                }),
                
                TextColumn::make('date')
                ->label('Fecha')
                ->sortable()
                ->searchable()
                ->date(),

                TextColumn::make('pdf_document')
                    ->label('Documento PDF')
                    ->url(fn($record) => asset('storage/' . $record->documento_pdf))
                    ->openUrlInNewTab(),
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReportesOperativos::route('/'),
            'create' => Pages\CreateReportesOperativos::route('/create'),
            'edit' => Pages\EditReportesOperativos::route('/{record}/edit'),
        ];
    }
}
