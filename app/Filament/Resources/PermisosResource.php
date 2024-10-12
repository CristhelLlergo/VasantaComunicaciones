<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermisosResource\Pages;
use App\Filament\Resources\PermisosResource\RelationManagers;
use App\Models\Permisos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermisosResource extends Resource
{
    protected static ?string $model = Permisos::class;

    protected static ?string $navigationGroup = 'Seguridad';

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name') 
                ->label('Nombre')
                ->autofocus()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nombre')
                ->sortable()
                ->searchable(),
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
            'index' => Pages\ListPermisos::route('/'),
            'create' => Pages\CreatePermisos::route('/create'),
            'edit' => Pages\EditPermisos::route('/{record}/edit'),
        ];
    }
}
