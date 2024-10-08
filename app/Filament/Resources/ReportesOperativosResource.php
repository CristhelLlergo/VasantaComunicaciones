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
                    ->relationship('user', 'name')
                    ->required(),

                Select::make('id_site')
                    ->label('Nombre del Sitio')
                    ->relationship('operaciones', 'site_name')  // Asegúrate de que la relación 'operacion' esté bien definida en el modelo
                    ->required(),

                Select::make('event_type')
                    ->label('Tipo de Evento')
                    ->options([
                        'preventivo' => 'Mantenimiento Preventivo',
                        'correctivo' => 'Mantenimiento Correctivo',
                    ])
                    ->required(),

                DatePicker::make('date')
                    ->label('Fecha')
                    ->default(now()) 
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
                TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('operaciones.site_name')  
                    ->label('Nombre del Sitio')
                    ->sortable()
                    ->searchable(),
                    
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
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Descargar PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (ReportesOperativos $record) {
                        $filePath = storage_path('app/public/' . $record->pdf_document);
                        
                        if (file_exists($filePath)) {
                            return response()->download($filePath);
                        } else {
                            session()->flash('notification', [
                                'message' => 'El archivo PDF no se encontró.',
                                'type' => 'danger',
                            ]);

                            return redirect()->back();
                        }
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
