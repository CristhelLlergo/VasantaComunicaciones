<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuariosResource\Pages;
use App\Filament\Resources\UsuarioResource\RelationManagers\RolesRelationManager;
use App\Models\User; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class UsuariosResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Seguridad'; 
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->autofocus()
                    ->required(),
                
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->unique(ignoreRecord: true),
                
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
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
                
                TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->sortable()
                    ->searchable(),
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
            RolesRelationManager::class, 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuarios::route('/create'),
            'edit' => Pages\EditUsuarios::route('/{record}/edit'),
        ];
    }
}
