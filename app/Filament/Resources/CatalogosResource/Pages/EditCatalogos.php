<?php

namespace App\Filament\Resources\CatalogosResource\Pages;

use App\Filament\Resources\CatalogosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatalogos extends EditRecord
{
    protected static string $resource = CatalogosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
