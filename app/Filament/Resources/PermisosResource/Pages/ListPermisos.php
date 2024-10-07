<?php

namespace App\Filament\Resources\PermisosResource\Pages;

use App\Filament\Resources\PermisosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermisos extends ListRecords
{
    protected static string $resource = PermisosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
