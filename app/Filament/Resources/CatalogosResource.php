<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogosResource\Pages;
use App\Models\Catalogos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;

class CatalogosResource extends Resource
{
    protected static ?string $model = Catalogos::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('catalog_name')
                    ->label('Nombre Catálogo')
                    ->required(),

                Select::make('id_users')
                    ->label('Usuario')
                    ->relationship('usuario', 'name') 
                    ->required(),
           
                FileUpload::make('pdf_document')
                    ->label('Documento PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('catalogos_pdfs') 
                    ->preserveFilenames() 
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('catalog_name')
                    ->label('Nombre del Catálogo')
                    ->sortable()
                    ->searchable(),

                    TextColumn::make('usuario.name')
                    ->label('Usuario'),

                TextColumn::make('pdf_document')
                    ->label('PDF')
                    ->url(fn($record) => asset('storage/' . $record->pdf_document))
                    ->openUrlInNewTab(),
            ])
            ->emptyStateHeading('No hay catálogos disponibles')
            ->emptyStateDescription('Actualmente no hay datos de catálogos registrados. Por favor, agrega nuevos catálogos para empezar a gestionar la información.')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
               
                Tables\Actions\Action::make('download')
                    ->label('Descargar PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (Catalogos $record) {  
                        $filePath = storage_path('app/public/catalogos_pdfs/' . $record->pdf_document); 

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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatalogos::route('/'),
            'create' => Pages\CreateCatalogos::route('/create'),
            'edit' => Pages\EditCatalogos::route('/{record}/edit'),
        ];
    }
}
