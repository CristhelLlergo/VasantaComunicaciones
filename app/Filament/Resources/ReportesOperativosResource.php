<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportesOperativosResource\Pages;
use App\Models\ReportesOperativos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

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
                    ->relationship('usuario', 'name') 
                    ->required(),

                Select::make('id_site')
                    ->label('Nombre del Sitio')
                    ->relationship('operacion', 'site_name') 
                    ->required(),

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
                    ->directory('documentos')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('usuario.name') // Asegúrate de usar la relación correcta
                ->label('Usuario')
                ->sortable(),
                TextColumn::make('operacion.site_name')
                    ->label('Sitio'),
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
                    ->url(fn($record) => asset('storage/' . $record->pdf_document))
                    ->openUrlInNewTab(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Descargar PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (ReportesOperativos $record) {
                        $filePath = storage_path('app/public/documentos/' . $record->pdf_document);

                        if (!file_exists($filePath)) {
                            return redirect()->back()->withErrors('El archivo no existe.');
                        }

                        return response()->download($filePath, $record->pdf_document);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
