<?php

namespace App\Filament\Resources\OperacionesResource\Pages;

use App\Filament\Resources\OperacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOperaciones extends ListRecords
{
    protected static string $resource = OperacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
