<?php

namespace App\Filament\Resources\CatalogosResource\Pages;

use App\Filament\Resources\CatalogosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatalogos extends ListRecords
{
    protected static string $resource = CatalogosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
